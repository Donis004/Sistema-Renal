<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alergia;
use App\Models\Comorbilidad;
use App\Models\LimitesNutricionales;

class PerfilPacienteController extends Controller
{
    // Mostrar formulario wizard para completar perfil
    public function completar()
    {
        $usuario = Auth::user();
        $paciente = $usuario->pacientes()->first();

        // Si ya está completo, redirigir al dashboard (protección extra)
        if ($paciente && $paciente->perfil_completo) {
            return redirect()->route('paciente.dashboard');
        }

        $alergias = Alergia::all();
        $comorbilidades = Comorbilidad::all();

        return view('paciente.perfil.completar', compact('alergias', 'comorbilidades', 'paciente'));
    }

    // Guardar el perfil completo y calcular límites
    public function guardarPerfil(Request $request)
    {
        $request->validate([
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:M,F,O',
            'peso_kg' => 'required|numeric|min:30|max:250',
            'presion_arterial' => 'required|string|max:10', // Ej: 120/80
            'egfr' => 'required|numeric|min:1|max:150',
            'alergias' => 'array',
            'comorbilidades' => 'array',
        ]);

        $usuario = Auth::user();
        $paciente = $usuario->pacientes()->first();

        // Determinar la etapa ERC basada en el eGFR (fórmula estándar médica)
        $egfr = $request->egfr;
        $etapa_erc = '1';
        if ($egfr >= 90) { $etapa_erc = '1'; }
        elseif ($egfr >= 60) { $etapa_erc = '2'; }
        elseif ($egfr >= 45) { $etapa_erc = '3a'; }
        elseif ($egfr >= 30) { $etapa_erc = '3b'; }
        elseif ($egfr >= 15) { $etapa_erc = '4'; }
        else { $etapa_erc = '5'; }

        // Actualizar datos del paciente
        $paciente->update([
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo' => $request->sexo,
            'peso_kg' => $request->peso_kg,
            'presion_arterial' => $request->presion_arterial,
            'egfr' => $request->egfr,
            'etapa_erc' => $etapa_erc,
            'perfil_completo' => true, // ¡Clave para dejarlo pasar!
        ]);

        // Guardar relaciones (Alergias y Comorbilidades)
        if ($request->has('alergias')) {
            $paciente->alergias()->sync($request->alergias);
        }
        if ($request->has('comorbilidades')) {
            $paciente->comorbilidades()->sync($request->comorbilidades);
        }

        // --- CÁLCULO DE LÍMITES NUTRICIONALES AUTOMÁTICO (HU-02) ---
        // Estos cálculos son aproximaciones estándar para dieta renal. 
        // Proteína: 0.6g a 0.8g por kg de peso (dependiendo de la etapa)
        // Potasio: ~2000mg, Fósforo: ~800mg a 1000mg, Sodio: ~2000mg, Líquidos: ~1000ml a 1500ml
        
        $factorProteina = ($etapa_erc == '4' || $etapa_erc == '5') ? 0.6 : 0.8;
        $proteinaDiaria = $request->peso_kg * $factorProteina;

        LimitesNutricionales::create([
            'id_paciente' => $paciente->id_paciente,
            'potasio_mg' => 2000, 
            'fosforo_mg' => ($etapa_erc == '4' || $etapa_erc == '5') ? 800 : 1000,
            'sodio_mg' => 2000,
            'liquidos_ml' => 1200, // Ajustable después
            'proteina_g' => $proteinaDiaria,
            'origen' => 'AUTOMATICO',
            'justificacion' => 'Cálculo inicial basado en etapa ' . $etapa_erc . ' y peso.',
        ]);

        return redirect()->route('paciente.dashboard')->with('success', '¡Perfil completado exitosamente! Tus límites nutricionales han sido calculados.');
    }

    // Mostrar el perfil y los límites actuales
    public function show()
    {
        $usuario = Auth::user();
        $paciente = $usuario->pacientes()->with(['alergias', 'comorbilidades', 'limitesNutricionales'])->first();
        $limites = $paciente->limitesNutricionales()->latest('fecha_actualizacion')->first();

        return view('paciente.perfil.show', compact('paciente', 'usuario', 'limites'));
    }

    // Mostrar formulario para editar datos físicos
    public function edit()
    {
        $usuario = Auth::user();
        $paciente = $usuario->pacientes()->first();

        return view('paciente.perfil.edit', compact('paciente', 'usuario'));
    }

    // Actualizar datos y recalcular límites si es necesario
    public function update(Request $request)
    {
        $request->validate([
            'peso_kg' => 'required|numeric|min:30|max:250',
            'presion_arterial' => 'required|string|max:10',
            'egfr' => 'required|numeric|min:1|max:150',
        ]);

        $paciente = Auth::user()->pacientes()->first();

        // 1. Recalcular la etapa ERC por si el eGFR cambió
        $egfr = $request->egfr;
        $etapa_erc = '1';
        if ($egfr >= 90) { $etapa_erc = '1'; }
        elseif ($egfr >= 60) { $etapa_erc = '2'; }
        elseif ($egfr >= 45) { $etapa_erc = '3a'; }
        elseif ($egfr >= 30) { $etapa_erc = '3b'; }
        elseif ($egfr >= 15) { $etapa_erc = '4'; }
        else { $etapa_erc = '5'; }

        // 2. Actualizar al paciente
        $paciente->update([
            'peso_kg' => $request->peso_kg,
            'presion_arterial' => $request->presion_arterial,
            'egfr' => $egfr,
            'etapa_erc' => $etapa_erc,
        ]);

        // 3. Crear un nuevo registro de límites nutricionales (Historial)
        $factorProteina = ($etapa_erc == '4' || $etapa_erc == '5') ? 0.6 : 0.8;
        $proteinaDiaria = $request->peso_kg * $factorProteina;

        LimitesNutricionales::create([
            'id_paciente' => $paciente->id_paciente,
            'potasio_mg' => 2000, 
            'fosforo_mg' => ($etapa_erc == '4' || $etapa_erc == '5') ? 800 : 1000,
            'sodio_mg' => 2000,
            'liquidos_ml' => 1200, 
            'proteina_g' => $proteinaDiaria,
            'origen' => 'AUTOMATICO',
            'justificacion' => 'Ajuste por actualización física (Peso: '.$request->peso_kg.'kg, Etapa: '.$etapa_erc.').',
        ]);

        return redirect()->route('paciente.perfil.show')->with('success', 'Tus datos físicos y límites han sido actualizados.');
    }
}
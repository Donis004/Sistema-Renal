<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AlertaClinica;
use App\Models\ConsumoLiquidos;
use App\Models\Comida;
use App\Models\RegistroSintoma;

class AlertaPacienteController extends Controller
{
    // Mostrar el buzón de alertas
    public function index()
    {
        $paciente = Auth::user()->pacientes()->first();

        // Traemos todas las alertas, mostrando primero las NO atendidas y las más recientes
        $alertas = AlertaClinica::where('id_paciente', $paciente->id_paciente)
            ->orderBy('atendida', 'asc')
            ->orderBy('fecha', 'desc')
            ->get();

        return view('paciente.alertas.index', compact('alertas'));
    }

    // Marcar una alerta como leída/atendida
    public function marcarAtendida($id)
    {
        $paciente = Auth::user()->pacientes()->first();
        
        $alerta = AlertaClinica::where('id_paciente', $paciente->id_paciente)
            ->where('id_alerta', $id)
            ->firstOrFail();

        $alerta->update(['atendida' => true]);

        return back()->with('success', 'Alerta marcada como atendida.');
    }

    // El motor que recalcula las alertas basándose en los datos de hoy
    public function recalcular()
    {
        $paciente = Auth::user()->pacientes()->first();
        $hoy = Carbon::today();
        $limites = $paciente->limitesNutricionales()->latest('fecha_actualizacion')->first();

        if (!$limites) {
            return back()->with('error', 'Debes completar tu perfil para calcular alertas.');
        }

        // --- 1. EVALUAR AGUA / LÍQUIDOS ---
        $liquidosHoy = ConsumoLiquidos::where('id_paciente', $paciente->id_paciente)
            ->whereDate('fecha_hora', $hoy)
            ->sum('cantidad_ml');

        if ($liquidosHoy > $limites->liquidos_ml) {
            $exceso = $liquidosHoy - $limites->liquidos_ml;
            $this->crearOActualizarAlerta($paciente->id_paciente, 'Exceso de Líquidos', 
                "Has superado tu límite de agua/líquidos por {$exceso} ml. Restringe tu consumo para evitar hinchazón (edema) o presión alta.", 'ALTO', $hoy);
        } elseif ($liquidosHoy > ($limites->liquidos_ml * 0.85)) { 
            // Alerta preventiva si ya consumió más del 85% de su agua
            $restante = $limites->liquidos_ml - $liquidosHoy;
            $this->crearOActualizarAlerta($paciente->id_paciente, 'Advertencia de Líquidos', 
                "Estás a punto de alcanzar tu límite de agua diario. Solo te quedan {$restante} ml permitidos para el resto del día.", 'MEDIO', $hoy);
        }

        // --- 2. EVALUAR NUTRIENTES (Potasio, Fósforo, Sodio, Proteína) ---
        $comidasHoy = Comida::with('comidaDetalles.alimento')
            ->where('id_paciente', $paciente->id_paciente)
            ->whereDate('fecha_hora', $hoy)
            ->get();

        $potasio = 0; $fosforo = 0; $sodio = 0; $proteina = 0;

        foreach ($comidasHoy as $comida) {
            foreach ($comida->comidaDetalles as $detalle) {
                if ($detalle->alimento) {
                    $porcion = $detalle->cantidad_porcion ?? 1;
                    $potasio += ($detalle->alimento->potasio_mg * $porcion);
                    $fosforo += ($detalle->alimento->fosforo_mg * $porcion);
                    $sodio += ($detalle->alimento->sodio_mg * $porcion);
                    $proteina += ($detalle->alimento->proteina_g * $porcion);
                }
            }
        }

        // Alerta Potasio
        if ($potasio > $limites->potasio_mg) {
            $this->crearOActualizarAlerta($paciente->id_paciente, 'Nivel de Potasio Crítico', 
                "Has consumido ".round($potasio)." mg de potasio, superando el límite de {$limites->potasio_mg} mg. Riesgo cardíaco.", 'ALTO', $hoy);
        } elseif ($potasio > ($limites->potasio_mg * 0.85)) { 
            $this->crearOActualizarAlerta($paciente->id_paciente, 'Advertencia de Potasio', 
                "Estás al 85% de tu límite diario de potasio. Ten cuidado con tu próxima comida.", 'MEDIO', $hoy);
        }

        // Alerta Fósforo
        if ($fosforo > $limites->fosforo_mg) {
            $this->crearOActualizarAlerta($paciente->id_paciente, 'Exceso de Fósforo', 
                "Has superado tu límite de fósforo (".round($fosforo)." mg). Recuerda tomar tus quelantes si te los recetaron.", 'MEDIO', $hoy);
        }

        // Alerta Sodio
        if ($sodio > $limites->sodio_mg) {
            $this->crearOActualizarAlerta($paciente->id_paciente, 'Exceso de Sodio', 
                "Superaste el límite diario de sodio (".round($sodio)." mg). Esto aumenta la sed, la presión arterial y causa retención de líquidos.", 'ALTO', $hoy);
        }

        // Alerta Proteína
        if ($proteina > $limites->proteina_g) {
            $this->crearOActualizarAlerta($paciente->id_paciente, 'Exceso de Proteína', 
                "Has consumido ".round($proteina, 1)." g de proteína, superando tu límite de {$limites->proteina_g} g. Esto genera más toxinas en tu sangre.", 'MEDIO', $hoy);
        }

        // --- 3. EVALUAR SÍNTOMAS ---
        $sintomasSeveros = RegistroSintoma::where('id_paciente', $paciente->id_paciente)
            ->whereDate('fecha_hora', $hoy)
            ->where('intensidad', 'SEVERO')
            ->exists();

        if ($sintomasSeveros) {
            $this->crearOActualizarAlerta($paciente->id_paciente, 'Síntomas Severos', 
                "Registraste síntomas con intensidad severa hoy. Si no mejoras, contacta a tu médico.", 'ALTO', $hoy);
        }

        return back()->with('success', 'Análisis completado. Tus alertas están al día evaluando todos los nutrientes y tu consumo de agua.');
    }

    // Función privada para no duplicar alertas del mismo tipo en el mismo día
    private function crearOActualizarAlerta($id_paciente, $tipo, $descripcion, $nivel, $fecha)
    {
        $alerta = AlertaClinica::where('id_paciente', $id_paciente)
            ->where('tipo', $tipo)
            ->whereDate('fecha', $fecha)
            ->first();

        if ($alerta) {
            // Si ya existe la alerta hoy, solo la actualizamos si no estaba atendida
            if (!$alerta->atendida) {
                $alerta->update(['descripcion' => $descripcion, 'nivel' => $nivel]);
            }
        } else {
            // Si no existe, la creamos
            AlertaClinica::create([
                'id_paciente' => $id_paciente,
                'tipo' => $tipo,
                'descripcion' => $descripcion,
                'nivel' => $nivel,
                'atendida' => false,
                'fecha' => now(),
            ]);
        }
    }
}
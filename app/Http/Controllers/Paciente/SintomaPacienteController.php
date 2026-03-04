<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroSintoma;
use App\Models\Sintoma; // Asegúrate de tener este modelo creado

class SintomaPacienteController extends Controller
{
    // Historial de Síntomas
    public function index()
    {
        $paciente = Auth::user()->pacientes()->first();

        // Traemos los registros ordenados desde el más reciente
        $registrosBrutos = RegistroSintoma::with('sintoma')
            ->where('id_paciente', $paciente->id_paciente)
            ->orderBy('fecha_hora', 'desc')
            ->get();

        // AGRUPACIÓN INTELIGENTE:
        // Agrupamos los registros que tengan exactamente la misma fecha y minuto
        // Así, si el paciente guardó 3 síntomas a las 14:05, se verán en una sola tarjeta.
        $registrosAgrupados = $registrosBrutos->groupBy(function ($item) {
            return $item->fecha_hora->format('Y-m-d H:i');
        });

        return view('paciente.sintomas.index', compact('registrosAgrupados'));
    }

    // Mostrar formulario
    public function create()
    {
        // Traemos el catálogo de síntomas reales de la base de datos
        $catalogoSintomas = Sintoma::orderBy('nombre', 'asc')->get();
        
        return view('paciente.sintomas.create', compact('catalogoSintomas'));
    }

    // Guardar el registro
    public function store(Request $request)
    {
        $request->validate([
            'intensidad' => 'required|in:LEVE,MODERADO,SEVERO',
            'sintomas' => 'required|array|min:1',
            'sintomas.*' => 'exists:sintomas,id_sintoma', // Validamos que los IDs existan
        ]);

        $paciente = Auth::user()->pacientes()->first();
        $fechaHoraActual = now(); // Usamos la misma hora exacta para todo el bloque

        // Guardamos UN registro en la BD por cada síntoma seleccionado
        foreach ($request->sintomas as $id_sintoma) {
            RegistroSintoma::create([
                'id_paciente' => $paciente->id_paciente,
                'id_sintoma' => $id_sintoma,
                'intensidad' => $request->intensidad,
                'fecha_hora' => $fechaHoraActual,
            ]);
        }

        // Aquí podríamos disparar una "Alerta Clínica" automáticamente si la intensidad es SEVERO (Lo haremos después)

        return redirect()->route('paciente.sintomas.index')
            ->with('success', 'Tus síntomas han sido registrados correctamente.');
    }
}
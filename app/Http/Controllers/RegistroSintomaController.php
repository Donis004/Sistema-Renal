<?php

namespace App\Http\Controllers;

use App\Models\RegistroSintoma;
use Illuminate\Http\Request;

class RegistroSintomaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = RegistroSintoma::with(['paciente', 'sintoma'])->get();
        return response()->json($registros);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'id_sintoma' => 'required|exists:sintomas,id_sintoma',
            'intensidad' => 'required|in:LEVE,MODERADO,SEVERO',
            'fecha_hora' => 'datetime',
        ]);

        $registro = RegistroSintoma::create($validated);
        return response()->json($registro, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RegistroSintoma $registro)
    {
        return response()->json($registro);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistroSintoma $registro)
    {
        $validated = $request->validate([
            'id_paciente' => 'exists:pacientes,id_paciente',
            'id_sintoma' => 'exists:sintomas,id_sintoma',
            'intensidad' => 'in:LEVE,MODERADO,SEVERO',
            'fecha_hora' => 'datetime',
        ]);

        $registro->update($validated);
        return response()->json($registro);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistroSintoma $registro)
    {
        $registro->delete();
        return response()->json(null, 204);
    }

    /**
     * Get symptoms by patient.
     */
    public function porPaciente($id_paciente)
    {
        $registros = RegistroSintoma::where('id_paciente', $id_paciente)
            ->with('sintoma')
            ->orderBy('fecha_hora', 'desc')
            ->get();
        return response()->json($registros);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Recomendacion;
use Illuminate\Http\Request;

class RecomendacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recomendaciones = Recomendacion::with(['paciente', 'profesional'])->get();
        return response()->json($recomendaciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'id_profesional' => 'required|exists:usuarios,id_usuario',
            'mensaje' => 'required|text',
            'fecha' => 'datetime',
        ]);

        $recomendacion = Recomendacion::create($validated);
        return response()->json($recomendacion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recomendacion $recomendacion)
    {
        return response()->json($recomendacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recomendacion $recomendacion)
    {
        $validated = $request->validate([
            'id_paciente' => 'exists:pacientes,id_paciente',
            'id_profesional' => 'exists:usuarios,id_usuario',
            'mensaje' => 'text',
            'fecha' => 'datetime',
        ]);

        $recomendacion->update($validated);
        return response()->json($recomendacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recomendacion $recomendacion)
    {
        $recomendacion->delete();
        return response()->json(null, 204);
    }

    /**
     * Get recommendations by patient.
     */
    public function porPaciente($id_paciente)
    {
        $recomendaciones = Recomendacion::where('id_paciente', $id_paciente)
            ->with('profesional')
            ->orderBy('fecha', 'desc')
            ->get();
        return response()->json($recomendaciones);
    }
}

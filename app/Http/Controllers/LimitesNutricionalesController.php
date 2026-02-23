<?php

namespace App\Http\Controllers;

use App\Models\LimitesNutricionales;
use Illuminate\Http\Request;

class LimitesNutricionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limites = LimitesNutricionales::with(['paciente', 'usuario'])->get();
        return response()->json($limites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'potasio_mg' => 'integer',
            'fosforo_mg' => 'integer',
            'sodio_mg' => 'integer',
            'liquidos_ml' => 'integer',
            'proteina_g' => 'decimal:2',
            'origen' => 'in:AUTOMATICO,MANUAL',
            'ajustado_por' => 'exists:usuarios,id_usuario',
            'justificacion' => 'text',
            'fecha_actualizacion' => 'datetime',
        ]);

        $limite = LimitesNutricionales::create($validated);
        return response()->json($limite, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LimitesNutricionales $limite)
    {
        $limite->load(['paciente', 'usuario']);
        return response()->json($limite);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LimitesNutricionales $limite)
    {
        $validated = $request->validate([
            'id_paciente' => 'exists:pacientes,id_paciente',
            'potasio_mg' => 'integer',
            'fosforo_mg' => 'integer',
            'sodio_mg' => 'integer',
            'liquidos_ml' => 'integer',
            'proteina_g' => 'decimal:2',
            'origen' => 'in:AUTOMATICO,MANUAL',
            'ajustado_por' => 'exists:usuarios,id_usuario',
            'justificacion' => 'text',
            'fecha_actualizacion' => 'datetime',
        ]);

        $limite->update($validated);
        return response()->json($limite);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LimitesNutricionales $limite)
    {
        $limite->delete();
        return response()->json(null, 204);
    }

    /**
     * Get current limits for a patient.
     */
    public function porPaciente($id_paciente)
    {
        $limite = LimitesNutricionales::where('id_paciente', $id_paciente)
            ->orderBy('fecha_actualizacion', 'desc')
            ->first();
        return response()->json($limite);
    }
}

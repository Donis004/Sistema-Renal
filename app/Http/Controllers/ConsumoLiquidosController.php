<?php

namespace App\Http\Controllers;

use App\Models\ConsumoLiquidos;
use Illuminate\Http\Request;

class ConsumoLiquidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consumos = ConsumoLiquidos::with('paciente')->get();
        return response()->json($consumos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'cantidad_ml' => 'required|integer',
            'descripcion' => 'string|max:100',
            'fecha_hora' => 'datetime',
        ]);

        $consumo = ConsumoLiquidos::create($validated);
        return response()->json($consumo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsumoLiquidos $consumo)
    {
        return response()->json($consumo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsumoLiquidos $consumo)
    {
        $validated = $request->validate([
            'id_paciente' => 'exists:pacientes,id_paciente',
            'cantidad_ml' => 'integer',
            'descripcion' => 'string|max:100',
            'fecha_hora' => 'datetime',
        ]);

        $consumo->update($validated);
        return response()->json($consumo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsumoLiquidos $consumo)
    {
        $consumo->delete();
        return response()->json(null, 204);
    }

    /**
     * Get liquid consumption by patient for today.
     */
    public function porPaciente($id_paciente)
    {
        $consumos = ConsumoLiquidos::where('id_paciente', $id_paciente)
            ->whereDate('fecha_hora', now()->toDateString())
            ->get();
        return response()->json($consumos);
    }

    /**
     * Get total liquid consumption for a patient.
     */
    public function totalDiario($id_paciente)
    {
        $total = ConsumoLiquidos::where('id_paciente', $id_paciente)
            ->whereDate('fecha_hora', now()->toDateString())
            ->sum('cantidad_ml');
        return response()->json(['total_ml' => $total]);
    }
}

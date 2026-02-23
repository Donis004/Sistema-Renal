<?php

namespace App\Http\Controllers;

use App\Models\AlertaClinica;
use Illuminate\Http\Request;

class AlertaClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alertas = AlertaClinica::with('paciente')->get();
        return response()->json($alertas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'tipo' => 'required|string|max:100',
            'descripcion' => 'text',
            'nivel' => 'required|in:BAJO,MEDIO,ALTO',
            'atendida' => 'boolean',
            'fecha' => 'datetime',
        ]);

        $alerta = AlertaClinica::create($validated);
        return response()->json($alerta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AlertaClinica $alerta)
    {
        return response()->json($alerta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlertaClinica $alerta)
    {
        $validated = $request->validate([
            'id_paciente' => 'exists:pacientes,id_paciente',
            'tipo' => 'string|max:100',
            'descripcion' => 'text',
            'nivel' => 'in:BAJO,MEDIO,ALTO',
            'atendida' => 'boolean',
            'fecha' => 'datetime',
        ]);

        $alerta->update($validated);
        return response()->json($alerta);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlertaClinica $alerta)
    {
        $alerta->delete();
        return response()->json(null, 204);
    }

    /**
     * Get pending alerts for a patient.
     */
    public function pendientes($id_paciente)
    {
        $alertas = AlertaClinica::where('id_paciente', $id_paciente)
            ->where('atendida', false)
            ->get();
        return response()->json($alertas);
    }

    /**
     * Mark alert as attended.
     */
    public function atender(AlertaClinica $alerta)
    {
        $alerta->update(['atendida' => true]);
        return response()->json($alerta);
    }
}

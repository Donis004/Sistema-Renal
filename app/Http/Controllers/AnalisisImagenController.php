<?php

namespace App\Http\Controllers;

use App\Models\AnalisisImagen;
use Illuminate\Http\Request;

class AnalisisImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $analisis = AnalisisImagen::with('fotoComida.comida')->get();
        return response()->json($analisis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_foto' => 'required|foto_comidas,id_foto',
            'estado' => 'in:PENDIENTE,ANALIZADO,ERROR',
            'nivel_riesgo' => 'in:BAJO,MEDIO,ALTO',
            'observacion_general' => 'text',
            'fecha' => 'datetime',
        ]);

        $analisis = AnalisisImagen::create($validated);
        return response()->json($analisis, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AnalisisImagen $analisis)
    {
        $analisis->load(['fotoComida.comida', 'alimentoDetectados']);
        return response()->json($analisis);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnalisisImagen $analisis)
    {
        $validated = $request->validate([
            'id_foto' => 'exists:foto_comidas,id_foto',
            'estado' => 'in:PENDIENTE,ANALIZADO,ERROR',
            'nivel_riesgo' => 'in:BAJO,MEDIO,ALTO',
            'observacion_general' => 'text',
            'fecha' => 'datetime',
        ]);

        $analisis->update($validated);
        return response()->json($analisis);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnalisisImagen $analisis)
    {
        $analisis->delete();
        return response()->json(null, 204);
    }

    /**
     * Get pending analysis.
     */
    public function pendientes()
    {
        $analisis = AnalisisImagen::where('estado', 'PENDIENTE')
            ->with('fotoComida.comida')
            ->get();
        return response()->json($analisis);
    }

    /**
     * Mark analysis as completed.
     */
    public function completar(Request $request, AnalisisImagen $analisis)
    {
        $validated = $request->validate([
            'estado' => 'required|in:ANALIZADO,ERROR',
            'nivel_riesgo' => 'in:BAJO,MEDIO,ALTO',
            'observacion_general' => 'text',
        ]);

        $analisis->update($validated);
        return response()->json($analisis);
    }
}

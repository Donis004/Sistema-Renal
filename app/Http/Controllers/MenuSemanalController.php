<?php

namespace App\Http\Controllers;

use App\Models\MenuSemanal;
use Illuminate\Http\Request;

class MenuSemanalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = MenuSemanal::with(['paciente', 'menuDetalles.alimento'])->get();
        return response()->json($menus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'semana_inicio' => 'required|date',
        ]);

        $menu = MenuSemanal::create($validated);
        return response()->json($menu, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuSemanal $menu)
    {
        $menu->load(['paciente', 'menuDetalles.alimento']);
        return response()->json($menu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuSemanal $menu)
    {
        $validated = $request->validate([
            'id_paciente' => 'exists:pacientes,id_paciente',
            'semana_inicio' => 'date',
        ]);

        $menu->update($validated);
        return response()->json($menu);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuSemanal $menu)
    {
        $menu->delete();
        return response()->json(null, 204);
    }

    /**
     * Get menus by patient.
     */
    public function porPaciente($id_paciente)
    {
        $menus = MenuSemanal::where('id_paciente', $id_paciente)
            ->with('menuDetalles.alimento')
            ->orderBy('semana_inicio', 'desc')
            ->get();
        return response()->json($menus);
    }
}

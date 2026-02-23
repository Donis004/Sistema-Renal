<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicamentos = Medicamento::all();
        return response()->json($medicamentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
        ]);

        $medicamento = Medicamento::create($validated);
        return response()->json($medicamento, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicamento $medicamento)
    {
        return response()->json($medicamento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicamento $medicamento)
    {
        $validated = $request->validate([
            'nombre' => 'string|max:150',
        ]);

        $medicamento->update($validated);
        return response()->json($medicamento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return response()->json(null, 204);
    }
}

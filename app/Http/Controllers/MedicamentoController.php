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
        $medicamentos = Medicamento::paginate(15);
        return view('administrador.medicamentos.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.medicamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150|unique:medicamentos,nombre',
        ]);

        Medicamento::create($validated);
        return redirect()->route('administrador.medicamentos.index')->with('success', 'Medicamento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_medicamento)
    {
        $medicamento = Medicamento::with('pacienteMedicamentos.paciente')->findOrFail($id_medicamento);
        return view('administrador.medicamentos.show', compact('medicamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_medicamento)
    {
        $medicamento = Medicamento::findOrFail($id_medicamento);
        return view('administrador.medicamentos.edit', compact('medicamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_medicamento)
    {
        $medicamento = Medicamento::findOrFail($id_medicamento);

        $validated = $request->validate([
            'nombre' => 'required|string|max:150|unique:medicamentos,nombre,' . $id_medicamento . ',id_medicamento',
        ]);

        $medicamento->update($validated);
        return redirect()->route('administrador.medicamentos.show', $medicamento->id_medicamento)->with('success', 'Medicamento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_medicamento)
    {
        $medicamento = Medicamento::findOrFail($id_medicamento);
        $medicamento->delete();
        return redirect()->route('administrador.medicamentos.index')->with('success', 'Medicamento eliminado exitosamente.');
    }
}

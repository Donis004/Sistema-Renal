<?php

namespace App\Http\Controllers;

use App\Models\Sintoma;
use Illuminate\Http\Request;

class SintomaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sintomas = Sintoma::with('registroSintomas')->latest()->paginate(15);
        return view('administrador.sintomas.index', compact('sintomas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.sintomas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:sintomas,nombre',
        ]);

        Sintoma::create($validated);
        return redirect()->route('administrador.sintomas.index')->with('success', 'Síntoma creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_sintoma)
    {
        $sintoma = Sintoma::with('registroSintomas.paciente.usuario')->findOrFail($id_sintoma);
        return view('administrador.sintomas.show', compact('sintoma'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_sintoma)
    {
        $sintoma = Sintoma::findOrFail($id_sintoma);
        return view('administrador.sintomas.edit', compact('sintoma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_sintoma)
    {
        $sintoma = Sintoma::findOrFail($id_sintoma);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:sintomas,nombre,' . $id_sintoma . ',id_sintoma',
        ]);

        $sintoma->update($validated);
        return redirect()->route('administrador.sintomas.show', $sintoma->id_sintoma)->with('success', 'Síntoma actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_sintoma)
    {
        $sintoma = Sintoma::findOrFail($id_sintoma);
        $sintoma->delete();
        return redirect()->route('administrador.sintomas.index')->with('success', 'Síntoma eliminado exitosamente.');
    }
}

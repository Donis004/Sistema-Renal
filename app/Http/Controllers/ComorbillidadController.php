<?php

namespace App\Http\Controllers;

use App\Models\Comorbilidad;
use Illuminate\Http\Request;

class ComorbillidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comorbilidades = Comorbilidad::latest()->paginate(15);
        return view('administrador.comorbilidades.index', compact('comorbilidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.comorbilidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:comorbilidades,nombre',
        ]);

        Comorbilidad::create($validated);
        return redirect()->route('administrador.comorbilidades.index')->with('success', 'Comorbilidad creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_comorbilidad)
    {
        $comorbilidad = Comorbilidad::with('pacientes')->findOrFail($id_comorbilidad);
        return view('administrador.comorbilidades.show', compact('comorbilidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_comorbilidad)
    {
        $comorbilidad = Comorbilidad::findOrFail($id_comorbilidad);
        return view('administrador.comorbilidades.edit', compact('comorbilidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_comorbilidad)
    {
        $comorbilidad = Comorbilidad::findOrFail($id_comorbilidad);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:comorbilidades,nombre,' . $id_comorbilidad . ',id_comorbilidad',
        ]);

        $comorbilidad->update($validated);
        return redirect()->route('administrador.comorbilidades.show', $comorbilidad->id_comorbilidad)->with('success', 'Comorbilidad actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_comorbilidad)
    {
        $comorbilidad = Comorbilidad::findOrFail($id_comorbilidad);
        $comorbilidad->delete();
        return redirect()->route('administrador.comorbilidades.index')->with('success', 'Comorbilidad eliminada exitosamente.');
    }
}

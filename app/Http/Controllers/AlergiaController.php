<?php

namespace App\Http\Controllers;

use App\Models\Alergia;
use Illuminate\Http\Request;

class AlergiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alergias = Alergia::latest()->paginate(15);
        return view('administrador.alergias.index', compact('alergias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.alergias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:alergias,nombre',
        ]);

        Alergia::create($validated);
        return redirect()->route('administrador.alergias.index')->with('success', 'Alergia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_alergia)
    {
        $alergia = Alergia::with('pacientes')->findOrFail($id_alergia);
        return view('administrador.alergias.show', compact('alergia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_alergia)
    {
        $alergia = Alergia::findOrFail($id_alergia);
        return view('administrador.alergias.edit', compact('alergia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_alergia)
    {
        $alergia = Alergia::findOrFail($id_alergia);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:alergias,nombre,' . $id_alergia . ',id_alergia',
        ]);

        $alergia->update($validated);
        return redirect()->route('administrador.alergias.show', $alergia->id_alergia)->with('success', 'Alergia actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_alergia)
    {
        $alergia = Alergia::findOrFail($id_alergia);
        $alergia->delete();
        return redirect()->route('administrador.alergias.index')->with('success', 'Alergia eliminada exitosamente.');
    }
}

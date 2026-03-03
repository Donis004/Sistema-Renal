<?php

namespace App\Http\Controllers;

use App\Models\ContenidoEducativo;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ContenidoEducativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contenidos = ContenidoEducativo::paginate(15);
        return view('administrador.contenidos.index', compact('contenidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.contenidos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:150',
            'etapa_erc' => 'required|string|max:10',
            'tipo' => 'required|in:DIETA,LIQUIDOS,EJERCICIO',
            'contenido' => 'required|string',
        ]);

        ContenidoEducativo::create($validated);
        return redirect()->route('administrador.contenidos.index')->with('success', 'Contenido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_contenido)
    {
        $contenido = ContenidoEducativo::with('contenidosVistos.paciente.usuario')->findOrFail($id_contenido);
        return view('administrador.contenidos.show', compact('contenido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_contenido)
    {
        $contenido = ContenidoEducativo::findOrFail($id_contenido);
        return view('administrador.contenidos.edit', compact('contenido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_contenido)
    {
        $contenido = ContenidoEducativo::findOrFail($id_contenido);

        $validated = $request->validate([
            'titulo' => 'required|string|max:150',
            'etapa_erc' => 'required|string|max:10',
            'tipo' => 'required|in:DIETA,LIQUIDOS,EJERCICIO',
            'contenido' => 'required|string',
        ]);

        $contenido->update($validated);
        return redirect()->route('administrador.contenidos.show', $contenido->id_contenido)->with('success', 'Contenido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_contenido)
    {
        $contenido = ContenidoEducativo::findOrFail($id_contenido);
        $contenido->delete();
        return redirect()->route('administrador.contenidos.index')->with('success', 'Contenido eliminado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Recomendacion;
use App\Models\Paciente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Auth;

class RecomendacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recomendaciones = Recomendacion::with('paciente.usuario', 'profesional')
            ->latest()
            ->paginate(15);
        return view('administrador.recomendaciones.index', compact('recomendaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pacientes = Paciente::with('usuario')->get();
        $profesionales = Usuario::whereIn('rol', ['DOCTOR', 'NUTRICIONISTA'])->get();
        return view('administrador.recomendaciones.create', compact('pacientes', 'profesionales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'id_profesional' => 'required|exists:usuarios,id_usuario',
            'mensaje' => 'required|string',
        ]);

        Recomendacion::create($validated);
        return redirect()->route('administrador.recomendaciones.index')->with('success', 'Recomendación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_recomendacion)
    {
        $recomendacion = Recomendacion::with('paciente.usuario', 'profesional')->findOrFail($id_recomendacion);
        return view('administrador.recomendaciones.show', compact('recomendacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_recomendacion)
    {
        $recomendacion = Recomendacion::findOrFail($id_recomendacion);
        $pacientes = Paciente::with('usuario')->get();
        $profesionales = Usuario::whereIn('rol', ['DOCTOR', 'NUTRICIONISTA'])->get();
        return view('administrador.recomendaciones.edit', compact('recomendacion', 'pacientes', 'profesionales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_recomendacion)
    {
        $recomendacion = Recomendacion::findOrFail($id_recomendacion);

        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'id_profesional' => 'required|exists:usuarios,id_usuario',
            'mensaje' => 'required|string',
        ]);

        $recomendacion->update($validated);
        return redirect()->route('administrador.recomendaciones.show', $recomendacion->id_recomendacion)->with('success', 'Recomendación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_recomendacion)
    {
        $recomendacion = Recomendacion::findOrFail($id_recomendacion);
        $recomendacion->delete();
        return redirect()->route('administrador.recomendaciones.index')->with('success', 'Recomendación eliminada exitosamente.');
    }
}

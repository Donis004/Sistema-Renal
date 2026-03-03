<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::with('usuario')->paginate(15);
        return view('administrador.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = Usuario::all();
        return view('administrador.pacientes.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'required|in:M,F,O',
            'peso_kg' => 'nullable|numeric|min:0',
            'presion_arterial' => 'nullable|string|max:10',
            'etapa_erc' => 'required|in:1,2,3a,3b,4,5',
            'egfr' => 'nullable|numeric|min:0',
            'dieta_prescrita' => 'nullable|string',
            'perfil_completo' => 'nullable|boolean',
        ]);

        Paciente::create($validated);
        return redirect()->route('administrador.pacientes.index')->with('success', 'Paciente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_paciente)
    {
        $paciente = Paciente::with(['usuario', 'alergias', 'comorbilidades', 'limitesNutricionales'])->findOrFail($id_paciente);
        return view('administrador.pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_paciente)
    {
        $paciente = Paciente::findOrFail($id_paciente);
        $usuarios = Usuario::all();
        return view('administrador.pacientes.edit', compact('paciente', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_paciente)
    {
        $paciente = Paciente::findOrFail($id_paciente);

        $validated = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'required|in:M,F,O',
            'peso_kg' => 'nullable|numeric|min:0',
            'presion_arterial' => 'nullable|string|max:10',
            'etapa_erc' => 'required|in:1,2,3a,3b,4,5',
            'egfr' => 'nullable|numeric|min:0',
            'dieta_prescrita' => 'nullable|string',
            'perfil_completo' => 'nullable|boolean',
        ]);

        $paciente->update($validated);
        return redirect()->route('administrador.pacientes.show', $paciente->id_paciente)->with('success', 'Paciente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_paciente)
    {
        $paciente = Paciente::findOrFail($id_paciente);
        $paciente->delete();
        return redirect()->route('administrador.pacientes.index')->with('success', 'Paciente eliminado exitosamente.');
    }

    // ========== MÉTODOS ADICIONALES PARA API (OPCIONAL) ==========
    // Los siguientes métodos pueden ser utilizados para endpoints API si es necesario
}

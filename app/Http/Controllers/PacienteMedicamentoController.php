<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Medicamento;
use App\Models\PacienteMedicamento;
use Illuminate\Http\Request;

class PacienteMedicamentoController extends Controller
{
    /**
     * Show medicamentos for a specific paciente.
     */
    public function index($id_paciente)
    {
        $paciente = Paciente::with('usuario')->findOrFail($id_paciente);
        $pacienteMedicamentos = PacienteMedicamento::where('id_paciente', $id_paciente)
            ->with('medicamento')
            ->paginate(15);
        
        return view('administrador.pacientes.medicamentos.index', compact('paciente', 'pacienteMedicamentos'));
    }

    /**
     * Show the form for creating a new medicamento assignment.
     */
    public function create($id_paciente)
    {
        $paciente = Paciente::with('usuario')->findOrFail($id_paciente);
        $medicamentos = Medicamento::all();
        
        // Obtener medicamentos ya asignados al paciente
        $medicamentosAsignados = PacienteMedicamento::where('id_paciente', $id_paciente)
            ->pluck('id_medicamento')
            ->toArray();
        
        return view('administrador.pacientes.medicamentos.create', compact('paciente', 'medicamentos', 'medicamentosAsignados'));
    }

    /**
     * Store a newly created medicamento assignment.
     */
    public function store(Request $request, $id_paciente)
    {
        $paciente = Paciente::findOrFail($id_paciente);

        $validated = $request->validate([
            'id_medicamento' => 'required|exists:medicamentos,id_medicamento',
            'dosis' => 'nullable|string|max:50',
            'frecuencia' => 'nullable|string|max:50',
            'con_alimentos' => 'nullable|boolean',
            'activo' => 'nullable|boolean',
        ]);

        // Verificar si el medicamento ya está asignado
        $existe = PacienteMedicamento::where('id_paciente', $id_paciente)
            ->where('id_medicamento', $validated['id_medicamento'])
            ->exists();

        if ($existe) {
            return redirect()->route('administrador.pacientes.medicamentos.index', $id_paciente)
                ->with('error', 'Este medicamento ya está asignado a este paciente.');
        }

        $validated['id_paciente'] = $id_paciente;
        $validated['activo'] = $validated['activo'] ?? true;

        PacienteMedicamento::create($validated);

        return redirect()->route('administrador.pacientes.medicamentos.index', $id_paciente)
            ->with('success', 'Medicamento asignado exitosamente.');
    }

    /**
     * Show the form for editing a medicamento assignment.
     */
    public function edit($id_paciente, $id_pm)
    {
        $paciente = Paciente::with('usuario')->findOrFail($id_paciente);
        $pacienteMedicamento = PacienteMedicamento::where('id_pm', $id_pm)
            ->where('id_paciente', $id_paciente)
            ->with('medicamento')
            ->firstOrFail();
        
        return view('administrador.pacientes.medicamentos.edit', compact('paciente', 'pacienteMedicamento'));
    }

    /**
     * Update the specified medicamento assignment.
     */
    public function update(Request $request, $id_paciente, $id_pm)
    {
        $paciente = Paciente::findOrFail($id_paciente);
        $pacienteMedicamento = PacienteMedicamento::where('id_pm', $id_pm)
            ->where('id_paciente', $id_paciente)
            ->firstOrFail();

        $validated = $request->validate([
            'dosis' => 'nullable|string|max:50',
            'frecuencia' => 'nullable|string|max:50',
            'con_alimentos' => 'nullable|boolean',
            'activo' => 'nullable|boolean',
        ]);

        $validated['activo'] = $validated['activo'] ?? true;

        $pacienteMedicamento->update($validated);

        return redirect()->route('administrador.pacientes.medicamentos.index', $id_paciente)
            ->with('success', 'Asignación de medicamento actualizada exitosamente.');
    }

    /**
     * Remove the specified medicamento assignment.
     */
    public function destroy($id_paciente, $id_pm)
    {
        $paciente = Paciente::findOrFail($id_paciente);
        $pacienteMedicamento = PacienteMedicamento::where('id_pm', $id_pm)
            ->where('id_paciente', $id_paciente)
            ->firstOrFail();

        $pacienteMedicamento->delete();

        return redirect()->route('administrador.pacientes.medicamentos.index', $id_paciente)
            ->with('success', 'Medicamento desasignado exitosamente.');
    }

    /**
     * Toggle the status of a medicamento assignment.
     */
    public function toggleEstado($id_paciente, $id_pm)
    {
        $paciente = Paciente::findOrFail($id_paciente);
        $pacienteMedicamento = PacienteMedicamento::where('id_pm', $id_pm)
            ->where('id_paciente', $id_paciente)
            ->firstOrFail();

        $pacienteMedicamento->update(['activo' => !$pacienteMedicamento->activo]);

        $estado = $pacienteMedicamento->activo ? 'activado' : 'desactivado';
        return redirect()->route('administrador.pacientes.medicamentos.index', $id_paciente)
            ->with('success', 'Medicamento ' . $estado . ' exitosamente.');
    }
}

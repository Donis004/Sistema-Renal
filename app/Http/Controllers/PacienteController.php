<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::with('usuario')->get();
        return response()->json($pacientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'fecha_nacimiento' => 'date',
            'sexo' => 'in:M,F,O',
            'peso_kg' => 'decimal:2',
            'presion_arterial' => 'string|max:10',
            'etapa_erc' => 'in:1,2,3a,3b,4,5',
            'egfr' => 'decimal:2',
            'dieta_prescrita' => 'text',
            'perfil_completo' => 'boolean',
        ]);

        $paciente = Paciente::create($validated);
        return response()->json($paciente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        $paciente->load(['usuario', 'alergias', 'comorbilidades', 'limitesNutricionales']);
        return response()->json($paciente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $validated = $request->validate([
            'id_usuario' => 'exists:usuarios,id_usuario',
            'fecha_nacimiento' => 'date',
            'sexo' => 'in:M,F,O',
            'peso_kg' => 'decimal:2',
            'presion_arterial' => 'string|max:10',
            'etapa_erc' => 'in:1,2,3a,3b,4,5',
            'egfr' => 'decimal:2',
            'dieta_prescrita' => 'text',
            'perfil_completo' => 'boolean',
        ]);

        $paciente->update($validated);
        return response()->json($paciente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->json(null, 204);
    }

    /**
     * Get patient's allergies.
     */
    public function alergias(Paciente $paciente)
    {
        return response()->json($paciente->alergias);
    }

    /**
     * Get patient's comorbidities.
     */
    public function comorbilidades(Paciente $paciente)
    {
        return response()->json($paciente->comorbilidades);
    }

    /**
     * Get patient's nutritional limits.
     */
    public function limitesNutricionales(Paciente $paciente)
    {
        return response()->json($paciente->limitesNutricionales);
    }

    /**
     * Get patient's meals.
     */
    public function comidas(Paciente $paciente)
    {
        return response()->json($paciente->comidas);
    }

    /**
     * Get patient's liquid consumption.
     */
    public function consumoLiquidos(Paciente $paciente)
    {
        return response()->json($paciente->consumoLiquidos);
    }

    /**
     * Get patient's medications.
     */
    public function medicamentos(Paciente $paciente)
    {
        return response()->json($paciente->pacienteMedicamentos);
    }

    /**
     * Get patient's symptoms.
     */
    public function sintomas(Paciente $paciente)
    {
        return response()->json($paciente->registroSintomas);
    }

    /**
     * Get patient's clinical alerts.
     */
    public function alertas(Paciente $paciente)
    {
        return response()->json($paciente->alertaClinicas);
    }

    /**
     * Get patient's recommendations.
     */
    public function recomendaciones(Paciente $paciente)
    {
        return response()->json($paciente->recomendaciones);
    }

    /**
     * Get patient's weekly menus.
     */
    public function menus(Paciente $paciente)
    {
        return response()->json($paciente->menuSemanales);
    }
}

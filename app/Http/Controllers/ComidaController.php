<?php

namespace App\Http\Controllers;

use App\Models\Comida;
use App\Models\ComidaDetalle;
use App\Models\Paciente;
use App\Models\Usuario;
use App\Models\Alimento;
use Illuminate\Http\Request;

class ComidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Comida::with(['paciente', 'comidaDetalles.alimento']);

        // Filtro por búsqueda
        if ($request->has('busqueda') && $request->busqueda) {
            $busqueda = $request->busqueda;
            $query->whereHas('paciente.usuario', function($q) use ($busqueda) {
                $q->where('nombre', 'like', "%{$busqueda}%");
            });
        }

        // Filtro por tipo de registro
        if ($request->has('tipo_registro') && $request->tipo_registro) {
            $query->where('tipo_registro', $request->tipo_registro);
        }

        $comidas = $query->orderBy('fecha_hora', 'desc')->get();
        return view('administrador.comidas.index', compact('comidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener usuarios con rol PACIENTE directamente de la tabla usuarios
        $pacientes = Usuario::where('rol', 'PACIENTE')->get();
        return view('administrador.comidas.create', compact('pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:usuarios,id_usuario',
            'tipo_registro' => 'required|in:FOTO,MANUAL',
            'fecha_hora' => 'date',
        ]);

        // Buscar o crear el paciente en la tabla pacientes
        $paciente = Paciente::where('id_usuario', $validated['id_paciente'])->first();
        
        if (!$paciente) {
            // Crear el registro del paciente si no existe
            $paciente = Paciente::create([
                'id_usuario' => $validated['id_paciente'],
            ]);
        }

        // Crear la comida con el id_paciente correcto
        Comida::create([
            'id_paciente' => $paciente->id_paciente,
            'tipo_registro' => $validated['tipo_registro'],
            'fecha_hora' => $validated['fecha_hora'] ?? now(),
        ]);

        return redirect()->route('administrador.comidas.index')->with('success', 'Comida registrada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $comida = Comida::with(['paciente.usuario', 'comidaDetalles.alimento', 'fotoComidas'])->findOrFail($id);
        
        // Obtener ID de alimentos ya agregados a esta comida
        $alimentosAgregadosIds = $comida->comidaDetalles->pluck('id_alimento')->toArray();
        
        // Obtener alimentos filtrados (excluyendo los ya agregados)
        $alimentos = Alimento::whereNotIn('id_alimento', $alimentosAgregadosIds)
            ->orderBy('nombre')
            ->get();
        
        return view('administrador.comidas.show', compact('comida', 'alimentos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comida = Comida::findOrFail($id);
        $pacientes = Paciente::with('usuario')->get();
        return view('administrador.comidas.edit', compact('comida', 'pacientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comida = Comida::findOrFail($id);
        
        $validated = $request->validate([
            'id_paciente' => 'exists:pacientes,id_paciente',
            'tipo_registro' => 'in:FOTO,MANUAL',
            'fecha_hora' => 'date',
        ]);

        $comida->update($validated);
        return redirect()->route('administrador.comidas.index')->with('success', 'Comida actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comida = Comida::findOrFail($id);
        $comida->delete();
        return redirect()->route('administrador.comidas.index')->with('success', 'Comida eliminada exitosamente');
    }

    /**
     * Get meals by patient (API).
     */
    public function porPaciente($id_paciente)
    {
        $comidas = Comida::where('id_paciente', $id_paciente)
            ->with('comidaDetalles.alimento')
            ->get();
        return response()->json($comidas);
    }

    /**
     * Get meals by date range (API).
     */
    public function porFecha(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $comidas = Comida::where('id_paciente', $validated['id_paciente'])
            ->whereBetween('fecha_hora', [$validated['fecha_inicio'], $validated['fecha_fin']])
            ->with('comidaDetalles.alimento')
            ->get();
        return response()->json($comidas);
    }

    /**
     * Add alimento to comida (detalle).
     */
    public function agregarAlimento(Request $request, $id)
    {
        $request->validate([
            'id_alimento' => 'required|exists:alimentos,id_alimento',
            'cantidad_porcion' => 'required|numeric|min:0.01',
        ]);

        $comida = Comida::findOrFail($id);
        
        ComidaDetalle::create([
            'id_comida' => $comida->id_comida,
            'id_alimento' => $request->id_alimento,
            'cantidad_porcion' => $request->cantidad_porcion,
        ]);

        return redirect()->route('administrador.comidas.show', $comida->id_comida)
            ->with('success', 'Alimento agregado a la comida correctamente');
    }

    /**
     * Remove alimento from comida (detalle).
     */
    public function eliminarAlimento($id_detalle)
    {
        $detalle = ComidaDetalle::findOrFail($id_detalle);
        $comidaId = $detalle->id_comida;
        $detalle->delete();

        return redirect()->route('administrador.comidas.show', $comidaId)
            ->with('success', 'Alimento eliminado de la comida correctamente');
    }
}

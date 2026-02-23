<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use Illuminate\Http\Request;

class AlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alimento::query();

        // Filtro por búsqueda
        if ($request->has('busqueda') && $request->busqueda) {
            $busqueda = $request->busqueda;
            $query->where('nombre', 'like', "%{$busqueda}%");
        }

        // Filtro por seguridad renal
        if ($request->has('seguro_renal') && $request->seguro_renal !== '') {
            $query->where('seguro_renal', $request->seguro_renal);
        }

        $alimentos = $query->orderBy('nombre')->get();
        return view('administrador.alimentos.index', compact('alimentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.alimentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'potasio_mg' => 'nullable|integer|min:0',
            'fosforo_mg' => 'nullable|integer|min:0',
            'sodio_mg' => 'nullable|integer|min:0',
            'proteina_g' => 'nullable|numeric|min:0',
            'porcion_estandar' => 'nullable|string|max:50',
            'seguro_renal' => 'nullable|boolean',
        ]);

        Alimento::create($validated);
        return redirect()->route('administrador.alimentos.index')->with('success', 'Alimento creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alimento $alimento)
    {
        return view('administrador.alimentos.show', compact('alimento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alimento $alimento)
    {
        return view('administrador.alimentos.edit', compact('alimento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alimento $alimento)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'potasio_mg' => 'nullable|integer|min:0',
            'fosforo_mg' => 'nullable|integer|min:0',
            'sodio_mg' => 'nullable|integer|min:0',
            'proteina_g' => 'nullable|numeric|min:0',
            'porcion_estandar' => 'nullable|string|max:50',
            'seguro_renal' => 'nullable|boolean',
        ]);

        $alimento->update($validated);
        return redirect()->route('administrador.alimentos.index')->with('success', 'Alimento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alimento $alimento)
    {
        $alimento->delete();
        return redirect()->route('administrador.alimentos.index')->with('success', 'Alimento eliminado correctamente');
    }

    /**
     * Get foods safe for renal diet.
     */
    public function seguros()
    {
        $alimentos = Alimento::where('seguro_renal', true)->get();
        return response()->json($alimentos);
    }

    /**
     * Search foods by name.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $alimentos = Alimento::where('nombre', 'like', "%{$query}%")->get();
        return response()->json($alimentos);
    }
}

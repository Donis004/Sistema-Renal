<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Usuario::query();

        // Filtro por búsqueda
        if ($request->has('busqueda') && $request->busqueda) {
            $busqueda = $request->busqueda;
            $query->where(function($q) use ($busqueda) {
                $q->where('nombre', 'like', "%{$busqueda}%")
                  ->orWhere('email', 'like', "%{$busqueda}%");
            });
        }

        // Filtro por rol
        if ($request->has('rol') && $request->rol) {
            $query->where('rol', $request->rol);
        }

        // Filtro por estado
        if ($request->has('estado') && $request->estado !== '') {
            $query->where('estado', $request->estado);
        }

        $usuarios = $query->orderBy('fecha_registro', 'desc')->paginate(10);
        
        return view('administrador.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:usuarios,email',
            'password' => 'required|string|min:6|max:255',
            'password_confirmation' => 'required|string|same:password',
            'rol' => 'required|in:PACIENTE,DOCTOR,NUTRICIONISTA,ADMIN',
            'estado' => 'boolean',
        ]);

        // Convertir password a password_hash
        $validated['password_hash'] = $validated['password'];
        unset($validated['password']);
        unset($validated['password_confirmation']);

        // Por defecto estado es true
        if (!isset($validated['estado'])) {
            $validated['estado'] = true;
        }

        Usuario::create($validated);
        return redirect()->route('administrador.usuarios.index')->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('administrador.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('administrador.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        
        $validated = $request->validate([
            'nombre' => 'string|max:100',
            'email' => 'string|email|max:150|unique:usuarios,email,' . $id . ',id_usuario',
            'password_hash' => 'nullable|string|max:255',
            'rol' => 'in:PACIENTE,DOCTOR,NUTRICIONISTA,ADMIN',
            'estado' => 'boolean',
        ]);

        if (empty($validated['password_hash'])) {
            unset($validated['password_hash']);
        }

        $usuario->update($validated);
        return redirect()->route('administrador.usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('administrador.usuarios.index')->with('success', 'Usuario eliminado exitosamente');
    }

    /**
     * Toggle user status (activate/deactivate).
     */
    public function toggleEstado($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->estado = !$usuario->estado;
        $usuario->save();
        
        $mensaje = $usuario->estado ? 'Usuario activado exitosamente' : 'Usuario desactivado exitosamente';
        return redirect()->route('administrador.usuarios.index')->with('success', $mensaje);
    }

    /**
     * Login user.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password_hash' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $validated['email'])
            ->where('password_hash', $validated['password_hash'])
            ->where('estado', true)
            ->first();

        if (!$usuario) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        return response()->json($usuario);
    }
}

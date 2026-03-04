<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar la vista de login que creamos
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el intento de login
    public function login(Request $request)
    {
        // 1. Validar los datos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Buscar usuario manualmente
        $usuario = \App\Models\Usuario::where('email', $credentials['email'])->first();

        // 3. Verificar si existe y si la contraseña coincide (texto plano)
        if ($usuario && $usuario->password_hash === $credentials['password']) {

            // Iniciar sesión manualmente
            Auth::login($usuario);
            $request->session()->regenerate();

            // Verificar si la cuenta está activa
            if (!$usuario->estado) {
                Auth::logout();
                return back()->withErrors(['email' => 'Esta cuenta se encuentra desactivada.']);
            }

            // Redirección según rol
            if ($usuario->isPaciente()) {
                $paciente = $usuario->pacientes()->first();

                if ($paciente && !$paciente->perfil_completo) {
                    return redirect()->route('paciente.perfil.completar');
                }

                return redirect()->route('paciente.dashboard');
            }

            if ($usuario->isAdmin()) {
                return redirect()->route('administrador.dashboard');
            }

            if ($usuario->isDoctor() || $usuario->isNutricionista()) {
                return redirect()->route('administrador.dashboard');
            }

            return redirect('/');
        }

        // Si falla
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
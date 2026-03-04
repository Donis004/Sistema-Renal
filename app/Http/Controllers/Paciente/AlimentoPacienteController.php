<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Models\Alimento;
use Illuminate\Http\Request;

class AlimentoPacienteController extends Controller
{
    // ESTA es la función que Laravel te está diciendo que no existe
    public function sugerencias()
    {
        // Traemos todos los alimentos que estén marcados como seguros en la BD
        // Y los ordenamos alfabéticamente
        $alimentosSeguros = Alimento::where('seguro_renal', true)
                                    ->where('estado', true)
                                    ->orderBy('nombre', 'asc')
                                    ->get();

        return view('paciente.alimentos.sugerencias', compact('alimentosSeguros'));
    }
}
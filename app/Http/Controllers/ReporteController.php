<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Comida;
use App\Models\RegistroSintoma;
use App\Models\ConsumoLiquidos;
use App\Models\PacienteMedicamento;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display report filter form
     */
    public function index()
    {
        $pacientes = Paciente::with('usuario')->get();
        return view('administrador.reportes.index', compact('pacientes'));
    }

    /**
     * Generate and download PDF report
     */
    public function descargar(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $paciente = Paciente::with('usuario')->findOrFail($validated['id_paciente']);
        
        $fechaInicio = Carbon::parse($validated['fecha_inicio'])->startOfDay();
        $fechaFin = Carbon::parse($validated['fecha_fin'])->endOfDay();

        // Obtener datos
        $comidas = Comida::where('id_paciente', $paciente->id_paciente)
            ->whereBetween('fecha_hora', [$fechaInicio, $fechaFin])
            ->with('comidaDetalles.alimento')
            ->get();

        $sintomas = RegistroSintoma::where('id_paciente', $paciente->id_paciente)
            ->whereBetween('fecha_hora', [$fechaInicio, $fechaFin])
            ->with('sintoma')
            ->get();

        $liquidos = ConsumoLiquidos::where('id_paciente', $paciente->id_paciente)
            ->whereBetween('fecha_hora', [$fechaInicio, $fechaFin])
            ->get();

        $medicamentos = PacienteMedicamento::where('id_paciente', $paciente->id_paciente)
            ->with('medicamento')
            ->get();

        $data = [
            'paciente' => $paciente,
            'comidas' => $comidas,
            'sintomas' => $sintomas,
            'liquidos' => $liquidos,
            'medicamentos' => $medicamentos,
            'fechaInicio' => $fechaInicio->format('d/m/Y'),
            'fechaFin' => $fechaFin->format('d/m/Y'),
            'fechaReporte' => now()->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('administrador.reportes.pdf', $data);
        
        $nombreArchivo = 'Reporte_' . strtoupper(str_replace(' ', '_', $paciente->usuario->nombre)) . '_' . now()->format('d_m_Y_His') . '.pdf';
        
        return $pdf->download($nombreArchivo);
    }
}

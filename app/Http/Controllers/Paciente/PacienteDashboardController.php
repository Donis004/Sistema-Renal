<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ConsumoLiquidos;
use App\Models\Comida;
use App\Models\AlertaClinica;
use App\Models\RecordatorioMedicamento;

class PacienteDashboardController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $paciente = $usuario->pacientes()->first();

        // 1. Obtener Límites Nutricionales actuales
        $limites = $paciente->limitesNutricionales()->latest('fecha_actualizacion')->first();

        // Si por alguna razón no tiene límites, creamos unos por defecto para no romper la vista
        if (!$limites) {
            $limites = (object)[
                'potasio_mg' => 2000, 'fosforo_mg' => 1000, 
                'sodio_mg' => 2000, 'proteina_g' => 60, 'liquidos_ml' => 1200
            ];
        }

        $hoy = Carbon::today();

        // 2. Control de Líquidos de Hoy (HU-06)
        $registrosLiquidos = ConsumoLiquidos::where('id_paciente', $paciente->id_paciente)
            ->whereDate('fecha_hora', $hoy)
            ->orderBy('fecha_hora', 'desc')
            ->get();
            
        $liquidosHoy = $registrosLiquidos->sum('cantidad_ml');

        // 3. Consumo Nutricional de Hoy (HU-13)
        // Obtenemos las comidas de hoy con sus detalles y los alimentos asociados
        $comidasHoy = Comida::with(['comidaDetalles.alimento'])
            ->where('id_paciente', $paciente->id_paciente)
            ->whereDate('fecha_hora', $hoy)
            ->get();

        $consumoHoy = [
            'potasio' => 0,
            'fosforo' => 0,
            'sodio' => 0,
            'proteina' => 0,
        ];

        foreach ($comidasHoy as $comida) {
            foreach ($comida->comidaDetalles as $detalle) {
                if ($detalle->alimento) {
                    // Calculamos el valor nutricional basado en la cantidad de la porción consumida
                    // Asumiendo que cantidad_porcion es un multiplicador (ej. 1 = 1 porción estándar, 0.5 = media porción)
                    $porcion = $detalle->cantidad_porcion ?? 1;
                    
                    $consumoHoy['potasio'] += ($detalle->alimento->potasio_mg * $porcion);
                    $consumoHoy['fosforo'] += ($detalle->alimento->fosforo_mg * $porcion);
                    $consumoHoy['sodio'] += ($detalle->alimento->sodio_mg * $porcion);
                    $consumoHoy['proteina'] += ($detalle->alimento->proteina_g * $porcion);
                }
            }
        }

        // Redondeamos los valores para mostrarlos limpios en la vista
        $consumoHoy['potasio'] = round($consumoHoy['potasio']);
        $consumoHoy['fosforo'] = round($consumoHoy['fosforo']);
        $consumoHoy['sodio'] = round($consumoHoy['sodio']);
        $consumoHoy['proteina'] = round($consumoHoy['proteina'], 1);

        // 4. Alertas Recientes
        $alertasRecientes = AlertaClinica::where('id_paciente', $paciente->id_paciente)
            ->where('atendida', false)
            ->orderBy('nivel', 'desc') // Mostrar primero las ALTO riesgo
            ->orderBy('fecha', 'desc')
            ->take(3)
            ->get();

        // 5. NUEVO: Recordatorios de Medicamentos de Hoy
        $recordatoriosHoy = RecordatorioMedicamento::with('pacienteMedicamento.medicamento')
            ->whereHas('pacienteMedicamento', function ($query) use ($paciente) {
                $query->where('id_paciente', $paciente->id_paciente)->where('activo', true);
            })
            ->whereDate('fecha', $hoy)
            ->orderBy('hora', 'asc')
            ->get();

        return view('paciente.dashboard.index', compact(
            'limites', 'liquidosHoy', 'registrosLiquidos', 'consumoHoy', 'alertasRecientes', 'recordatoriosHoy'
        ));
    }

    // Método para guardar un nuevo registro de líquido desde el Dashboard
    public function storeLiquido(Request $request)
    {
        $request->validate([
            'cantidad_ml' => 'required|integer|min:1|max:2000',
            'descripcion' => 'nullable|string|max:100',
        ]);

        $paciente = Auth::user()->pacientes()->first();

        ConsumoLiquidos::create([
            'id_paciente' => $paciente->id_paciente,
            'cantidad_ml' => $request->cantidad_ml,
            'descripcion' => $request->descripcion ?? 'Toma rápida',
            'fecha_hora' => now(),
        ]);

        return redirect()->route('paciente.dashboard')->with('success', 'Líquido registrado correctamente.');
    }
}
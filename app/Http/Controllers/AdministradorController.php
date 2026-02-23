<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Alimento;
use App\Models\Medicamento;
use App\Models\ContenidoEducativo;
use App\Models\Comida;
use App\Models\AlertaClinica;
use App\Models\ConsumoLiquidos;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    /**
     * Mostrar el panel de administración.
     */
    public function home()
    {
        // Estadísticas del sistema
        $totalUsuarios = Usuario::count();
        $totalPacientes = Usuario::where('rol', 'PACIENTE')->count();
        $totalDoctores = Usuario::where('rol', 'DOCTOR')->count();
        $totalNutricionistas = Usuario::where('rol', 'NUTRICIONISTA')->count();
        $totalAlimentos = Alimento::count();
        $totalMedicamentos = Medicamento::count();
        $totalContenidos = ContenidoEducativo::count();
        
        // Estadísticas de comidas
        $totalComidas = Comida::count();
        $comidasHoy = Comida::whereDate('fecha_hora', today())->count();
        
        // Alertas clínicas pendientes
        $alertasPendientes = AlertaClinica::where('atendida', false)->count();
        $alertasRecientes = AlertaClinica::where('atendida', false)
            ->orderBy('fecha', 'desc')
            ->limit(5)
            ->get();
        
        // Últimas comidas registradas
        $comidasRecientes = Comida::with('paciente.usuario')
            ->orderBy('fecha_hora', 'desc')
            ->limit(5)
            ->get();
        
        // Consumos de líquidos de hoy
        $consumoLiquidosHoy = ConsumoLiquidos::whereDate('fecha_hora', today())
            ->sum('cantidad_ml');

        // Usuarios recientes
        $usuariosRecientes = Usuario::orderBy('fecha_registro', 'desc')
            ->limit(10)
            ->get();

        // Pacientes con más alertas
        $pacientesConAlertas = Paciente::with('usuario')
            ->withCount(['alertaClinicas' => function($query) {
                $query->where('atendida', false);
            }])
            ->having('alerta_clinicas_count', '>', 0)
            ->orderByDesc('alerta_clinicas_count')
            ->limit(5)
            ->get();

        return view('administrador.home', compact(
            'totalUsuarios',
            'totalPacientes',
            'totalDoctores',
            'totalNutricionistas',
            'totalAlimentos',
            'totalMedicamentos',
            'totalContenidos',
            'totalComidas',
            'comidasHoy',
            'alertasPendientes',
            'alertasRecientes',
            'comidasRecientes',
            'consumoLiquidosHoy',
            'usuariosRecientes',
            'pacientesConAlertas'
        ));
    }

    /**
     * Mostrar lista de pacientes.
     */
    public function pacientesIndex()
    {
        $pacientes = Paciente::with('usuario')->get();
        return view('administrador.pacientes.index', compact('pacientes'));
    }

    /**
     * Mostrar lista de alimentos.
     */
    public function alimentosIndex()
    {
        $alimentos = Alimento::all();
        return view('administrador.alimentos.index', compact('alimentos'));
    }

    /**
     * Mostrar lista de medicamentos.
     */
    public function medicamentosIndex()
    {
        $medicamentos = Medicamento::all();
        return view('administrador.medicamentos.index', compact('medicamentos'));
    }

    /**
     * Mostrar lista de contenidos educativos.
     */
    public function contenidosIndex()
    {
        $contenidos = ContenidoEducativo::all();
        return view('administrador.contenidos.index', compact('contenidos'));
    }

    /**
     * Mostrar reportes del sistema.
     */
    public function reportesIndex()
    {
        return view('administrador.reportes.index');
    }
}

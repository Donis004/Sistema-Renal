<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Medicamento;
use App\Models\PacienteMedicamento;
use App\Models\RecordatorioMedicamento;

class MedicamentoPacienteController extends Controller
{
    // Mostrar tratamiento y agenda
    public function index()
    {
        $paciente = Auth::user()->pacientes()->first();
        $hoy = Carbon::today();

        // 1. Obtener tratamientos activos
        $tratamientos = PacienteMedicamento::with('medicamento')
            ->where('id_paciente', $paciente->id_paciente)
            ->where('activo', true)
            ->get();

        // 2. Generar recordatorios del día automáticamente si no existen
        foreach ($tratamientos as $tratamiento) {
            $tieneRecordatoriosHoy = RecordatorioMedicamento::where('id_pm', $tratamiento->id_pm)
                ->whereDate('fecha', $hoy)
                ->exists();

            if (!$tieneRecordatoriosHoy && $tratamiento->frecuencia != 'Solo si hay dolor') {
                $this->generarRecordatorios($tratamiento, $hoy);
            }
        }

        // 3. Obtener la agenda generada para hoy, ordenada por hora
        $recordatoriosHoy = RecordatorioMedicamento::with('pacienteMedicamento.medicamento')
            ->whereHas('pacienteMedicamento', function ($query) use ($paciente) {
                $query->where('id_paciente', $paciente->id_paciente)->where('activo', true);
            })
            ->whereDate('fecha', $hoy)
            ->orderBy('hora', 'asc')
            ->get();

        return view('paciente.medicamentos.index', compact('tratamientos', 'recordatoriosHoy'));
    }

    // Mostrar formulario de nuevo medicamento
    public function create()
    {
        $catalogoMedicamentos = Medicamento::orderBy('nombre', 'asc')->get();
        return view('paciente.medicamentos.create', compact('catalogoMedicamentos'));
    }

    // Guardar nuevo tratamiento
    public function store(Request $request)
    {
        $request->validate([
            'id_medicamento' => 'required|exists:medicamentos,id_medicamento',
            'dosis' => 'required|string|max:50',
            'frecuencia' => 'required|string|max:50',
            'con_alimentos' => 'required|boolean',
        ]);

        $paciente = Auth::user()->pacientes()->first();

        PacienteMedicamento::create([
            'id_paciente' => $paciente->id_paciente,
            'id_medicamento' => $request->id_medicamento,
            'dosis' => $request->dosis,
            'frecuencia' => $request->frecuencia,
            'con_alimentos' => $request->con_alimentos,
            'activo' => true,
        ]);

        return redirect()->route('paciente.medicamentos.index')->with('success', 'Medicamento añadido a tu tratamiento.');
    }

    // Mostrar formulario para editar
    public function edit($id)
    {
        $paciente = Auth::user()->pacientes()->first();
        
        $tratamiento = PacienteMedicamento::with('medicamento')
            ->where('id_paciente', $paciente->id_paciente)
            ->where('id_pm', $id)
            ->firstOrFail();

        return view('paciente.medicamentos.edit', compact('tratamiento'));
    }

    // Actualizar dosis/frecuencia
    public function update(Request $request, $id)
    {
        $request->validate([
            'dosis' => 'required|string|max:50',
            'frecuencia' => 'required|string|max:50',
            'con_alimentos' => 'required|boolean',
        ]);

        $paciente = Auth::user()->pacientes()->first();
        
        $tratamiento = PacienteMedicamento::where('id_paciente', $paciente->id_paciente)
            ->where('id_pm', $id)
            ->firstOrFail();

        $tratamiento->update([
            'dosis' => $request->dosis,
            'frecuencia' => $request->frecuencia,
            'con_alimentos' => $request->con_alimentos,
        ]);

        // Al cambiar la frecuencia, borramos los recordatorios futuros de hoy (no los ya tomados)
        RecordatorioMedicamento::where('id_pm', $tratamiento->id_pm)
            ->whereDate('fecha', Carbon::today())
            ->where('tomado', false)
            ->delete();

        return redirect()->route('paciente.medicamentos.index')->with('success', 'Tratamiento actualizado.');
    }

    // Suspender un medicamento (Soft delete lógico)
    public function destroy($id)
    {
        $paciente = Auth::user()->pacientes()->first();
        
        $tratamiento = PacienteMedicamento::where('id_paciente', $paciente->id_paciente)
            ->where('id_pm', $id)
            ->firstOrFail();

        $tratamiento->update(['activo' => false]);

        // Borrar alarmas pendientes de hoy
        RecordatorioMedicamento::where('id_pm', $tratamiento->id_pm)
            ->whereDate('fecha', Carbon::today())
            ->where('tomado', false)
            ->delete();

        return redirect()->route('paciente.medicamentos.index')->with('success', 'Medicamento suspendido.');
    }

    // Marcar un recordatorio como "Tomado"
    public function marcarTomado($id_recordatorio)
    {
        $recordatorio = RecordatorioMedicamento::findOrFail($id_recordatorio);
        
        // Verificación de seguridad (que sea del paciente logueado)
        $paciente = Auth::user()->pacientes()->first();
        if ($recordatorio->pacienteMedicamento->id_paciente !== $paciente->id_paciente) {
            abort(403);
        }

        $recordatorio->update(['tomado' => true]);

        return back()->with('success', '¡Dosis registrada!');
    }

    // ==========================================
    // MÉTODO PRIVADO: Generador de horarios
    // ==========================================
    private function generarRecordatorios($tratamiento, Carbon $fecha)
    {
        $horas = [];
        
        // Lógica simple para distribuir pastillas a lo largo del día
        switch ($tratamiento->frecuencia) {
            case 'Cada 8 horas':
                $horas = ['08:00', '16:00', '23:59']; // 3 veces
                break;
            case 'Cada 12 horas':
                $horas = ['08:00', '20:00']; // 2 veces
                break;
            case 'Una vez al día':
                $horas = ['09:00']; // 1 vez
                break;
        }

        foreach ($horas as $horaString) {
            RecordatorioMedicamento::create([
                'id_pm' => $tratamiento->id_pm,
                'hora' => Carbon::parse($fecha->format('Y-m-d') . ' ' . $horaString),
                'fecha' => $fecha,
                'tomado' => false,
            ]);
        }
    }
}
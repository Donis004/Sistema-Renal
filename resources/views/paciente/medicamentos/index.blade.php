@extends('layouts.app_paciente')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-0"><i class="bi bi-capsule text-primary-custom me-2"></i> Mis Medicamentos</h2>
        <p class="text-muted">Controla tu tratamiento y marca tus tomas de hoy, {{ now()->isoFormat('D de MMMM') }}.</p>
    </div>
    <div>
        <a href="{{ route('paciente.medicamentos.create') }}" class="btn btn-primary-custom shadow-sm rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i> Añadir Medicamento
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-light-green border border-success border-opacity-10">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 text-dark"><i class="bi bi-calendar2-check text-success me-2"></i> Agenda de Hoy</h5>
                
                <div class="overflow-auto custom-scrollbar pe-2" style="max-height: 400px;">
                    @forelse($recordatoriosHoy as $recordatorio)
                        <div class="card border-0 shadow-sm rounded-3 mb-3 {{ $recordatorio->tomado ? 'opacity-75' : '' }}">
                            <div class="card-body p-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="bg-{{ $recordatorio->tomado ? 'success' : 'primary' }} bg-opacity-10 p-2 rounded-3 me-3">
                                        <i class="bi bi-clock-history text-{{ $recordatorio->tomado ? 'success' : 'primary-custom' }} fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-{{ $recordatorio->tomado ? 'success' : 'dark' }}">
                                            {{ \Carbon\Carbon::parse($recordatorio->hora)->format('h:i A') }}
                                        </h6>
                                        <p class="mb-0 small fw-semibold">{{ $recordatorio->pacienteMedicamento->medicamento->nombre }}</p>
                                        <p class="text-muted small mb-0">{{ $recordatorio->pacienteMedicamento->dosis }}</p>
                                    </div>
                                </div>
                                
                                <form action="{{ route('paciente.medicamentos.marcar_tomado', $recordatorio->id_recordatorio) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($recordatorio->tomado)
                                        <button type="button" class="btn btn-sm btn-success rounded-pill px-3 disabled">
                                            <i class="bi bi-check2-all me-1"></i> Tomado
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-outline-primary-custom rounded-pill px-3">
                                            Marcar
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-emoji-smile text-muted fs-1 d-block mb-2"></i>
                            <p class="text-muted mb-0">No tienes medicamentos programados para hoy.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-clipboard2-pulse text-primary-custom me-2"></i> Mi Tratamiento Activo</h5>
                
                <div class="overflow-auto custom-scrollbar pe-2" style="max-height: 400px;">
                    <ul class="list-group list-group-flush">
                        @forelse($tratamientos as $tratamiento)
                            <li class="list-group-item px-0 py-3 bg-transparent border-bottom-dashed">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">
                                            {{ $tratamiento->medicamento->nombre }}
                                        </h6>
                                        <div class="d-flex gap-3 text-muted small mb-2">
                                            <span><i class="bi bi-droplet-half me-1"></i> Dosis: {{ $tratamiento->dosis }}</span>
                                            <span><i class="bi bi-arrow-repeat me-1"></i> Frecuencia: {{ $tratamiento->frecuencia }}</span>
                                        </div>
                                        @if($tratamiento->con_alimentos)
                                            <span class="badge bg-warning text-dark"><i class="bi bi-cup-hot me-1"></i> Tomar con alimentos</span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-25 text-dark border"><i class="bi bi-cup me-1"></i> Tomar en ayunas</span>
                                        @endif
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                            <li><a class="dropdown-item" href="{{ route('paciente.medicamentos.edit', $tratamiento->id_pm) }}"><i class="bi bi-pencil me-2"></i> Editar dosis</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('paciente.medicamentos.destroy', $tratamiento->id_pm) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-pause-circle me-2"></i> Suspender</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <div class="text-center py-5">
                                <p class="text-muted mb-0">No has registrado ningún tratamiento continuo.</p>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .border-bottom-dashed { border-bottom: 1px dashed #dee2e6; }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cce8e0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #2ecc71; }
</style>
@endpush
@endsection
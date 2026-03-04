@extends('layouts.app_paciente')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-0">Hola, {{ explode(' ', Auth::user()->nombre)[0] }}</h2>
        <p class="text-muted">Aquí está tu resumen de salud para hoy, {{ now()->isoFormat('D de MMMM') }}.</p>
    </div>
    <div>
        <a href="{{ route('paciente.comidas.create_foto') }}" class="btn btn-primary-custom shadow-sm rounded-pill px-4">
            <i class="bi bi-camera-fill me-2"></i> Analizar Comida
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    
    <div class="col-xl-4 col-lg-5 d-flex flex-column gap-4">
        
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 d-flex flex-column">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-droplet-fill text-info me-2"></i> Control de Líquidos</h5>
                
                <div class="text-center mb-4">
                    @php 
                        $porcentajeLiquido = $limites->liquidos_ml > 0 ? min(100, round(($liquidosHoy / $limites->liquidos_ml) * 100)) : 0;
                        $colorLiquido = $porcentajeLiquido > 90 ? 'bg-danger' : ($porcentajeLiquido > 75 ? 'bg-warning' : 'bg-info');
                    @endphp
                    
                    <h2 class="display-5 fw-bold text-dark mb-0">{{ $liquidosHoy }} <span class="fs-5 text-muted">ml</span></h2>
                    <p class="text-muted mb-2">de tu límite de {{ $limites->liquidos_ml }} ml</p>
                    
                    <div class="progress" style="height: 25px; border-radius: 15px; background-color: #e9ecef;">
                        <div class="progress-bar {{ $colorLiquido }} progress-bar-striped progress-bar-animated" 
                             role="progressbar" 
                             style="width: {{ $porcentajeLiquido }}%" 
                             aria-valuenow="{{ $porcentajeLiquido }}" aria-valuemin="0" aria-valuemax="100">
                             {{ $porcentajeLiquido }}%
                        </div>
                    </div>
                </div>

                <h6 class="fw-semibold text-muted mb-3">Añadir toma rápida:</h6>
                <form action="{{ route('paciente.liquidos.store') }}" method="POST" class="d-flex justify-content-between gap-2 mb-4">
                    @csrf
                    <button type="submit" name="cantidad_ml" value="250" class="btn btn-outline-info flex-fill rounded-3 py-2">
                        <i class="bi bi-cup-straw d-block fs-4 mb-1"></i> 250ml
                    </button>
                    <button type="submit" name="cantidad_ml" value="150" class="btn btn-outline-info flex-fill rounded-3 py-2">
                        <i class="bi bi-cup-hot d-block fs-4 mb-1"></i> 150ml
                    </button>
                    <button type="button" class="btn btn-outline-secondary flex-fill rounded-3 py-2" data-bs-toggle="modal" data-bs-target="#modalLiquido">
                        <i class="bi bi-plus-lg d-block fs-4 mb-1"></i> Otro
                    </button>
                </form>

                <h6 class="fw-semibold text-muted mb-3">Hoy:</h6>
                <div class="overflow-auto pe-2 custom-scrollbar" style="max-height: 150px;">
                    <ul class="list-group list-group-flush">
                        @forelse($registrosLiquidos as $registro)
                            <li class="list-group-item px-0 d-flex justify-content-between align-items-center bg-transparent border-bottom-dashed">
                                <span class="text-dark"><i class="bi bi-clock text-muted me-2 small"></i> {{ $registro->fecha_hora->format('H:i') }}</span>
                                <span class="fw-bold text-info">+{{ $registro->cantidad_ml }} ml</span>
                            </li>
                        @empty
                            <li class="list-group-item px-0 text-muted small text-center bg-transparent">No has registrado líquidos hoy.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-capsule text-primary-custom me-2"></i> Medicinas de Hoy</h5>
                    <a href="{{ route('paciente.medicamentos.index') }}" class="text-decoration-none small text-primary-custom fw-semibold">Ver agenda</a>
                </div>
                
                <div class="overflow-auto pe-2 custom-scrollbar" style="max-height: 250px;">
                    @forelse($recordatoriosHoy as $recordatorio)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom-dashed {{ $recordatorio->tomado ? 'opacity-50' : '' }}">
                            <div class="d-flex align-items-center">
                                <i class="bi {{ $recordatorio->tomado ? 'bi-check-circle-fill text-success' : 'bi-clock text-warning' }} fs-5 me-2"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark fs-6">{{ $recordatorio->pacienteMedicamento->medicamento->nombre }}</h6>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($recordatorio->hora)->format('h:i A') }} - {{ $recordatorio->pacienteMedicamento->dosis }}</small>
                                </div>
                            </div>
                            
                            @if(!$recordatorio->tomado)
                                <form action="{{ route('paciente.medicamentos.marcar_tomado', $recordatorio->id_recordatorio) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1">
                                        Tomar
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-3">
                            <i class="bi bi-emoji-smile text-muted fs-3 d-block mb-1"></i>
                            <p class="text-muted small mb-0">No hay pastillas programadas.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <div class="col-xl-8 col-lg-7 d-flex flex-column gap-4">
        
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-pie-chart-fill text-primary-custom me-2"></i> Consumo Nutricional</h5>
                    <a href="{{ route('paciente.comidas.index') }}" class="text-decoration-none small text-primary-custom fw-semibold">Ver detalles</a>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        @php $pctPotasio = min(100, ($consumoHoy['potasio'] / $limites->potasio_mg) * 100); @endphp
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold text-dark">Potasio</span>
                            <span class="text-muted small">{{ $consumoHoy['potasio'] }} / {{ $limites->potasio_mg }} mg</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar {{ $pctPotasio > 90 ? 'bg-danger' : 'bg-warning' }}" style="width: {{ $pctPotasio }}%"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @php $pctFosforo = min(100, ($consumoHoy['fosforo'] / $limites->fosforo_mg) * 100); @endphp
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold text-dark">Fósforo</span>
                            <span class="text-muted small">{{ $consumoHoy['fosforo'] }} / {{ $limites->fosforo_mg }} mg</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar {{ $pctFosforo > 90 ? 'bg-danger' : 'bg-secondary' }}" style="width: {{ $pctFosforo }}%"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @php $pctSodio = min(100, ($consumoHoy['sodio'] / $limites->sodio_mg) * 100); @endphp
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold text-dark">Sodio</span>
                            <span class="text-muted small">{{ $consumoHoy['sodio'] }} / {{ $limites->sodio_mg }} mg</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar {{ $pctSodio > 90 ? 'bg-danger' : 'bg-primary' }}" style="width: {{ $pctSodio }}%"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        @php $pctProteina = min(100, ($consumoHoy['proteina'] / $limites->proteina_g) * 100); @endphp
                        <div class="d-flex justify-content-between mb-1">
                            <span class="fw-semibold text-dark">Proteína</span>
                            <span class="text-muted small">{{ $consumoHoy['proteina'] }} / {{ $limites->proteina_g }} g</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar {{ $pctProteina > 90 ? 'bg-danger' : 'bg-success' }}" style="width: {{ $pctProteina }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 flex-grow-1">
            <div class="card-body p-4">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> Alertas de Salud</h5>
                
                @forelse($alertasRecientes as $alerta)
                    <div class="alert {{ $alerta->nivel == 'ALTO' ? 'alert-danger' : ($alerta->nivel == 'MEDIO' ? 'alert-warning' : 'alert-info') }} border-0 shadow-sm mb-3 d-flex align-items-start">
                        <i class="bi {{ $alerta->nivel == 'ALTO' ? 'bi-shield-fill-x text-danger' : 'bi-shield-fill-exclamation text-warning' }} fs-4 me-3 mt-1"></i>
                        <div>
                            <h6 class="fw-bold mb-1">{{ $alerta->tipo }}</h6>
                            <p class="mb-0 small">{{ $alerta->descripcion }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-check-circle text-success fs-1 d-block mb-2"></i>
                        <p class="mb-0">Todo en orden. No tienes alertas recientes.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalLiquido" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('paciente.liquidos.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Registrar líquido manual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label text-muted">Cantidad en mililitros (ml)</label>
                    <input type="number" name="cantidad_ml" class="form-control form-control-lg" placeholder="Ej: 300" required>
                    <input type="text" name="descripcion" class="form-control mt-3" placeholder="Descripción (Ej: Sopa, Jugo)">
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-info text-white w-100 py-2 rounded-3">Guardar Registro</button>
                </div>
            </form>
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
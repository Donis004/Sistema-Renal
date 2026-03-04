@extends('layouts.app_paciente')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-0"><i class="bi bi-bell text-primary-custom me-2"></i> Centro de Alertas</h2>
        <p class="text-muted">Revisa las advertencias clínicas generadas por tu actividad.</p>
    </div>
    <div>
        <form action="{{ route('paciente.alertas.recalcular') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary-custom shadow-sm rounded-pill px-4">
                <i class="bi bi-arrow-clockwise me-2"></i> Analizar mi salud hoy
            </button>
        </form>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-8 mx-auto">
        
        @forelse($alertas as $alerta)
            @php
                $borderColor = 'border-info';
                $iconColor = 'text-info';
                $icon = 'bi-info-circle-fill';
                
                if ($alerta->nivel == 'ALTO') {
                    $borderColor = 'border-danger';
                    $iconColor = 'text-danger';
                    $icon = 'bi-shield-fill-x';
                } elseif ($alerta->nivel == 'MEDIO') {
                    $borderColor = 'border-warning';
                    $iconColor = 'text-warning';
                    $icon = 'bi-shield-fill-exclamation';
                }

                // Si está atendida, la ponemos en gris
                if ($alerta->atendida) {
                    $borderColor = 'border-secondary';
                    $iconColor = 'text-secondary';
                    $icon = 'bi-check-circle-fill';
                }
            @endphp

            <div class="card border-0 shadow-sm rounded-4 mb-3 border-start border-5 {{ $borderColor }} {{ $alerta->atendida ? 'bg-light opacity-75' : '' }}">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-start">
                        <i class="bi {{ $icon }} {{ $iconColor }} fs-3 me-3 mt-1"></i>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <h5 class="fw-bold mb-0 {{ $alerta->atendida ? 'text-muted' : 'text-dark' }}">{{ $alerta->tipo }}</h5>
                                @if(!$alerta->atendida)
                                    <span class="badge {{ $alerta->nivel == 'ALTO' ? 'bg-danger' : 'bg-warning text-dark' }} rounded-pill" style="font-size: 0.7rem;">
                                        Prioridad {{ ucfirst(strtolower($alerta->nivel)) }}
                                    </span>
                                @endif
                            </div>
                            <p class="mb-1 {{ $alerta->atendida ? 'text-muted' : '' }}">{{ $alerta->descripcion }}</p>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ $alerta->fecha->isoFormat('D [de] MMMM, h:i A') }}</small>
                        </div>
                    </div>

                    <div>
                        @if(!$alerta->atendida)
                            <form action="{{ route('paciente.alertas.atendida', $alerta->id_alerta) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-secondary rounded-pill btn-sm px-3" title="Marcar como leída">
                                    <i class="bi bi-check2"></i> Entendido
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-shield-check text-success" style="font-size: 5rem;"></i>
                <h4 class="fw-bold mt-3">¡Todo está perfecto!</h4>
                <p class="text-muted">No tienes alertas de salud. Sigue cuidando tu dieta y líquidos.</p>
                <form action="{{ route('paciente.alertas.recalcular') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary-custom rounded-pill px-4">
                        Analizar de nuevo
                    </button>
                </form>
            </div>
        @endforelse

    </div>
</div>
@endsection
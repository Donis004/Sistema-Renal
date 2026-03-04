@extends('layouts.app_paciente')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-0"><i class="bi bi-activity text-primary-custom me-2"></i> Mis Síntomas</h2>
        <p class="text-muted">Historial de cómo te has sentido en los últimos días.</p>
    </div>
    <div>
        <a href="{{ route('paciente.sintomas.create') }}" class="btn btn-primary-custom shadow-sm rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i> Registrar Hoy
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                
                <div class="position-relative">
                    <div class="position-absolute h-100" style="left: 24px; top: 0; width: 2px; background-color: #e9ecef;"></div>
                    
                    @forelse($registrosAgrupados as $fechaHora => $grupoRegistros)
                        @php
                            // Tomamos la intensidad del primer registro del grupo (todos tienen la misma porque se guardaron juntos)
                            $intensidad = strtoupper($grupoRegistros->first()->intensidad);
                            
                            $colorBadge = 'bg-secondary';
                            $icono = 'bi-emoji-neutral';
                            
                            if($intensidad == 'LEVE') { $colorBadge = 'bg-success'; $icono = 'bi-emoji-smile'; }
                            if($intensidad == 'MODERADO') { $colorBadge = 'bg-warning text-dark'; $icono = 'bi-emoji-frown'; }
                            if($intensidad == 'SEVERO') { $colorBadge = 'bg-danger'; $icono = 'bi-emoji-dizzy'; }

                            // Formatear la fecha
                            $fechaFormateada = \Carbon\Carbon::parse($fechaHora);
                        @endphp

                        <div class="position-relative ps-5 mb-4">
                            <div class="position-absolute bg-white border border-3 border-white shadow-sm rounded-circle d-flex align-items-center justify-content-center {{ str_replace('text-dark', '', $colorBadge) }}" 
                                 style="left: 6px; top: 0; width: 38px; height: 38px; z-index: 2;">
                                <i class="bi {{ $icono }} text-white fs-5"></i>
                            </div>

                            <div class="card border border-light shadow-sm rounded-4 bg-light">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-bold mb-0 text-dark">{{ $fechaFormateada->isoFormat('dddd, D [de] MMMM YYYY') }}</h6>
                                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $fechaFormateada->format('h:i A') }}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <span class="badge {{ $colorBadge }} px-3 py-2 rounded-pill me-2">
                                            Intensidad: {{ ucfirst(strtolower($intensidad)) }}
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 mb-1">
                                        @foreach($grupoRegistros as $registro)
                                            <span class="badge bg-white text-dark border px-2 py-1">
                                                <i class="bi bi-check2 text-primary-custom me-1"></i> 
                                                {{ $registro->sintoma->nombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-clipboard-pulse text-muted fs-1 d-block mb-3"></i>
                            <h5 class="fw-bold text-dark">No hay registros aún</h5>
                            <p class="text-muted">Llevar un registro ayuda a tu médico a entender mejor tu progreso.</p>
                            <a href="{{ route('paciente.sintomas.create') }}" class="btn btn-outline-primary-custom rounded-pill px-4 mt-2">Crear mi primer registro</a>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
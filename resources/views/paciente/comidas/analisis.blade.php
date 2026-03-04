@extends('layouts.app_paciente')

@section('contenido')
<div class="mb-4">
    <h2 class="fw-bold text-dark"><i class="bi bi-robot text-primary-custom me-2"></i> Resultados del Análisis</h2>
    <p class="text-muted">Esto es lo que nuestra Inteligencia Artificial detectó en tu plato.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <img src="{{ asset('storage/' . $rutaImagen) }}" alt="Tu comida" class="img-fluid w-100" style="object-fit: cover; height: 250px;">
            <div class="card-body bg-light text-center">
                <span class="badge bg-success rounded-pill px-3 py-2"><i class="bi bi-check-circle me-1"></i> Análisis Completado</span>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 bg-light-green">
            <div class="card-body p-4">
                <h6 class="fw-bold text-primary-custom"><i class="bi bi-info-circle-fill me-2"></i> Observación de la IA</h6>
                <p class="mb-0 text-dark small">{{ $resultadoIa['observacion_general'] ?? 'No hay observaciones adicionales.' }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8 d-flex flex-column" style="max-height: calc(100vh - 120px);">
        
        @php
            // Verificamos si hay al menos una advertencia para mostrar el contenedor
            $hasWarnings = collect($resultadoIa['alimentos'])->contains(function ($alimento) {
                return isset($alimento['es_peligroso']) && $alimento['es_peligroso'];
            });
        @endphp
        
        @if($hasWarnings)
        <div class="mb-3 overflow-auto pe-2 custom-scrollbar" style="max-height: 200px;">
            @foreach($resultadoIa['alimentos'] as $alimento)
                @if(isset($alimento['es_peligroso']) && $alimento['es_peligroso'])
                    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-2 d-flex align-items-start p-3">
                        <i class="bi bi-exclamation-triangle-fill fs-3 text-danger me-3 mt-1"></i>
                        <div>
                            <h5 class="fw-bold mb-1">¡Cuidado con: {{ $alimento['nombre'] }}!</h5>
                            <p class="mb-0 small">{{ $alimento['motivo_riesgo'] }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 flex-grow-1 d-flex flex-column mb-3">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-2">
                <h5 class="fw-bold mb-0">Alimentos Detectados</h5>
                <p class="text-muted small mb-0">Revisa y ajusta las cantidades si es necesario antes de guardar.</p>
            </div>
            
            <div class="card-body px-4 pb-4 d-flex flex-column h-100 overflow-hidden">
                <form action="{{ route('paciente.comidas.confirmar_ia') }}" method="POST" class="d-flex flex-column h-100">
                    @csrf
                    
                    <ul class="list-group list-group-flush mb-3 overflow-auto pe-2 custom-scrollbar flex-grow-1" style="max-height: 350px;">
                        @foreach($resultadoIa['alimentos'] as $alimento)
                            <li class="list-group-item px-0 d-flex justify-content-between align-items-center bg-transparent border-bottom-dashed py-3">
                                
                                <input type="hidden" name="nombres[]" value="{{ $alimento['nombre'] }}">
                                <input type="hidden" name="potasios[]" value="{{ $alimento['potasio_mg'] }}">
                                <input type="hidden" name="fosforos[]" value="{{ $alimento['fosforo_mg'] }}">
                                <input type="hidden" name="sodios[]" value="{{ $alimento['sodio_mg'] }}">
                                <input type="hidden" name="proteinas[]" value="{{ $alimento['proteina_g'] }}">
                                <input type="hidden" name="porciones_estandar[]" value="{{ $alimento['porcion_estandar'] }}">

                                <div class="d-flex align-items-center">
                                    <div class="bg-light-green p-2 rounded-3 me-3 text-primary-custom">
                                        <i class="bi bi-check2-square"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 {{ (isset($alimento['es_peligroso']) && $alimento['es_peligroso']) ? 'text-danger' : '' }}">
                                            {{ $alimento['nombre'] }}
                                        </h6>
                                        <div class="d-flex gap-2 text-muted mt-1" style="font-size: 0.75rem;">
                                            <span class="badge bg-light text-dark border">K: {{ $alimento['potasio_mg'] }}mg</span>
                                            <span class="badge bg-light text-dark border">P: {{ $alimento['fosforo_mg'] }}mg</span>
                                            <span class="badge bg-light text-dark border">Pro: {{ $alimento['proteina_g'] }}g</span>
                                        </div>
                                    </div>
                                </div>
                                <div style="width: 140px;">
                                    <div class="input-group input-group-sm">
                                        <input type="number" step="0.25" min="0.25" name="cantidades[]" class="form-control text-center" value="{{ $alimento['cantidad_detectada'] ?? 1 }}">
                                        <span class="input-group-text">porción</span>
                                    </div>
                                    <div class="text-center text-muted mt-1" style="font-size: 0.65rem;">
                                        (= {{ $alimento['porcion_estandar'] }})
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="d-flex justify-content-end gap-2 mt-auto pt-3 border-top">
                        <a href="{{ route('paciente.comidas.create_foto') }}" class="btn btn-outline-secondary rounded-pill px-4">Retomar Foto</a>
                        <button type="submit" class="btn btn-primary-custom rounded-pill px-4">Confirmar y Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Estilizamos un poco la barra de scroll para que no se vea tosca */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1; 
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cce8e0; 
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #2ecc71; 
    }
</style>
@endpush
@endsection
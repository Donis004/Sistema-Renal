@extends('layouts.app_paciente')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-0">Mis Comidas</h2>
        <p class="text-muted">Registro nutricional de hoy, {{ now()->isoFormat('D de MMMM') }}.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('paciente.alimentos.sugerencias') }}" class="btn btn-primary-custom shadow-sm rounded-pill px-4">
            <i class="bi bi-shield-check me-2"></i> Sugerencias
        </a>
        <a href="{{ route('paciente.comidas.create_manual') }}" class="btn btn-primary-custom shadow-sm rounded-pill px-4">
            <i class="bi bi-pencil-square me-2"></i> Manual
        </a>
        <a href="{{ route('paciente.comidas.create_foto') }}" class="btn btn-primary-custom shadow-sm rounded-pill px-4">
            <i class="bi bi-camera-fill me-2"></i> Foto
        </a>
    </div>
</div>

<div class="overflow-auto pe-2 custom-scrollbar" style="max-height: calc(100vh - 160px); overflow-x: hidden;">
    <div class="row g-4 pb-4">
        @forelse($comidas as $index => $comida)
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="bi bi-egg-fried text-warning me-2"></i> Comida {{ $index + 1 }} 
                            <span class="text-muted fs-6 fw-normal ms-2"><i class="bi bi-clock"></i> {{ $comida->fecha_hora->format('h:i A') }}</span>
                        </h5>
                        <span class="badge {{ $comida->tipo_registro == 'FOTO' ? 'bg-info' : 'bg-secondary' }} rounded-pill">
                            {{ $comida->tipo_registro == 'FOTO' ? 'IA' : 'Manual' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover align-middle mb-0">
                                <thead class="border-bottom text-muted small">
                                    <tr>
                                        <th>Alimento</th>
                                        <th>Porción</th>
                                        <th>Potasio</th>
                                        <th>Fósforo</th>
                                        <th>Sodio</th>
                                        <th>Proteína</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comida->comidaDetalles as $detalle)
                                        <tr>
                                            <td class="fw-semibold">{{ $detalle->alimento->nombre }}</td>
                                            <td>{{ $detalle->cantidad_porcion }} {{ $detalle->alimento->porcion_estandar }}</td>
                                            <td class="text-danger fw-semibold">{{ $detalle->alimento->potasio_mg * $detalle->cantidad_porcion }} mg</td>
                                            <td class="text-secondary fw-semibold">{{ $detalle->alimento->fosforo_mg * $detalle->cantidad_porcion }} mg</td>
                                            <td class="text-primary fw-semibold">{{ $detalle->alimento->sodio_mg * $detalle->cantidad_porcion }} mg</td>
                                            <td class="text-success fw-semibold">{{ $detalle->alimento->proteina_g * $detalle->cantidad_porcion }} g</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 shadow-sm border border-light">
                    <i class="bi bi-basket text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 fw-bold text-dark">No has registrado comidas hoy</h4>
                    <p class="text-muted">Añade tu primera comida usando la cámara o de forma manual para llevar el control de tus nutrientes.</p>
                    <a href="{{ route('paciente.comidas.create_foto') }}" class="btn btn-primary-custom mt-2 px-4 py-2">Comenzar ahora</a>
                </div>
            </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    /* Diseño de la barra de desplazamiento (Scrollbar) */
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
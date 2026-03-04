@extends('layouts.app_paciente')

@section('contenido')
<div class="mb-4">
    <h2 class="fw-bold text-dark"><i class="bi bi-lightbulb text-warning me-2"></i> Sugerencias Inteligentes</h2>
    <p class="text-muted">Descubre alimentos amigables con tus riñones y aprende a sustituir los que son peligrosos.</p>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-5">
    <div class="card-body p-3">
        <div class="input-group input-group-lg">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" id="buscador-alimentos" class="form-control border-start-0 ps-0" placeholder="Buscar una fruta, verdura o proteína...">
        </div>
    </div>
</div>

<h4 class="fw-bold mb-3"><i class="bi bi-arrow-left-right text-primary-custom me-2"></i> Cambios Inteligentes</h4>
<div class="row g-4 mb-5">
    
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
            <div class="row g-0 h-100">
                <div class="col-5 bg-danger bg-opacity-10 d-flex flex-column justify-content-center align-items-center p-3 border-end">
                    <i class="bi bi-x-circle text-danger fs-1 mb-2"></i>
                    <span class="text-danger fw-bold text-center small">Evita el Plátano</span>
                    <span class="badge bg-danger mt-2">Alto en Potasio</span>
                </div>
                <div class="col-7 bg-light-green d-flex flex-column justify-content-center align-items-center p-3">
                    <i class="bi bi-check-circle text-success fs-1 mb-2"></i>
                    <span class="text-success fw-bold text-center">Prefiere la Manzana</span>
                    <span class="badge bg-success mt-2">Bajo en Potasio</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
            <div class="row g-0 h-100">
                <div class="col-5 bg-danger bg-opacity-10 d-flex flex-column justify-content-center align-items-center p-3 border-end">
                    <i class="bi bi-x-circle text-danger fs-1 mb-2"></i>
                    <span class="text-danger fw-bold text-center small">Evita el Tomate</span>
                    <span class="badge bg-danger mt-2">Alto en Potasio</span>
                </div>
                <div class="col-7 bg-light-green d-flex flex-column justify-content-center align-items-center p-3">
                    <i class="bi bi-check-circle text-success fs-1 mb-2"></i>
                    <span class="text-success fw-bold text-center">Prefiere Pimiento Rojo</span>
                    <span class="badge bg-success mt-2">Seguro Renal</span>
                </div>
            </div>
        </div>
    </div>

</div>

<h4 class="fw-bold mb-3"><i class="bi bi-shield-check text-primary-custom me-2"></i> Catálogo Seguro</h4>
<div class="row g-4" id="catalogo-seguro">
    
    @forelse($alimentosSeguros as $alimento)
        <div class="col-md-6 col-lg-4 col-xl-3 item-alimento">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                <div class="card-body p-4 d-flex flex-column">
                    
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="bg-light-green p-3 rounded-circle text-primary-custom">
                            <i class="bi bi-apple fs-3"></i>
                        </div>
                        <span class="badge bg-success bg-opacity-25 text-success rounded-pill px-3 py-2 border border-success">
                            <i class="bi bi-check2-all me-1"></i> Recomendado
                        </span>
                    </div>

                    <h5 class="fw-bold text-dark nombre-alimento">{{ $alimento->nombre }}</h5>
                    <p class="text-muted small mb-3"><i class="bi bi-pie-chart me-1"></i> Porción: {{ $alimento->porcion_estandar }}</p>

                    <div class="mt-auto">
                        <div class="d-flex justify-content-between text-muted small border-bottom pb-2 mb-2">
                            <span>Potasio</span>
                            <span class="fw-semibold">{{ $alimento->potasio_mg }} mg</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small border-bottom pb-2 mb-2">
                            <span>Fósforo</span>
                            <span class="fw-semibold">{{ $alimento->fosforo_mg }} mg</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small pb-2">
                            <span>Sodio</span>
                            <span class="fw-semibold">{{ $alimento->sodio_mg }} mg</span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No se encontraron alimentos seguros en la base de datos.</p>
        </div>
    @endforelse

</div>

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(46, 204, 113, 0.15) !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Filtro rápido en el frontend para el catálogo
    document.getElementById('buscador-alimentos').addEventListener('keyup', function() {
        let filtro = this.value.toLowerCase();
        let items = document.querySelectorAll('.item-alimento');

        items.forEach(function(item) {
            let nombre = item.querySelector('.nombre-alimento').textContent.toLowerCase();
            if (nombre.includes(filtro)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection
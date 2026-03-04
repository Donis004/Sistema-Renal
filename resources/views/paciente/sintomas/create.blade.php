@extends('layouts.app_paciente')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('paciente.sintomas.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Volver al historial
    </a>
    <h2 class="fw-bold text-dark">¿Cómo te sientes hoy?</h2>
    <p class="text-muted">Registra tus síntomas rápidamente para llevar un control detallado.</p>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                
                <form action="{{ route('paciente.sintomas.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="form-label fw-bold d-block mb-3">En general, ¿cómo calificarías tu malestar?</label>
                        <div class="d-flex gap-2">
                            <input type="radio" class="btn-check" name="intensidad" id="int_leve" value="LEVE" autocomplete="off" required>
                            <label class="btn btn-outline-success rounded-pill flex-fill py-2" for="int_leve">
                                <i class="bi bi-emoji-smile d-block fs-4 mb-1"></i> Leve
                            </label>

                            <input type="radio" class="btn-check" name="intensidad" id="int_moderado" value="MODERADO" autocomplete="off">
                            <label class="btn btn-outline-warning rounded-pill flex-fill py-2" for="int_moderado">
                                <i class="bi bi-emoji-frown d-block fs-4 mb-1"></i> Moderado
                            </label>

                            <input type="radio" class="btn-check" name="intensidad" id="int_severo" value="SEVERO" autocomplete="off">
                            <label class="btn btn-outline-danger rounded-pill flex-fill py-2" for="int_severo">
                                <i class="bi bi-emoji-dizzy d-block fs-4 mb-1"></i> Severo
                            </label>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold d-block mb-3">¿Qué síntomas específicos presentas? (Selecciona uno o más)</label>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($catalogoSintomas as $sintoma)
                                <input type="checkbox" class="btn-check" name="sintomas[]" id="sintoma_{{ $sintoma->id_sintoma }}" value="{{ $sintoma->id_sintoma }}" autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill px-3 py-2" for="sintoma_{{ $sintoma->id_sintoma }}">
                                    {{ $sintoma->nombre }}
                                </label>
                            @empty
                                <div class="alert alert-warning border-0 rounded-3 w-100">
                                    No hay síntomas registrados en el catálogo del sistema. Contacta al administrador.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary-custom btn-lg rounded-3">
                            <i class="bi bi-send me-2"></i> Guardar Registro
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .btn-check:checked + .btn-outline-success { background-color: #198754; color: white; border-color: #198754; }
    .btn-check:checked + .btn-outline-warning { background-color: #ffc107; color: black; border-color: #ffc107; }
    .btn-check:checked + .btn-outline-danger { background-color: #dc3545; color: white; border-color: #dc3545; }
    .btn-check:checked + .btn-outline-secondary { background-color: #6c757d; color: white; border-color: #6c757d; }
</style>
@endpush
@endsection
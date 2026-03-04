@extends('layouts.app_paciente')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('paciente.medicamentos.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Volver a mis medicamentos
    </a>
    <h2 class="fw-bold text-dark">Editar Medicamento</h2>
    <p class="text-muted">Modifica la dosis de <strong>{{ $tratamiento->medicamento->nombre }}</strong>.</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                
                <form action="{{ route('paciente.medicamentos.update', $tratamiento->id_pm) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Dosis</label>
                            <input type="text" name="dosis" class="form-control" value="{{ $tratamiento->dosis }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Frecuencia</label>
                            <select name="frecuencia" class="form-select" required>
                                <option value="Cada 8 horas" {{ $tratamiento->frecuencia == 'Cada 8 horas' ? 'selected' : '' }}>Cada 8 horas</option>
                                <option value="Cada 12 horas" {{ $tratamiento->frecuencia == 'Cada 12 horas' ? 'selected' : '' }}>Cada 12 horas</option>
                                <option value="Una vez al día" {{ $tratamiento->frecuencia == 'Una vez al día' ? 'selected' : '' }}>Una vez al día</option>
                                <option value="Solo si hay dolor" {{ $tratamiento->frecuencia == 'Solo si hay dolor' ? 'selected' : '' }}>Solo si hay dolor</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block mb-3">Recomendaciones de toma</label>
                        
                        <div class="form-check form-check-inline bg-light border p-2 rounded-3 me-2">
                            <input class="form-check-input ms-1 mt-1" type="radio" name="con_alimentos" id="con_alimentos_si" value="1" {{ $tratamiento->con_alimentos ? 'checked' : '' }}>
                            <label class="form-check-label px-2" for="con_alimentos_si">
                                <i class="bi bi-cup-hot text-warning me-1"></i> Con alimentos
                            </label>
                        </div>
                        
                        <div class="form-check form-check-inline bg-light border p-2 rounded-3">
                            <input class="form-check-input ms-1 mt-1" type="radio" name="con_alimentos" id="con_alimentos_no" value="0" {{ !$tratamiento->con_alimentos ? 'checked' : '' }}>
                            <label class="form-check-label px-2" for="con_alimentos_no">
                                <i class="bi bi-cup text-secondary me-1"></i> En ayunas
                            </label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-primary-custom btn-lg rounded-3">
                            <i class="bi bi-check2 me-2"></i> Actualizar Cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
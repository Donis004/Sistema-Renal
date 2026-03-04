@extends('layouts.app_paciente')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('paciente.medicamentos.index') }}" class="text-decoration-none text-muted mb-2 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Volver a mis medicamentos
    </a>
    <h2 class="fw-bold text-dark">Añadir Medicamento</h2>
    <p class="text-muted">Registra un nuevo medicamento a tu tratamiento diario.</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                
                <form action="{{ route('paciente.medicamentos.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Medicamento</label>
                        <select name="id_medicamento" class="form-select form-select-lg" required>
                            <option value="">Selecciona tu medicina...</option>
                            @foreach($catalogoMedicamentos as $med)
                                <option value="{{ $med->id_medicamento }}">{{ $med->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Dosis</label>
                            <input type="text" name="dosis" class="form-control" placeholder="Ej: 1 pastilla (50mg)" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Frecuencia</label>
                            <select name="frecuencia" class="form-select" required>
                                <option value="">Selecciona...</option>
                                <option value="Cada 8 horas">Cada 8 horas</option>
                                <option value="Cada 12 horas">Cada 12 horas</option>
                                <option value="Una vez al día">Una vez al día</option>
                                <option value="Solo si hay dolor">Solo si hay dolor</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block mb-3">Recomendaciones de toma</label>
                        
                        <div class="form-check form-check-inline bg-light border p-2 rounded-3 me-2">
                            <input class="form-check-input ms-1 mt-1" type="radio" name="con_alimentos" id="con_alimentos_si" value="1" checked>
                            <label class="form-check-label px-2" for="con_alimentos_si">
                                <i class="bi bi-cup-hot text-warning me-1"></i> Con alimentos
                            </label>
                        </div>
                        
                        <div class="form-check form-check-inline bg-light border p-2 rounded-3">
                            <input class="form-check-input ms-1 mt-1" type="radio" name="con_alimentos" id="con_alimentos_no" value="0">
                            <label class="form-check-label px-2" for="con_alimentos_no">
                                <i class="bi bi-cup text-secondary me-1"></i> En ayunas
                            </label>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary-custom btn-lg rounded-3">
                            <i class="bi bi-save me-2"></i> Guardar Tratamiento
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app_paciente')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('paciente.perfil.show') }}" class="text-decoration-none text-muted mb-2 d-inline-block">
        <i class="bi bi-arrow-left me-1"></i> Volver a mi perfil
    </a>
    <h2 class="fw-bold text-dark">Actualizar Datos Físicos</h2>
    <p class="text-muted">Mantén tus datos al día para que tus cálculos nutricionales sean exactos.</p>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                
                <form action="{{ route('paciente.perfil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="alert bg-light-green border-0 rounded-4 mb-4 d-flex align-items-center">
                        <i class="bi bi-info-circle-fill text-primary-custom fs-4 me-3"></i>
                        <p class="mb-0 small text-dark">Al actualizar tu peso o tus resultados de laboratorio (eGFR), <strong>el sistema recalculará automáticamente tus límites diarios</strong> de proteína y minerales.</p>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Peso actual (kg)</label>
                        <div class="input-group input-group-lg">
                            <input type="number" step="0.1" name="peso_kg" class="form-control" value="{{ $paciente->peso_kg }}" required>
                            <span class="input-group-text bg-light">kg</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Presión Arterial Promedio</label>
                        <input type="text" name="presion_arterial" class="form-control form-control-lg" value="{{ $paciente->presion_arterial }}" placeholder="Ej: 120/80" required>
                        <div class="form-text">Usa el formato Sistólica/Diastólica.</div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-semibold">Tasa de Filtración Glomerular (eGFR)</label>
                        <div class="input-group input-group-lg">
                            <input type="number" step="0.1" name="egfr" class="form-control" value="{{ $paciente->egfr }}" required>
                            <span class="input-group-text bg-light">mL/min</span>
                        </div>
                        <div class="form-text">Si tus últimos exámenes de sangre muestran un nuevo valor, actualízalo aquí.</div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary-custom btn-lg rounded-3">
                            <i class="bi bi-save me-2"></i> Guardar y Recalcular
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar Perfil - RenalMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-green: #2ecc71;
            --dark-green: #27ae60;
            --light-green: #e8f8f5;
        }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4fdf8;
        }
        .text-primary-custom { color: var(--dark-green) !important; }
        .bg-light-green { background-color: var(--light-green); border: 1px solid #cce8e0; }
        .btn-primary-custom {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: white;
            font-weight: 600;
        }
        .btn-primary-custom:hover {
            background-color: var(--dark-green);
            border-color: var(--dark-green);
            color: white;
        }
        .wizard-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .section-icon {
            font-size: 1.5rem;
            color: var(--primary-green);
            background: var(--light-green);
            padding: 10px 15px;
            border-radius: 10px;
            margin-right: 15px;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.25);
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-primary-custom">
                        <i class="bi bi-heart-pulse text-danger"></i> Bienvenido a RenalMe
                    </h2>
                    <p class="lead text-muted">Para personalizar tu dieta y calcular tus límites nutricionales, necesitamos conocer un poco más sobre ti.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 shadow-sm">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('paciente.perfil.guardar') }}">
                    @csrf

                    <div class="card wizard-card p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-person-badge section-icon"></i>
                            <h4 class="mb-0 fw-bold">1. Datos Personales y Físicos</h4>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Sexo</label>
                                <select name="sexo" class="form-select" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                                    <option value="O" {{ old('sexo') == 'O' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Peso actual (kg)</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" name="peso_kg" class="form-control" placeholder="Ej: 75.5" value="{{ old('peso_kg') }}" required>
                                    <span class="input-group-text">kg</span>
                                </div>
                                <small class="text-muted">Tu peso es crucial para calcular cuánta proteína y líquidos puedes consumir.</small>
                            </div>
                        </div>
                    </div>

                    <div class="card wizard-card p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-clipboard2-pulse section-icon"></i>
                            <h4 class="mb-0 fw-bold">2. Estado Renal Actual</h4>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Presión Arterial Promedio</label>
                                <input type="text" name="presion_arterial" class="form-control" placeholder="Ej: 120/80" value="{{ old('presion_arterial') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tasa de Filtración Glomerular (eGFR)</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" name="egfr" class="form-control" placeholder="Ej: 45" value="{{ old('egfr') }}" required>
                                    <span class="input-group-text">mL/min</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="alert bg-light-green mb-0 mt-2">
                                    <i class="bi bi-info-circle-fill text-primary-custom me-2"></i>
                                    <strong>¿Qué es el eGFR?</strong> Es el número que indica qué tan bien están filtrando tus riñones. Aparece en tus últimos exámenes de sangre.  Lo usaremos para determinar tu etapa de Enfermedad Renal Crónica (ERC) automáticamente.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card wizard-card p-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-journal-medical section-icon"></i>
                            <h4 class="mb-0 fw-bold">3. Antecedentes Médicos</h4>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Alergias Alimentarias / Medicamentosas</label>
                                <div class="border rounded p-3 bg-white" style="max-height: 200px; overflow-y: auto;">
                                    @forelse($alergias as $alergia)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="alergias[]" value="{{ $alergia->id_alergia }}" id="alergia_{{ $alergia->id_alergia }}">
                                            <label class="form-check-label" for="alergia_{{ $alergia->id_alergia }}">
                                                {{ $alergia->nombre }}
                                            </label>
                                        </div>
                                    @empty
                                        <span class="text-muted small">No hay alergias registradas en el sistema.</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Otras Condiciones Médicas (Comorbilidades)</label>
                                <div class="border rounded p-3 bg-white" style="max-height: 200px; overflow-y: auto;">
                                    @forelse($comorbilidades as $comorbilidad)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="comorbilidades[]" value="{{ $comorbilidad->id_comorbilidad }}" id="comorbilidad_{{ $comorbilidad->id_comorbilidad }}">
                                            <label class="form-check-label" for="comorbilidad_{{ $comorbilidad->id_comorbilidad }}">
                                                {{ $comorbilidad->nombre }}
                                            </label>
                                        </div>
                                    @empty
                                        <span class="text-muted small">No hay comorbilidades registradas.</span>
                                    @endforelse
                                </div>
                                <small class="text-muted d-block mt-1">Ej: Diabetes, Hipertensión.</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mb-5">
                        <button type="submit" class="btn btn-primary-custom btn-lg py-3 shadow-sm rounded-3">
                            <i class="bi bi-check2-circle me-2"></i> Guardar Perfil y Calcular Mis Límites
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</body>
</html>
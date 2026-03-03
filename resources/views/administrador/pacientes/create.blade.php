<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Crear Paciente - Sistema Renal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #c9f3d6;
      font-family: 'Segoe UI', sans-serif;
    }

    .app-wrapper {
      background: #f6fff9;
      border-radius: 20px;
      padding: 20px;
      box-shadow: 0 15px 40px rgba(0,0,0,.1);
      margin: 30px;
    }

    .sidebar {
      background: #ffffff;
      border-radius: 20px;
      padding: 20px;
      height: 100%;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 15px;
      border-radius: 12px;
      color: #555;
      text-decoration: none;
      margin-bottom: 8px;
    }

    .sidebar a.active,
    .sidebar a:hover {
      background: #1fbf83;
      color: white;
    }

    .header-section {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      border-radius: 20px;
      padding: 25px;
      color: white;
      margin-bottom: 25px;
    }

    .card-custom {
      background: white;
      border-radius: 18px;
      padding: 25px;
      box-shadow: 0 8px 20px rgba(0,0,0,.05);
    }

    .form-control-custom {
      border-radius: 12px;
      padding: 12px 15px;
      border: 1px solid #ddd;
    }

    .form-control-custom:focus {
      border-color: #1fbf83;
      box-shadow: 0 0 0 0.2rem rgba(31, 191, 131, 0.25);
    }

    .btn-success-custom {
      background: #1fbf83;
      border: none;
      color: white;
      padding: 12px 30px;
      border-radius: 12px;
    }

    .btn-success-custom:hover {
      background: #179a6d;
      color: white;
    }

    .btn-outline-custom {
      border: 2px solid #1fbf83;
      color: #1fbf83;
      padding: 12px 30px;
      border-radius: 12px;
    }

    .btn-outline-custom:hover {
      background: #1fbf83;
      color: white;
    }

    .form-label {
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 8px;
    }

    .form-text {
      font-size: 0.85rem;
      color: #6b7280;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="app-wrapper">
    <div class="row g-4">

      <!-- SIDEBAR -->
      <div class="col-md-2">
        <div class="sidebar">
          <h5 class="fw-bold mb-4"><i class="bi bi-heart-pulse text-danger"></i> RenalMe</h5>
          <a href="{{ route('administrador.dashboard') }}"><i class="bi bi-speedometer"></i> Dashboard</a>
          <a href="{{ route('administrador.usuarios.index') }}"><i class="bi bi-people"></i> Usuarios</a>
          <a href="{{ route('administrador.pacientes.index') }}" class="active"><i class="bi bi-person-heart"></i> Pacientes</a>
          <a href="{{ route('administrador.comidas.index') }}"><i class="bi bi-utensils"></i> Comidas</a>
          <a href="{{ route('administrador.alimentos.index') }}"><i class="bi bi-cup-hot"></i> Alimentos</a>
          <a href="{{ route('administrador.medicamentos.index') }}"><i class="bi bi-capsule"></i> Medicina</a>
          <a href="{{ route('administrador.contenidos.index') }}"><i class="bi bi-book"></i> Contenido</a>
          <a href="{{ route('administrador.reportes.index') }}"><i class="bi bi-graph-up"></i> Reportes</a>
        </div>
      </div>

      <!-- MAIN CONTENT -->
      <div class="col-md-10">

        <!-- HEADER SECTION -->
        <div class="header-section">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h2 class="mb-1"><i class="bi bi-person-plus me-2"></i>Crear Nuevo Paciente</h2>
              <p class="mb-0 opacity-75">Agrega un nuevo paciente al sistema</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.pacientes.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- FORMULARIO -->
        <div class="card-custom">
          <form method="POST" action="{{ route('administrador.pacientes.store') }}">
            @csrf
            
            <!-- Información del Usuario -->
            <h6 class="mb-4 fw-bold text-primary"><i class="bi bi-person-badge"></i> Información del Usuario</h6>
            
            <div class="row g-3 mb-4">
              <div class="col-md-12">
                <label for="id_usuario" class="form-label">Usuario Asociado *</label>
                <select class="form-select form-control-custom @error('id_usuario') is-invalid @enderror" 
                        id="id_usuario" name="id_usuario" required>
                  <option value="">Seleccionar usuario</option>
                  @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}" {{ old('id_usuario') == $usuario->id_usuario ? 'selected' : '' }}>
                      {{ $usuario->nombre }} ({{ $usuario->email }})
                    </option>
                  @endforeach
                </select>
                @error('id_usuario')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <hr>

            <!-- Información Clínica -->
            <h6 class="mb-4 fw-bold text-primary"><i class="bi bi-heart-pulse"></i> Información Clínica</h6>
            
            <div class="row g-3 mb-4">
              <div class="col-md-4">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control form-control-custom @error('fecha_nacimiento') is-invalid @enderror" 
                       id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                @error('fecha_nacimiento')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="sexo" class="form-label">Género *</label>
                <select class="form-select form-control-custom @error('sexo') is-invalid @enderror" 
                        id="sexo" name="sexo" required>
                  <option value="">Seleccionar género</option>
                  <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                  <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                  <option value="O" {{ old('sexo') == 'O' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('sexo')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4">
                <label for="peso_kg" class="form-label">Peso (kg)</label>
                <input type="number" step="0.01" class="form-control form-control-custom @error('peso_kg') is-invalid @enderror" 
                       id="peso_kg" name="peso_kg" value="{{ old('peso_kg') }}" placeholder="Ej: 75.50">
                @error('peso_kg')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="presion_arterial" class="form-label">Presión Arterial</label>
                <input type="text" class="form-control form-control-custom @error('presion_arterial') is-invalid @enderror" 
                       id="presion_arterial" name="presion_arterial" value="{{ old('presion_arterial') }}" placeholder="Ej: 120/80">
                @error('presion_arterial')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="egfr" class="form-label">EGFR (mL/min/1.73m²)</label>
                <input type="number" step="0.01" class="form-control form-control-custom @error('egfr') is-invalid @enderror" 
                       id="egfr" name="egfr" value="{{ old('egfr') }}" placeholder="Ej: 45.50">
                @error('egfr')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-12">
                <label for="etapa_erc" class="form-label">Etapa de ERC (Enfermedad Renal Crónica) *</label>
                <select class="form-select form-control-custom @error('etapa_erc') is-invalid @enderror" 
                        id="etapa_erc" name="etapa_erc" required>
                  <option value="">Seleccionar etapa</option>
                  <option value="1" {{ old('etapa_erc') == '1' ? 'selected' : '' }}>Etapa 1 (EGFR ≥ 90)</option>
                  <option value="2" {{ old('etapa_erc') == '2' ? 'selected' : '' }}>Etapa 2 (EGFR 60-89)</option>
                  <option value="3a" {{ old('etapa_erc') == '3a' ? 'selected' : '' }}>Etapa 3a (EGFR 45-59)</option>
                  <option value="3b" {{ old('etapa_erc') == '3b' ? 'selected' : '' }}>Etapa 3b (EGFR 30-44)</option>
                  <option value="4" {{ old('etapa_erc') == '4' ? 'selected' : '' }}>Etapa 4 (EGFR 15-29)</option>
                  <option value="5" {{ old('etapa_erc') == '5' ? 'selected' : '' }}>Etapa 5 (EGFR < 15)</option>
                </select>
                @error('etapa_erc')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <hr>

            <!-- Plan de Dieta -->
            <h6 class="mb-4 fw-bold text-primary"><i class="bi bi-cup-hot"></i> Plan de Dieta</h6>
            
            <div class="row g-3 mb-4">
              <div class="col-md-12">
                <label for="dieta_prescrita" class="form-label">Dieta Prescrita</label>
                <textarea class="form-control form-control-custom @error('dieta_prescrita') is-invalid @enderror" 
                          id="dieta_prescrita" name="dieta_prescrita" rows="4" placeholder="Describe el plan dietético para el paciente...">{{ old('dieta_prescrita') }}</textarea>
                @error('dieta_prescrita')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text">Incluye restricciones, alimentos permitidos y prohibidos.</small>
              </div>
            </div>

            <div class="col-md-12 mt-4 mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="perfil_completo" name="perfil_completo" value="1" 
                       {{ old('perfil_completo') ? 'checked' : '' }}>
                <label class="form-check-label" for="perfil_completo">
                  Perfil Completo
                </label>
                <small class="form-text d-block">Marca si el perfil del paciente está completamente lleno de información.</small>
              </div>
            </div>

            <div class="col-md-12 mt-4">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success-custom">
                  <i class="bi bi-check-circle me-2"></i>Crear Paciente
                </button>
                <a href="{{ route('administrador.pacientes.index') }}" class="btn btn-outline-custom">
                  Cancelar
                </a>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

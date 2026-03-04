<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Editar Recomendación - Sistema Renal</title>
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

    .form-select-custom {
      border-radius: 12px;
      padding: 12px 15px;
      border: 1px solid #ddd;
    }

    .form-select-custom:focus {
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

    .form-section-title {
      font-size: 1rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 20px;
      margin-top: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid #1fbf83;
    }

    textarea.form-control-custom {
      min-height: 200px;
      resize: vertical;
    }

    .info-box {
      background: #f0fdf4;
      border-left: 4px solid #1fbf83;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .info-box-label {
      font-size: 0.85rem;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .info-box-value {
      font-size: 1.1rem;
      color: #1fbf83;
      font-weight: 600;
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
          <a href="{{ route('administrador.pacientes.index') }}"><i class="bi bi-person-heart"></i> Pacientes</a>
          <a href="{{ route('administrador.comidas.index') }}"><i class="bi bi-utensils"></i> Comidas</a>
          <a href="{{ route('administrador.alimentos.index') }}"><i class="bi bi-cup-hot"></i> Alimentos</a>
          <a href="{{ route('administrador.medicamentos.index') }}"><i class="bi bi-capsule"></i> Medicina</a>
          <a href="{{ route('administrador.contenidos.index') }}"><i class="bi bi-book"></i> Contenido</a>
          <a href="{{ route('administrador.recomendaciones.index') }}" class="active"><i class="bi bi-chat-left-text"></i> Recomendaciones</a>
          <a href="{{ route('administrador.reportes.index') }}"><i class="bi bi-graph-up"></i> Reportes</a>
        </div>
      </div>

      <!-- MAIN CONTENT -->
      <div class="col-md-10">

        <!-- HEADER SECTION -->
        <div class="header-section">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h2 class="mb-1"><i class="bi bi-pencil me-2"></i>Editar Recomendación</h2>
              <p class="mb-0 opacity-75">Actualiza la recomendación de profesional a paciente</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.recomendaciones.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- FORMULARIO -->
        <div class="card-custom">
          <div class="info-box">
            <div class="info-box-label">Identificador</div>
            <div class="info-box-value">#{{ $recomendacion->id_recomendacion }}</div>
          </div>

          <form method="POST" action="{{ route('administrador.recomendaciones.update', $recomendacion->id_recomendacion) }}">
            @csrf
            @method('PUT')
            
            <h6 class="form-section-title"><i class="bi bi-bookmark"></i> Información de la Recomendación</h6>
            
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label for="id_paciente" class="form-label">Paciente *</label>
                <select class="form-select form-select-custom @error('id_paciente') is-invalid @enderror" 
                        id="id_paciente" name="id_paciente" required>
                  <option value="">Seleccionar paciente</option>
                  @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}" {{ old('id_paciente', $recomendacion->id_paciente) == $paciente->id_paciente ? 'selected' : '' }}>
                      {{ $paciente->usuario->nombre }}
                    </option>
                  @endforeach
                </select>
                @error('id_paciente')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="id_profesional" class="form-label">Profesional *</label>
                <select class="form-select form-select-custom @error('id_profesional') is-invalid @enderror" 
                        id="id_profesional" name="id_profesional" required>
                  <option value="">Seleccionar profesional</option>
                  @foreach($profesionales as $profesional)
                    <option value="{{ $profesional->id_usuario }}" {{ old('id_profesional', $recomendacion->id_profesional) == $profesional->id_usuario ? 'selected' : '' }}>
                      {{ $profesional->nombre }} ({{ $profesional->email }})
                    </option>
                  @endforeach
                </select>
                @error('id_profesional')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <h6 class="form-section-title"><i class="bi bi-chat-left-text"></i> Mensaje</h6>

            <div class="row g-3 mb-4">
              <div class="col-md-12">
                <label for="mensaje" class="form-label">Mensaje de Recomendación *</label>
                <textarea class="form-control form-control-custom @error('mensaje') is-invalid @enderror" 
                          id="mensaje" name="mensaje" 
                          placeholder="Escribe la recomendación aquí..." required>{{ old('mensaje', $recomendacion->mensaje) }}</textarea>
                @error('mensaje')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text">Proporciona una recomendación clara y detallada para el paciente</small>
              </div>
            </div>

            <div class="col-md-12 mt-4">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success-custom">
                  <i class="bi bi-check-circle me-2"></i>Guardar Cambios
                </button>
                <a href="{{ route('administrador.recomendaciones.index') }}" class="btn btn-outline-custom">
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

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Reportes - Sistema Renal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --primary-green: #1fbf83;
      --secondary-green: #38b2ac;
      --dark-text: #1f2937;
      --muted-text: #6b7280;
    }

    body {
      background-color: #c9f3d6;
      font-family: 'Segoe UI', sans-serif;
    }

    .app-wrapper {
      background: #f6fff9;
      border-radius: 20px;
      padding: 25px;
      box-shadow: 0 15px 40px rgba(0,0,0,.1);
      margin: 30px;
    }

    .sidebar {
      background: #ffffff;
      border-radius: 20px;
      padding: 20px;
      height: 100%;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 15px;
      border-radius: 12px;
      color: #555;
      text-decoration: none;
      margin-bottom: 8px;
      transition: all 0.3s ease;
    }

    .sidebar a:hover,
    .sidebar a.active {
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
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      padding: 25px;
      margin-bottom: 25px;
    }

    .form-label {
      color: var(--dark-text);
      font-weight: 600;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-control, .form-select {
      border-radius: 10px;
      border: 2px solid #e5e7eb;
      padding: 12px 15px;
      font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--primary-green);
      box-shadow: 0 0 0 0.2rem rgba(31, 191, 131, 0.25);
    }

    .btn-generate {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      border: none;
      color: white;
      padding: 12px 30px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-generate:hover {
      background: linear-gradient(135deg, #38b2ac, #2c9a94);
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(31, 191, 131, 0.4);
      color: white;
    }

    .btn-reset {
      background: #e5e7eb;
      border: none;
      color: var(--dark-text);
      padding: 12px 30px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-reset:hover {
      background: #d1d5db;
    }

    .section-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--dark-text);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .section-title i {
      color: var(--primary-green);
    }

    .info-box {
      background: #f0fdf4;
      border-left: 4px solid var(--primary-green);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .info-box i {
      color: var(--primary-green);
      font-size: 1.3rem;
    }

    .info-text {
      color: var(--dark-text);
      margin-left: 12px;
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
          <h5 class="fw-bold mb-4">
            <i class="bi bi-heart-pulse text-danger me-2"></i>RenalMe
          </h5>
          <a href="{{ route('administrador.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
          <a href="{{ route('administrador.usuarios.index') }}">
            <i class="bi bi-people"></i> Usuarios
          </a>
          <a href="{{ route('administrador.pacientes.index') }}">
            <i class="bi bi-person-heart"></i> Pacientes
          </a>
          <a href="{{ route('administrador.comidas.index') }}">
            <i class="bi bi-utensils"></i> Comidas
          </a>
          <a href="{{ route('administrador.alimentos.index') }}">
            <i class="bi bi-cup-hot"></i> Alimentos
          </a>
          <a href="{{ route('administrador.medicamentos.index') }}">
            <i class="bi bi-capsule"></i> Medicina
          </a>
          <a href="{{ route('administrador.contenidos.index') }}">
            <i class="bi bi-book"></i> Contenido
          </a>
          <a href="{{ route('administrador.recomendaciones.index') }}">
            <i class="bi bi-chat-left-text"></i> Recomendaciones
          </a>
          <a href="{{ route('administrador.reportes.index') }}" class="active">
            <i class="bi bi-graph-up"></i> Reportes
          </a>
        </div>
      </div>

      <!-- MAIN CONTENT -->
      <div class="col-md-10">

        <!-- HEADER SECTION -->
        <div class="header-section">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h2 class="mb-2">
                <i class="bi bi-graph-up me-2"></i>Reportes Clínicos
              </h2>
              <p class="mb-0 opacity-75">Genera y descarga reportes detallados de pacientes</p>
            </div>
            <div class="col-md-4 text-end">
              <i class="bi bi-info-circle me-2"></i>
              <small>Confidencial - Solo para profesionales</small>
            </div>
          </div>
        </div>

        <!-- INFO BOX -->
        <div class="info-box">
          <div class="d-flex align-items-start">
            <i class="bi bi-shield-check"></i>
            <div class="info-text">
              <strong>Confidencialidad garantizada:</strong> Este reporte contiene información médica del paciente. Acceso restringido solo a doctores y nutricionistas autorizados.
            </div>
          </div>
        </div>

        <!-- FORMULARIO DE FILTROS -->
        <div class="card-custom">
          <h5 class="section-title mb-4">
            <i class="bi bi-funnel"></i>Generar Reporte
          </h5>

          <form action="{{ route('administrador.reportes.descargar') }}" method="POST">
            @csrf
            
            <div class="row">
              <!-- Seleccionar Paciente -->
              <div class="col-md-6 mb-4">
                <label for="id_paciente" class="form-label">
                  <i class="bi bi-person-heart"></i>Paciente
                </label>
                <select name="id_paciente" id="id_paciente" class="form-select @error('id_paciente') is-invalid @enderror" required>
                  <option value="">-- Seleccionar paciente --</option>
                  @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}" {{ old('id_paciente') == $paciente->id_paciente ? 'selected' : '' }}>
                      {{ $paciente->usuario->nombre }} ({{ $paciente->usuario->email }})
                    </option>
                  @endforeach
                </select>
                @error('id_paciente')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Fecha Inicio -->
              <div class="col-md-3 mb-4">
                <label for="fecha_inicio" class="form-label">
                  <i class="bi bi-calendar-event"></i>Desde
                </label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" 
                       value="{{ old('fecha_inicio', now()->subMonths(1)->format('Y-m-d')) }}" required>
                @error('fecha_inicio')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Fecha Fin -->
              <div class="col-md-3 mb-4">
                <label for="fecha_fin" class="form-label">
                  <i class="bi bi-calendar-event"></i>Hasta
                </label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" 
                       value="{{ old('fecha_fin', now()->format('Y-m-d')) }}" required>
                @error('fecha_fin')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- BOTONES -->
            <div class="d-flex gap-3 mt-4">
              <button type="submit" class="btn btn-generate">
                <i class="bi bi-download me-2"></i>Descargar Reporte PDF
              </button>
              <button type="reset" class="btn btn-reset">
                <i class="bi bi-arrow-clockwise me-2"></i>Limpiar
              </button>
            </div>
          </form>
        </div>

        <!-- INFORMACIÓN -->
        <div class="card-custom">
          <h5 class="section-title mb-3">
            <i class="bi bi-info-circle"></i>Información del Reporte
          </h5>
          
          <div class="row">
            <div class="col-md-6">
              <p><strong><i class="bi bi-check-circle text-success me-2"></i>Incluye:</strong></p>
              <ul class="list-unstyled ms-4">
                <li><i class="bi bi-cup-hot text-muted me-2"></i>Consumo de líquidos</li>
                <li><i class="bi bi-utensils text-muted me-2"></i>Dieta registrada</li>
                <li><i class="bi bi-heart-pulse text-muted me-2"></i>Síntomas reportados</li>
                <li><i class="bi bi-capsule text-muted me-2"></i>Medicamentos prescritos</li>
              </ul>
            </div>
            <div class="col-md-6">
              <p><strong><i class="bi bi-shield-check text-success me-2"></i>Características:</strong></p>
              <ul class="list-unstyled ms-4">
                <li><i class="bi bi-calendar-event text-muted me-2"></i>Rango de fechas personalizable</li>
                <li><i class="bi bi-file-pdf text-muted me-2"></i>Descargable en PDF</li>
                <li><i class="bi bi-printer text-muted me-2"></i>Imprimible</li>
                <li><i class="bi bi-lock text-muted me-2"></i>Datos confidenciales</li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

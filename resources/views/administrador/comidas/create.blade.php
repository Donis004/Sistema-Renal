<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Crear Comida - Sistema Renal</title>
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
          <a href="{{ route('administrador.comidas.index') }}" class="active"><i class="bi bi-utensils"></i> Comidas</a>
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
              <h2 class="mb-1"><i class="bi bi-plus-circle me-2"></i>Nueva Comida</h2>
              <p class="mb-0 opacity-75">Registra una nueva comida</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.comidas.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- FORMULARIO -->
        <div class="card-custom">
          <form method="POST" action="{{ route('administrador.comidas.store') }}">
            @csrf
            
            <div class="row g-3">
              <div class="col-md-6">
                <label for="id_paciente" class="form-label">Paciente</label>
                @if($pacientes->isEmpty())
                  <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle me-2"></i>No hay pacientes registrados. 
                    <a href="{{ route('administrador.pacientes.index') }}">Ver pacientes</a>
                  </div>
                @else
                  <select class="form-select form-control-custom @error('id_paciente') is-invalid @enderror" 
                          id="id_paciente" name="id_paciente" required>
                    <option value="">Seleccionar paciente</option>
                    @foreach($pacientes as $paciente)
                      <option value="{{ $paciente->id_usuario }}">
                        {{ $paciente->nombre ?? 'Paciente #' . $paciente->id_usuario }}
                      </option>
                    @endforeach
                  </select>
                @endif
                @error('id_paciente')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="tipo_registro" class="form-label">Tipo de Registro</label>
                <select class="form-select form-control-custom @error('tipo_registro') is-invalid @enderror" 
                        id="tipo_registro" name="tipo_registro" required>
                  <option value="">Seleccionar tipo</option>
                  <option value="MANUAL" {{ old('tipo_registro') == 'MANUAL' ? 'selected' : '' }}>Manual</option>
                  <option value="FOTO" {{ old('tipo_registro') == 'FOTO' ? 'selected' : '' }}>Foto</option>
                </select>
                @error('tipo_registro')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                <input type="datetime-local" class="form-control form-control-custom @error('fecha_hora') is-invalid @enderror" 
                       id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora') }}">
                @error('fecha_hora')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-12 mt-4">
                <div class="d-flex gap-2">
                  <button type="submit" class="btn btn-success-custom">
                    <i class="bi bi-check-circle me-2"></i>Crear Comida
                  </button>
                  <a href="{{ route('administrador.comidas.index') }}" class="btn btn-outline-custom">
                    Cancelar
                  </a>
                </div>
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

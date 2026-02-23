<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Editar Alimento - Sistema Renal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --primary-green: #1fbf83;
      --secondary-green: #38b2ac;
      --light-green: #f0fdf4;
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

    .sidebar a.active,
    .sidebar a:hover {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      color: white;
      transform: translateX(5px);
    }

    .header-section {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      border-radius: 20px;
      padding: 30px;
      color: white;
      margin-bottom: 30px;
      box-shadow: 0 10px 30px rgba(31, 191, 131, 0.3);
    }

    .card-custom {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      border: none;
    }

    .form-label {
      font-weight: 600;
      color: var(--dark-text);
      margin-bottom: 8px;
    }

    .form-control,
    .form-select {
      border-radius: 12px;
      padding: 12px 15px;
      border: 2px solid #e5e7eb;
      transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #1fbf83;
      box-shadow: 0 0 0 3px rgba(31, 191, 131, 0.1);
    }

    .btn-primary-custom {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      border: none;
      color: white;
      padding: 12px 30px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(31, 191, 131, 0.4);
      color: white;
    }

    .btn-secondary-custom {
      background: #f3f4f6;
      border: none;
      color: #4b5563;
      padding: 12px 30px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-secondary-custom:hover {
      background: #e5e7eb;
      color: #4b5563;
    }

    .nutrient-card {
      background: #f8fafc;
      border-radius: 15px;
      padding: 20px;
      border: 1px solid #e5e7eb;
    }

    .nutrient-title {
      font-weight: 600;
      color: var(--dark-text);
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-check-input:checked {
      background-color: #1fbf83;
      border-color: #1fbf83;
    }

    .back-btn {
      background: rgba(255,255,255,0.2);
      border: 2px solid rgba(255,255,255,0.3);
      color: white;
      padding: 10px 20px;
      border-radius: 12px;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .back-btn:hover {
      background: white;
      color: #1fbf83;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="app-wrapper">
    <div class="row g-4">

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
          <a href="{{ route('administrador.alimentos.index') }}" class="active">
            <i class="bi bi-cup-hot"></i> Alimentos
          </a>
          <a href="{{ route('administrador.medicamentos.index') }}">
            <i class="bi bi-capsule"></i> Medicina
          </a>
          <a href="{{ route('administrador.contenidos.index') }}">
            <i class="bi bi-book"></i> Contenido
          </a>
          <a href="{{ route('administrador.reportes.index') }}">
            <i class="bi bi-graph-up"></i> Reportes
          </a>
        </div>
      </div>

      <div class="col-md-10">
        <div class="header-section">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h2 class="mb-2">
                <i class="bi bi-pencil-square me-2"></i>Editar Alimento
              </h2>
              <p class="mb-0 opacity-75">Modifica los datos del alimento</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.alimentos.index') }}" class="back-btn">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <div class="card-custom">
          <form method="POST" action="{{ route('administrador.alimentos.update', $alimento->id_alimento) }}">
            @csrf
            @method('PUT')

            <div class="row g-4">
              <!-- Nombre -->
              <div class="col-md-12">
                <label for="nombre" class="form-label">
                  <i class="bi bi-cup-hot me-2 text-success"></i>Nombre del Alimento *
                </label>
                <input type="text" class="form-control" id="nombre" name="nombre" 
                       value="{{ old('nombre', $alimento->nombre) }}" required maxlength="150">
                @error('nombre')
                  <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>

              <!-- Nutrientes -->
              <div class="col-md-12">
                <div class="nutrient-card">
                  <div class="nutrient-title">
                    <i class="bi bi-lightning text-warning"></i>
                    Valores Nutricionales (por 100g)
                  </div>
                  <div class="row g-3">
                    <div class="col-md-3">
                      <label for="potasio_mg" class="form-label">Potasio (mg)</label>
                      <input type="number" class="form-control" id="potasio_mg" name="potasio_mg" 
                             value="{{ old('potasio_mg', $alimento->potasio_mg) }}" min="0">
                    </div>
                    <div class="col-md-3">
                      <label for="fosforo_mg" class="form-label">Fósforo (mg)</label>
                      <input type="number" class="form-control" id="fosforo_mg" name="fosforo_mg" 
                             value="{{ old('fosforo_mg', $alimento->fosforo_mg) }}" min="0">
                    </div>
                    <div class="col-md-3">
                      <label for="sodio_mg" class="form-label">Sodio (mg)</label>
                      <input type="number" class="form-control" id="sodio_mg" name="sodio_mg" 
                             value="{{ old('sodio_mg', $alimento->sodio_mg) }}" min="0">
                    </div>
                    <div class="col-md-3">
                      <label for="proteina_g" class="form-label">Proteína (g)</label>
                      <input type="number" step="0.01" class="form-control" id="proteina_g" name="proteina_g" 
                             value="{{ old('proteina_g', $alimento->proteina_g) }}" min="0">
                    </div>
                  </div>
                </div>
              </div>

              <!-- Porción Estándar -->
              <div class="col-md-6">
                <label for="porcion_estandar" class="form-label">
                  <i class="bi bi-rulers me-2 text-primary"></i>Porción Estándar
                </label>
                <input type="text" class="form-control" id="porcion_estandar" name="porcion_estandar" 
                       value="{{ old('porcion_estandar', $alimento->porcion_estandar) }}">
              </div>

              <!-- Seguro Renal -->
              <div class="col-md-6">
                <label class="form-label">
                  <i class="bi bi-shield-check me-2 text-success"></i>¿Seguro para Renal?
                </label>
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" id="seguro_renal" name="seguro_renal" 
                         value="1" {{ old('seguro_renal', $alimento->seguro_renal) ? 'checked' : '' }}>
                  <label class="form-check-label" for="seguro_renal">
                    Marcar si el alimento es seguro para pacientes renales
                  </label>
                </div>
              </div>

              <!-- Botones -->
              <div class="col-md-12 mt-4">
                <div class="d-flex gap-3 justify-content-end">
                  <a href="{{ route('administrador.alimentos.index') }}" class="btn btn-secondary-custom">
                    <i class="bi bi-x-circle me-2"></i>Cancelar
                  </a>
                  <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-2"></i>Actualizar Alimento
                  </button>
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

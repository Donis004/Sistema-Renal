<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Alimento - Sistema Renal</title>
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
      transition: transform 0.3s ease;
    }

    .card-custom:hover {
      transform: translateY(-5px);
    }

    .card-icon {
      width: 60px;
      height: 60px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 15px;
    }

    .icon-primary { background: #e0f7eb; color: #1fbf83; }
    .icon-info { background: #e0efff; color: #3182ce; }
    .icon-warning { background: #fff8e0; color: #d69e2e; }

    .info-label {
      font-weight: 600;
      color: var(--muted-text);
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 5px;
    }

    .info-value {
      color: var(--dark-text);
      font-size: 1.1rem;
      font-weight: 500;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 1px solid #f0f0f0;
    }

    .info-value:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .badge-seguro {
      background: #d1fae5;
      color: #059669;
      padding: 8px 18px;
      border-radius: 25px;
      font-size: 0.9rem;
      font-weight: 600;
    }

    .badge-peligroso {
      background: #fee2e2;
      color: #dc2626;
      padding: 8px 18px;
      border-radius: 25px;
      font-size: 0.9rem;
      font-weight: 600;
    }

    .nutrient-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 15px;
      background: #f8fafc;
      border-radius: 10px;
      margin-bottom: 10px;
    }

    .nutrient-item:last-child {
      margin-bottom: 0;
    }

    .nutrient-name {
      font-weight: 600;
      color: var(--dark-text);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .nutrient-value {
      font-weight: 700;
      color: var(--primary-green);
    }

    .btn-action {
      padding: 12px 25px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .btn-edit {
      background: linear-gradient(135deg, #38b2ac, #2c9a94);
      border: none;
      color: white;
    }

    .btn-delete {
      background: linear-gradient(135deg, #e53e3e, #c53030);
      border: none;
      color: white;
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
                <i class="bi bi-cup-hot me-2"></i>Detalles del Alimento
              </h2>
              <p class="mb-0 opacity-75">Información completa del alimento</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.alimentos.index') }}" class="back-btn">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-md-6">
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-primary me-3">
                  <i class="bi bi-info-circle"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información General</h5>
                  <small class="text-muted">Datos principales del alimento</small>
                </div>
              </div>
              
              <div class="info-label">ID del Alimento</div>
              <div class="info-value">#{{ $alimento->id_alimento }}</div>

              <div class="info-label">Nombre</div>
              <div class="info-value">
                <i class="bi bi-cup-hot me-2 text-success"></i>
                {{ $alimento->nombre }}
              </div>

              <div class="info-label">Porción Estándar</div>
              <div class="info-value">
                <i class="bi bi-rulers me-2 text-primary"></i>
                {{ $alimento->porcion_estandar ?? 'No especificada' }}
              </div>

              <div class="info-label">Estado Renal</div>
              <div class="info-value">
                @if($alimento->seguro_renal)
                  <span class="badge-seguro">
                    <i class="bi bi-check-circle me-1"></i>Seguro para Renal
                  </span>
                @else
                  <span class="badge-peligroso">
                    <i class="bi bi-exclamation-triangle me-1"></i>No Recomendado
                  </span>
                @endif
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card-custom mb-4">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-info me-3">
                  <i class="bi bi-lightning"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Valores Nutricionales</h5>
                  <small class="text-muted">Por cada 100g</small>
                </div>
              </div>
              
              <div class="nutrient-item">
                <div class="nutrient-name">
                  <i class="bi bi-lightning-charge text-warning"></i> Potasio
                </div>
                <div class="nutrient-value">{{ $alimento->potasio_mg ?? 0 }} mg</div>
              </div>

              <div class="nutrient-item">
                <div class="nutrient-name">
                  <i class="bi bi-gem text-purple"></i> Fósforo
                </div>
                <div class="nutrient-value">{{ $alimento->fosforo_mg ?? 0 }} mg</div>
              </div>

              <div class="nutrient-item">
                <div class="nutrient-name">
                  <i class="bi bi-droplet text-info"></i> Sodio
                </div>
                <div class="nutrient-value">{{ $alimento->sodio_mg ?? 0 }} mg</div>
              </div>

              <div class="nutrient-item">
                <div class="nutrient-name">
                  <i class="bi bi-egg text-orange"></i> Proteína
                </div>
                <div class="nutrient-value">{{ $alimento->proteina_g ?? 0 }} g</div>
              </div>
            </div>

            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-warning me-3">
                  <i class="bi bi-gear"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Acciones</h5>
                  <small class="text-muted">Opciones disponibles</small>
                </div>
              </div>
              
              <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('administrador.alimentos.edit', $alimento->id_alimento) }}" 
                   class="btn btn-action btn-edit">
                  <i class="bi bi-pencil me-2"></i>Editar Alimento
                </a>
                
                <form action="{{ route('administrador.alimentos.destroy', $alimento->id_alimento) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="btn btn-action btn-delete" 
                          onclick="return confirm('¿Estás seguro de eliminar este alimento? Esta acción no se puede deshacer.')">
                    <i class="bi bi-trash me-2"></i>Eliminar
                  </button>
                </form>
              </div>
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

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Recomendación - Sistema Renal</title>
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

    .card-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
    }

    .icon-primary {
      background: #f0fdf4;
      color: #1fbf83;
    }

    .icon-paciente {
      background: #dbeafe;
      color: #3b82f6;
    }

    .icon-profesional {
      background: #fef3c7;
      color: #f59e0b;
    }

    .info-label {
      color: var(--muted-text);
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 5px;
      font-weight: 600;
    }

    .info-value {
      color: var(--dark-text);
      font-size: 1rem;
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

    .mensaje-box {
      background: #f9fafb;
      padding: 20px;
      border-radius: 12px;
      border-left: 4px solid #1fbf83;
      white-space: pre-wrap;
      word-wrap: break-word;
      line-height: 1.6;
      color: var(--dark-text);
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
    }

    .back-btn:hover {
      background: white;
      color: #1fbf83;
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
      color: #1fbf83;
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
          <a href="{{ route('administrador.recomendaciones.index') }}" class="active">
            <i class="bi bi-chat-left-text"></i> Recomendaciones
          </a>
          <a href="{{ route('administrador.reportes.index') }}">
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
                <i class="bi bi-chat-left-text me-2"></i>Recomendación
              </h2>
              <p class="mb-0 opacity-75">Detalles de la recomendación del profesional</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.recomendaciones.index') }}" class="back-btn text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- INFORMACIÓN PRINCIPAL -->
        <div class="row g-4">
          <!-- Información del Paciente -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-paciente me-3">
                  <i class="bi bi-person-heart"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información del Paciente</h5>
                  <small class="text-muted">Datos del paciente</small>
                </div>
              </div>
              
              <div class="info-label">Nombre del Paciente</div>
              <div class="info-value">
                <i class="bi bi-person-circle me-2 text-muted"></i>
                {{ $recomendacion->paciente->usuario->nombre }}
              </div>

              <div class="info-label">Email</div>
              <div class="info-value">
                <i class="bi bi-envelope me-2 text-muted"></i>
                {{ $recomendacion->paciente->usuario->email }}
              </div>

              <div class="info-label">ID del Paciente</div>
              <div class="info-value">#{{ $recomendacion->paciente->id_paciente }}</div>
            </div>
          </div>

          <!-- Información del Profesional -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-profesional me-3">
                  <i class="bi bi-person-badge"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información del Profesional</h5>
                  <small class="text-muted">Datos del profesional</small>
                </div>
              </div>
              
              @if($recomendacion->profesional)
                <div class="info-label">Nombre del Profesional</div>
                <div class="info-value">
                  <i class="bi bi-person-circle me-2 text-muted"></i>
                  {{ $recomendacion->profesional->nombre }}
                </div>

                <div class="info-label">Email</div>
                <div class="info-value">
                  <i class="bi bi-envelope me-2 text-muted"></i>
                  {{ $recomendacion->profesional->email }}
                </div>

                <div class="info-label">Fecha de Registro</div>
                <div class="info-value">
                  <i class="bi bi-calendar-event me-2 text-muted"></i>
                  {{ $recomendacion->fecha->format('d/m/Y H:i') }}
                </div>
              @else
                <div class="alert alert-warning mb-0">
                  <i class="bi bi-exclamation-triangle me-2"></i>
                  No se encontró el profesional asignado
                </div>
              @endif
            </div>
          </div>

          <!-- Mensaje de Recomendación -->
          <div class="col-md-12">
            <div class="card-custom">
              <div class="section-title mb-4">
                <i class="bi bi-chat-left-text"></i>Mensaje de Recomendación
              </div>
              <div class="mensaje-box">
{{ $recomendacion->mensaje }}
              </div>
            </div>
          </div>

          <!-- Acciones -->
          <div class="col-md-12">
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-primary me-3">
                  <i class="bi bi-gear"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Acciones</h5>
                  <small class="text-muted">Opciones disponibles</small>
                </div>
              </div>
              
              <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('administrador.recomendaciones.edit', $recomendacion->id_recomendacion) }}" 
                   class="btn btn-action btn-edit">
                  <i class="bi bi-pencil me-2"></i>Editar Recomendación
                </a>
                
                <form action="{{ route('administrador.recomendaciones.destroy', $recomendacion->id_recomendacion) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="btn btn-action btn-delete" 
                          onclick="return confirm('¿Estás seguro de eliminar esta recomendación?')">
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

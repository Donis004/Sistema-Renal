<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Contenido Educativo - Sistema Renal</title>
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

    .icon-clinical {
      background: #fef3c7;
      color: #f59e0b;
    }

    .icon-info {
      background: #dbeafe;
      color: #3b82f6;
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

    .contenido-text {
      background: #f9fafb;
      padding: 20px;
      border-radius: 12px;
      border-left: 4px solid #1fbf83;
      white-space: pre-wrap;
      word-wrap: break-word;
      line-height: 1.6;
      color: var(--dark-text);
    }

    .badge-dieta {
      background: #3b82f6 !important;
      color: white;
    }

    .badge-liquidos {
      background: #06b6d4 !important;
      color: white;
    }

    .badge-ejercicio {
      background: #f59e0b !important;
      color: white;
    }

    .table-custom {
      margin: 0;
    }

    .table-custom thead {
      background: #f9fafb;
      border-bottom: 2px solid #e5e7eb;
    }

    .table-custom tbody tr {
      border-bottom: 1px solid #e5e7eb;
      transition: all 0.2s ease;
    }

    .table-custom tbody tr:hover {
      background: #f0fdf4;
    }

    .table-custom th {
      color: #1f2937;
      font-weight: 600;
      padding: 15px;
      text-transform: uppercase;
      font-size: 0.85rem;
      letter-spacing: 0.5px;
    }

    .table-custom td {
      padding: 15px;
      color: #6b7280;
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

    .empty-state {
      text-align: center;
      padding: 30px;
      color: #9ca3af;
    }

    .empty-state i {
      font-size: 2rem;
      color: #d1d5db;
      margin-bottom: 10px;
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
          <a href="{{ route('administrador.contenidos.index') }}" class="active">
            <i class="bi bi-book"></i> Contenido
          </a>
          <a href="{{ route('administrador.recomendaciones.index') }}">
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
                <i class="bi bi-book me-2"></i>{{ $contenido->titulo }}
              </h2>
              <p class="mb-0 opacity-75">Información completa del contenido educativo</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.contenidos.index') }}" class="back-btn text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- INFORMACIÓN PRINCIPAL -->
        <div class="row g-4">
          <!-- Información Básica -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-primary me-3">
                  <i class="bi bi-book"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información Básica</h5>
                  <small class="text-muted">Detalles principales</small>
                </div>
              </div>
              
              <div class="info-label">ID del Contenido</div>
              <div class="info-value">#{{ $contenido->id_contenido }}</div>

              <div class="info-label">Título</div>
              <div class="info-value">{{ $contenido->titulo }}</div>

              <div class="info-label">Etapa ERC</div>
              <div class="info-value">{{ $contenido->etapa_erc }}</div>

              <div class="info-label">Tipo de Contenido</div>
              <div class="info-value">
                @if($contenido->tipo === 'DIETA')
                  <span class="badge badge-dieta">
                    <i class="bi bi-cup-hot me-1"></i>Dieta
                  </span>
                @elseif($contenido->tipo === 'LIQUIDOS')
                  <span class="badge badge-liquidos">
                    <i class="bi bi-droplet me-1"></i>Líquidos
                  </span>
                @elseif($contenido->tipo === 'EJERCICIO')
                  <span class="badge badge-ejercicio">
                    <i class="bi bi-activity me-1"></i>Ejercicio
                  </span>
                @endif
              </div>
            </div>
          </div>

          <!-- Estadísticas -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-info me-3">
                  <i class="bi bi-bar-chart"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Estadísticas</h5>
                  <small class="text-muted">Información de uso</small>
                </div>
              </div>
              
              <div class="info-label">Total de Pacientes que lo Vieron</div>
              <div class="info-value">
                <span class="badge bg-info" style="font-size: 1.2rem; padding: 8px 15px;">
                  <i class="bi bi-people-fill me-1"></i>
                  {{ $contenido->contenidosVistos->count() }}
                </span>
              </div>

              <div class="info-label">Fecha de Creación</div>
              <div class="info-value">
                <i class="bi bi-calendar me-2 text-muted"></i>
                {{ $contenido->created_at->format('d/m/Y H:i') }}
              </div>

              <div class="info-label">Última Actualización</div>
              <div class="info-value">
                <i class="bi bi-clock me-2 text-muted"></i>
                {{ $contenido->updated_at->format('d/m/Y H:i') }}
              </div>
            </div>
          </div>

          <!-- Contenido Educativo -->
          <div class="col-md-12">
            <div class="card-custom">
              <div class="section-title mb-4">
                <i class="bi bi-file-text"></i>Contenido Educativo
              </div>
              <div class="contenido-text">
{{ $contenido->contenido }}
              </div>
            </div>
          </div>

          <!-- Pacientes que lo Vieron -->
          <div class="col-md-12">
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-clinical me-3">
                  <i class="bi bi-person-check"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Pacientes que Vieron este Contenido</h5>
                  <small class="text-muted">Registro de visualizaciones</small>
                </div>
              </div>

              @if($contenido->contenidosVistos->count() > 0)
                <div style="overflow-x: auto;">
                  <table class="table table-custom">
                    <thead>
                      <tr>
                        <th>Paciente</th>
                        <th>Email</th>
                        <th>Fecha de Visualización</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($contenido->contenidosVistos as $cv)
                      <tr>
                        <td>
                          <strong>{{ $cv->paciente->usuario->nombre ?? 'N/A' }}</strong><br>
                          <small class="text-muted">ID: {{ $cv->paciente->id_paciente }}</small>
                        </td>
                        <td>{{ $cv->paciente->usuario->email ?? 'N/A' }}</td>
                        <td>
                          <i class="bi bi-calendar-event me-2 text-muted"></i>
                          {{ Carbon\Carbon::parse($cv->fecha_visto)->format('d/m/Y H:i') }}
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="empty-state">
                  <i class="bi bi-inbox"></i>
                  <p>Aún no hay pacientes que hayan visualizado este contenido</p>
                </div>
              @endif
            </div>
          </div>

          <!-- Acciones -->
          <div class="col-md-12">
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-info me-3">
                  <i class="bi bi-gear"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Acciones</h5>
                  <small class="text-muted">Opciones disponibles</small>
                </div>
              </div>
              
              <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('administrador.contenidos.edit', $contenido->id_contenido) }}" 
                   class="btn btn-action btn-edit">
                  <i class="bi bi-pencil me-2"></i>Editar Contenido
                </a>
                
                <form action="{{ route('administrador.contenidos.destroy', $contenido->id_contenido) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="btn btn-action btn-delete" 
                          onclick="return confirm('¿Estás seguro de eliminar este contenido?')">
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

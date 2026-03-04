<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Medicamento - Sistema Renal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 5 -->
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
    .icon-usage { background: #ffe0e0; color: #e53e3e; }

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

    .badge-custom {
      padding: 8px 18px;
      border-radius: 25px;
      font-size: 0.9rem;
      font-weight: 600;
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

    .table-patients {
      border-collapse: collapse;
      width: 100%;
    }

    .table-patients th {
      background: #f3f4f6;
      padding: 12px;
      text-align: left;
      font-weight: 600;
      border-bottom: 2px solid #e5e7eb;
    }

    .table-patients td {
      padding: 12px;
      border-bottom: 1px solid #e5e7eb;
    }

    .table-patients tbody tr:hover {
      background: #f9fafb;
    }

    .empty-patients {
      text-align: center;
      padding: 30px;
      color: #9ca3af;
    }

    .empty-patients i {
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
          <a href="{{ route('administrador.medicamentos.index') }}" class="active">
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

      <!-- MAIN CONTENT -->
      <div class="col-md-10">

        <!-- HEADER SECTION -->
        <div class="header-section">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h2 class="mb-2">
                <i class="bi bi-capsule me-2"></i>Detalles del Medicamento
              </h2>
              <p class="mb-0 opacity-75">Información y uso del medicamento</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.medicamentos.index') }}" class="back-btn text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- INFORMACIÓN -->
        <div class="row g-4">
          <!-- Información Principal -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-primary me-3">
                  <i class="bi bi-capsule"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información del Medicamento</h5>
                  <small class="text-muted">Datos principais</small>
                </div>
              </div>
              
              <div class="info-label">ID del Medicamento</div>
              <div class="info-value">#{{ $medicamento->id_medicamento }}</div>

              <div class="info-label">Nombre</div>
              <div class="info-value">
                <i class="bi bi-capsule me-2 text-muted"></i>
                {{ $medicamento->nombre }}
              </div>
            </div>
          </div>

          <!-- Estadísticas de Uso -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-info me-3">
                  <i class="bi bi-bar-chart"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Estadísticas de Uso</h5>
                  <small class="text-muted">Información de utilización</small>
                </div>
              </div>
              
              <div class="info-label">Total de Pacientes</div>
              <div class="info-value">
                <span class="badge badge-custom" style="background: #3182ce; color: white;">
                  <i class="bi bi-people-fill me-1"></i>
                  {{ $medicamento->pacienteMedicamentos->count() }} Paciente(s)
                </span>
              </div>

              <div class="info-label">Prescripciones Activas</div>
              <div class="info-value">
                <span class="badge badge-custom" style="background: #1fbf83; color: white;">
                  <i class="bi bi-check-circle me-1"></i>
                  {{ $medicamento->pacienteMedicamentos->where('activo', true)->count() }} Activa(s)
                </span>
              </div>
            </div>
          </div>

          <!-- Pacientes Asociados -->
          <div class="col-md-12">
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-usage me-3">
                  <i class="bi bi-person-check"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Pacientes que Usan este Medicamento</h5>
                  <small class="text-muted">Lista de prescripciones</small>
                </div>
              </div>
              
              @if($medicamento->pacienteMedicamentos->count() > 0)
                <div style="overflow-x: auto;">
                  <table class="table-patients">
                    <thead>
                      <tr>
                        <th>Paciente</th>
                        <th>Dosis</th>
                        <th>Frecuencia</th>
                        <th>Con Alimentos</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($medicamento->pacienteMedicamentos as $pm)
                      <tr>
                        <td>
                          <strong>{{ $pm->paciente->usuario->nombre ?? 'N/A' }}</strong><br>
                          <small class="text-muted">ID: {{ $pm->paciente->id_paciente }}</small>
                        </td>
                        <td>{{ $pm->dosis ?? 'No especificada' }}</td>
                        <td>{{ $pm->frecuencia ?? 'No especificada' }}</td>
                        <td>
                          @if($pm->con_alimentos === null)
                            <span class="text-muted">—</span>
                          @elseif($pm->con_alimentos)
                            <span class="badge bg-success">Sí</span>
                          @else
                            <span class="badge bg-danger">No</span>
                          @endif
                        </td>
                        <td>
                          @if($pm->activo)
                            <span class="badge bg-success">Activo</span>
                          @else
                            <span class="badge bg-secondary">Inactivo</span>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="empty-patients">
                  <i class="bi bi-inbox"></i>
                  <p>No hay pacientes asignados a este medicamento</p>
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
                <a href="{{ route('administrador.medicamentos.edit', $medicamento->id_medicamento) }}" 
                   class="btn btn-action btn-edit">
                  <i class="bi bi-pencil me-2"></i>Editar Medicamento
                </a>
                
                <form action="{{ route('administrador.medicamentos.destroy', $medicamento->id_medicamento) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="btn btn-action btn-delete" 
                          onclick="return confirm('¿Estás seguro de eliminar este medicamento? Esta acción no se puede deshacer.')">
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

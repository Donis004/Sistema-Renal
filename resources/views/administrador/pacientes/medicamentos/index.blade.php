<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Medicamentos de {{ $paciente->usuario->nombre }} - Sistema Renal</title>
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
      border-radius: 15px;
      padding: 25px;
      color: white;
      margin-bottom: 25px;
    }

    .card-custom {
      background: white;
      border-radius: 18px;
      padding: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,.05);
    }

    .table-custom {
      background: white;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,.05);
    }

    .table-custom thead {
      background: #1fbf83;
      color: white;
    }

    .table-custom tbody tr:hover {
      background: #f0fdf4;
    }

    .table-custom th {
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.85rem;
      letter-spacing: 0.5px;
      padding: 15px;
    }

    .table-custom td {
      padding: 15px;
      vertical-align: middle;
    }

    .btn-success-custom {
      background: #1fbf83;
      border: none;
      color: white;
      padding: 8px 20px;
      border-radius: 10px;
    }

    .btn-success-custom:hover {
      background: #179a6d;
      color: white;
    }

    /* Action Buttons */
    .btn-action {
      width: 36px;
      height: 36px;
      padding: 0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .btn-edit {
      background: #38b2ac;
      border: none;
      color: white;
    }

    .btn-edit:hover {
      background: #2c9a94;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(56, 178, 172, 0.4);
    }

    .btn-delete {
      background: #e53e3e;
      border: none;
      color: white;
    }

    .btn-delete:hover {
      background: #c53030;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(229, 62, 62, 0.4);
    }

    .btn-status {
      background: #718096;
      border: none;
      color: white;
    }

    .btn-status:hover {
      background: #4a5568;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(113, 128, 150, 0.4);
    }

    .btn-status.active {
      background: #1fbf83;
    }

    .btn-status.active:hover {
      background: #179a6d;
    }

    .badge-activo {
      background: #1fbf83 !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-inactivo {
      background: #e53e3e !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .empty-state {
      text-align: center;
      padding: 40px;
      color: #718096;
    }

    .empty-state i {
      font-size: 3rem;
      color: #cbd5e0;
      margin-bottom: 15px;
    }

    .alert-custom {
      border-radius: 12px;
      border: none;
      margin-bottom: 20px;
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
              <h2 class="mb-1"><i class="bi bi-capsule me-2"></i>Medicamentos de {{ $paciente->usuario->nombre }}</h2>
              <p class="mb-0 opacity-75">Gestiona los medicamentos asignados a este paciente</p>
            </div>
            <div class="col-md-4 text-end">
              <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('administrador.pacientes.show', $paciente->id_paciente) }}" class="btn btn-light btn-sm">
                  <i class="bi bi-arrow-left me-2"></i>Volver
                </a>
                <a href="{{ route('administrador.pacientes.medicamentos.create', $paciente->id_paciente) }}" class="btn btn-light btn-sm">
                  <i class="bi bi-plus-circle me-2"></i>Asignar Medicamento
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- ALERTAS -->
        @if ($errors->any())
          <div class="alert alert-danger alert-custom" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Error:</strong> Revisa los campos del formulario.
          </div>
        @endif

        @if (session('success'))
          <div class="alert alert-success alert-custom" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger alert-custom" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
          </div>
        @endif

        <!-- TABLA -->
        <div class="table-custom">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Medicamento</th>
                  <th class="text-center">Dosis</th>
                  <th class="text-center">Frecuencia</th>
                  <th class="text-center">Con Alimentos</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center" style="width: 180px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($pacienteMedicamentos as $pm)
                <tr>
                  <td>
                    <i class="bi bi-capsule me-2 text-danger"></i>
                    <strong>{{ $pm->medicamento->nombre }}</strong>
                  </td>
                  <td class="text-center">{{ $pm->dosis ?? '—' }}</td>
                  <td class="text-center">{{ $pm->frecuencia ?? '—' }}</td>
                  <td class="text-center">
                    @if($pm->con_alimentos === null)
                      <span class="text-muted">—</span>
                    @elseif($pm->con_alimentos)
                      <span class="badge bg-success">Sí</span>
                    @else
                      <span class="badge bg-danger">No</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($pm->activo)
                      <span class="badge badge-activo"><i class="bi bi-check-circle me-1"></i>Activo</span>
                    @else
                      <span class="badge badge-inactivo"><i class="bi bi-x-circle me-1"></i>Inactivo</span>
                    @endif
                  </td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <!-- Botón para cambiar estado -->
                      <form action="{{ route('administrador.pacientes.medicamentos.toggleEstado', [$paciente->id_paciente, $pm->id_pm]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        @if($pm->activo)
                          <button type="submit" 
                                  class="btn btn-action btn-status" 
                                  title="Desactivar medicamento" 
                                  onclick="return confirm('¿Desactivar este medicamento?')">
                            <i class="bi bi-toggle-on"></i>
                          </button>
                        @else
                          <button type="submit" 
                                  class="btn btn-action btn-status active" 
                                  title="Activar medicamento" 
                                  onclick="return confirm('¿Activar este medicamento?')">
                            <i class="bi bi-toggle-off"></i>
                          </button>
                        @endif
                      </form>
                      
                      <a href="{{ route('administrador.pacientes.medicamentos.edit', [$paciente->id_paciente, $pm->id_pm]) }}" 
                         class="btn btn-action btn-edit" 
                         title="Editar">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                      <form action="{{ route('administrador.pacientes.medicamentos.destroy', [$paciente->id_paciente, $pm->id_pm]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-action btn-delete" 
                                title="Eliminar" 
                                onclick="return confirm('¿Estás seguro de desasignar este medicamento?')">
                          <i class="bi bi-trash-fill"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6">
                    <div class="empty-state">
                      <i class="bi bi-inbox"></i>
                      <p class="mb-0">No hay medicamentos asignados a este paciente</p>
                      <a href="{{ route('administrador.pacientes.medicamentos.create', $paciente->id_paciente) }}" class="btn btn-success-custom mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Asignar Medicamento
                      </a>
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          
          @if(method_exists($pacienteMedicamentos, 'links') && $pacienteMedicamentos->hasPages())
          <div class="d-flex justify-content-center mt-3 p-3 border-top">
            {{ $pacienteMedicamentos->links() }}
          </div>
          @endif
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

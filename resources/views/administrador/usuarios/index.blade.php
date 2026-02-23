<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Gestión de Usuarios - Sistema Renal</title>
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

    .search-box {
      border-radius: 12px;
      padding: 10px 15px;
      border: 1px solid #ddd;
    }

    .filter-select {
      border-radius: 12px;
      padding: 10px 15px;
      border: 1px solid #ddd;
    }

    /* Action Buttons - Green Theme */
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

    .btn-view {
      background: #1fbf83;
      border: none;
      color: white;
    }

    .btn-view:hover {
      background: #179a6d;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(31, 191, 131, 0.4);
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

    /* Role Badges - Estilo redondeado como alimentos */
    .badge-paciente {
      background: #805ad5 !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-doctor {
      background: #3182ce !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-nutricionista {
      background: #d69e2e !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-admin {
      background: #e53e3e !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    /* Status Badges - Estilo redondeado como alimentos */
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

    /* Avatar */
    .avatar-circle {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      font-weight: 600;
      color: white;
    }

    .avatar-paciente { background: #805ad5; }
    .avatar-doctor { background: #3182ce; }
    .avatar-nutricionista { background: #d69e2e; }
    .avatar-admin { background: #e53e3e; }

    /* Pagination */
    .pagination {
      margin: 0;
    }

    .page-link {
      color: #1fbf83;
      border-color: #e2e8f0;
    }

    .page-link:hover {
      background: #f0fdf4;
      color: #179a6d;
    }

    .page-item.active .page-link {
      background: #1fbf83;
      border-color: #1fbf83;
    }

    /* Empty state */
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
          <a href="{{ route('administrador.usuarios.index') }}" class="active"><i class="bi bi-people"></i> Usuarios</a>
          <a href="{{ route('administrador.pacientes.index') }}"><i class="bi bi-person-heart"></i> Pacientes</a>
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
              <h2 class="mb-1"><i class="bi bi-people me-2"></i>Gestión de Usuarios</h2>
              <p class="mb-0 opacity-75">Administra los usuarios del sistema</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.usuarios.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Usuario
              </a>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <span class="badge bg-light text-dark">{{ now()->format('d/m/Y') }}</span>
              <span class="badge bg-light text-dark ms-2">{{ count($usuarios) }} Usuarios registrados</span>
            </div>
          </div>
        </div>

        <!-- FILTROS -->
        <div class="card-custom mb-4">
          <form method="GET" action="{{ route('administrador.usuarios.index') }}" class="row g-3">
            <div class="col-md-4">
              <input type="text" name="busqueda" class="form-control search-box" placeholder="Buscar por nombre o email" value="{{ request('busqueda') }}">
            </div>
            <div class="col-md-3">
              <select name="rol" class="form-select filter-select">
                <option value="">Todos los roles</option>
                <option value="PACIENTE" {{ request('rol') == 'PACIENTE' ? 'selected' : '' }}>Paciente</option>
                <option value="DOCTOR" {{ request('rol') == 'DOCTOR' ? 'selected' : '' }}>Doctor</option>
                <option value="NUTRICIONISTA" {{ request('rol') == 'NUTRICIONISTA' ? 'selected' : '' }}>Nutricionista</option>
                <option value="ADMIN" {{ request('rol') == 'ADMIN' ? 'selected' : '' }}>Admin</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success-custom w-100"><i class="bi bi-search"></i> Filtrar</button>
            </div>
            <div class="col-md-2">
              <a href="{{ route('administrador.usuarios.index') }}" class="btn btn-outline-secondary w-100">Limpiar</a>
            </div>
          </form>
        </div>

        <!-- TABLA -->
        <div class="table-custom">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th class="text-center" style="width: 60px;">#</th>
                  <th>Usuario</th>
                  <th>Email</th>
                  <th class="text-center">Rol</th>
                  <th class="text-center">Estado</th>
                  <th>Fecha Registro</th>
                  <th class="text-center" style="width: 180px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                  <td class="text-center fw-bold">{{ $usuario->id_usuario }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="avatar-circle avatar-{{ strtolower($usuario->rol) }} me-2">
                        {{ strtoupper(substr($usuario->nombre, 0, 1)) }}
                      </span>
                      <span class="fw-medium">{{ $usuario->nombre }}</span>
                    </div>
                  </td>
                  <td>
                    <i class="bi bi-envelope me-1 text-muted"></i>
                    {{ $usuario->email }}
                  </td>
                  <td class="text-center">
                    @if($usuario->rol === 'PACIENTE')
                      <span class="badge badge-paciente"><i class="bi bi-person me-1"></i>Paciente</span>
                    @elseif($usuario->rol === 'DOCTOR')
                      <span class="badge badge-doctor"><i class="bi bi-doctor me-1"></i>Doctor</span>
                    @elseif($usuario->rol === 'NUTRICIONISTA')
                      <span class="badge badge-nutricionista"><i class="bi bi-heart-pulse me-1"></i>Nutricionista</span>
                    @else
                      <span class="badge badge-admin"><i class="bi bi-shield-check me-1"></i>Admin</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($usuario->estado)
                      <span class="badge badge-activo"><i class="bi bi-check-circle me-1"></i>Activo</span>
                    @else
                      <span class="badge badge-inactivo"><i class="bi bi-x-circle me-1"></i>Inactivo</span>
                    @endif
                  </td>
                  <td>
                    <i class="bi bi-calendar3 me-1 text-muted"></i>
                    {{ $usuario->fecha_registro ? \Carbon\Carbon::parse($usuario->fecha_registro)->format('d/m/Y') : 'N/A' }}
                  </td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <!-- Botón para cambiar estado -->
                      <form action="{{ route('administrador.usuarios.toggleEstado', $usuario->id_usuario) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        @if($usuario->estado)
                          <button type="submit" 
                                  class="btn btn-action btn-status" 
                                  title="Desactivar usuario" 
                                  onclick="return confirm('¿Estás seguro de desactivar este usuario?')">
                            <i class="bi bi-person-dash-fill"></i>
                          </button>
                        @else
                          <button type="submit" 
                                  class="btn btn-action btn-status active" 
                                  title="Activar usuario" 
                                  onclick="return confirm('¿Estás seguro de activar este usuario?')">
                            <i class="bi bi-person-check-fill"></i>
                          </button>
                        @endif
                      </form>
                      
                      <a href="{{ route('administrador.usuarios.show', $usuario->id_usuario) }}" 
                         class="btn btn-action btn-view" 
                         title="Ver detalles">
                        <i class="bi bi-eye-fill"></i>
                      </a>
                      <a href="{{ route('administrador.usuarios.edit', $usuario->id_usuario) }}" 
                         class="btn btn-action btn-edit" 
                         title="Editar">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                      <form action="{{ route('administrador.usuarios.destroy', $usuario->id_usuario) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-action btn-delete" 
                                title="Eliminar" 
                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                          <i class="bi bi-trash-fill"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7">
                    <div class="empty-state">
                      <i class="bi bi-inbox"></i>
                      <p class="mb-0">No hay usuarios registrados</p>
                      <a href="{{ route('administrador.usuarios.create') }}" class="btn btn-success-custom mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Crear primer usuario
                      </a>
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          
          @if(method_exists($usuarios, 'links') && $usuarios->hasPages())
          <div class="d-flex justify-content-center mt-3 p-3 border-top">
            {{ $usuarios->links() }}
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

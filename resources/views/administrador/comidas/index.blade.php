<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Gestión de Comidas - Sistema Renal</title>
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

    /* Badges - Estilo redondeado como alimentos */
    .badge-foto {
      background: #805ad5 !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-manual {
      background: #718096 !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-alimentos {
      background: #1fbf83 !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-sin-detalles {
      background: #dd6b20 !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

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

    /* Avatar */
    .avatar-circle {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
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
          <h5 class="fw-bold mb-4"><i class="bi bi-heart-pulse text-danger"></i> RenalMe </h5>
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
              <h2 class="mb-1"><i class="bi bi-utensils me-2"></i>Gestión de Comidas</h2>
              <p class="mb-0 opacity-75">Administra las comidas registradas</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.comidas.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle me-2"></i>Nueva Comida
              </a>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <span class="badge bg-light text-dark">{{ now()->format('d/m/Y') }}</span>
              <span class="badge bg-light text-dark ms-2">{{ count($comidas) }} Comidas registradas</span>
            </div>
          </div>
        </div>

        <!-- FILTROS -->
        <div class="card-custom mb-4">
          <form method="GET" action="{{ route('administrador.comidas.index') }}" class="row g-3">
            <div class="col-md-5">
              <input type="text" name="busqueda" class="form-control search-box" placeholder="Buscar por paciente" value="{{ request('busqueda') }}">
            </div>
            <div class="col-md-3">
              <select name="tipo_registro" class="form-select filter-select">
                <option value="">Todos los tipos</option>
                <option value="FOTO" {{ request('tipo_registro') == 'FOTO' ? 'selected' : '' }}>Foto</option>
                <option value="MANUAL" {{ request('tipo_registro') == 'MANUAL' ? 'selected' : '' }}>Manual</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success-custom w-100"><i class="bi bi-search"></i> Filtrar</button>
            </div>
            <div class="col-md-2">
              <a href="{{ route('administrador.comidas.index') }}" class="btn btn-outline-secondary w-100">Limpiar</a>
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
                  <th>Paciente</th>
                  <th class="text-center">Tipo de Registro</th>
                  <th>Fecha/Hora</th>
                  <th class="text-center">Alimentos</th>
                  <th class="text-center" style="width: 140px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($comidas as $comida)
                <tr>
                  <td class="text-center fw-bold">{{ $comida->id_comida }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar-circle bg-success text-white me-2">
                        {{ strtoupper(substr($comida->paciente->usuario->nombre ?? 'N/A', 0, 1)) }}
                      </div>
                      <span class="fw-medium">{{ $comida->paciente->usuario->nombre ?? 'N/A' }}</span>
                    </div>
                  </td>
                  <td class="text-center">
                    @if($comida->tipo_registro === 'FOTO')
                      <span class="badge badge-foto"><i class="bi bi-camera me-1"></i>Foto</span>
                    @else
                      <span class="badge badge-manual"><i class="bi bi-pencil me-1"></i>Manual</span>
                    @endif
                  </td>
                  <td>
                    <i class="bi bi-calendar3 me-1 text-muted"></i>
                    {{ $comida->fecha_hora ? \Carbon\Carbon::parse($comida->fecha_hora)->format('d/m/Y H:i') : 'No especificada' }}
                  </td>
                  <td class="text-center">
                    @if($comida->comidaDetalles->count() > 0)
                      <span class="badge badge-alimentos"><i class="bi bi-utensils me-1"></i>{{ $comida->comidaDetalles->count() }} alimentos</span>
                    @else
                      <span class="badge badge-sin-detalles"><i class="bi bi-exclamation-triangle me-1"></i>Sin detalles</span>
                    @endif
                  </td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('administrador.comidas.show', $comida->id_comida) }}" 
                         class="btn btn-action btn-view" 
                         title="Ver detalles">
                        <i class="bi bi-eye-fill"></i>
                      </a>
                      <a href="{{ route('administrador.comidas.edit', $comida->id_comida) }}" 
                         class="btn btn-action btn-edit" 
                         title="Editar">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                      <form action="{{ route('administrador.comidas.destroy', $comida->id_comida) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-action btn-delete" 
                                title="Eliminar" 
                                onclick="return confirm('¿Estás seguro de eliminar esta comida?')">
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
                      <p class="mb-0">No hay comidas registradas</p>
                      <a href="{{ route('administrador.comidas.create') }}" class="btn btn-success-custom mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Registrar primera comida
                      </a>
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          
          @if(method_exists($comidas, 'links') && $comidas->hasPages())
          <div class="d-flex justify-content-center mt-3 p-3 border-top">
            {{ $comidas->links() }}
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

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Gestión de Pacientes - Sistema Renal</title>
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

    /* ERC Badges */
    .badge-erc1 { background: #48bb78 !important; color: white; }
    .badge-erc2 { background: #38b2ac !important; color: white; }
    .badge-erc3a { background: #ecc94b !important; color: #1a202c; }
    .badge-erc3b { background: #ed8936 !important; color: white; }
    .badge-erc4 { background: #f6ad55 !important; color: #1a202c; }
    .badge-erc5 { background: #e53e3e !important; color: white; }

    /* Gender Badge */
    .badge-sexo {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-m { background: #3182ce !important; color: white; }
    .badge-f { background: #d69e2e !important; color: white; }
    .badge-o { background: #718096 !important; color: white; }

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
      background: #1fbf83;
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
              <h2 class="mb-1"><i class="bi bi-person-heart me-2"></i>Gestión de Pacientes</h2>
              <p class="mb-0 opacity-75">Administra la información de los pacientes</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.pacientes.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Paciente
              </a>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <span class="badge bg-light text-dark">{{ now()->format('d/m/Y') }}</span>
              <span class="badge bg-light text-dark ms-2">{{ count($pacientes) }} Pacientes registrados</span>
            </div>
          </div>
        </div>

        <!-- FILTROS -->
        <div class="card-custom mb-4">
          <form method="GET" action="{{ route('administrador.pacientes.index') }}" class="row g-3">
            <div class="col-md-4">
              <input type="text" name="busqueda" class="form-control search-box" placeholder="Buscar por nombre o ID" value="{{ request('busqueda') }}">
            </div>
            <div class="col-md-3">
              <select name="etapa_erc" class="form-select filter-select">
                <option value="">Todas las etapas ERC</option>
                <option value="1" {{ request('etapa_erc') == '1' ? 'selected' : '' }}>Etapa 1</option>
                <option value="2" {{ request('etapa_erc') == '2' ? 'selected' : '' }}>Etapa 2</option>
                <option value="3a" {{ request('etapa_erc') == '3a' ? 'selected' : '' }}>Etapa 3a</option>
                <option value="3b" {{ request('etapa_erc') == '3b' ? 'selected' : '' }}>Etapa 3b</option>
                <option value="4" {{ request('etapa_erc') == '4' ? 'selected' : '' }}>Etapa 4</option>
                <option value="5" {{ request('etapa_erc') == '5' ? 'selected' : '' }}>Etapa 5</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success-custom w-100"><i class="bi bi-search"></i> Filtrar</button>
            </div>
            <div class="col-md-2">
              <a href="{{ route('administrador.pacientes.index') }}" class="btn btn-outline-secondary w-100">Limpiar</a>
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
                  <th>Género</th>
                  <th class="text-center">Edad</th>
                  <th class="text-center">Peso</th>
                  <th class="text-center">ERC</th>
                  <th class="text-center">EGFR</th>
                  <th class="text-center" style="width: 180px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($pacientes as $paciente)
                <tr>
                  <td class="text-center fw-bold">{{ $paciente->id_paciente }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="avatar-circle me-2">
                        {{ strtoupper(substr($paciente->usuario->nombre ?? 'P', 0, 1)) }}
                      </span>
                      <span class="fw-medium">{{ $paciente->usuario->nombre ?? 'N/A' }}</span>
                    </div>
                  </td>
                  <td>
                    @if($paciente->sexo === 'M')
                      <span class="badge badge-sexo badge-m"><i class="bi bi-person-fill me-1"></i>Masculino</span>
                    @elseif($paciente->sexo === 'F')
                      <span class="badge badge-sexo badge-f"><i class="bi bi-person-fill me-1"></i>Femenino</span>
                    @else
                      <span class="badge badge-sexo badge-o"><i class="bi bi-person-fill me-1"></i>Otro</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($paciente->fecha_nacimiento)
                      {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años
                    @else
                      N/A
                    @endif
                  </td>
                  <td class="text-center">
                    {{ $paciente->peso_kg ?? 'N/A' }} kg
                  </td>
                  <td class="text-center">
                    @if($paciente->etapa_erc)
                      <span class="badge badge-erc{{ str_replace('.', '', $paciente->etapa_erc) }}">
                        Etapa {{ $paciente->etapa_erc }}
                      </span>
                    @else
                      <span class="text-muted">N/A</span>
                    @endif
                  </td>
                  <td class="text-center">
                    {{ $paciente->egfr ? number_format($paciente->egfr, 2) : 'N/A' }}
                  </td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('administrador.pacientes.show', $paciente->id_paciente) }}" 
                         class="btn btn-action btn-view" 
                         title="Ver detalles">
                        <i class="bi bi-eye-fill"></i>
                      </a>
                      <a href="{{ route('administrador.pacientes.edit', $paciente->id_paciente) }}" 
                         class="btn btn-action btn-edit" 
                         title="Editar">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                      <form action="{{ route('administrador.pacientes.destroy', $paciente->id_paciente) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-action btn-delete" 
                                title="Eliminar" 
                                onclick="return confirm('¿Estás seguro de eliminar este paciente?')">
                          <i class="bi bi-trash-fill"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="8">
                    <div class="empty-state">
                      <i class="bi bi-inbox"></i>
                      <p class="mb-0">No hay pacientes registrados</p>
                      <a href="{{ route('administrador.pacientes.create') }}" class="btn btn-success-custom mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Crear primer paciente
                      </a>
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          
          @if(method_exists($pacientes, 'links') && $pacientes->hasPages())
          <div class="d-flex justify-content-center mt-3 p-3 border-top">
            {{ $pacientes->links() }}
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

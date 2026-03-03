<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Alimentos - Sistema Renal</title>
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

    /* Status Badges - Mismo estilo que usuarios */
    .badge-seguro {
      background: #1fbf83 !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .badge-peligroso {
      background: #e53e3e !important;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .nutrient-badge {
      background: #f3f4f6;
      color: #4b5563;
      padding: 4px 10px;
      border-radius: 8px;
      font-size: 0.75rem;
      margin-right: 5px;
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
            <i class="bi bi-heart-pulse text-danger"></i> RenalMe
          </h5>
          <a href="{{ route('administrador.dashboard') }}">
            <i class="bi bi-speedometer"></i> Dashboard
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
          <a href="{{ route('administrador.comorbilidades.index') }}">
            <i class="bi bi-heart-pulse"></i> Comorbilidades
          </a>
          <a href="{{ route('administrador.alergias.index') }}">
            <i class="bi bi-exclamation-triangle"></i> Alergias
          </a>
          <a href="{{ route('administrador.sintomas.index') }}">
            <i class="bi bi-thermometer"></i> Síntomas
          </a>
          <a href="{{ route('administrador.recomendaciones.index') }}">
            <i class="bi bi-lightbulb"></i> Recomendaciones
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
              <h2 class="mb-1">
                <i class="bi bi-cup-hot me-2"></i>Gestión de Alimentos
              </h2>
              <p class="mb-0 opacity-75">Administra el catálogo de alimentos del sistema renal</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.alimentos.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Alimento
              </a>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <span class="badge bg-light text-dark">{{ now()->format('d/m/Y') }}</span>
              <span class="badge bg-light text-dark ms-2">{{ count($alimentos) }} Alimentos registrados</span>
            </div>
          </div>
        </div>

        <!-- FILTROS -->
        <div class="card-custom mb-4">
          <form method="GET" action="{{ route('administrador.alimentos.index') }}" class="row g-3">
            <div class="col-md-10">
              <input type="text" name="busqueda" class="form-control search-box" placeholder="Buscar alimentos por nombre..." value="{{ request('busqueda') }}">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success-custom w-100">
                <i class="bi bi-search"></i> Buscar
              </button>
            </div>
          </form>
        </div>

        <!-- ALERTS -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i>
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- TABLE -->
        <div class="table-custom">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th class="text-center" style="width: 60px;">#</th>
                  <th>Nombre</th>
                  <th>Nutrientes (por 100g)</th>
                  <th class="text-center">Porción</th>
                  <th class="text-center">Estado Renal</th>
                  <th class="text-center" style="width: 150px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse($alimentos as $alimento)
                <tr>
                  <td class="text-center fw-bold">{{ $alimento->id_alimento }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-cup-hot text-success me-2 fs-5"></i>
                      <span class="fw-medium">{{ $alimento->nombre }}</span>
                    </div>
                  </td>
                  <td>
                    @if($alimento->potasio_mg)
                    <span class="nutrient-badge">
                      <i class="bi bi-lightning-charge"></i> K: {{ $alimento->potasio_mg }}mg
                    </span>
                    @endif
                    @if($alimento->fosforo_mg)
                    <span class="nutrient-badge">
                      <i class="bi bi-gem"></i> P: {{ $alimento->fosforo_mg }}mg
                    </span>
                    @endif
                    @if($alimento->sodio_mg)
                    <span class="nutrient-badge">
                      <i class="bi bi-droplet"></i> Na: {{ $alimento->sodio_mg }}mg
                    </span>
                    @endif
                    @if($alimento->proteina_g)
                    <span class="nutrient-badge">
                      <i class="bi bi-egg"></i> Prot: {{ $alimento->proteina_g }}g
                    </span>
                    @endif
                  </td>
                  <td class="text-center">
                    {{ $alimento->porcion_estandar ?? 'N/A' }}
                  </td>
                  <td class="text-center">
                    @if($alimento->seguro_renal)
                      <span class="badge-seguro">
                        <i class="bi bi-check-circle me-1"></i>Seguro
                      </span>
                    @else
                      <span class="badge-peligroso">
                        <i class="bi bi-exclamation-triangle me-1"></i>Peligroso
                      </span>
                    @endif
                  </td>
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('administrador.alimentos.show', $alimento->id_alimento) }}" 
                         class="btn btn-action btn-view" 
                         title="Ver detalles">
                        <i class="bi bi-eye-fill"></i>
                      </a>
                      <a href="{{ route('administrador.alimentos.edit', $alimento->id_alimento) }}" 
                         class="btn btn-action btn-edit" 
                         title="Editar">
                        <i class="bi bi-pencil-fill"></i>
                      </a>
                      <form action="{{ route('administrador.alimentos.destroy', $alimento->id_alimento) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-action btn-delete" 
                                title="Eliminar"
                                onclick="return confirm('¿Estás seguro de eliminar este alimento?')">
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
                      <p class="mb-0">No hay alimentos registrados</p>
                      <a href="{{ route('administrador.alimentos.create') }}" class="btn btn-success-custom mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Crear primer alimento
                      </a>
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

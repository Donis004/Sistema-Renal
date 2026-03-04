<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Comorbilidades - Sistema Renal</title>
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
      overflow: hidden;
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
      font-size: 0.95rem;
    }

    .btn-action {
      padding: 8px 12px;
      border-radius: 8px;
      border: none;
      font-size: 0.85rem;
      transition: all 0.2s ease;
      margin-right: 5px;
    }

    .btn-view {
      background: #e0f2fe;
      color: #3b82f6;
    }

    .btn-edit {
      background: #ccfbf1;
      color: #14b8a6;
    }

    .btn-delete {
      background: #fee2e2;
      color: #ef4444;
    }

    .btn-view:hover {
      background: #bae6fd;
    }

    .btn-edit:hover {
      background: #99f6e4;
    }

    .btn-delete:hover {
      background: #fecaca;
    }

    .btn-create {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      border: none;
      color: white;
      padding: 12px 25px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-create:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(31, 191, 131, 0.4);
    }

    .empty-state {
      text-align: center;
      padding: 40px;
      color: #9ca3af;
    }

    .empty-state i {
      font-size: 3rem;
      color: #d1d5db;
      margin-bottom: 15px;
    }

    .badge-count {
      background: #1fbf83;
      color: white;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
    }

    .alert-custom {
      border-radius: 12px;
      border: none;
      padding: 15px 20px;
    }

    .alert-success {
      background: #d1fae5;
      color: #065f46;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="app-wrapper">
    <div class="row g-4">

      <!-- SIDEBAR -->
      <div class="col-md-2">
        @include('components.sidebar-admin')
      </div>

      <!-- MAIN CONTENT -->
      <div class="col-md-10">

        <!-- HEADER SECTION -->
        <div class="header-section">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h2 class="mb-2">
                <i class="bi bi-heart-pulse me-2"></i>Comorbilidades
              </h2>
              <p class="mb-0 opacity-75">Gestiona enfermedades crónicas que pueden correlacionarse con el paciente</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.comorbilidades.create') }}" class="btn btn-create">
                <i class="bi bi-plus-circle me-2"></i>Nueva Comorbilidad
              </a>
            </div>
          </div>
        </div>

        <!-- MENSAJES -->
        @if(session('success'))
          <div class="alert alert-success alert-custom mb-4">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          </div>
        @endif

        <!-- TABLA DE COMORBILIDADES -->
        <div class="card-custom">
          @if($comorbilidades->count() > 0)
            <div style="overflow-x: auto;">
              <table class="table table-custom">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Pacientes Asignados</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($comorbilidades as $comorbilidad)
                  <tr>
                    <td>
                      <strong>{{ $comorbilidad->nombre }}</strong>
                    </td>
                    <td>
                      <span class="badge-count">{{ $comorbilidad->pacientes->count() }}</span>
                    </td>
                    <td>
                      <a href="{{ route('administrador.comorbilidades.show', $comorbilidad->id_comorbilidad) }}" 
                         class="btn btn-action btn-view">
                        <i class="bi bi-eye me-1"></i>Ver
                      </a>
                      <a href="{{ route('administrador.comorbilidades.edit', $comorbilidad->id_comorbilidad) }}" 
                         class="btn btn-action btn-edit">
                        <i class="bi bi-pencil me-1"></i>Editar
                      </a>
                      <form action="{{ route('administrador.comorbilidades.destroy', $comorbilidad->id_comorbilidad) }}" 
                            method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-action btn-delete"
                                onclick="return confirm('¿Estás seguro de eliminar esta comorbilidad?')">
                          <i class="bi bi-trash me-1"></i>Eliminar
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- PAGINACIÓN -->
            <div class="d-flex justify-content-center mt-4 mb-3">
              {{ $comorbilidades->links() }}
            </div>
          @else
            <div class="empty-state">
              <i class="bi bi-inbox"></i>
              <p>No hay comorbilidades registradas</p>
              <a href="{{ route('administrador.comorbilidades.create') }}" class="btn btn-create mt-3">
                <i class="bi bi-plus-circle me-2"></i>Crear la Primera Comorbilidad
              </a>
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

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Alergias - Sistema Renal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root { --primary-green: #1fbf83; --secondary-green: #38b2ac; }
    body { background-color: #c9f3d6; font-family: 'Segoe UI', sans-serif; }
    .app-wrapper { background: #f6fff9; border-radius: 20px; padding: 25px; box-shadow: 0 15px 40px rgba(0,0,0,.1); margin: 30px; }
    .sidebar { background: #ffffff; border-radius: 20px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .sidebar a { display: flex; align-items: center; gap: 10px; padding: 12px 15px; border-radius: 12px; color: #555; text-decoration: none; margin-bottom: 8px; transition: all 0.3s ease; }
    .sidebar a:hover, .sidebar a.active { background: #1fbf83; color: white; }
    .header-section { background: linear-gradient(135deg, #1fbf83, #38b2ac); border-radius: 20px; padding: 25px; color: white; margin-bottom: 25px; }
    .card-custom { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden; }
    .table-custom { margin: 0; }
    .table-custom thead { background: #f9fafb; border-bottom: 2px solid #e5e7eb; }
    .table-custom tbody tr { border-bottom: 1px solid #e5e7eb; transition: all 0.2s ease; }
    .table-custom tbody tr:hover { background: #f0fdf4; }
    .table-custom th { color: #1f2937; font-weight: 600; padding: 15px; text-transform: uppercase; font-size: 0.85rem; }
    .table-custom td { padding: 15px; }
    .btn-action { padding: 8px 12px; border-radius: 8px; border: none; font-size: 0.85rem; margin-right: 5px; }
    .btn-view { background: #e0f2fe; color: #3b82f6; }
    .btn-edit { background: #ccfbf1; color: #14b8a6; }
    .btn-delete { background: #fee2e2; color: #ef4444; }
    .btn-create { background: linear-gradient(135deg, #1fbf83, #38b2ac); border: none; color: white; padding: 12px 25px; border-radius: 12px; font-weight: 600; text-decoration: none; display: inline-block; }
    .btn-create:hover { color: white; }
    .empty-state { text-align: center; padding: 40px; color: #9ca3af; }
    .badge-count { background: #1fbf83; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
    .alert-success { background: #d1fae5; color: #065f46; border-radius: 12px; }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="app-wrapper">
    <div class="row g-4">
      <div class="col-md-2">
        @include('components.sidebar-admin')
      </div>
      <div class="col-md-10">
        <div class="header-section">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h2 class="mb-2"><i class="bi bi-exclamation-triangle me-2"></i>Alergias</h2>
              <p class="mb-0 opacity-75">Gestiona alergias que pueden afectar al paciente</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.alergias.create') }}" class="btn btn-create"><i class="bi bi-plus-circle me-2"></i>Nueva Alergia</a>
            </div>
          </div>
        </div>
        @if(session('success'))
          <div class="alert alert-success mb-4"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
        @endif
        <div class="card-custom">
          @if($alergias->count() > 0)
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
                  @foreach($alergias as $alergia)
                  <tr>
                    <td><strong>{{ $alergia->nombre }}</strong></td>
                    <td><span class="badge-count">{{ $alergia->pacientes->count() }}</span></td>
                    <td>
                      <a href="{{ route('administrador.alergias.show', $alergia->id_alergia) }}" class="btn btn-action btn-view"><i class="bi bi-eye me-1"></i>Ver</a>                      <a href="{{ route('administrador.alergias.edit', $alergia->id_alergia) }}" class="btn btn-action btn-edit"><i class="bi bi-pencil me-1"></i>Editar</a>                      <form action="{{ route('administrador.alergias.destroy', $alergia->id_alergia) }}" method="POST" class="d-inline">                        @csrf                       @method('DELETE')                        <button type="submit" class="btn btn-action btn-delete" onclick="return confirm('¿Estás seguro?')"><i class="bi bi-trash me-1"></i>Eliminar</button>                      </form>                    </td>                  </tr>                 @endforeach                </tbody>              </table>            </div>            <div class="d-flex justify-content-center mt-4 mb-3">{{ $alergias->links() }}</div>          @else            <div class="empty-state">              <i class="bi bi-inbox"></i>              <p>No hay alergias registradas</p>              <a href="{{ route('administrador.alergias.create') }}" class="btn btn-create mt-3"><i class="bi bi-plus-circle me-2"></i>Crear la Primera Alergia</a>            </div>\n          @endif        </div>      </div>    </div>  </div></div><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script></body></html>
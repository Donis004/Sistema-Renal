<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Comorbilidad - Sistema Renal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root { --primary-green: #1fbf83; --secondary-green: #38b2ac; }
    body { background-color: #c9f3d6; font-family: 'Segoe UI', sans-serif; }
    .app-wrapper { background: #f6fff9; border-radius: 20px; padding: 25px; box-shadow: 0 15px 40px rgba(0,0,0,.1); margin: 30px; }
    .sidebar { background: #ffffff; border-radius: 20px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .sidebar a { display: flex; align-items: center; gap: 10px; padding: 12px 15px; border-radius: 12px; color: #555; text-decoration: none; margin-bottom: 8px; }
    .sidebar a:hover, .sidebar a.active { background: #1fbf83; color: white; }
    .header-section { background: linear-gradient(135deg, #1fbf83, #38b2ac); border-radius: 20px; padding: 25px; color: white; margin-bottom: 25px; }
    .card-custom { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 25px; margin-bottom: 25px; }
    .info-box { background: #e0f2fe; border-left: 4px solid #1fbf83; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
    .table-custom { margin: 0; }
    .table-custom thead { background: #f9fafb; border-bottom: 2px solid #e5e7eb; }
    .table-custom th { color: #1f2937; font-weight: 600; padding: 15px; text-transform: uppercase; font-size: 0.85rem; }
    .table-custom td { padding: 15px; }
    .badge-count { background: #1fbf83; color: white; padding: 4px 12px; border-radius: 20px; font-weight: 600; }
    .btn-edit { background: linear-gradient(135deg, #1fbf83, #38b2ac); border: none; color: white; padding: 12px 25px; border-radius: 12px; }
    .btn-delete { background: #ef4444; border: none; color: white; padding: 12px 25px; border-radius: 12px; }
    .empty-state { text-align: center; padding: 40px; color: #9ca3af; }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="app-wrapper">
    <div class="row g-4">
      <div class="col-md-2">
        <div class="sidebar">
          <h5 class="fw-bold mb-4"><i class="bi bi-heart-pulse text-danger me-2"></i>RenalMe</h5>
          <a href="{{ route('administrador.comorbilidades.index') }}" class="active"><i class="bi bi-heart-pulse"></i> Comorbilidades</a>
        </div>
      </div>
      <div class="col-md-10">
        <div class="header-section">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h2 class="mb-2"><i class="bi bi-heart-pulse me-2"></i>{{ $comorbilidad->nombre }}</h2>
              <p class="mb-0 opacity-75">Detalles de la comorbilidad</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.comorbilidades.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>
        <div class="card-custom">
          <div class="info-box mb-4">
            <strong>ID:</strong> #{{ $comorbilidad->id_comorbilidad }}
          </div>
          <h5 class="mb-3"><i class="bi bi-person-heart me-2"></i>Pacientes Asignados</h5>
          @if($comorbilidad->pacientes->count() > 0)
            <table class="table table-custom">
              <thead>
                <tr>
                  <th>Paciente</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                @foreach($comorbilidad->pacientes as $paciente)
                <tr>
                  <td><strong>{{ $paciente->usuario->nombre }}</strong></td>
                  <td>{{ $paciente->usuario->email }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <div class="empty-state">
              <i class="bi bi-inbox" style="font-size: 2rem; color: #d1d5db; margin-bottom: 10px;"></i>
              <p>No hay pacientes con esta comorbilidad asignada</p>
            </div>
          @endif
          <div class="d-flex gap-3 mt-4">
            <a href="{{ route('administrador.comorbilidades.edit', $comorbilidad->id_comorbilidad) }}" class="btn btn-edit">
              <i class="bi bi-pencil me-2"></i>Editar
            </a>
            <form action="{{ route('administrador.comorbilidades.destroy', $comorbilidad->id_comorbilidad) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro?')">
                <i class="bi bi-trash me-2"></i>Eliminar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
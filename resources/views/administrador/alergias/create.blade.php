<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Crear Alergia - Sistema Renal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background-color: #c9f3d6; font-family: 'Segoe UI', sans-serif; }
    .app-wrapper { background: #f6fff9; border-radius: 20px; padding: 25px; box-shadow: 0 15px 40px rgba(0,0,0,.1); margin: 30px; }
    .sidebar { background: #ffffff; border-radius: 20px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .sidebar a { display: flex; align-items: center; gap: 10px; padding: 12px 15px; border-radius: 12px; color: #555; text-decoration: none; margin-bottom: 8px; transition: all 0.3s ease; }
    .sidebar a:hover, .sidebar a.active { background: #1fbf83; color: white; }
    .header-section { background: linear-gradient(135deg, #1fbf83, #38b2ac); border-radius: 20px; padding: 25px; color: white; margin-bottom: 25px; }
    .card-custom { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 25px; }
    .form-label { color: #1f2937; font-weight: 600; margin-bottom: 10px; }
    .form-control { border-radius: 10px; border: 2px solid #e5e7eb; padding: 12px 15px; }
    .form-control:focus { border-color: #1fbf83; box-shadow: 0 0 0 3px rgba(31, 191, 131, 0.1); }
    .btn-action { background: linear-gradient(135deg, #1fbf83, #38b2ac); border: none; color: white; padding: 12px 30px; border-radius: 12px; font-weight: 600; }
    .btn-action:hover { color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(31, 191, 131, 0.4); }
    .btn-cancel { background: #e5e7eb; color: #1f2937; padding: 12px 30px; border-radius: 12px; text-decoration: none; display: inline-block; }
    .btn-cancel:hover { color: #1f2937; }
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
          <h2 class="mb-2"><i class="bi bi-exclamation-triangle me-2"></i>Crear Alergia</h2>
          <p class="mb-0 opacity-75">Registra una nueva alergia para los pacientes</p>
        </div>
        <div class="card-custom">
          <form action="{{ route('administrador.alergias.store') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label for="nombre" class="form-label">
                <i class="bi bi-exclamation-triangle me-2"></i>Nombre de la Alergia
              </label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej: Maní, Lácteos, Gluten" required>
            </div>
            <div class="d-flex gap-3">
              <button type="submit" class="btn btn-action">
                <i class="bi bi-check-circle me-2"></i>Crear
              </button>
              <a href="{{ route('administrador.alergias.index') }}" class="btn btn-cancel">
                <i class="bi bi-x-circle me-2"></i>Cancelar
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

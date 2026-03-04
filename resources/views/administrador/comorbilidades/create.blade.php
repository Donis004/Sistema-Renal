<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Crear Comorbilidad - Sistema Renal</title>
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
    .card-custom { background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 25px; margin-bottom: 25px; }
    .form-label { color: #1f2937; font-weight: 600; margin-bottom: 10px; }
    .form-control { border-radius: 10px; border: 2px solid #e5e7eb; padding: 12px 15px; }
    .form-control:focus { border-color: #1fbf83; box-shadow: 0 0 0 0.2rem rgba(31, 191, 131, 0.25); }
    .btn-create { background: linear-gradient(135deg, #1fbf83, #38b2ac); border: none; color: white; padding: 12px 30px; border-radius: 12px; font-weight: 600; }
    .btn-cancel { background: #e5e7eb; color: #1f2937; }
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
          <a href="{{ route('administrador.alergias.index') }}"><i class="bi bi-exclamation-triangle"></i> Alergias</a>
          <a href="{{ route('administrador.sintomas.index') }}"><i class="bi bi-thermometer"></i> Síntomas</a>
        </div>
      </div>
      <div class="col-md-10">
        <div class="header-section">
          <h2 class="mb-2"><i class="bi bi-heart-pulse me-2"></i>Crear Comorbilidad</h2>
          <p class="mb-0 opacity-75">Agrega una nueva enfermedad crónica al catálogo</p>
        </div>
        <div class="card-custom">
          <form action="{{ route('administrador.comorbilidades.store') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label for="nombre" class="form-label"><i class="bi bi-heart-pulse me-2"></i>Nombre de la Comorbilidad</label>
              <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                     placeholder="Ej: Diabetes, Hipertensión, Asma" value="{{ old('nombre') }}" required>
              @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-3">
              <button type="submit" class="btn btn-create"><i class="bi bi-check-circle me-2"></i>Crear Comorbilidad</button>
              <a href="{{ route('administrador.comorbilidades.index') }}" class="btn btn-cancel"><i class="bi bi-x-circle me-2"></i>Cancelar</a>
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
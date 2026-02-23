<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Usuario - Sistema Renal</title>
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

    .sidebar a.active,
    .sidebar a:hover {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      color: white;
      transform: translateX(5px);
    }

    .header-section {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      border-radius: 20px;
      padding: 30px;
      color: white;
      margin-bottom: 30px;
      box-shadow: 0 10px 30px rgba(31, 191, 131, 0.3);
    }

    .card-custom {
      background: white;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
      border: none;
      transition: transform 0.3s ease;
    }

    .card-custom:hover {
      transform: translateY(-5px);
    }

    .card-icon {
      width: 60px;
      height: 60px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 15px;
    }

    .icon-primary { background: #e0f7eb; color: #1fbf83; }
    .icon-info { background: #e0efff; color: #3182ce; }
    .icon-warning { background: #fff8e0; color: #d69e2e; }
    .icon-danger { background: #ffe0e0; color: #e53e3e; }
    .icon-success { background: #e0f7eb; color: #38a169; }

    .info-label {
      font-weight: 600;
      color: var(--muted-text);
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 5px;
    }

    .info-value {
      color: var(--dark-text);
      font-size: 1.1rem;
      font-weight: 500;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 1px solid #f0f0f0;
    }

    .info-value:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .badge-custom {
      padding: 8px 18px;
      border-radius: 25px;
      font-size: 0.9rem;
      font-weight: 600;
    }

    .badge-paciente { background: #805ad5; color: white; }
    .badge-doctor { background: #3182ce; color: white; }
    .badge-nutricionista { background: #d69e2e; color: white; }
    .badge-admin { background: #e53e3e; color: white; }
    .badge-activo { background: #1fbf83; color: white; }
    .badge-inactivo { background: #e53e3e; color: white; }

    .btn-action {
      padding: 12px 25px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .btn-edit {
      background: linear-gradient(135deg, #38b2ac, #2c9a94);
      border: none;
      color: white;
    }

    .btn-status-active {
      background: linear-gradient(135deg, #1fbf83, #179a6d);
      border: none;
      color: white;
    }

    .btn-status-inactive {
      background: linear-gradient(135deg, #718096, #4a5568);
      border: none;
      color: white;
    }

    .btn-delete {
      background: linear-gradient(135deg, #e53e3e, #c53030);
      border: none;
      color: white;
    }

    .back-btn {
      background: rgba(255,255,255,0.2);
      border: 2px solid rgba(255,255,255,0.3);
      color: white;
      padding: 10px 20px;
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .back-btn:hover {
      background: white;
      color: #1fbf83;
    }

    .section-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--dark-text);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .section-title i {
      color: #1fbf83;
    }

    .divider {
      height: 1px;
      background: linear-gradient(to right, transparent, #e5e7eb, transparent);
      margin: 20px 0;
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
            <i class="bi bi-heart-pulse text-danger me-2"></i>RenalMe
          </h5>
          <a href="{{ route('administrador.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
          <a href="{{ route('administrador.usuarios.index') }}" class="active">
            <i class="bi bi-people"></i> Usuarios
          </a>
          <a href="{{ route('administrador.pacientes.index') }}">
            <i class="bi bi-person-heart"></i> Pacientes
          </a>
          <a href="{{ route('administrador.comidas.index') }}">
            <i class="bi bi-utensils"></i> Comidas
          </a>
          <a href="{{ route('administrador.alimentos.index') }}">
            <i class="bi bi-cup-hot"></i> Alimentos
          </a>
          <a href="{{ route('administrador.medicamentos.index') }}">
            <i class="bi bi-capsule"></i> Medicina
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
              <h2 class="mb-2">
                <i class="bi bi-person-badge me-2"></i>Detalles del Usuario
              </h2>
              <p class="mb-0 opacity-75">Información completa del usuario registrado</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.usuarios.index') }}" class="back-btn text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- INFORMACIÓN -->
        <div class="row g-4">
          <!-- Card de Información Personal -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-primary me-3">
                  <i class="bi bi-person"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información Personal</h5>
                  <small class="text-muted">Datos básicos del usuario</small>
                </div>
              </div>
              
              <div class="info-label">ID del Usuario</div>
              <div class="info-value">#{{ $usuario->id_usuario }}</div>

              <div class="info-label">Nombre Completo</div>
              <div class="info-value">
                <i class="bi bi-person-circle me-2 text-muted"></i>
                {{ $usuario->nombre }}
              </div>

              <div class="info-label">Correo Electrónico</div>
              <div class="info-value">
                <i class="bi bi-envelope me-2 text-muted"></i>
                {{ $usuario->email }}
              </div>

              <div class="info-label">Rol en el Sistema</div>
              <div class="info-value">
                @if($usuario->rol === 'PACIENTE')
                  <span class="badge badge-custom badge-paciente">
                    <i class="bi bi-person me-1"></i>Paciente
                  </span>
                @elseif($usuario->rol === 'DOCTOR')
                  <span class="badge badge-custom badge-doctor">
                    <i class="bi bi-doctor me-1"></i>Doctor
                  </span>
                @elseif($usuario->rol === 'NUTRICIONISTA')
                  <span class="badge badge-custom badge-nutricionista">
                    <i class="bi bi-heart-pulse me-1"></i>Nutricionista
                  </span>
                @else
                  <span class="badge badge-custom badge-admin">
                    <i class="bi bi-shield-check me-1"></i>Administrador
                  </span>
                @endif
              </div>

              <div class="info-label">Estado de Cuenta</div>
              <div class="info-value">
                @if($usuario->estado)
                  <span class="badge badge-custom badge-activo">
                    <i class="bi bi-check-circle me-1"></i>Cuenta Activa
                  </span>
                @else
                  <span class="badge badge-custom badge-inactivo">
                    <i class="bi bi-x-circle me-1"></i>Cuenta Inactiva
                  </span>
                @endif
              </div>
            </div>
          </div>

          <!-- Card de Información Adicional y Acciones -->
          <div class="col-md-6">
            <!-- Información Adicional -->
            <div class="card-custom mb-4">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-info me-3">
                  <i class="bi bi-calendar-event"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información Adicional</h5>
                  <small class="text-muted">Fechas y registros</small>
                </div>
              </div>
              
              <div class="info-label">Fecha de Registro</div>
              <div class="info-value">
                <i class="bi bi-calendar-plus me-2 text-muted"></i>
                {{ $usuario->fecha_registro ? \Carbon\Carbon::parse($usuario->fecha_registro)->format('d/m/Y H:i') : 'N/A' }}
              </div>

              <div class="info-label">Última Actualización</div>
              <div class="info-value">
                <i class="bi bi-clock-history me-2 text-muted"></i>
                {{ $usuario->updated_at ? \Carbon\Carbon::parse($usuario->updated_at)->format('d/m/Y H:i') : 'N/A' }}
              </div>
            </div>

            <!-- Acciones -->
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-warning me-3">
                  <i class="bi bi-gear"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Acciones</h5>
                  <small class="text-muted">Opciones disponibles</small>
                </div>
              </div>
              
              <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('administrador.usuarios.edit', $usuario->id_usuario) }}" 
                   class="btn btn-action btn-edit">
                  <i class="bi bi-pencil me-2"></i>Editar Usuario
                </a>
                
                <form action="{{ route('administrador.usuarios.toggleEstado', $usuario->id_usuario) }}" method="POST" class="d-inline">
                  @csrf
                  @method('PATCH')
                  @if($usuario->estado)
                    <button type="submit" 
                            class="btn btn-action btn-status-inactive" 
                            onclick="return confirm('¿Estás seguro de desactivar este usuario?')">
                      <i class="bi bi-person-dash me-2"></i>Desactivar
                    </button>
                  @else
                    <button type="submit" 
                            class="btn btn-action btn-status-active" 
                            onclick="return confirm('¿Estás seguro de activar este usuario?')">
                      <i class="bi bi-person-check me-2"></i>Activar
                    </button>
                  @endif
                </form>

                <form action="{{ route('administrador.usuarios.destroy', $usuario->id_usuario) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="btn btn-action btn-delete" 
                          onclick="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')">
                    <i class="bi bi-trash me-2"></i>Eliminar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

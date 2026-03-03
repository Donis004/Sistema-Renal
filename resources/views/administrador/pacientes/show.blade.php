<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Paciente - Sistema Renal</title>
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
    .icon-clinical { background: #ffe0e0; color: #e53e3e; }
    .icon-diet { background: #fff8e0; color: #d69e2e; }

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

    .badge-m { background: #3182ce !important; color: white; }
    .badge-f { background: #d69e2e !important; color: white; }
    .badge-o { background: #718096 !important; color: white; }

    .badge-erc1 { background: #48bb78 !important; color: white; }
    .badge-erc2 { background: #38b2ac !important; color: white; }
    .badge-erc3a { background: #ecc94b !important; color: #1a202c; }
    .badge-erc3b { background: #ed8936 !important; color: white; }
    .badge-erc4 { background: #f6ad55 !important; color: #1a202c; }
    .badge-erc5 { background: #e53e3e !important; color: white; }

    .badge-completo { background: #1fbf83 !important; color: white; }
    .badge-incompleto { background: #cbd5e0 !important; color: #1a202c; }

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

    .diet-box {
      background: #f9fafb;
      border-left: 4px solid #1fbf83;
      padding: 15px;
      border-radius: 8px;
      margin-top: 10px;
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
          <a href="{{ route('administrador.usuarios.index') }}">
            <i class="bi bi-people"></i> Usuarios
          </a>
          <a href="{{ route('administrador.pacientes.index') }}" class="active">
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
                <i class="bi bi-person-badge me-2"></i>Detalles del Paciente
              </h2>
              <p class="mb-0 opacity-75">Información completa del paciente registrado</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.pacientes.index') }}" class="back-btn text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- INFORMACIÓN -->
        <div class="row g-4">
          <!-- Información Personal -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-primary me-3">
                  <i class="bi bi-person"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información Personal</h5>
                  <small class="text-muted">Datos básicos del paciente</small>
                </div>
              </div>
              
              <div class="info-label">ID del Paciente</div>
              <div class="info-value">#{{ $paciente->id_paciente }}</div>

              <div class="info-label">Nombre del Paciente</div>
              <div class="info-value">
                <i class="bi bi-person-circle me-2 text-muted"></i>
                {{ $paciente->usuario->nombre ?? 'N/A' }}
              </div>

              <div class="info-label">Correo Electrónico</div>
              <div class="info-value">
                <i class="bi bi-envelope me-2 text-muted"></i>
                {{ $paciente->usuario->email ?? 'N/A' }}
              </div>

              <div class="info-label">Género</div>
              <div class="info-value">
                @if($paciente->sexo === 'M')
                  <span class="badge badge-custom badge-m"><i class="bi bi-person-fill me-1"></i>Masculino</span>
                @elseif($paciente->sexo === 'F')
                  <span class="badge badge-custom badge-f"><i class="bi bi-person-fill me-1"></i>Femenino</span>
                @else
                  <span class="badge badge-custom badge-o"><i class="bi bi-person-fill me-1"></i>Otro</span>
                @endif
              </div>

              <div class="info-label">Fecha de Nacimiento</div>
              <div class="info-value">
                @if($paciente->fecha_nacimiento)
                  <i class="bi bi-calendar me-2 text-muted"></i>
                  {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }} 
                  <small class="text-muted">({{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años)</small>
                @else
                  <span class="text-muted">No especificado</span>
                @endif
              </div>
            </div>
          </div>

          <!-- Información Clínica -->
          <div class="col-md-6">
            <div class="card-custom h-100">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-clinical me-3">
                  <i class="bi bi-heart-pulse"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información Clínica</h5>
                  <small class="text-muted">Datos médicos relevantes</small>
                </div>
              </div>
              
              <div class="info-label">Etapa de ERC</div>
              <div class="info-value">
                @if($paciente->etapa_erc)
                  <span class="badge badge-erc{{ str_replace('.', '', $paciente->etapa_erc) }}">
                    <i class="bi bi-exclamation-triangle me-1"></i>Etapa {{ $paciente->etapa_erc }}
                  </span>
                @else
                  <span class="text-muted">No especificada</span>
                @endif
              </div>

              <div class="info-label">EGFR (mL/min/1.73m²)</div>
              <div class="info-value">
                @if($paciente->egfr)
                  <span>{{ number_format($paciente->egfr, 2) }} mL/min/1.73m²</span>
                @else
                  <span class="text-muted">No especificado</span>
                @endif
              </div>

              <div class="info-label">Peso</div>
              <div class="info-value">
                @if($paciente->peso_kg)
                  <span>{{ $paciente->peso_kg }} kg</span>
                @else
                  <span class="text-muted">No especificado</span>
                @endif
              </div>

              <div class="info-label">Presión Arterial</div>
              <div class="info-value">
                @if($paciente->presion_arterial)
                  <span>{{ $paciente->presion_arterial }} mmHg</span>
                @else
                  <span class="text-muted">No especificada</span>
                @endif
              </div>
            </div>
          </div>

          <!-- Plan Dietético -->
          <div class="col-md-12">
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-diet me-3">
                  <i class="bi bi-cup-hot"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Plan Dietético</h5>
                  <small class="text-muted">Recomendaciones nutricionales</small>
                </div>
              </div>
              
              <div class="info-label">Dieta Prescrita</div>
              @if($paciente->dieta_prescrita)
                <div class="diet-box">
                  {{ $paciente->dieta_prescrita }}
                </div>
              @else
                <div class="text-muted">No especificada</div>
              @endif

              <div class="divider"></div>

              <div class="info-label">Estado del Perfil</div>
              <div class="info-value">
                @if($paciente->perfil_completo)
                  <span class="badge badge-completo">
                    <i class="bi bi-check-circle me-1"></i>Perfil Completo
                  </span>
                @else
                  <span class="badge badge-incompleto">
                    <i class="bi bi-clock me-1"></i>Perfil Incompleto
                  </span>
                @endif
              </div>
            </div>
          </div>

          <!-- Acciones -->
          <div class="col-md-12">
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-info me-3">
                  <i class="bi bi-gear"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Acciones</h5>
                  <small class="text-muted">Opciones disponibles</small>
                </div>
              </div>
              
              <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('administrador.pacientes.edit', $paciente->id_paciente) }}" 
                   class="btn btn-action btn-edit">
                  <i class="bi bi-pencil me-2"></i>Editar Paciente
                </a>

                <a href="{{ route('administrador.pacientes.medicamentos.index', $paciente->id_paciente) }}" 
                   class="btn btn-action" style="background: linear-gradient(135deg, #1fbf83, #16a369); border: none; color: white;">
                  <i class="bi bi-capsule me-2"></i>Gestionar Medicamentos
                </a>
                
                <form action="{{ route('administrador.pacientes.destroy', $paciente->id_paciente) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="btn btn-action btn-delete" 
                          onclick="return confirm('¿Estás seguro de eliminar este paciente? Esta acción no se puede deshacer.')">
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

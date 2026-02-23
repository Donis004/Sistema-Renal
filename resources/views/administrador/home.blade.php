<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Healthcare Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
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
      padding: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,.05);
    }

    .chart-card {
      background: white;
      border-radius: 18px;
      padding: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,.05);
      margin-bottom: 20px;
    }

    .stat {
      font-size: 28px;
      font-weight: bold;
      color: #1fbf83;
    }

    .badge-green {
      background: #e0f7eb;
      color: #1fbf83;
    }

    .progress {
      height: 8px;
      border-radius: 10px;
    }

    .progress-bar {
      background-color: #1fbf83;
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
          <a href="{{ route('administrador.dashboard') }}" class="active"><i class="bi bi-speedometer"></i> Dashboard</a>
          <a href="{{ route('administrador.usuarios.index') }}"><i class="bi bi-people"></i> Usuarios</a>
          <a href="{{ route('administrador.pacientes.index') }}"><i class="bi bi-person-heart"></i> Pacientes</a>
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
              <h2 class="mb-1"><i class="bi bi-heart-pulse me-2"></i>Panel de Administración</h2>
              <p class="mb-0 opacity-75">Sistema de Control de Pacientes Renales</p>
            </div>
            <div class="col-md-4">
              <form method="GET" action="{{ route('administrador.pacientes.index') }}" class="d-flex">
                <input type="text" name="busqueda" class="form-control" placeholder="Buscar pacientes por nombre...">
                <button type="submit" class="btn btn-light ms-2">
                  <i class="bi bi-search"></i>
                </button>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <span class="badge bg-light text-dark">{{ now()->format('d/m/Y') }}</span>
              <span class="badge bg-light text-dark ms-2">{{ $totalPacientes }} Pacientes registrados</span>
              <span class="badge bg-light text-dark ms-2">{{ $alertasPendientes }} Alertas pendientes</span>
            </div>
          </div>
        </div>

        <!-- TOPBAR -->
        <div class="topbar">
          <input type="text" class="form-control w-50" placeholder="Buscar pacientes, doctores...">
          <div class="d-flex align-items-center gap-3">
            <i class="bi bi-bell"></i>
            <img src="https://i.pravatar.cc/40" class="rounded-circle">
          </div>
        </div>

        <!-- STATS -->
        <div class="row g-4 mb-3">
          <div class="col-md-3">
            <div class="card-custom text-center">
              <p class="mb-1">Usuarios</p>
              <div class="stat">{{ $totalUsuarios }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-custom text-center">
              <p class="mb-1">Pacientes</p>
              <div class="stat">{{ $totalPacientes }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-custom text-center">
              <p class="mb-1">Doctores</p>
              <div class="stat">{{ $totalDoctores }}</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-custom text-center">
              <p class="mb-1">Nutricionistas</p>
              <div class="stat">{{ $totalNutricionistas }}</div>
            </div>
          </div>
        </div>

        <!-- CONTENT -->
        <div class="row g-4 mb-4">

          <div class="col-md-4">
            <div class="card-custom">
              <h6>Monitoreo Renal</h6>
              <div class="stat">{{ $alertasPendientes }}</div>
              <span class="badge badge-green">Alertas Pendientes</span>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card-custom">
              <h6>Comidas Registradas</h6>
              <div class="stat">{{ $comidasHoy }}</div>
              <div class="progress mt-2">
                <div class="progress-bar" style="width:70%"></div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card-custom">
              <h6>Satisfacción del Paciente</h6>
              <p class="mb-1">Alimentos: {{ $totalAlimentos }}</p>
              <div class="progress mb-2">
                <div class="progress-bar" style="width:50%"></div>
              </div>
              <p class="mb-1">Medicamentos: {{ $totalMedicamentos }}</p>
              <div class="progress">
                <div class="progress-bar" style="width:30%"></div>
              </div>
            </div>
          </div>

        </div>

        <!-- GRÁFICOS -->
        <div class="row g-4">
          <!-- Gráfico de Roles de Usuarios -->
          <div class="col-md-4">
            <div class="chart-card">
              <h6 class="text-center mb-3">Distribución por Rol</h6>
              <canvas id="rolesChart"></canvas>
            </div>
          </div>

          <!-- Gráfico de Comidas de la Semana -->
          <div class="col-md-4">
            <div class="chart-card">
              <h6 class="text-center mb-3">Comidas de la Semana</h6>
              <canvas id="comidasChart"></canvas>
            </div>
          </div>

          <!-- Gráfico de Estado de Pacientes -->
          <div class="col-md-4">
            <div class="chart-card">
              <h6 class="text-center mb-3">Estado de Pacientes</h6>
              <canvas id="pacientesChart"></canvas>
            </div>
          </div>
        </div>

        <!-- OTROS GRÁFICOS -->
        <div class="row g-4">
          <!-- Gráfico de Alertas por Nivel -->
          <div class="col-md-6">
            <div class="chart-card">
              <h6 class="text-center mb-3">Alertas Clínicas por Nivel</h6>
              <canvas id="alertasChart"></canvas>
            </div>
          </div>

          <!-- Gráfico de Contenido Educativo -->
          <div class="col-md-6">
            <div class="chart-card">
              <h6 class="text-center mb-3">Tipos de Contenido</h6>
              <canvas id="contenidoChart"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Variables desde PHP
  var totalPacientes = {{ $totalPacientes ?? 0 }};
  var totalDoctores = {{ $totalDoctores ?? 0 }};
  var totalNutricionistas = {{ $totalNutricionistas ?? 0 }};
  var alertasPendientes = {{ $alertasPendientes ?? 0 }};

  // Gráfico de Roles de Usuarios
  const rolesCtx = document.getElementById('rolesChart').getContext('2d');
  new Chart(rolesCtx, {
    type: 'doughnut',
    data: {
      labels: ['Pacientes', 'Doctores', 'Nutricionistas', 'Admin'],
      datasets: [{
        data: [totalPacientes, totalDoctores, totalNutricionistas, 1],
        backgroundColor: ['#4299e1', '#48bb78', '#ed8936', '#f56565'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });

  // Gráfico de Comidas de la Semana
  const comidasCtx = document.getElementById('comidasChart').getContext('2d');
  new Chart(comidasCtx, {
    type: 'bar',
    data: {
      labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
      datasets: [{
        label: 'Comidas',
        data: [12, 19, 15, 17, 22, 10, 8],
        backgroundColor: '#1fbf83',
        borderRadius: 5
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Gráfico de Estado de Pacientes
  const pacientesCtx = document.getElementById('pacientesChart').getContext('2d');
  new Chart(pacientesCtx, {
    type: 'pie',
    data: {
      labels: ['Activos', 'Inactivos'],
      datasets: [{
        data: [totalPacientes, 0],
        backgroundColor: ['#48bb78', '#e53e3e'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });

  // Gráfico de Alertas por Nivel
  const alertasCtx = document.getElementById('alertasChart').getContext('2d');
  new Chart(alertasCtx, {
    type: 'bar',
    data: {
      labels: ['Bajo', 'Medio', 'Alto'],
      datasets: [{
        label: 'Alertas',
        data: [5, 8, alertasPendientes],
        backgroundColor: ['#4299e1', '#ed8936', '#f56565'],
        borderRadius: 5
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Gráfico de Tipos de Contenido
  const contenidoCtx = document.getElementById('contenidoChart').getContext('2d');
  new Chart(contenidoCtx, {
    type: 'polarArea',
    data: {
      labels: ['Dieta', 'Líquidos', 'Ejercicio'],
      datasets: [{
        data: [15, 10, 8],
        backgroundColor: ['rgba(31, 191, 131, 0.7)', 'rgba(56, 178, 172, 0.7)', 'rgba(237, 137, 54, 0.7)'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script>
</body>
</html>

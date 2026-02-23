<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Comida - Sistema Renal</title>
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
      border-radius: 18px;
      padding: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .table-custom {
      background: white;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.05);
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

    .badge-foto { background: #805ad5; color: white; }
    .badge-manual { background: #718096; color: white; }

    .badge-seguro {
      background: #d1fae5;
      color: #059669;
      padding: 4px 10px;
      border-radius: 15px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .badge-peligroso {
      background: #fee2e2;
      color: #dc2626;
      padding: 4px 10px;
      border-radius: 15px;
      font-size: 0.75rem;
      font-weight: 600;
    }

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

    .back-btn {
      background: rgba(255,255,255,0.2);
      border: 2px solid rgba(255,255,255,0.3);
      color: white;
      padding: 10px 20px;
      border-radius: 12px;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .back-btn:hover {
      background: white;
      color: #1fbf83;
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

    .empty-state {
      text-align: center;
      padding: 40px 20px;
      color: var(--muted-text);
    }

    .empty-state i {
      font-size: 3rem;
      margin-bottom: 15px;
      color: #d1d5db;
    }

    .modal-header-custom {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      color: white;
      border-radius: 15px 15px 0 0;
    }

    .form-label-custom {
      font-weight: 600;
      color: var(--dark-text);
      margin-bottom: 8px;
    }

    .form-control-custom {
      border-radius: 12px;
      padding: 12px 15px;
      border: 2px solid #e5e7eb;
      transition: all 0.3s ease;
    }

    .form-control-custom:focus {
      border-color: #1fbf83;
      box-shadow: 0 0 0 3px rgba(31, 191, 131, 0.1);
    }

    .btn-primary-custom {
      background: linear-gradient(135deg, #1fbf83, #38b2ac);
      border: none;
      color: white;
      padding: 12px 30px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(31, 191, 131, 0.4);
      color: white;
    }

    .btn-primary-custom:disabled {
      background: #ccc;
      cursor: not-allowed;
      transform: none;
    }

    /* Filter styles */
    .filter-container {
      margin-bottom: 15px;
    }

    .filter-btn {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }

    .filter-btn.active {
      border-color: currentColor;
    }

    .filter-todos {
      background: #f3f4f6;
      color: #6b7280;
    }

    .filter-seguro {
      background: #d1fae5;
      color: #059669;
    }

    .filter-peligroso {
      background: #fee2e2;
      color: #dc2626;
    }

    /* Food list in modal */
    .food-list-container {
      max-height: 400px;
      overflow-y: auto;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
    }

    .food-option {
      padding: 12px 15px;
      border-bottom: 1px solid #f0f0f0;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .food-option:hover {
      background: #f0fdf4;
    }

    .food-option:last-child {
      border-bottom: none;
    }

    .food-option.selected {
      background: #d1fae5;
      border-left: 4px solid #1fbf83;
    }

    .food-option.seguro {
      border-left: 4px solid #059669;
    }

    .food-option.peligroso {
      border-left: 4px solid #dc2626;
    }

    .food-nutrition {
      font-size: 0.8rem;
      color: #6b7280;
    }

    .selected-food-display {
      background: #f0fdf4;
      border: 2px solid #1fbf83;
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 15px;
    }

    .selected-food-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
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
          <a href="{{ route('administrador.pacientes.index') }}">
            <i class="bi bi-person-heart"></i> Pacientes
          </a>
          <a href="{{ route('administrador.comidas.index') }}" class="active">
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
                <i class="bi bi-utensils me-2"></i>Detalles de la Comida
              </h2>
              <p class="mb-0 opacity-75">Información completa del registro alimenticio</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.comidas.index') }}" class="back-btn">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- ALERTS -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i>
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- INFORMACIÓN -->
        <div class="row g-4">
          <!-- Card de Información General -->
          <div class="col-md-6">
            <div class="card-custom">
              <div class="d-flex align-items-center mb-4">
                <div class="card-icon icon-primary me-3">
                  <i class="bi bi-info-circle"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Información General</h5>
                  <small class="text-muted">Datos principales de la comida</small>
                </div>
              </div>
              
              <div class="info-label">ID de Comida</div>
              <div class="info-value">#{{ $comida->id_comida }}</div>

              <div class="info-label">Paciente</div>
              <div class="info-value">
                <i class="bi bi-person-circle me-2 text-muted"></i>
                {{ $comida->paciente->usuario->nombre ?? 'N/A' }}
              </div>

              <div class="info-label">Tipo de Registro</div>
              <div class="info-value">
                @if($comida->tipo_registro === 'FOTO')
                  <span class="badge badge-custom badge-foto">
                    <i class="bi bi-camera me-1"></i>Foto
                  </span>
                @else
                  <span class="badge badge-custom badge-manual">
                    <i class="bi bi-pencil me-1"></i>Manual
                  </span>
                @endif
              </div>

              <div class="info-label">Fecha y Hora</div>
              <div class="info-value">
                <i class="bi bi-calendar-event me-2 text-muted"></i>
                {{ $comida->fecha_hora ? \Carbon\Carbon::parse($comida->fecha_hora)->format('d/m/Y H:i') : 'N/A' }}
              </div>
            </div>
          </div>

          <!-- Card de Acciones -->
          <div class="col-md-6">
            <div class="card-custom mb-4">
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
                <a href="{{ route('administrador.comidas.edit', $comida->id_comida) }}" 
                   class="btn btn-success-custom">
                  <i class="bi bi-pencil me-2"></i>Editar Comida
                </a>
                
                <form action="{{ route('administrador.comidas.destroy', $comida->id_comida) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="btn btn-delete" 
                          onclick="return confirm('¿Estás seguro de eliminar esta comida? Esta acción no se puede deshacer.')">
                    <i class="bi bi-trash me-2"></i>Eliminar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- TABLA DE ALIMENTOS REGISTRADOS -->
        <div class="row g-4 mt-2">
          <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="d-flex align-items-center">
                <div class="card-icon icon-info me-3">
                  <i class="bi bi-basket"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold">Alimentos Registrados</h5>
                  <small class="text-muted">Listado de alimentos consumidos en esta comida</small>
                </div>
              </div>
              <button class="btn btn-success-custom" data-bs-toggle="modal" data-bs-target="#agregarAlimentoModal">
                <i class="bi bi-plus-circle me-2"></i>Agregar Alimento
              </button>
            </div>

            @if($comida->comidaDetalles->count() > 0)
            <div class="table-custom">
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 60px;">#</th>
                      <th>Alimento</th>
                      <th class="text-center">Estado Renal</th>
                      <th class="text-center">Cantidad</th>
                      <th class="text-center">Potasio (K)</th>
                      <th class="text-center">Fósforo (P)</th>
                      <th class="text-center">Sodio (Na)</th>
                      <th class="text-center">Proteína</th>
                      <th class="text-center" style="width: 100px;">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($comida->comidaDetalles as $index => $detalle)
                    <tr>
                      <td class="text-center fw-bold">{{ $index + 1 }}</td>
                      <td>
                        <i class="bi bi-cup-hot text-success me-2"></i>
                        <strong>{{ $detalle->alimento->nombre ?? 'Alimento #' . $detalle->id_alimento }}</strong>
                      </td>
                      <td class="text-center">
                        @if($detalle->alimento && $detalle->alimento->seguro_renal)
                          <span class="badge-seguro"><i class="bi bi-check-circle me-1"></i>Seguro</span>
                        @else
                          <span class="badge-peligroso"><i class="bi bi-exclamation-triangle me-1"></i>Peligroso</span>
                        @endif
                      </td>
                      <td class="text-center">
                        {{ $detalle->cantidad_porcion }} porcion{{ $detalle->cantidad_porcion != 1 ? 'es' : '' }}
                      </td>
                      <td class="text-center">
                        {{ $detalle->alimento ? ($detalle->alimento->potasio_mg ?? 0) * $detalle->cantidad_porcion : 0 }} mg
                      </td>
                      <td class="text-center">
                        {{ $detalle->alimento ? ($detalle->alimento->fosforo_mg ?? 0) * $detalle->cantidad_porcion : 0 }} mg
                      </td>
                      <td class="text-center">
                        {{ $detalle->alimento ? ($detalle->alimento->sodio_mg ?? 0) * $detalle->cantidad_porcion : 0 }} mg
                      </td>
                      <td class="text-center">
                        {{ $detalle->alimento ? ($detalle->alimento->proteina_g ?? 0) * $detalle->cantidad_porcion : 0 }} g
                      </td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <form action="{{ route('administrador.comidas.eliminarAlimento', $detalle->id_detalle) }}" method="POST" class="d-inline">
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
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @else
            <div class="card-custom">
              <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p class="mb-0">Sin alimentos registrados</p>
                <small>Agrega alimentos a esta comida</small>
              </div>
            </div>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Modal para agregar alimento con filtros mejorados -->
<div class="modal fade" id="agregarAlimentoModal" tabindex="-1" aria-labelledby="agregarAlimentoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-custom">
        <h5 class="modal-title" id="agregarAlimentoModalLabel">
          <i class="bi bi-plus-circle me-2"></i>Agregar Alimento
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('administrador.comidas.agregarAlimento', $comida->id_comida) }}" method="POST" id="agregarAlimentoForm">
        @csrf
        <div class="modal-body">
          <!-- Filtros -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label form-label-custom">
                <i class="bi bi-search me-2"></i>Buscar
              </label>
              <input type="text" class="form-control form-control-custom" id="buscarAlimento" 
                     placeholder="Escribe el nombre del alimento...">
            </div>
            <div class="col-md-6">
              <label class="form-label form-label-custom">
                <i class="bi bi-funnel me-2"></i>Filtrar por
              </label>
              <div class="d-flex gap-2">
                <button type="button" class="filter-btn filter-todos active" data-filter="todos">
                  Todos
                </button>
                <button type="button" class="filter-btn filter-seguro" data-filter="seguro">
                  <i class="bi bi-check-circle me-1"></i>Seguros
                </button>
                <button type="button" class="filter-btn filter-peligroso" data-filter="peligroso">
                  <i class="bi bi-exclamation-triangle me-1"></i>Peligrosos
                </button>
              </div>
            </div>
          </div>

          <!-- Selected food display -->
          <div id="selectedFoodDisplay" class="selected-food-display" style="display: none;">
            <div class="selected-food-info">
              <div>
                <strong id="selectedFoodName"></strong>
                <span id="selectedFoodBadge"></span>
                <div class="food-nutrition mt-1" id="selectedFoodNutrition"></div>
              </div>
              <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearSelection()">
                <i class="bi bi-x-lg"></i>
              </button>
            </div>
          </div>

          <!-- Lista de alimentos -->
          <div class="mb-3">
            <label class="form-label form-label-custom">
              <i class="bi bi-cup-hot me-2 text-success"></i>Seleccionar Alimento
            </label>
            <div class="food-list-container" id="foodList">
              @forelse($alimentos as $alimento)
                <div class="food-option {{ $alimento->seguro_renal ? 'seguro' : 'peligroso' }}"
                     data-id="{{ $alimento->id_alimento }}"
                     data-nombre="{{ strtolower($alimento->nombre) }}"
                     data-seguro="{{ $alimento->seguro_renal ? 'seguro' : 'peligroso' }}"
                     onclick="selectFood({{ $alimento->id_alimento }}, '{{ $alimento->nombre }}', {{ $alimento->seguro_renal ? 'true' : 'false' }}, {{ $alimento->potasio_mg ?? 0 }}, {{ $alimento->fosforo_mg ?? 0 }})">
                  <div>
                    <strong>{{ $alimento->nombre }}</strong>
                    <span class="badge {{ $alimento->seguro_renal ? 'badge-seguro' : 'badge-peligroso' }}">
                      {{ $alimento->seguro_renal ? 'Seguro' : 'Peligroso' }}
                    </span>
                    <div class="food-nutrition">
                      K: {{ $alimento->potasio_mg ?? 0 }}mg | P: {{ $alimento->fosforo_mg ?? 0 }}mg | Na: {{ $alimento->sodio_mg ?? 0 }}mg | Proteína: {{ $alimento->proteina_g ?? 0 }}g
                    </div>
                  </div>
                  <i class="bi bi-chevron-right text-muted"></i>
                </div>
              @empty
                <div class="text-center py-4 text-muted">
                  <i class="bi bi-inbox fs-1"></i>
                  <p class="mb-0">No hay alimentos disponibles</p>
                </div>
              @endforelse
            </div>
            <div id="noResults" class="text-center py-3 text-muted" style="display: none;">
              <i class="bi bi-search fs-4"></i>
              <p class="mb-0">No se encontraron alimentos con los filtros aplicados</p>
            </div>
          </div>

          <!-- Hidden input for selected food -->
          <input type="hidden" name="id_alimento" id="selectedAlimentoId" required>
          
          <div class="mb-3">
            <label for="cantidad_porcion" class="form-label form-label-custom">
              <i class="bi bi-rulers me-2 text-primary"></i>Cantidad (porciones) *
            </label>
            <input type="number" class="form-control form-control-custom" id="cantidad_porcion" name="cantidad_porcion" 
                   step="0.1" min="0.1" value="1" required placeholder="Ej: 1, 1.5, 2">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-2"></i>Cancelar
          </button>
          <button type="submit" class="btn btn-primary-custom" id="btnAgregar" disabled>
            <i class="bi bi-check-circle me-2"></i>Agregar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  let currentFilter = 'todos';
  let selectedFoodId = null;

  // Filter buttons
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      currentFilter = this.dataset.filter;
      applyFilters();
    });
  });

  // Search input
  document.getElementById('buscarAlimento').addEventListener('keyup', applyFilters);

  function applyFilters() {
    const searchTerm = document.getElementById('buscarAlimento').value.toLowerCase();
    const options = document.querySelectorAll('.food-option');
    let visibleCount = 0;

    options.forEach(option => {
      const nombre = option.dataset.nombre;
      const seguro = option.dataset.seguro;
      
      const matchesSearch = nombre.includes(searchTerm);
      const matchesFilter = currentFilter === 'todos' || seguro === currentFilter;
      
      if (matchesSearch && matchesFilter) {
        option.style.display = 'flex';
        visibleCount++;
      } else {
        option.style.display = 'none';
      }
    });

    document.getElementById('noResults').style.display = visibleCount === 0 ? 'block' : 'none';
  }

  function selectFood(id, nombre, seguro, potasio, fosforo) {
    // Remove previous selection
    document.querySelectorAll('.food-option').forEach(opt => opt.classList.remove('selected'));
    
    // Add selection to clicked option
    const clickedOption = document.querySelector(`.food-option[data-id="${id}"]`);
    if (clickedOption) {
      clickedOption.classList.add('selected');
    }

    // Update hidden input
    document.getElementById('selectedAlimentoId').value = id;
    selectedFoodId = id;

    // Update display
    const badge = seguro 
      ? '<span class="badge badge-seguro ms-2">Seguro</span>' 
      : '<span class="badge badge-peligroso ms-2">Peligroso</span>';
    
    document.getElementById('selectedFoodName').textContent = nombre;
    document.getElementById('selectedFoodBadge').innerHTML = badge;
    document.getElementById('selectedFoodNutrition').textContent = `K: ${potasio}mg | P: ${fosforo}mg`;
    
    document.getElementById('selectedFoodDisplay').style.display = 'block';
    document.getElementById('btnAgregar').disabled = false;
  }

  function clearSelection() {
    document.querySelectorAll('.food-option').forEach(opt => opt.classList.remove('selected'));
    document.getElementById('selectedAlimentoId').value = '';
    document.getElementById('selectedFoodDisplay').style.display = 'none';
    document.getElementById('btnAgregar').disabled = true;
    selectedFoodId = null;
  }

  // Reset on modal close
  document.getElementById('agregarAlimentoModal').addEventListener('hidden.bs.modal', function() {
    clearSelection();
    document.getElementById('buscarAlimento').value = '';
    currentFilter = 'todos';
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    document.querySelector('.filter-todos').classList.add('active');
    applyFilters();
  });
</script>
</body>
</html>

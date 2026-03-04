<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Asignar Medicamento - Sistema Renal</title>
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
      padding: 25px;
      box-shadow: 0 8px 20px rgba(0,0,0,.05);
    }

    .form-control-custom {
      border-radius: 12px;
      padding: 12px 15px;
      border: 1px solid #ddd;
    }

    .form-control-custom:focus {
      border-color: #1fbf83;
      box-shadow: 0 0 0 0.2rem rgba(31, 191, 131, 0.25);
    }

    .btn-success-custom {
      background: #1fbf83;
      border: none;
      color: white;
      padding: 12px 30px;
      border-radius: 12px;
    }

    .btn-success-custom:hover {
      background: #179a6d;
      color: white;
    }

    .btn-outline-custom {
      border: 2px solid #1fbf83;
      color: #1fbf83;
      padding: 12px 30px;
      border-radius: 12px;
    }

    .btn-outline-custom:hover {
      background: #1fbf83;
      color: white;
    }

    .form-label {
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 8px;
    }

    .form-text {
      font-size: 0.85rem;
      color: #6b7280;
    }

    .form-section-title {
      font-size: 1rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 20px;
      margin-top: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid #1fbf83;
    }

    .medicamento-search-wrapper {
      position: relative;
    }

    .medicamento-search-input {
      width: 100%;
      padding: 12px 15px 12px 40px;
      border-radius: 12px;
      border: 1px solid #ddd;
      font-size: 0.95rem;
      transition: all 0.3s ease;
    }

    .medicamento-search-input:focus {
      outline: none;
      border-color: #1fbf83;
      box-shadow: 0 0 0 0.2rem rgba(31, 191, 131, 0.25);
    }

    .medicamento-search-input::placeholder {
      color: #9ca3af;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      pointer-events: none;
      z-index: 1;
    }

    .medicamentos-dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 1px solid #ddd;
      border-top: none;
      border-radius: 0 0 12px 12px;
      max-height: 300px;
      overflow-y: auto;
      z-index: 1000;
      display: none;
      box-shadow: 0 8px 20px rgba(0,0,0,.1);
    }

    .medicamentos-dropdown.show {
      display: block;
    }

    .medicamento-option {
      padding: 12px 15px;
      cursor: pointer;
      transition: all 0.2s ease;
      border-bottom: 1px solid #f0f0f0;
    }

    .medicamento-option:last-child {
      border-bottom: none;
    }

    .medicamento-option:hover {
      background: #f0fdf4;
      color: #1fbf83;
    }

    .medicamento-option.selected {
      background: #1fbf83;
      color: white;
    }

    .medicamento-option.hidden {
      display: none;
    }

    .medicamentos-empty {
      padding: 15px;
      text-align: center;
      color: #9ca3af;
      font-size: 0.9rem;
    }

    #id_medicamento {
      display: none;
    }

    .selected-medicamento {
      background: #f0fdf4;
      border: 2px solid #1fbf83;
      padding: 10px 12px;
      border-radius: 8px;
      margin-top: 8px;
      display: none;
      align-items: center;
      gap: 8px;
    }

    .selected-medicamento.show {
      display: flex;
    }

    .selected-medicamento-name {
      flex: 1;
      color: #1fbf83;
      font-weight: 600;
    }

    .clear-selection {
      background: none;
      border: none;
      color: #1fbf83;
      cursor: pointer;
      padding: 4px 8px;
      font-size: 1.2rem;
      line-height: 1;
    }

    .clear-selection:hover {
      color: #e53e3e;
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
          <a href="{{ route('administrador.dashboard') }}"><i class="bi bi-speedometer"></i> Dashboard</a>
          <a href="{{ route('administrador.usuarios.index') }}"><i class="bi bi-people"></i> Usuarios</a>
          <a href="{{ route('administrador.pacientes.index') }}" class="active"><i class="bi bi-person-heart"></i> Pacientes</a>
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
              <h2 class="mb-1"><i class="bi bi-plus-circle me-2"></i>Asignar Medicamento</h2>
              <p class="mb-0 opacity-75">Agrega un medicamento a {{ $paciente->usuario->nombre }}</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="{{ route('administrador.pacientes.medicamentos.index', $paciente->id_paciente) }}" class="btn btn-light">
                <i class="bi bi-arrow-left me-2"></i>Volver
              </a>
            </div>
          </div>
        </div>

        <!-- FORMULARIO -->
        <div class="card-custom">
          <form method="POST" action="{{ route('administrador.pacientes.medicamentos.store', $paciente->id_paciente) }}">
            @csrf
            
            <h6 class="form-section-title"><i class="bi bi-capsule"></i> Información del Medicamento</h6>
            
            <div class="row g-3 mb-4">
              <div class="col-md-12">
                <label for="medicamentoSearch" class="form-label">Medicamento *</label>
                
                <div class="medicamento-search-wrapper">
                  <i class="bi bi-search search-icon"></i>
                  <input type="text" 
                         id="medicamentoSearch" 
                         class="medicamento-search-input @error('id_medicamento') is-invalid @enderror" 
                         placeholder="Buscar medicamento por nombre...">
                  
                  <div class="medicamentos-dropdown" id="medicamentosDropdown">
                    @foreach($medicamentos as $medicamento)
                      @if(!in_array($medicamento->id_medicamento, $medicamentosAsignados))
                        <div class="medicamento-option" 
                             data-id="{{ $medicamento->id_medicamento }}" 
                             data-nombre="{{ strtolower($medicamento->nombre) }}">
                          {{ $medicamento->nombre }}
                        </div>
                      @endif
                    @endforeach
                    <div class="medicamentos-empty" id="medicamentosEmpty" style="display: none;">
                      No se encontraron medicamentos
                    </div>
                  </div>
                </div>

                <div class="selected-medicamento" id="selectedMedicamento">
                  <i class="bi bi-check2-circle" style="color: #1fbf83; font-size: 1.2rem;"></i>
                  <span class="selected-medicamento-name" id="selectedMedicamentoName"></span>
                  <button type="button" class="clear-selection" id="clearSelection">
                    <i class="bi bi-x-circle"></i>
                  </button>
                </div>

                <input type="hidden" id="id_medicamento" name="id_medicamento" value="{{ old('id_medicamento') }}">
                
                @error('id_medicamento')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="form-text">Solo se muestran medicamentos no asignados a este paciente.</small>
              </div>
            </div>

            <h6 class="form-section-title"><i class="bi bi-prescription"></i> Detalles de Prescripción</h6>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label for="dosis" class="form-label">Dosis</label>
                <input type="text" class="form-control form-control-custom @error('dosis') is-invalid @enderror" 
                       id="dosis" name="dosis" value="{{ old('dosis') }}" 
                       placeholder="Ej: 500mg, 1 comprimido">
                @error('dosis')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="frecuencia" class="form-label">Frecuencia</label>
                <input type="text" class="form-control form-control-custom @error('frecuencia') is-invalid @enderror" 
                       id="frecuencia" name="frecuencia" value="{{ old('frecuencia') }}" 
                       placeholder="Ej: 2 veces al día, cada 8 horas">
                @error('frecuencia')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <div class="form-check mt-4">
                  <input class="form-check-input" type="checkbox" id="con_alimentos" name="con_alimentos" value="1" 
                         {{ old('con_alimentos') ? 'checked' : '' }}>
                  <label class="form-check-label" for="con_alimentos">
                    Con Alimentos
                  </label>
                  <small class="form-text d-block">¿El medicamento debe tomarse con alimentos?</small>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-check mt-4">
                  <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" 
                         {{ old('activo', true) ? 'checked' : '' }}>
                  <label class="form-check-label" for="activo">
                    Activo
                  </label>
                  <small class="form-text d-block">¿El medicamento está activo?</small>
                </div>
              </div>
            </div>

            <div class="col-md-12 mt-4">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success-custom">
                  <i class="bi bi-check-circle me-2"></i>Asignar Medicamento
                </button>
                <a href="{{ route('administrador.pacientes.medicamentos.index', $paciente->id_paciente) }}" class="btn btn-outline-custom">
                  Cancelar
                </a>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('medicamentoSearch');
    const dropdown = document.getElementById('medicamentosDropdown');
    const options = dropdown.querySelectorAll('.medicamento-option:not(.medicamentos-empty)');
    const emptyMessage = document.getElementById('medicamentosEmpty');
    const hiddenInput = document.getElementById('id_medicamento');
    const selectedMedicamento = document.getElementById('selectedMedicamento');
    const selectedMedicamentoName = document.getElementById('selectedMedicamentoName');
    const clearSelection = document.getElementById('clearSelection');

    // Mostrar dropdown al hacer foco en el input
    searchInput.addEventListener('focus', function() {
      dropdown.classList.add('show');
      filterOptions('');
    });

    // Filtrar opciones mientras se escribe
    searchInput.addEventListener('input', function() {
      filterOptions(this.value.toLowerCase());
    });

    // Cerrar dropdown si se hace clic fuera
    document.addEventListener('click', function(e) {
      if (!dropdown.parentElement.contains(e.target) && e.target !== searchInput) {
        dropdown.classList.remove('show');
      }
    });

    // Función para filtrar opciones
    function filterOptions(searchTerm) {
      let visibleCount = 0;

      options.forEach(option => {
        const nombre = option.getAttribute('data-nombre');
        
        if (nombre.includes(searchTerm)) {
          option.classList.remove('hidden');
          visibleCount++;
        } else {
          option.classList.add('hidden');
        }
      });

      if (visibleCount === 0) {
        emptyMessage.style.display = 'block';
      } else {
        emptyMessage.style.display = 'none';
      }
    }

    // Seleccionar medicamento
    options.forEach(option => {
      option.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nombre = this.textContent;

        hiddenInput.value = id;
        searchInput.value = '';
        selectedMedicamentoName.textContent = nombre;
        selectedMedicamento.classList.add('show');
        dropdown.classList.remove('show');

        // Limpiar filtro
        filterOptions('');
      });
    });

    // Limpiar selección
    clearSelection.addEventListener('click', function(e) {
      e.preventDefault();
      hiddenInput.value = '';
      searchInput.value = '';
      selectedMedicamento.classList.remove('show');
      dropdown.classList.add('show');
      filterOptions('');
    });

    // Si hay valor guardado (old), mostrar selección
    if (hiddenInput.value) {
      const selectedOption = Array.from(options).find(opt => opt.getAttribute('data-id') === hiddenInput.value);
      if (selectedOption) {
        selectedMedicamentoName.textContent = selectedOption.textContent;
        selectedMedicamento.classList.add('show');
      }
    }
  });
</script>
</body>
</html>

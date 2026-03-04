<!-- Sidebar Component for Admin Pages -->
<div class="sidebar">
  <h5 class="fw-bold mb-4"><i class="bi bi-heart-pulse text-danger"></i> RenalMe</h5>
  <a href="{{ route('administrador.dashboard') }}" class="{{ request()->routeIs('administrador.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer"></i> Dashboard
  </a>
  <a href="{{ route('administrador.usuarios.index') }}" class="{{ request()->routeIs('administrador.usuarios.*') ? 'active' : '' }}">
    <i class="bi bi-people"></i> Usuarios
  </a>
  <a href="{{ route('administrador.pacientes.index') }}" class="{{ request()->routeIs('administrador.pacientes.*') ? 'active' : '' }}">
    <i class="bi bi-person-heart"></i> Pacientes
  </a>
  <a href="{{ route('administrador.comidas.index') }}" class="{{ request()->routeIs('administrador.comidas.*') ? 'active' : '' }}">
    <i class="bi bi-utensils"></i> Comidas
  </a>
  <a href="{{ route('administrador.alimentos.index') }}" class="{{ request()->routeIs('administrador.alimentos.*') ? 'active' : '' }}">
    <i class="bi bi-cup-hot"></i> Alimentos
  </a>
  <a href="{{ route('administrador.medicamentos.index') }}" class="{{ request()->routeIs('administrador.medicamentos.*') ? 'active' : '' }}">
    <i class="bi bi-capsule"></i> Medicina
  </a>
  <a href="{{ route('administrador.comorbilidades.index') }}" class="{{ request()->routeIs('administrador.comorbilidades.*') ? 'active' : '' }}">
    <i class="bi bi-heart-pulse"></i> Comorbilidades
  </a>
  <a href="{{ route('administrador.alergias.index') }}" class="{{ request()->routeIs('administrador.alergias.*') ? 'active' : '' }}">
    <i class="bi bi-exclamation-triangle"></i> Alergias
  </a>
  <a href="{{ route('administrador.sintomas.index') }}" class="{{ request()->routeIs('administrador.sintomas.*') ? 'active' : '' }}">
    <i class="bi bi-thermometer"></i> Síntomas
  </a>
  <a href="{{ route('administrador.recomendaciones.index') }}" class="{{ request()->routeIs('administrador.recomendaciones.*') ? 'active' : '' }}">
    <i class="bi bi-lightbulb"></i> Recomendaciones
  </a>
  <a href="{{ route('administrador.contenidos.index') }}" class="{{ request()->routeIs('administrador.contenidos.*') ? 'active' : '' }}">
    <i class="bi bi-book"></i> Contenido
  </a>
  <a href="{{ route('administrador.reportes.index') }}" class="{{ request()->routeIs('administrador.reportes.*') ? 'active' : '' }}">
    <i class="bi bi-graph-up"></i> Reportes
  </a>
</div>

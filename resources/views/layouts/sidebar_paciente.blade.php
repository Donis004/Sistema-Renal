<div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 sidebar-container d-flex flex-column h-100 p-3">
    
    <div class="text-center mb-4 mt-2">
        <a href="{{ route('paciente.dashboard') }}" class="text-decoration-none text-dark">
            <h4 class="fw-bold mb-0">
                <i class="bi bi-heart-pulse text-danger"></i> RenalMe
            </h4>
        </a>
    </div>
    
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100" id="menu">
        
        <li class="nav-item w-100 mb-2">
            <a href="{{ route('paciente.dashboard') }}" class="nav-link sidebar-link d-block px-3 py-2 rounded {{ request()->routeIs('paciente.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> <span class="d-none d-sm-inline">Mi Resumen</span>
            </a>
        </li>
        
        <li class="nav-item w-100 mb-2">
            <a href="{{ route('paciente.comidas.index') }}" class="nav-link sidebar-link d-block px-3 py-2 rounded {{ request()->routeIs('paciente.comidas.*') ? 'active' : '' }}">
                <i class="bi bi-camera me-2"></i> <span class="d-none d-sm-inline">Mis Comidas</span>
            </a>
        </li>
        
        <li class="nav-item w-100 mb-2">
            <a href="{{ route('paciente.alimentos.sugerencias') }}" class="nav-link sidebar-link d-block px-3 py-2 rounded {{ request()->routeIs('paciente.alimentos.*') ? 'active' : '' }}">
                <i class="bi bi-lightbulb me-2"></i> <span class="d-none d-sm-inline">Sugerencias</span>
            </a>
        </li>
        
        <li class="nav-item w-100 mb-2">
             <a href="{{ route('paciente.medicamentos.index') }}" class="nav-link sidebar-link d-block px-3 py-2 rounded {{ request()->routeIs('paciente.medicamentos.*') ? 'active' : '' }}">
                <i class="bi bi-capsule me-2"></i> <span class="d-none d-sm-inline">Medicamentos</span>
            </a> 
        </li>

                
        <li class="nav-item w-100 mb-2">
            <a href="{{ route('paciente.sintomas.index') }}" class="nav-link sidebar-link d-block px-3 py-2 rounded {{ request()->routeIs('paciente.sintomas.*') ? 'active' : '' }}">
                <i class="bi bi-activity me-2"></i> <span class="d-none d-sm-inline">Síntomas</span>
            </a>
        </li>

                <li class="nav-item w-100 mb-2">
            <a href="{{ route('paciente.alertas.index') }}" class="nav-link sidebar-link d-block px-3 py-2 rounded {{ request()->routeIs('paciente.alertas.*') ? 'active' : '' }}">
                <i class="bi bi-bell me-2"></i> <span class="d-none d-sm-inline">Alertas</span>
            </a>
        </li>

    </ul>

    <hr class="text-secondary w-100">

    <div class="w-100 pb-3">
        <a href="{{ route('paciente.perfil.show') }}" class="nav-link sidebar-link d-block px-3 py-2 rounded mb-2 {{ request()->routeIs('paciente.perfil.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle me-2"></i> <span class="d-none d-sm-inline">Mi Perfil</span>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-light w-100 text-start text-danger border-0 fw-semibold">
                <i class="bi bi-box-arrow-left me-2"></i> <span class="d-none d-sm-inline">Salir</span>
            </button>
        </form>
    </div>
</div>
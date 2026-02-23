<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema Renal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c7a7b;
            --secondary-color: #38b2ac;
            --accent-color: #81e6d9;
            --dark-bg: #1a202c;
            --light-bg: #f7fafc;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
        }
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }
        .sidebar {
            min-height: 100vh;
            background-color: var(--dark-bg);
            color: white;
        }
        .sidebar a {
            color: #a0aec0;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: var(--primary-color);
            color: white;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        }
        .table {
            background: white;
            border-radius: 10px;
        }
        .badge-role {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85em;
        }
        .badge-PACIENTE { background-color: #4299e1; }
        .badge-DOCTOR { background-color: #48bb78; }
        .badge-NUTRICIONISTA { background-color: #ed8936; }
        .badge-ADMIN { background-color: #f56565; }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('administrador.home') }}">
                <i class="fas fa-heartbeat me-2"></i>Sistema Renal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Bienvenido, {{ session('usuario_nombre') ?? 'Usuario' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
            <div class="col-md-2 sidebar p-0">
                <a href="{{ route('administrador.home') }}" class="{{ request()->routeIs('administrador.home') ? 'active' : '' }}">
                    <i class="fas fa-home me-2"></i>Inicio
                </a>
                <a href="{{ route('administrador.usuarios.index') }}" class="{{ request()->routeIs('administrador.usuarios.*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>Usuarios
                </a>
                <a href="{{ route('administrador.pacientes.index') }}" class="{{ request()->routeIs('administrador.pacientes.*') ? 'active' : '' }}">
                    <i class="fas fa-user-injured me-2"></i>Pacientes
                </a>
                <a href="{{ route('administrador.alimentos.index') }}" class="{{ request()->routeIs('administrador.alimentos.*') ? 'active' : '' }}">
                    <i class="fas fa-apple-alt me-2"></i>Alimentos
                </a>
                <a href="{{ route('administrador.medicamentos.index') }}" class="{{ request()->routeIs('administrador.medicamentos.*') ? 'active' : '' }}">
                    <i class="fas fa-pills me-2"></i>Medicamentos
                </a>
                <a href="{{ route('administrador.contenidos.index') }}" class="{{ request()->routeIs('administrador.contenidos.*') ? 'active' : '' }}">
                    <i class="fas fa-book-medical me-2"></i>Contenidos
                </a>
                <a href="{{ route('administrador.reportes.index') }}" class="{{ request()->routeIs('administrador.reportes.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar me-2"></i>Reportes
                </a>
            </div>
            <div class="col-md-10">
            @else
            <div class="col-12">
            @endauth
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    @yield('scripts')
</body>
</html>

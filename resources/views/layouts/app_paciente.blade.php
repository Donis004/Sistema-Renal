<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RenalMe - Módulo Paciente</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-green: #2ecc71;
            --dark-green: #27ae60;
            --light-green: #e8f8f5;
            --sidebar-width: 250px;
        }
        
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f8f9fa;
        }
        
        /* Clases utilitarias personalizadas */
        .bg-primary-custom { background-color: var(--primary-green) !important; }
        .text-primary-custom { color: var(--dark-green) !important; }
        
        .btn-primary-custom {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            color: white;
            border-radius: 8px;
            padding: 10px 24px;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--dark-green);
            border-color: var(--dark-green);
            color: white;
        }
        
        /* Ajustes específicos para el layout */
        .sidebar-container {
            background-color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            z-index: 1000;
        }
        
        .sidebar-link {
            transition: all 0.3s ease;
            color: #495057;
        }
        
        .sidebar-link:hover:not(.active) {
            background-color: var(--light-green);
            color: var(--dark-green);
        }
        
        .sidebar-link.active {
            background-color: var(--primary-green) !important;
            color: white !important;
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
        }
        
        .main-content {
            background-color: #f4fdf8; /* Fondo sutilmente verde para el contenido */
        }
    </style>
    
    @stack('styles') </head>
<body>

    <div class="container-fluid overflow-hidden">
        <div class="row vh-100">
            
            @include('layouts.sidebar_paciente')

            <div class="col d-flex flex-column h-sm-100 main-content overflow-auto p-4">
                @yield('contenido')
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts') </body>
</html>
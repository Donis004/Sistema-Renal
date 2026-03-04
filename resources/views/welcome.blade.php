<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RenalMe - Tu compañero de salud renal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-green: #2ecc71;
            --dark-green: #27ae60;
            --light-green: #e8f8f5;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
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
        .hero-section {
            background: linear-gradient(135deg, var(--light-green) 0%, #ffffff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 text-primary-custom" href="/">
                <i class="bi bi-heart-pulse text-danger"></i> RenalMe
            </a>
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-success me-2 fw-semibold border-2">Ingresar</a>
            </div>
        </div>
    </nav>

    <section class="hero-section mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="badge bg-primary-custom mb-3 fs-6 px-3 py-2">Innovación en Salud</span>
                    <h1 class="display-4 fw-bold mb-4" style="color: #2c3e50;">
                        Toma el control de tu <span class="text-primary-custom">salud renal</span> hoy mismo.
                    </h1>
                    <p class="lead text-muted mb-5">
                        Monitorea tu dieta, controla tus líquidos y recibe análisis en tiempo real de tus comidas usando Inteligencia Artificial. Diseñado especialmente para pacientes con Enfermedad Renal Crónica.
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg shadow-sm">
                        Comenzar mi tratamiento <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="p-5 bg-white rounded-4 shadow-lg border border-success border-opacity-10">
                        <i class="bi bi-shield-check text-primary-custom" style="font-size: 8rem;"></i>
                        <h3 class="mt-4 fw-bold">Seguridad y Precisión</h3>
                        <p class="text-muted">Tus límites nutricionales calculados automáticamente.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
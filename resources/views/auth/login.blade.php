<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - RenalMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4fdf8; /* Fondo verde muy tenue */
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card-login {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(46, 204, 113, 0.15);
        }
        .btn-success-custom {
            background-color: #27ae60;
            border-color: #27ae60;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
        }
        .btn-success-custom:hover {
            background-color: #219a52;
            border-color: #219a52;
        }
        .form-control:focus {
            border-color: #2ecc71;
            box-shadow: 0 0 0 0.25rem rgba(46, 204, 113, 0.25);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="text-center mb-4">
                    <a href="/" class="text-decoration-none display-5 fw-bold" style="color: #27ae60;">
                        <i class="bi bi-heart-pulse text-danger"></i> RenalMe
                    </a>
                </div>
                
                <div class="card card-login p-4">
                    <div class="card-body">
                        <h4 class="card-title text-center fw-bold mb-4" style="color: #2c3e50;">Bienvenido de nuevo</h4>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="email" class="form-label text-muted fw-semibold">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="tu@correo.com">
                                </div>
                                @error('email')
                                    <span class="text-danger small mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label text-muted fw-semibold">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-success"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" required placeholder="••••••••">
                                </div>
                                @error('password')
                                    <span class="text-danger small mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success-custom btn-lg text-white">
                                    Ingresar al sistema
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
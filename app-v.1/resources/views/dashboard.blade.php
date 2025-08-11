<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Smart Community</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .dashboard-container {
            padding: 40px 0;
        }
        
        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            backdrop-filter: blur(10px);
        }
        
        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 40px;
        }
        
        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            color: white;
        }
        
        .stats-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-icon {
            font-size: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="container">
            <!-- Mensajes de éxito -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="welcome-card">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        
                        <h1 class="mb-3">¡Bienvenido, {{ $user->user }}!</h1>
                        <p class="text-muted mb-4">Has iniciado sesión correctamente en Smart Community</p>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="stats-card">
                                    <div class="stats-icon text-primary">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h6>Usuario</h6>
                                    <p class="text-muted small">{{ $user->user }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card">
                                    <div class="stats-icon text-success">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h6>Rol</h6>
                                    <p class="text-muted small">{{ ucfirst($user->role) }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-card">
                                    <div class="stats-icon text-info">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h6>Último acceso</h6>
                                    <p class="text-muted small">{{ now()->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-3">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-logout">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Información adicional -->
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="welcome-card">
                        <h4 class="mb-3">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            Información del Sistema
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>ID de Usuario:</strong> {{ $user->id }}</p>
                                <p><strong>Estado:</strong> 
                                    @if($user->status == 'A')
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-warning">Inactivo</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Sesión iniciada:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
                                <p><strong>Rol del usuario:</strong> {{ ucfirst($user->role) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Auto-ocultar alertas -->
    <script>
        // Auto-ocultar las alertas después de 5 segundos
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>
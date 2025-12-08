<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Dashboard - BéninCulture')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --info-color: #17a2b8;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            min-height: 100vh;
            box-shadow: 3px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .sidebar-menu .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu .nav-link:hover,
        .sidebar-menu .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-left-color: var(--warning-color);
        }
        
        .sidebar-menu .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        
        .stat-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        
        .content-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }
        
        .content-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .badge-status {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }
        
        .quick-action {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }
        
        .quick-action:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-color: var(--primary-color);
        }
        
        .quick-action-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            display: inline-block;
        }
        
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .activity-item {
            border-left: 3px solid var(--primary-color);
            padding-left: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .activity-item.success { border-left-color: var(--success-color); }
        .activity-item.warning { border-left-color: var(--warning-color); }
        .activity-item.danger { border-left-color: var(--danger-color); }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation principale -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('user') }}">
                <i class="bi bi-house-door me-2"></i>BéninCulture
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contenus.index') }}">
                            <i class="bi bi-file-text me-1"></i>Mes Contenus
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            @if(Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" 
                                 class="user-avatar rounded-circle me-2" 
                                 alt="{{ Auth::user()->prenom }}">
                            @else
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                 style="width: 30px; height: 30px;">
                                <i class="bi bi-person"></i>
                            </div>
                            @endif
                            {{ Auth::user()->prenom }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-circle me-2"></i>Mon Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('user') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 col-xl-2 d-none d-lg-block sidebar">
                <div class="sidebar-brand">
                    <h5 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>
                        {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                    </h5>
                    <small class="text-muted">Membre depuis {{ \Carbon\Carbon::parse(Auth::user()->date_inscription)->format('d/m/Y') }}</small>
                </div>
                
                <nav class="sidebar-menu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" 
                               href="{{ route('user') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contenus.*') ? 'active' : '' }}" 
                               href="{{ route('contenus.index') }}">
                                <i class="bi bi-file-text"></i> Mes Contenus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-chat-left-text"></i> Mes Commentaires
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person"></i> Mon Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}" target="_blank">
                                <i class="bi bi-globe"></i> Visiter le site
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <!-- Statut -->
                <div class="p-3 mt-4 border-top border-secondary">
                    <small class="text-muted">STATUT</small>
                    <div class="d-flex align-items-center mt-2">
                        <div class="bg-success rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                        <small>Actif</small>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <main class="col-lg-9 col-xl-10 px-4 py-3">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light border-top py-3 mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">
                        &copy; {{ date('Y') }} BéninCulture. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        <i class="bi bi-shield-check me-1"></i>
                        Plateforme sécurisée
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Auto-dismiss alerts
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Active sidebar items
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('.sidebar-menu .nav-link');
            
            sidebarLinks.forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
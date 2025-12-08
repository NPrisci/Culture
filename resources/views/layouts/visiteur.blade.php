<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Bénin Culture</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1518837695005-2083093ee35b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
        }
        
        .badge-custom {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        footer {
            background-color: #343a40;
            color: white;
            margin-top: 50px;
        }
        
        .language-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .region-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        
        .content-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('accue') }}">
                <i class="bi bi-globe-europe-africa"></i> Bénin Culture
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('accueil') ? 'active' : '' }}" href="{{ route('accue') }}">
                            <i class="bi bi-house"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('langues.index.public') ? 'active' : '' }}" href="{{ route('langues.index.public') }}">
                            <i class="bi bi-translate"></i> Langues
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('regions.index.public') ? 'active' : '' }}" href="{{ route('regions.index.public') }}">
                            <i class="bi bi-geo-alt"></i> Régions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contenus.index.public') ? 'active' : '' }}" href="{{ route('contenus.index.public') }}">
                            <i class="bi bi-file-text"></i> Contenus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-info-circle"></i> À propos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-envelope"></i> Contact
                        </a>
                    </li>
                     <div class="user-profile-menu ms-3">
    <div class="dropdown">

        <button class="btn btn-link p-0 border-0 d-flex align-items-center" 
                type="button" 
                data-bs-toggle="dropdown" 
                aria-expanded="false"
                style="height:40px;">

            <i class="bi bi-person-circle fs-3"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-end">

            @auth
            <li class="px-3 py-2">
                <div class="d-flex gap-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-warning">Déconnexion</button>
                    </form>

                    <a href="{{ route('profile.edit') }}" class="btn btn-danger">Edit</a>
                </div>
            </li>
            @else
            <li class="px-3 py-2 d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-outline-success">Connexion</a>
                <a href="{{ route('register') }}" class="btn btn-benin">S’inscrire</a>
            </li>
            @endauth

        </ul>
    </div>
</div>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 mb-4">@yield('hero-title', 'Découvrez la richesse culturelle du Bénin')</h1>
            <p class="lead mb-4">@yield('hero-subtitle', 'Explorez les langues, régions et traditions du Bénin')</p>
            @hasSection('hero-search')
                @yield('hero-search')
            @else
                <form action="{{ route('contenus.index.public') }}" class="row g-3 justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" 
                                   placeholder="Rechercher un contenu, une langue, une région..." 
                                   name="search">
                            <button class="btn btn-primary btn-lg" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Bénin Culture</h5>
                    <p>Plateforme numérique pour la promotion de la culture et des langues du Bénin.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('langues.index.public') }}" class="text-white text-decoration-none">Langues du Bénin</a></li>
                        <li><a href="{{ route('regions.index.public') }}" class="text-white text-decoration-none">Régions du Bénin</a></li>
                        <li><a href="{{ route('contenus.index.public') }}" class="text-white text-decoration-none">Contenus culturels</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Galerie média</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p>
                        <i class="bi bi-geo-alt"></i> Cotonou, Bénin<br>
                        <i class="bi bi-envelope"></i> contact@beninculture.bj<br>
                        <i class="bi bi-telephone"></i> +229 XX XX XX XX
                    </p>
                </div>
            </div>
            <hr class="text-white">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Bénin Culture. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>
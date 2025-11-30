<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'Culture Bénin')</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- Main CSS -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    @stack('styles')

    <style>
        /* ======= STYLES POUR LE MENU UTILISATEUR ======= */

.user-profile-menu {
    position: relative;
}

.user-menu-btn {
    background: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 50%;
    padding: 8px;
}

.user-menu-btn:hover {
    background: rgba(0, 135, 81, 0.1);
}

.user-avatar-sm {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), #00a86b);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.user-menu-btn:hover .user-avatar-sm {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 135, 81, 0.3);
}

/* Menu déroulant */
.user-profile-menu .dropdown-menu {
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    border-radius: 12px;
    padding: 0.5rem;
    min-width: 220px;
    margin-top: 10px;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.dropdown-header {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-dark);
    padding: 0.75rem 1rem;
    border-bottom: 1px solid var(--border-color);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    color: var(--text-dark);
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.dropdown-item:hover {
    background: var(--primary-color);
    color: white;
    transform: translateX(5px);
}

.dropdown-item i {
    width: 18px;
    text-align: center;
    font-size: 1.1rem;
}

.dropdown-divider {
    margin: 0.5rem 0;
    border-color: var(--border-color);
}

/* Badge pour l'utilisateur connecté */
.user-badge {
    background: var(--secondary-color);
    color: var(--text-dark);
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: auto;
}

/* Avatar avec photo */
.user-avatar-with-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid var(--primary-color);
}

.user-avatar-with-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Animation du menu */
.dropdown-menu.show {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .user-profile-menu {
        margin-left: auto;
        margin-right: 1rem;
    }
    
    .user-avatar-sm {
        width: 36px;
        height: 36px;
        font-size: 1.3rem;
    }
}
    </style>
</head>

<body class="index-page">

    {{-- HEADER --}}
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">Culture Bénin</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}">Accueil</a></li>

<li><a href="{{ route('a-propos') }}">About</a></li>

<li><a href="{{ route('patrimoine') }}">Patrimoine</a></li>

<li><a href="{{ route('galerie') }}">Galerie</a></li>

<li><a href="{{ route('communaute') }}">Communaute</a></li>

<li><a href="{{ route('contact') }}">Contact</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <div class="user-profile-menu ms-3">
                <div class="dropdown">
                    <button class="user-menu-btn btn btn-link p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar-sm">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" id="userDropdownMenu">
                        <!-- Le contenu du menu sera généré dynamiquement par JavaScript -->
                        <div class="d-flex gap-2">
            @auth
    <div class="d-flex gap-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-warning">Déconnexion</button>
        </form>

        <a href="{{ route('profile.edit') }}" class="btn btn-danger">Edit</a>
    </div>
@else
    <a href="{{ route('login') }}" class="btn btn-outline-success me-2">Connexion</a>
    <a href="{{ route('register') }}" class="btn btn-benin">S’inscrire</a>
@endauth

        </div>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="main">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-5">

        <div class="col-lg-4">
          <div class="footer-brand">
            <a href="index.html" class="logo d-flex align-items-center mb-3">
              <span class="sitename">Culture Bénin</span>
            </a>
            <p class="tagline">Préserver et partager la richesse du patrimoine culturel béninois avec le monde.</p>

            <div class="social-links mt-4">
              <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
              <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
              <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="footer-links-grid">
            <div class="row">
              <div class="col-6 col-md-4">
                <h5>Culture Bénin</h5>
                <ul class="list-unstyled">
                  <li><a href="#">À propos</a></li>
                  <li><a href="#">Notre mission</a></li>
                  <li><a href="#">Événements</a></li>
                  <li><a href="#">Actualités</a></li>
                </ul>
              </div>
              <div class="col-6 col-md-4">
                <h5>Patrimoine</h5>
                <ul class="list-unstyled">
                  <li><a href="#">Sites UNESCO</a></li>
                  <li><a href="#">Traditions Vodoun</a></li>
                  <li><a href="#">Artisanat</a></li>
                  <li><a href="#">Musique & Danse</a></li>
                </ul>
              </div>
              <div class="col-6 col-md-4">
                <h5>Support</h5>
                <ul class="list-unstyled">
                  <li><a href="#">Centre d'aide</a></li>
                  <li><a href="#">Nous contacter</a></li>
                  <li><a href="#">Politique de confidentialité</a></li>
                  <li><a href="#">Conditions d'utilisation</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="footer-cta">
            <h5>Restons connectés</h5>
            <a href="contact.html" class="btn btn-outline">Contactez-nous</a>
          </div>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="footer-bottom-content">
              <p class="mb-0">© <span class="sitename">Culture Bénin</span>. Tous droits réservés.</p>
              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Conçu par <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
    {{-- <script>
        // Gestion du menu utilisateur
class UserMenu {
    constructor() {
        this.init();
    }

    init() {
        this.updateMenu();
        this.setupEventListeners();
    }

    // Vérifier si l'utilisateur est connecté
    isLoggedIn() {
        return localStorage.getItem('isLoggedIn') === 'true';
    }

    // Obtenir les informations de l'utilisateur
    getUserInfo() {
        const userData = localStorage.getItem('currentUser');
        return userData ? JSON.parse(userData) : null;
    }

    // Mettre à jour le menu en fonction du statut de connexion
    updateMenu() {
        const menu = document.getElementById('userDropdownMenu');
        if (!menu) return;

        if (this.isLoggedIn()) {
            this.renderLoggedInMenu(menu);
        } else {
            this.renderLoggedOutMenu(menu);
        }
    }

    // Menu pour utilisateur connecté
    renderLoggedInMenu(menu) {
        const user = this.getUserInfo();
        
        menu.innerHTML = `
            

            <li>
    <div class="dropdown-header">
        <div class="d-flex align-items-center">
            <div class="user-avatar-with-img me-2">
                <img src="{{ $user->avatar ?? asset('assets/img/users/default-avatar.webp') }}" 
                     alt="{{ $user->name ?? 'Utilisateur' }}">
            </div>
            <div>
                <div class="fw-bold">{{ $user->name ?? 'Utilisateur' }}</div>
                <small class="text-muted">{{ $user->email ?? '' }}</small>
            </div>
        </div>
    </div>
</li>
<li><hr class="dropdown-divider"></li>
<li>
    <a class="dropdown-item" href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2"></i>
        <span>Mon Dashboard</span>
    </a>
</li>
<li>
    <a class="dropdown-item" href="{{ route('profile.edit') }}">
        <i class="bi bi-person"></i>
        <span>Modifier mon profil</span>
    </a>
</li>

<li><hr class="dropdown-divider"></li>
<li>
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="register-btn">Déconnexion</button>
                </form>
</li>
        `;

        this.attachLoggedInEvents();
    }

    // Menu pour utilisateur non connecté
    renderLoggedOutMenu(menu) {
        menu.innerHTML = `
           <li>
    <div class="dropdown-header">
        <i class="bi bi-person me-2"></i>
        Mon compte
    </div>
</li>
<li><hr class="dropdown-divider"></li>
<li>
    <a class="dropdown-item" href="{{ route('login') }}">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Connexion</span>
    </a>
</li>
<li>
    <a class="dropdown-item" href="{{ route('register') }}">
        <i class="bi bi-person-plus"></i>
        <span>S'inscrire</span>
        <span class="user-badge">Nouveau</span>
    </a>
</li>
<li><hr class="dropdown-divider"></li>
<li>
   
</li>
        `;
    }

    // Attacher les événements pour utilisateur connecté
    attachLoggedInEvents() {
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.logout();
            });
        }
    }

    // Configuration des écouteurs d'événements
    setupEventListeners() {
        // Mettre à jour le menu quand le statut de connexion change
        window.addEventListener('storage', () => {
            this.updateMenu();
        });

        // Mettre à jour le menu quand la page est chargée
        document.addEventListener('DOMContentLoaded', () => {
            this.updateMenu();
        });
    }

    // Déconnexion
    logout() {
        if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
            localStorage.removeItem('currentUser');
            localStorage.removeItem('isLoggedIn');
            
            // Mettre à jour le menu immédiatement
            this.updateMenu();
            
            // Rediriger vers la page d'accueil
            window.location.href = 'index.html';
        }
    }
}

// Initialiser le menu utilisateur au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    new UserMenu();
});

// Fonction utilitaire pour forcer la mise à jour du menu
function updateUserMenu() {
    const userMenu = new UserMenu();
    userMenu.updateMenu();
}
    </script> --}}
</body>
</html>

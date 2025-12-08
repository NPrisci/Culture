<!doctype html>
<html lang="fr">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'BéninCulture | Dashboard Modérateur')</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="author" content="BéninCulture" />
    <meta name="description" content="Plateforme de gestion des contenus culturels du Bénin" />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- ChartJS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.css"
      crossorigin="anonymous"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Styles personnalisés -->
    <style>
      :root {
        --primary-color: #007bff;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --info-color: #17a2b8;
      }
      
      .card-custom {
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
      }
      
      .card-custom:hover {
        transform: translateY(-5px);
      }
      
      .stat-card .icon {
        font-size: 2.5rem;
        opacity: 0.8;
      }
      
      .badge-moderation {
        background-color: var(--warning-color);
        color: #212529;
      }
      
      .activity-feed {
        max-height: 400px;
        overflow-y: auto;
      }
      
      .activity-item {
        border-left: 3px solid var(--primary-color);
        padding-left: 15px;
        margin-bottom: 15px;
      }
      
      .activity-item.success { border-left-color: var(--success-color); }
      .activity-item.warning { border-left-color: var(--warning-color); }
      .activity-item.danger { border-left-color: var(--danger-color); }
      .activity-item.info { border-left-color: var(--info-color); }
      
      .quick-action-btn {
        padding: 20px 10px;
        text-align: center;
        transition: all 0.3s;
      }
      
      .quick-action-btn:hover {
        background-color: #f8f9fa;
        transform: scale(1.05);
      }
      
      .quick-action-btn i {
        font-size: 2.5rem;
        margin-bottom: 10px;
      }
      
      .content-status {
        font-size: 0.8rem;
        padding: 3px 8px;
        border-radius: 15px;
      }
      
      .status-valid { background-color: #d4edda; color: #155724; }
      .status-pending { background-color: #fff3cd; color: #856404; }
      .status-rejected { background-color: #f8d7da; color: #721c24; }
    </style>
    @stack('styles')
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <!-- Logo et bascule sidebar -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="{{ route('moderateur') }}" class="nav-link fw-bold">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
              </a>
            </li>
          </ul>

          <!-- Barre de recherche -->
          <div class="navbar-search-block me-auto" style="max-width: 300px;">
            <form class="form-inline">
              <div class="input-group">
                <input type="search" class="form-control" placeholder="Rechercher..." aria-label="Search">
                <button class="btn btn-outline-secondary" type="button">
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </form>
          </div>

          <!-- Menu utilisateur -->
          <ul class="navbar-nav ms-auto">
            <!-- Notifications -->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                @if(isset($stats['contenus_a_moderer']) && $stats['contenus_a_moderer'] > 0)
                <span class="navbar-badge badge bg-danger">{{ $stats['contenus_a_moderer'] }}</span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-header">
                  @if(isset($stats['contenus_a_moderer']) && $stats['contenus_a_moderer'] > 0)
                  {{ $stats['contenus_a_moderer'] }} contenus à modérer
                  @else
                  Aucune notification
                  @endif
                </span>
                <div class="dropdown-divider"></div>
                <a href="{{ route('contenus.index') }}?statut=en+attente" class="dropdown-item">
                  <i class="bi bi-clipboard-check me-2"></i> Voir les contenus à modérer
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Voir toutes les notifications</a>
              </div>
            </li>

            <!-- Profil utilisateur -->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                @if(Auth::user()->photo)
                <img src="{{ asset('storage/' . Auth::user()->photo) }}" 
                     class="user-image rounded-circle shadow me-2" 
                     alt="Photo profil"
                     style="width: 32px; height: 32px;">
                @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                     style="width: 32px; height: 32px;">
                  <i class="bi bi-person-fill"></i>
                </div>
                @endif
                <span class="d-none d-md-inline">
                  {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                </span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <li class="user-header text-bg-primary">
                  @if(Auth::user()->photo)
                  <img src="{{ asset('storage/' . Auth::user()->photo) }}" 
                       class="rounded-circle shadow" 
                       alt="Photo profil">
                  @else
                  <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center mx-auto mb-2"
                       style="width: 80px; height: 80px;">
                    <i class="bi bi-person-fill fs-1"></i>
                  </div>
                  @endif
                  <p class="mt-2">
                    {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                    <small>
                      Modérateur depuis {{ \Carbon\Carbon::parse(Auth::user()->date_inscription)->format('d/m/Y') }}
                    </small>
                  </p>
                </li>
                <li class="user-body">
                  <div class="row">
                    <div class="col-6 text-center">
                      <a href="{{ route('contenus.index') }}">Mes contenus</a>
                    </div>
                    <div class="col-6 text-center">
                      <a href="">Mon profil</a>
                    </div>
                  </div>
                </li>
                <li class="user-footer">
                  <a href="" class="btn btn-default btn-flat">
                    <i class="bi bi-gear me-1"></i> Profil
                  </a>
                  <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-default btn-flat float-end">
                      <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                    </button>
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!--end::Header-->

      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <a href="{{ route('moderateur') }}" class="brand-link">
            <img src="{{ asset('admin/assets/img/AdminLTELogo.png') }}" 
                 alt="Logo BéninCulture" 
                 class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">BéninCulture</span>
          </a>
        </div>
        <!--end::Sidebar Brand-->

        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview">
              <!-- Dashboard -->
              <li class="nav-item">
                <a href="{{ route('moderateur') }}" class="nav-link @if(Route::currentRouteName() == 'moderateur.dashboard') active @endif">
                  <i class="nav-icon bi bi-speedometer2"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <!-- Gestion des contenus -->
              <li class="nav-item">
                <a href="#" class="nav-link @if(in_array(Route::currentRouteName(), ['contenus.index', 'contenus.create', 'contenus.edit'])) active @endif">
                  <i class="nav-icon bi bi-file-text"></i>
                  <p>
                    Contenus
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('contenus.index') }}" class="nav-link @if(Route::currentRouteName() == 'contenus.index') active @endif">
                      <i class="nav-icon bi bi-list"></i>
                      <p>Tous les contenus</p>
                      @if(isset($stats['contenus_a_moderer']) && $stats['contenus_a_moderer'] > 0)
                      <span class="badge bg-danger float-end">{{ $stats['contenus_a_moderer'] }}</span>
                      @endif
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('contenus.index') }}?statut=validé" class="nav-link">
                      <i class="nav-icon bi bi-check-circle"></i>
                      <p>Contenus validés</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('contenus.index') }}?statut=en+attente" class="nav-link">
                      <i class="nav-icon bi bi-clock"></i>
                      <p>En attente</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('contenus.create') }}" class="nav-link">
                      <i class="nav-icon bi bi-plus-circle"></i>
                      <p>Créer un contenu</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Gestion des utilisateurs -->
              <li class="nav-item">
                <a href="{{ route('user') }}" class="nav-link @if(Route::currentRouteName() == 'users.index') active @endif">
                  <i class="nav-icon bi bi-people"></i>
                  <p>Utilisateurs</p>
                </a>
              </li>

              <!-- Gestion des commentaires -->
              <li class="nav-item">
                <a href="{{ route('commentaires.index') }}" class="nav-link @if(Route::currentRouteName() == 'commentaires.index') active @endif">
                  <i class="nav-icon bi bi-chat-left-text"></i>
                  <p>Commentaires</p>
                </a>
              </li>

              <!-- Catégories -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tags"></i>
                  <p>
                    Catégories
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('regions.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-geo-alt"></i>
                      <p>Régions</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('langues.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-translate"></i>
                      <p>Langues</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('typecontenus.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-card-text"></i>
                      <p>Types de contenu</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Médias -->
              <li class="nav-item">
                <a href="{{ route('medias.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-images"></i>
                  <p>Médias</p>
                </a>
              </li>

              <!-- Mon profil -->
              <li class="nav-item">
                <a href="" class="nav-link @if(Route::currentRouteName() == 'moderateur.profile') active @endif">
                  <i class="nav-icon bi bi-person"></i>
                  <p>Mon Profil</p>
                </a>
              </li>

              <!-- Paramètres -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-gear"></i>
                  <p>Paramètres</p>
                </a>
              </li>

              <!-- Retour au site -->
              <li class="nav-item mt-4">
                <a href="{{ url('/') }}" class="nav-link text-primary" target="_blank">
                  <i class="nav-icon bi bi-house"></i>
                  <p>Retour au site</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h1 class="m-0">@yield('page-title', 'Dashboard Modérateur')</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('moderateur') }}">Dashboard</a></li>
                  @yield('breadcrumb')
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
          <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle-fill me-2"></i>
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Contenu principal -->
            @yield('content')
          </div>
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

      <!--begin::Footer-->
      <footer class="app-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <strong>Copyright &copy; {{ date('Y') }} 
                <a href="{{ url('/') }}" class="text-decoration-none">BéninCulture</a>.
              </strong>
              Tous droits réservés.
            </div>
            <div class="col-md-6 text-end">
              <span class="text-muted">
                <i class="bi bi-clock-history me-1"></i>
                Dernière connexion : {{ Auth::user()->updated_at->diffForHumans() }}
              </span>
            </div>
          </div>
        </div>
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    <!-- OverlayScrollbars -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AdminLTE -->
    <script src="{{ asset('admin/js/adminlte.js') }}"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <!-- Scripts personnalisés -->
    <script>
      // Initialisation des tooltips
      document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
      });

      // Configuration OverlayScrollbars pour la sidebar
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: 'os-theme-light',
              autoHide: 'leave',
              clickScroll: true,
            },
          });
        }
      });

      // Auto-dismiss des alertes après 5 secondes
      setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
          var bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        });
      }, 5000);
    </script>

    @stack('scripts')
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>

@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tableau de Bord</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalUsers ?? 0 }}</h3>
                        <p>Total Utilisateurs</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <a href="{{ route('utilisateurs.index') }}" class="small-box-footer">
                        Plus d'info <i class="bi bi-arrow-right-circle ms-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $activeContents ?? 0 }}</h3>
                        <p>Contenus Actifs</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <a href="{{ route('contenus.index') }}" class="small-box-footer">
                        Plus d'info <i class="bi bi-arrow-right-circle ms-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $pendingModeration ?? 0 }}</h3>
                        <p>À Modérer</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <a href="{{ route('contenus.index') }}?statut=en+attente" class="small-box-footer">
                        Modérer <i class="bi bi-arrow-right-circle ms-1"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalComments ?? 0 }}</h3>
                        <p>Commentaires</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <a href="{{ route('commentaires.index') }}" class="small-box-footer">
                        Plus d'info <i class="bi bi-arrow-right-circle ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts) -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-bar-chart me-1"></i>
                            Évolution des Contenus
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#revenue-chart" data-bs-toggle="tab">Mensuel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sales-chart" data-bs-toggle="tab">Hebdomadaire</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-list-check me-1"></i>
                            Tâches à Faire
                        </h3>
                        <div class="card-tools">
                            <ul class="p-0 m-0">
                                <li class="d-inline me-2">
                                    <small>5 tâches restantes</small>
                                </li>
                                <li class="d-inline">
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="bi bi-plus"></i> Ajouter
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="todo-list" data-widget="todo-list">
                            <li>
                                <!-- drag handle -->
                                <span class="handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </span>
                                <!-- checkbox -->
                                <div class="icheck-primary d-inline ms-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div>
                                <!-- todo text -->
                                <span class="text">Modérer les nouveaux contenus</span>
                                <!-- Emphasis label -->
                                <small class="badge bg-danger">
                                    <i class="bi bi-clock"></i> 2 mins
                                </small>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <i class="bi bi-pencil-square"></i>
                                    <i class="bi bi-trash"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </span>
                                <div class="icheck-primary d-inline ms-2">
                                    <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                                    <label for="todoCheck2"></label>
                                </div>
                                <span class="text">Rapport mensuel d'activité</span>
                                <small class="badge bg-info">
                                    <i class="bi bi-clock"></i> 4 heures
                                </small>
                                <div class="tools">
                                    <i class="bi bi-pencil-square"></i>
                                    <i class="bi bi-trash"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </span>
                                <div class="icheck-primary d-inline ms-2">
                                    <input type="checkbox" value="" name="todo3" id="todoCheck3">
                                    <label for="todoCheck3"></label>
                                </div>
                                <span class="text">Vérifier les commentaires signalés</span>
                                <small class="badge bg-warning">
                                    <i class="bi bi-clock"></i> 1 jour
                                </small>
                                <div class="tools">
                                    <i class="bi bi-pencil-square"></i>
                                    <i class="bi bi-trash"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </span>
                                <div class="icheck-primary d-inline ms-2">
                                    <input type="checkbox" value="" name="todo4" id="todoCheck4">
                                    <label for="todoCheck4"></label>
                                </div>
                                <span class="text">Mettre à jour les catégories</span>
                                <small class="badge bg-success">
                                    <i class="bi bi-clock"></i> 3 jours
                                </small>
                                <div class="tools">
                                    <i class="bi bi-pencil-square"></i>
                                    <i class="bi bi-trash"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </span>
                                <div class="icheck-primary d-inline ms-2">
                                    <input type="checkbox" value="" name="todo5" id="todoCheck5">
                                    <label for="todoCheck5"></label>
                                </div>
                                <span class="text">Contrôler les utilisateurs inactifs</span>
                                <small class="badge bg-primary">
                                    <i class="bi bi-clock"></i> 1 semaine
                                </small>
                                <div class="tools">
                                    <i class="bi bi-pencil-square"></i>
                                    <i class="bi bi-trash"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <button type="button" class="btn btn-primary float-end">
                            <i class="bi bi-plus"></i> Ajouter une tâche
                        </button>
                    </div>
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->

            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
                <!-- Map card -->
                <div class="card bg-gradient-primary">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="bi bi-map me-1"></i>
                            Visiteurs
                        </h3>
                        <!-- card tools -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                <i class="bi bi-calendar"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse">
                                <i class="bi bi-dash"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 250px; width: 100%;"></div>
                    </div>
                    <!-- /.card-body-->
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visiteurs</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">En ligne</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Vues</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card -->

                <!-- Calendar -->
                <div class="card bg-gradient-success">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="bi bi-calendar me-1"></i>
                            Calendrier
                        </h3>
                        <!-- card tools -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="bi bi-dash"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Derniers Utilisateurs -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-people me-1"></i>
                            Derniers Utilisateurs
                        </h3>
                        <div class="card-tools">
                            <span class="badge bg-danger">{{ $recentUsers->count() ?? 0 }} Nouveaux</span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @foreach($recentUsers->take(8) ?? [] as $user)
                            <li>
                                @if($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="User Image">
                                @else
                                <div class="user-avatar bg-primary text-white d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person"></i>
                                </div>
                                @endif
                                <a class="users-list-name" href="#">{{ $user->prenom }} {{ $user->nom }}</a>
                                <span class="users-list-date">{{ \Carbon\Carbon::parse($user->date_inscription)->diffForHumans() }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="{{ route('utilisateurs.index') }}">Voir tous les utilisateurs</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->

                <!-- ACTIVITIES -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-clock-history me-1"></i>
                            Activités Récentes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="bi bi-dash"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            @foreach($recentActivities ?? [] as $activity)
                            <li class="item">
                                <div class="product-img">
                                    @if($activity['type'] == 'user')
                                    <img src="{{ URL::asset('admin/assets/img/user1-128x128.jpg') }}" alt="Product Image" class="img-size-50">
                                    @elseif($activity['type'] == 'content')
                                    <img src="{{ URL::asset('admin/assets/img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                                    @else
                                    <img src="{{ URL::asset('admin/assets/img/default-150x150.png') }}" alt="Product Image" class="img-size-50">
                                    @endif
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">
                                        {{ $activity['title'] }}
                                        <span class="badge {{ $activity['badge_color'] }} float-end">{{ $activity['badge_text'] }}</span>
                                    </a>
                                    <span class="product-description">
                                        {{ $activity['description'] }}
                                    </span>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i> {{ $activity['time'] }}
                                    </small>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="javascript:void(0)" class="uppercase">Voir toutes les activités</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Quick Stats -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Statistiques Rapides</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="bi bi-dash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info">
                                        <i class="bi bi-translate"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Langues</span>
                                        <span class="info-box-number">{{ $totalLangues ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Régions</span>
                                        <span class="info-box-number">{{ $totalRegions ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning">
                                        <i class="bi bi-collection"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Médias</span>
                                        <span class="info-box-number">{{ $totalMedias ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger">
                                        <i class="bi bi-card-text"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Catégories</span>
                                        <span class="info-box-number">{{ $totalCategories ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Styles spécifiques pour le dashboard AdminLTE */
    
    /* Amélioration des cartes statistiques */
    .small-box {
        border-radius: 10px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .small-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .small-box .icon {
        transition: transform 0.3s;
    }
    
    .small-box:hover .icon {
        transform: scale(1.1);
    }
    
    /* Style pour la liste des utilisateurs */
    .users-list > li {
        width: 25%;
        float: left;
        padding: 10px;
        text-align: center;
    }
    
    .users-list img, .user-avatar {
        border-radius: 50%;
        width: 64px;
        height: 64px;
        object-fit: cover;
    }
    
    .user-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    /* Style pour les activités */
    .products-list .product-img img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
    
    /* Style pour le calendrier */
    .fc {
        background: white;
        border-radius: 5px;
        padding: 10px;
    }
    
    /* Animation pour les cartes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .card {
        animation: fadeInUp 0.5s ease-out;
    }
    
    /* Style pour les badges */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    /* Style pour la liste des tâches */
    .todo-list > li {
        border-radius: 5px;
        padding: 10px;
        background: #f8f9fa;
        margin-bottom: 5px;
        border-left: 3px solid #007bff;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .users-list > li {
            width: 50%;
        }
        
        .small-box h3 {
            font-size: 1.5rem;
        }
    }
    
    /* Couleurs personnalisées */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
    }
    
    /* Amélioration des onglets */
    .nav-pills .nav-link.active {
        background-color: #007bff;
        box-shadow: 0 2px 5px rgba(0, 123, 255, 0.3);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique des revenus
    const revenueCtx = document.getElementById('revenue-chart-canvas').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Contenus créés',
                data: [65, 78, 66, 84, 105, 120, 140, 130, 145, 160, 180, 200],
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }, {
                label: 'Contenus validés',
                data: [45, 60, 50, 70, 85, 95, 110, 105, 120, 135, 150, 170],
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28, 200, 138, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Graphique des ventes
    const salesCtx = document.getElementById('sales-chart-canvas').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            datasets: [{
                label: 'Visites',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Inscriptions',
                data: [28, 48, 40, 19, 86, 27, 90],
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Calendrier
    $('#calendar').datetimepicker({
        format: 'L',
        inline: true,
        sideBySide: true
    });

    // Animation des cartes au chargement
    $('.card').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateY(20px)',
            'transition': 'opacity 0.5s ease, transform 0.5s ease'
        });
        
        setTimeout(() => {
            $(this).css({
                'opacity': '1',
                'transform': 'translateY(0)'
            });
        }, index * 100);
    });

    // Auto-dismiss des alertes
    setTimeout(() => {
        $('.alert').alert('close');
    }, 5000);

    // Toggle des sections
    $('[data-card-widget="collapse"]').click(function() {
        $(this).find('i').toggleClass('bi-dash bi-plus');
    });

    // Gestion des tâches
    $('.todo-list').on('click', 'input[type="checkbox"]', function() {
        const listItem = $(this).closest('li');
        if ($(this).is(':checked')) {
            listItem.addClass('done');
        } else {
            listItem.removeClass('done');
        }
    });

    // Sortable pour les tâches
    $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
    });
});
</script>

<!-- FullCalendar -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.4.2/main.min.js"></script>

<script>
// Initialisation du calendrier
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'interaction' ],
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            locale: 'fr',
            events: [
                {
                    title: 'Réunion',
                    start: new Date(),
                    backgroundColor: '#007bff'
                },
                {
                    title: 'Rapport mensuel',
                    start: new Date(new Date().setDate(new Date().getDate() + 3)),
                    backgroundColor: '#28a745'
                },
                {
                    title: 'Modération',
                    start: new Date(new Date().setDate(new Date().getDate() + 7)),
                    backgroundColor: '#ffc107'
                }
            ]
        });
        calendar.render();
    }
});
</script>
@endpush

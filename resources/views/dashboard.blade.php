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
        <!-- Alertes -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

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
            <section class="col-lg-8 connectedSortable">
                <!-- Graphique d'évolution -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-bar-chart me-1"></i>
                            Évolution des Contenus ({{ date('Y') }})
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="bi bi-dash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="contentEvolutionChart" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Dernières Activités -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-clock-history me-1"></i>
                            Activités Récentes
                        </h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus"></i> Tout voir
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">Type</th>
                                        <th>Description</th>
                                        <th style="width: 150px;">Utilisateur</th>
                                        <th style="width: 120px;">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentActivities ?? [] as $activity)
                                    <tr>
                                        <td>
                                            <div class="activity-icon bg-{{ $activity['color'] ?? 'primary' }} text-white rounded-circle text-center py-1">
                                                <i class="bi bi-{{ $activity['icon'] ?? 'bell' }}"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $activity['title'] ?? 'Nouvelle activité' }}</div>
                                            <small class="text-muted">{{ $activity['description'] ?? '' }}</small>
                                        </td>
                                        <td>
                                            @if(isset($activity['user']))
                                            <div class="d-flex align-items-center">
                                                @if($activity['user']->photo)
                                                <img src="{{ asset('storage/' . $activity['user']->photo) }}" 
                                                     class="rounded-circle me-2" 
                                                     width="24" 
                                                     height="24"
                                                     alt="{{ $activity['user']->prenom }}">
                                                @else
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                     style="width: 24px; height: 24px; font-size: 12px;">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                @endif
                                                <span>{{ $activity['user']->prenom }} {{ $activity['user']->nom }}</span>
                                            </div>
                                            @else
                                            <span class="text-muted">Système</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $activity['time'] ?? 'À l\'instant' }}</small>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                            Aucune activité récente
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.Left col -->

            <!-- right col -->
            <section class="col-lg-4 connectedSortable">
                <!-- Graphique des statuts -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-pie-chart me-1"></i>
                            Statut des Contenus
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-pie">
                            <canvas id="contentStatusChart" height="200"></canvas>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="d-flex align-items-center">
                                    <i class="bi bi-circle-fill text-success me-2"></i>
                                    <span>Validés</span>
                                </span>
                                <span class="fw-bold">{{ $contentStats['validated'] ?? 0 }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="d-flex align-items-center">
                                    <i class="bi bi-circle-fill text-warning me-2"></i>
                                    <span>En attente</span>
                                </span>
                                <span class="fw-bold">{{ $contentStats['pending'] ?? 0 }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="d-flex align-items-center">
                                    <i class="bi bi-circle-fill text-danger me-2"></i>
                                    <span>Rejetés</span>
                                </span>
                                <span class="fw-bold">{{ $contentStats['rejected'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

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
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($recentUsers ?? [] as $user)
                            <div class="list-group-item">
                                <div class="d-flex align-items-center">
                                    @if($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" 
                                         class="rounded-circle me-3" 
                                         width="40" 
                                         height="40"
                                         alt="{{ $user->prenom }}">
                                    @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                         style="width: 40px; height: 40px;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <div class="fw-medium">{{ $user->prenom }} {{ $user->nom }}</div>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block">{{ \Carbon\Carbon::parse($user->date_inscription)->format('d/m/Y') }}</small>
                                        <span class="badge bg-{{ $user->statut == 'actif' ? 'success' : 'secondary' }} badge-sm">
                                            {{ $user->statut }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="list-group-item text-center py-4 text-muted">
                                Aucun utilisateur récent
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('utilisateurs.index') }}" class="text-decoration-none">
                            Voir tous les utilisateurs <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Actions Rapides -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-lightning me-1"></i>
                            Actions Rapides
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('contenus.create') }}" class="btn btn-outline-primary text-start">
                                <i class="bi bi-plus-circle me-2"></i>
                                Nouveau Contenu
                            </a>
                            <a href="{{ route('utilisateurs.create') }}" class="btn btn-outline-success text-start">
                                <i class="bi bi-person-plus me-2"></i>
                                Nouvel Utilisateur
                            </a>
                            <a href="{{ route('contenus.index') }}?statut=en+attente" class="btn btn-outline-warning text-start">
                                <i class="bi bi-clipboard-check me-2"></i>
                                Modération ({{ $pendingModeration ?? 0 }})
                            </a>
                            <a href="{{ route('parametres') }}" class="btn btn-outline-info text-start">
                                <i class="bi bi-gear me-2"></i>
                                Paramètres
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

        <!-- Statistiques détaillées -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-graph-up me-2"></i>
                            Statistiques Détaillées
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-info">
                                        <i class="bi bi-translate"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Langues</span>
                                        <span class="info-box-number">{{ $totalLangues ?? 0 }}</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" style="width: 70%"></div>
                                        </div>
                                        <span class="progress-description">
                                            5 langues actives
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-success">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Régions</span>
                                        <span class="info-box-number">{{ $totalRegions ?? 0 }}</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: 50%"></div>
                                        </div>
                                        <span class="progress-description">
                                            12 régions couvertes
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-warning">
                                        <i class="bi bi-collection"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Médias</span>
                                        <span class="info-box-number">{{ $totalMedias ?? 0 }}</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" style="width: 80%"></div>
                                        </div>
                                        <span class="progress-description">
                                            Images, vidéos, audios
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-danger">
                                        <i class="bi bi-card-text"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Types de Contenu</span>
                                        <span class="info-box-number">{{ $totalTypeContenus ?? 0 }}</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" style="width: 60%"></div>
                                        </div>
                                        <span class="progress-description">
                                            Articles, guides, etc.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('styles')
<style>
    /* Styles spécifiques au dashboard */
    
    /* Cartes statistiques */
    .small-box {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .small-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .small-box .icon {
        transition: transform 0.3s ease;
    }
    
    .small-box:hover .icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .small-box .inner h3 {
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    /* Graphiques */
    .chart-container {
        position: relative;
        height: 250px;
        width: 100%;
    }
    
    .chart-container-pie {
        position: relative;
        height: 200px;
        width: 100%;
    }
    
    /* Activités */
    .activity-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .table th {
        font-weight: 600;
        color: #495057;
        background-color: #f8f9fa;
        border-top: none;
        padding: 12px 16px;
    }
    
    .table td {
        padding: 12px 16px;
        vertical-align: middle;
        border-top: 1px solid #e9ecef;
    }
    
    /* Liste utilisateurs */
    .list-group-item {
        border-left: none;
        border-right: none;
        padding: 15px;
    }
    
    .list-group-item:first-child {
        border-top: none;
    }
    
    .list-group-item:last-child {
        border-bottom: none;
    }
    
    /* Badges */
    .badge-sm {
        font-size: 0.75em;
        padding: 0.25em 0.6em;
        font-weight: 500;
    }
    
    /* Boutons actions rapides */
    .btn-outline-primary, 
    .btn-outline-success, 
    .btn-outline-warning, 
    .btn-outline-info {
        border-width: 2px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-primary:hover { background-color: #0d6efd; }
    .btn-outline-success:hover { background-color: #198754; }
    .btn-outline-warning:hover { background-color: #ffc107; }
    .btn-outline-info:hover { background-color: #0dcaf0; }
    
    /* Info boxes */
    .info-box {
        border-radius: 8px;
        border: 1px solid #e9ecef;
        transition: transform 0.3s ease;
    }
    
    .info-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    }
    
    .info-box-icon {
        width: 70px;
        height: 70px;
        border-radius: 8px 0 0 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }
    
    .info-box-content {
        padding: 10px 15px;
    }
    
    .info-box-text {
        font-size: 0.9rem;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 500;
    }
    
    .info-box-number {
        font-size: 1.75rem;
        font-weight: 700;
        color: #343a40;
        margin: 5px 0;
    }
    
    .progress {
        height: 5px;
        background-color: #e9ecef;
        border-radius: 2px;
        margin: 8px 0;
    }
    
    .progress-bar {
        border-radius: 2px;
    }
    
    .progress-description {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .small-box, .card, .info-box {
        animation: fadeIn 0.6s ease-out;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .chart-container, .chart-container-pie {
            height: 200px;
        }
        
        .small-box .inner h3 {
            font-size: 1.8rem;
        }
        
        .info-box-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .info-box-number {
            font-size: 1.5rem;
        }
    }
    
    /* Couleurs AdminLTE améliorées */
    .bg-info { background-color: #17a2b8 !important; }
    .bg-success { background-color: #28a745 !important; }
    .bg-warning { background-color: #ffc107 !important; }
    .bg-danger { background-color: #dc3545 !important; }
    
    .text-info { color: #17a2b8 !important; }
    .text-success { color: #28a745 !important; }
    .text-warning { color: #ffc107 !important; }
    .text-danger { color: #dc3545 !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique d'évolution des contenus
    const evolutionCtx = document.getElementById('contentEvolutionChart').getContext('2d');
    new Chart(evolutionCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Contenus créés',
                data: [{{ implode(',', $monthlyStats['created'] ?? [0,0,0,0,0,0,0,0,0,0,0,0]) }}],
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }, {
                label: 'Contenus validés',
                data: [{{ implode(',', $monthlyStats['validated'] ?? [0,0,0,0,0,0,0,0,0,0,0,0]) }}],
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28, 200, 138, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#1cc88a',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
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
                        usePointStyle: true,
                        font: {
                            size: 12,
                            family: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 6,
                    titleFont: {
                        size: 13,
                        weight: 'normal'
                    },
                    bodyFont: {
                        size: 13
                    },
                    displayColors: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 11
                        },
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    // Graphique des statuts
    const statusCtx = document.getElementById('contentStatusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Validés', 'En attente', 'Rejetés'],
            datasets: [{
                data: [
                    {{ $contentStats['validated'] ?? 0 }},
                    {{ $contentStats['pending'] ?? 0 }},
                    {{ $contentStats['rejected'] ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(28, 200, 138, 0.9)',
                    'rgba(255, 193, 7, 0.9)',
                    'rgba(220, 53, 69, 0.9)'
                ],
                borderColor: [
                    'rgba(28, 200, 138, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 6,
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '65%'
        }
    });

    // Auto-dismiss des alertes
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observer les éléments pour animation
    document.querySelectorAll('.small-box, .card, .info-box').forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(element);
    });

    // Mettre à jour l'heure en temps réel
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString('fr-FR');
        }
    }
    
    setInterval(updateTime, 1000);
    updateTime();
});
</script>
@endpush

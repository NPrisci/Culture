@extends('layouts.admin')

@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-2">Tableau de Bord Administrateur</h3>
                <p class="text-white-50 mb-0">Aperçu complet de votre plateforme</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-white">Accueil</a></li>
                    <li class="breadcrumb-item active text-white">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
    <div class="container-fluid">
        <!-- Alertes et messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Cartes de Statistiques -->
        <div class="row mb-4">
            <!-- Utilisateurs -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card border-start-primary h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="stat-title text-primary mb-1">Total Utilisateurs</div>
                                <div class="stat-number">{{ $totalUsers ?? 0 }}</div>
                                <div class="stat-trend text-success">
                                    <i class="bi bi-arrow-up me-1"></i>12% ce mois-ci
                                </div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="stat-icon bg-primary">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('user') }}" class="stat-link">
                            Voir détails <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contenus Actifs -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card border-start-success h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="stat-title text-success mb-1">Contenus Actifs</div>
                                <div class="stat-number">{{ $activeContents ?? 0 }}</div>
                                <div class="stat-trend text-success">
                                    <i class="bi bi-arrow-up me-1"></i>8% cette semaine
                                </div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="stat-icon bg-success">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('contenus.index') }}" class="stat-link">
                            Voir détails <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- À Modérer -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card border-start-warning h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="stat-title text-warning mb-1">À Modérer</div>
                                <div class="stat-number">{{ $pendingModeration ?? 0 }}</div>
                                <div class="stat-trend text-warning">
                                    <i class="bi bi-clock me-1"></i>En attente
                                </div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="stat-icon bg-warning">
                                    <i class="bi bi-clipboard-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('contenus.index') }}?statut=en+attente" class="stat-link">
                            Modérer <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Commentaires -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card border-start-info h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="stat-title text-info mb-1">Commentaires</div>
                                <div class="stat-number">{{ $totalComments ?? 0 }}</div>
                                <div class="stat-trend text-success">
                                    <i class="bi bi-arrow-up me-1"></i>15% d'engagement
                                </div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="stat-icon bg-info">
                                    <i class="bi bi-chat-dots"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('commentaires.index') }}" class="stat-link">
                            Voir détails <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques et Activités -->
        <div class="row mb-4">
            <!-- Graphique Évolution -->
            <div class="col-xl-8 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-bar-chart me-2"></i>Évolution des Contenus
                        </h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-calendar3 me-1"></i>30 derniers jours
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">7 derniers jours</a></li>
                                <li><a class="dropdown-item" href="#">30 derniers jours</a></li>
                                <li><a class="dropdown-item" href="#">Cette année</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="contentChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphique Statuts -->
            <div class="col-xl-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-pie-chart me-2"></i>Statut des Contenus
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-pie">
                            <canvas id="statusChart" height="250"></canvas>
                        </div>
                        <div class="legend mt-4 text-center">
                            <span class="legend-item me-3">
                                <i class="bi bi-circle-fill text-success me-1"></i>Validés
                            </span>
                            <span class="legend-item me-3">
                                <i class="bi bi-circle-fill text-warning me-1"></i>En attente
                            </span>
                            <span class="legend-item">
                                <i class="bi bi-circle-fill text-danger me-1"></i>Rejetés
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières Activités et Utilisateurs -->
        <div class="row">
            <!-- Activités Récentes -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-clock-history me-2"></i>Activités Récentes
                        </h6>
                        <a href="#" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            @forelse($recentActivities ?? [] as $activity)
                            <div class="activity-item">
                                <div class="activity-icon bg-{{ $activity['color'] ?? 'primary' }}">
                                    <i class="bi bi-{{ $activity['icon'] ?? 'bell' }}"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="d-flex justify-content-between mb-1">
                                        <strong>{{ $activity['title'] ?? 'Nouvelle activité' }}</strong>
                                        <small class="text-muted">{{ $activity['time'] ?? 'À l\'instant' }}</small>
                                    </div>
                                    <p class="mb-0 text-muted small">{{ $activity['description'] ?? '' }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                <p>Aucune activité récente</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Derniers Utilisateurs -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-people-fill me-2"></i>Derniers Utilisateurs
                        </h6>
                        <a href="{{ route('user') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th>Email</th>
                                        <th>Inscription</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentUsers ?? [] as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($user->photo)
                                                <img src="{{ asset('storage/' . $user->photo) }}" 
                                                     class="rounded-circle me-2 user-avatar" 
                                                     alt="{{ $user->prenom }}">
                                                @else
                                                <div class="avatar-placeholder bg-primary text-white rounded-circle me-2">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                @endif
                                                <div>
                                                    <div class="fw-medium">{{ $user->prenom }} {{ $user->nom }}</div>
                                                    <small class="text-muted">{{ $user->role->nom ?? 'Utilisateur' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="small">{{ $user->email }}</td>
                                        <td class="small">{{ \Carbon\Carbon::parse($user->date_inscription)->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $user->statut == 'actif' ? 'success' : 'secondary' }}">
                                                {{ $user->statut }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Aucun utilisateur récent
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Rapides -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 fw-bold text-primary">
                            <i class="bi bi-lightning-charge me-2"></i>Actions Rapides
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="{{ route('contenus.create') }}" class="quick-action-card">
                                    <div class="quick-action-icon bg-primary">
                                        <i class="bi bi-plus-circle"></i>
                                    </div>
                                    <div class="quick-action-text">
                                        <h6>Nouveau Contenu</h6>
                                        <p class="small text-muted mb-0">Ajouter un contenu</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('utilisateurs.create') }}" class="quick-action-card">
                                    <div class="quick-action-icon bg-success">
                                        <i class="bi bi-person-plus"></i>
                                    </div>
                                    <div class="quick-action-text">
                                        <h6>Nouvel Utilisateur</h6>
                                        <p class="small text-muted mb-0">Ajouter un utilisateur</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('contenus.index') }}?statut=en+attente" class="quick-action-card">
                                    <div class="quick-action-icon bg-warning">
                                        <i class="bi bi-clipboard-check"></i>
                                    </div>
                                    <div class="quick-action-text">
                                        <h6>Modération</h6>
                                        <p class="small text-muted mb-0">{{ $pendingModeration ?? 0 }} en attente</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="" class="quick-action-card">
                                    <div class="quick-action-icon bg-info">
                                        <i class="bi bi-gear"></i>
                                    </div>
                                    <div class="quick-action-text">
                                        <h6>Paramètres</h6>
                                        <p class="small text-muted mb-0">Configurer la plateforme</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::App Content-->
@endsection

@push('styles')
<style>
    /* Variables CSS */
    :root {
        --primary: #4e73df;
        --primary-light: rgba(78, 115, 223, 0.1);
        --success: #1cc88a;
        --success-light: rgba(28, 200, 138, 0.1);
        --warning: #f6c23e;
        --warning-light: rgba(246, 194, 62, 0.1);
        --info: #36b9cc;
        --info-light: rgba(54, 185, 204, 0.1);
        --danger: #e74a3b;
        --gray-100: #f8f9fc;
        --gray-200: #eaecf4;
        --gray-300: #dddfeb;
        --gray-600: #858796;
        --gray-800: #5a5c69;
    }

    /* En-tête du dashboard */
    .app-content-header {
        background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin: -1rem -1rem 2rem -1rem;
        border-radius: 0 0 15px 15px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.2);
    }

    .app-content-header h3 {
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .app-content-header .text-white-50 {
        opacity: 0.9;
    }

    .app-content-header .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .app-content-header .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s;
    }

    .app-content-header .breadcrumb-item a:hover {
        color: white;
    }

    .app-content-header .breadcrumb-item.active {
        color: white;
        font-weight: 600;
    }

    .app-content-header .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.5);
    }

    /* Cartes de statistiques */
    .stat-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: all 0.3s ease;
        background: white;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.25);
    }

    .stat-card .card-body {
        padding: 1.5rem;
    }

    .stat-card .stat-title {
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        color: var(--gray-800);
        margin-bottom: 0.5rem;
    }

    .stat-card .stat-trend {
        font-size: 0.875rem;
        display: flex;
        align-items: center;
    }

    .stat-card .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .stat-card .card-footer {
        background: var(--gray-100);
        border-top: 1px solid var(--gray-200);
        padding: 1rem 1.5rem;
    }

    .stat-card .stat-link {
        color: var(--gray-600);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: color 0.3s;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-card .stat-link:hover {
        color: var(--primary);
    }

    /* Bordures colorées */
    .border-start-primary {
        border-left: 4px solid var(--primary) !important;
    }

    .border-start-success {
        border-left: 4px solid var(--success) !important;
    }

    .border-start-warning {
        border-left: 4px solid var(--warning) !important;
    }

    .border-start-info {
        border-left: 4px solid var(--info) !important;
    }

    /* Graphiques */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    .card-header {
        background: white;
        border-bottom: 1px solid var(--gray-200);
        padding: 1.25rem 1.5rem;
        border-radius: 10px 10px 0 0 !important;
    }

    .card-body {
        padding: 1.5rem;
    }

    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    .chart-container-pie {
        position: relative;
        height: 250px;
        width: 100%;
    }

    /* Activités */
    .activity-timeline {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .activity-timeline::-webkit-scrollbar {
        width: 6px;
    }

    .activity-timeline::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 3px;
    }

    .activity-timeline::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 3px;
    }

    .activity-item {
        display: flex;
        padding: 1rem 0;
        border-bottom: 1px solid var(--gray-200);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
        color: white;
        font-size: 1.2rem;
    }

    .activity-content {
        flex: 1;
        min-width: 0;
    }

    /* Table utilisateurs */
    .user-avatar {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }

    .avatar-placeholder {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .table th {
        font-weight: 600;
        color: var(--gray-800);
        background: var(--gray-100);
        border-bottom: 2px solid var(--gray-200);
        padding: 1rem 1.25rem;
        white-space: nowrap;
    }

    .table td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
        border-color: var(--gray-200);
    }

    .table-hover tbody tr:hover {
        background: var(--gray-100);
    }

    /* Actions rapides */
    .quick-action-card {
        display: block;
        background: var(--gray-100);
        border: 2px dashed var(--gray-300);
        border-radius: 10px;
        padding: 1.5rem;
        text-decoration: none;
        color: var(--gray-800);
        transition: all 0.3s ease;
        height: 100%;
        text-align: center;
    }

    .quick-action-card:hover {
        background: white;
        border-color: var(--primary);
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        color: var(--primary);
    }

    .quick-action-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.75rem;
    }

    .quick-action-text h6 {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .quick-action-text p {
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    /* Badges */
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
        border-radius: 6px;
    }

    .bg-success { background-color: var(--success) !important; }
    .bg-secondary { background-color: var(--gray-600) !important; }

    /* Alertes */
    .alert {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        padding: 1rem 1.5rem;
    }

    .alert-success {
        background-color: var(--success-light);
        color: var(--success);
    }

    .alert-danger {
        background-color: rgba(231, 74, 59, 0.1);
        color: var(--danger);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .app-content-header {
            padding: 1.5rem 0;
            margin: -0.75rem -0.75rem 1.5rem -0.75rem;
        }

        .app-content-header h3 {
            font-size: 1.5rem;
        }

        .stat-card .stat-number {
            font-size: 1.75rem;
        }

        .chart-container,
        .chart-container-pie {
            height: 250px;
        }

        .quick-action-card {
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .quick-action-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }
    }

    /* Animation d'entrée */
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

    .stat-card,
    .card {
        animation: fadeInUp 0.5s ease-out;
    }

    .stat-card:nth-child(2) { animation-delay: 0.1s; }
    .stat-card:nth-child(3) { animation-delay: 0.2s; }
    .stat-card:nth-child(4) { animation-delay: 0.3s; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique de l'évolution des contenus
    const contentCtx = document.getElementById('contentChart').getContext('2d');
    const contentChart = new Chart(contentCtx, {
        type: 'line',
        data: {
            labels: ['1 Oct', '8 Oct', '15 Oct', '22 Oct', '29 Oct', '5 Nov', '12 Nov'],
            datasets: [{
                label: 'Contenus créés',
                data: [65, 78, 66, 84, 105, 120, 140],
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderWidth: 2,
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.4
            }, {
                label: 'Contenus validés',
                data: [45, 60, 50, 70, 85, 95, 110],
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28, 200, 138, 0.05)',
                borderWidth: 2,
                pointBackgroundColor: '#1cc88a',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 6,
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#858796',
                        font: {
                            size: 11
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [2],
                        drawBorder: false,
                        color: '#e3e6f0'
                    },
                    ticks: {
                        color: '#858796',
                        font: {
                            size: 11
                        },
                        padding: 10
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
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Validés', 'En attente', 'Rejetés'],
            datasets: [{
                data: [70, 20, 10],
                backgroundColor: [
                    'rgba(28, 200, 138, 1)',
                    'rgba(246, 194, 62, 1)',
                    'rgba(231, 74, 59, 1)'
                ],
                borderColor: [
                    'rgba(28, 200, 138, 0.2)',
                    'rgba(246, 194, 62, 0.2)',
                    'rgba(231, 74, 59, 0.2)'
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
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.parsed + '%';
                            return label;
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Auto-dismiss des alertes après 5 secondes
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Animation des cartes au chargement
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

    // Observer les cartes pour l'animation
    document.querySelectorAll('.stat-card, .card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(card);
    });
});
</script>
@endpush

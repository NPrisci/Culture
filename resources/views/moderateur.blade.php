@extends('layouts.lay')

@section('title', 'Dashboard Modérateur')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Modérateur</h1>
        <div class="d-flex">
            <span class="mr-3">Bienvenue, <strong>{{ $user->prenom }} {{ $user->nom }}</strong></span>
            {{-- <a href="" class="btn btn-primary">
                <i class="fas fa-user"></i> Mon Profil
            </a> --}}
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row">
        <!-- Utilisateurs -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Utilisateurs
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_utilisateurs'] }}</div>
                            <div class="text-xs text-muted mt-1">
                                <i class="fas fa-user-plus"></i> {{ $stats['utilisateurs_aujourdhui'] }} nouveaux aujourd'hui
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenus -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Contenus
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_contenus'] }}</div>
                            <div class="text-xs text-muted mt-1">
                                <i class="fas fa-file-alt"></i> {{ $stats['contenus_aujourdhui'] }} ajoutés aujourd'hui
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenus à modérer -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                À Modérer
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['contenus_a_moderer'] }}</div>
                            <div class="text-xs text-muted mt-1">
                                <i class="fas fa-tasks"></i> {{ $stats['contenus_moderes_par_moi'] }} modérés par moi
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commentaires -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Commentaires
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_commentaires'] }}</div>
                            <div class="text-xs text-muted mt-1">
                                <i class="fas fa-comments"></i> {{ $stats['commentaires_aujourdhui'] }} ajoutés aujourd'hui
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comment fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row">
        <!-- Graphique contenus 7 derniers jours -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Contenus créés (7 derniers jours)</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="contenusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphique statut contenus -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statut des contenus</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="statutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activités récentes -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Activités Récentes</h6>
                    <a href="#" class="btn btn-sm btn-primary">Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="activity-feed">
                        @forelse($recentActivities as $activity)
                        <div class="feed-item mb-3 p-3 border-bottom">
                            <div class="feed-content">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="badge badge-{{ 
                                            str_contains($activity->type, 'utilisateur') ? 'primary' : 
                                            (str_contains($activity->type, 'contenu') ? 'success' : 'info')
                                        }}">
                                            {{ $activity->type }}
                                        </span>
                                        <h6 class="mt-2 mb-1">
                                            @if(isset($activity->nom_complet))
                                                {{ $activity->nom_complet }}
                                            @elseif(isset($activity->titre))
                                                {{ $activity->titre }}
                                            @elseif(isset($activity->description))
                                                {{ $activity->description }}...
                                            @endif
                                        </h6>
                                        @if(isset($activity->email))
                                        <p class="mb-1 text-muted">{{ $activity->email }}</p>
                                        @endif
                                        @if(isset($activity->statut))
                                        <span class="badge badge-{{ 
                                            $activity->statut == 'validé' ? 'success' : 
                                            ($activity->statut == 'en attente' ? 'warning' : 'danger')
                                        }}">
                                            {{ $activity->statut }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> 
                                            {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted text-center py-4">Aucune activité récente</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Actions Rapides</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('contenus.index') . '?statut=en+attente' }}" class="btn btn-outline-warning btn-block">
                                <i class="fas fa-clipboard-check fa-2x mb-2"></i><br>
                                Modérer Contenus
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('user') }}" class="btn btn-outline-primary btn-block">
                                <i class="fas fa-users fa-2x mb-2"></i><br>
                                Gérer Utilisateurs
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('contenus.create') }}" class="btn btn-outline-success btn-block">
                                <i class="fas fa-plus fa-2x mb-2"></i><br>
                                Nouveau Contenu
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="" class="btn btn-outline-info btn-block">
                                <i class="fas fa-cog fa-2x mb-2"></i><br>
                                Paramètres
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique des contenus (7 derniers jours)
    const contenusCtx = document.getElementById('contenusChart').getContext('2d');
    const contenusData = @json($chartData['contenus_par_jour']);
    
    const labels = [];
    const data = [];
    
    for(let i = 6; i >= 0; i--) {
        const date = new Date();
        date.setDate(date.getDate() - i);
        const dateString = date.toISOString().split('T')[0];
        labels.push(new Date(dateString).toLocaleDateString('fr-FR', { weekday: 'short' }));
        data.push(contenusData[dateString] || 0);
    }
    
    new Chart(contenusCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de contenus',
                data: data,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    
    // Graphique des statuts des contenus
    const statutCtx = document.getElementById('statutChart').getContext('2d');
    const statutData = @json($chartData['statut_contenus']);
    
    const statutLabels = Object.keys(statutData);
    const statutValues = Object.values(statutData);
    const backgroundColors = [
        'rgba(255, 99, 132, 0.7)',   // Rouge pour rejeté
        'rgba(54, 162, 235, 0.7)',   // Bleu pour en attente
        'rgba(75, 192, 192, 0.7)',   // Vert pour validé
        'rgba(255, 205, 86, 0.7)',   // Jaune pour autre
    ];
    
    new Chart(statutCtx, {
        type: 'doughnut',
        data: {
            labels: statutLabels,
            datasets: [{
                data: statutValues,
                backgroundColor: backgroundColors.slice(0, statutLabels.length),
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endpush
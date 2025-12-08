@extends('layouts.user')

@section('title', 'Mon Dashboard')
@push('styles')
<style>
    .dashboard-header {
        margin-bottom: 2rem;
    }
    
    .greeting {
        font-size: 1.8rem;
        font-weight: 600;
    }
    
    .date-info {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .stat-card .card-body {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .recent-list .list-group-item {
        border: none;
        border-bottom: 1px solid #eee;
        padding: 1rem 0;
    }
    
    .recent-list .list-group-item:last-child {
        border-bottom: none;
    }
    
    .content-meta {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
<!-- En-tête du dashboard -->
<div class="dashboard-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="greeting mb-1">
                Bonjour, {{ Auth::user()->prenom }} 👋
            </h1>
            <p class="date-info mb-0">
                <i class="bi bi-calendar me-1"></i>
                {{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY') }}
            </p>
        </div>
        <a href="{{ route('contenus.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i>Nouveau Contenu
        </a>
    </div>
</div>

<!-- Statistiques -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stat-card border-start-primary border-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-number text-primary">{{ $stats['total_contenus'] ?? 0 }}</div>
                        <div class="stat-label">Contenus</div>
                    </div>
                    <div class="stat-icon text-primary">
                        <i class="bi bi-file-text"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-success">
                        <i class="bi bi-arrow-up"></i> 
                        {{ $stats['contenus_valides'] ?? 0 }} validés
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stat-card border-start-success border-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-number text-success">{{ $stats['contenus_valides'] ?? 0 }}</div>
                        <div class="stat-label">Validés</div>
                    </div>
                    <div class="stat-icon text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="bi bi-check-all"></i> 
                        Approuvés par les modérateurs
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stat-card border-start-warning border-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-number text-warning">{{ $stats['contenus_en_attente'] ?? 0 }}</div>
                        <div class="stat-label">En attente</div>
                    </div>
                    <div class="stat-icon text-warning">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-warning">
                        <i class="bi bi-hourglass-split"></i> 
                        En cours de modération
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stat-card border-start-info border-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-number text-info">{{ $stats['total_commentaires'] ?? 0 }}</div>
                        <div class="stat-label">Commentaires</div>
                    </div>
                    <div class="stat-icon text-info">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="bi bi-chat-dots"></i> 
                        Vos participations
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contenu récent et activités -->
<div class="row">
    <!-- Mes contenus récents -->
    <div class="col-lg-8 mb-4">
        <div class="card content-card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-file-earmark-text text-primary me-2"></i>
                    Mes Contenus Récents
                </h5>
                <a href="{{ route('contenus.index') }}" class="btn btn-sm btn-outline-primary">
                    Voir tout <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentContenus && $recentContenus->count() > 0)
                <div class="list-group list-group-flush recent-list">
                    @foreach($recentContenus as $contenu)
                    <a href="{{ route('contenus.show', $contenu->id_contenu) }}" 
                       class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">{{ $contenu->titre }}</h6>
                                <div class="content-meta">
                                    <span class="me-3">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}
                                    </span>
                                    <span>
                                        <i class="bi bi-tag me-1"></i>
                                        {{ $contenu->type_contenu ?? 'Non catégorisé' }}
                                    </span>
                                </div>
                            </div>
                            <span class="badge 
                                @if($contenu->statut == 'validé') bg-success
                                @elseif($contenu->statut == 'en attente') bg-warning
                                @else bg-secondary @endif">
                                {{ $contenu->statut }}
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-file-earmark"></i>
                    <h5 class="mt-3">Aucun contenu créé</h5>
                    <p class="mb-3">Commencez par créer votre premier contenu</p>
                    <a href="{{ route('contenus.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Créer un contenu
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Activités récentes -->
    <div class="col-lg-4 mb-4">
        <div class="card content-card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-activity text-success me-2"></i>
                    Activités Récentes
                </h5>
            </div>
            <div class="card-body">
                @if($recentCommentaires && $recentCommentaires->count() > 0)
                <div class="activity-list">
                    @foreach($recentCommentaires as $commentaire)
                    <div class="activity-item mb-3">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="bi bi-chat-left-text text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Commentaire posté</h6>
                                <p class="mb-1 small">{{ Str::limit($commentaire->texte, 80) }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($commentaire->date)->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state py-3">
                    <i class="bi bi-chat-left"></i>
                    <p class="mt-2 mb-0">Aucune activité récente</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card content-card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning-charge text-warning me-2"></i>
                    Actions Rapides
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <a href="{{ route('contenus.create') }}" class="quick-action text-decoration-none">
                            <div class="quick-action-icon text-primary">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                            <h6>Nouveau Contenu</h6>
                            <small class="text-muted">Partager votre savoir</small>
                        </a>
                    </div>
                    
                    <div class="col-md-3 col-6">
                        <a href="{{ route('contenus.index') }}" class="quick-action text-decoration-none">
                            <div class="quick-action-icon text-success">
                                <i class="bi bi-files"></i>
                            </div>
                            <h6>Mes Contenus</h6>
                            <small class="text-muted">Gérer mes publications</small>
                        </a>
                    </div>
                    
                    <div class="col-md-3 col-6">
                        <a href="{{ route('profile.edit') }}" class="quick-action text-decoration-none">
                            <div class="quick-action-icon text-info">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <h6>Mon Profil</h6>
                            <small class="text-muted">Modifier mes informations</small>
                        </a>
                    </div>
                    
                    <div class="col-md-3 col-6">
                        <a href="{{ url('/') }}" target="_blank" class="quick-action text-decoration-none">
                            <div class="quick-action-icon text-warning">
                                <i class="bi bi-globe"></i>
                            </div>
                            <h6>Visiter le site</h6>
                            <small class="text-muted">Explorer les contenus</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Informations profil -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card content-card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle text-info me-2"></i>
                    Mes Informations
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>Nom complet</strong></td>
                                <td>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date d'inscription</strong></td>
                                <td>{{ \Carbon\Carbon::parse(Auth::user()->date_inscription)->format('d/m/Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>Statut</strong></td>
                                <td>
                                    <span class="badge bg-success">Actif</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Contenus créés</strong></td>
                                <td>{{ $stats['total_contenus'] ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dernière connexion</strong></td>
                                <td>{{ Auth::user()->updated_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-square me-2"></i>Modifier mon profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Animation pour les cartes de statistiques
document.addEventListener('DOMContentLoaded', function() {
    const statCards = document.querySelectorAll('.stat-card');
    
    statCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
        
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s, transform 0.5s';
    });
});
</script>
@endpush
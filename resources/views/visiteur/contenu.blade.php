@extends('layouts.visiteur')

@section('title', 'Contenus culturels du Bénin')

@section('hero-title', 'Contenus culturels')
@section('hero-subtitle', 'Découvrez les richesses culturelles et linguistiques du Bénin')

@section('hero-search')
<form action="{{ route('contenus.index.public') }}" class="row g-3 justify-content-center">
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control form-control-lg" 
                   placeholder="Rechercher un contenu..." 
                   name="search" value="{{ request('search') }}">
            <button class="btn btn-primary btn-lg" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</form>
@endsection

@section('content')
<div class="row">
    <!-- Filtres -->
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-filter"></i> Filtres</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('contenus.index.public') }}">
                    <div class="mb-3">
                        <label for="region" class="form-label">Région</label>
                        <select name="region" id="region" class="form-select">
                            <option value="">Toutes les régions</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id_region }}" {{ request('region') == $region->id_region ? 'selected' : '' }}>
                                    {{ $region->nom_region }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="langue" class="form-label">Langue</label>
                        <select name="langue" id="langue" class="form-select">
                            <option value="">Toutes les langues</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id_langue }}" {{ request('langue') == $langue->id_langue ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="type_contenu" class="form-label">Type de contenu</label>
                        <select name="type_contenu" id="type_contenu" class="form-select">
                            <option value="">Tous les types</option>
                            @foreach($typesContenu as $type)
                                <option value="{{ $type->id_type_contenu }}" {{ request('type_contenu') == $type->id_type_contenu ? 'selected' : '' }}>
                                    {{ $type->nom_contentu }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Trier par :</label>
                        <select name="sort" class="form-select">
                            <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récents</option>
                            <option value="ancien" {{ request('sort') == 'ancien' ? 'selected' : '' }}>Plus anciens</option>
                            <option value="populaire" {{ request('sort') == 'populaire' ? 'selected' : '' }}>Plus populaires</option>
                            <option value="commented" {{ request('sort') == 'commented' ? 'selected' : '' }}>Plus commentés</option>
                        </select>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Appliquer</button>
                        <a href="{{ route('contenus.index.public') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-graph-up"></i> Statistiques</h5>
            </div>
            <div class="card-body">
                <p><i class="bi bi-file-text"></i> Contenus : {{ $contenus->total() }}</p>
                <p><i class="bi bi-translate"></i> Langues : {{ $languesCount }}</p>
                <p><i class="bi bi-geo-alt"></i> Régions : {{ $regionsCount }}</p>
                <p><i class="bi bi-chat-left-text"></i> Commentaires : {{ $totalCommentaires }}</p>
            </div>
        </div>
        
        <!-- Contenu vedette -->
        @if($contenuVedette)
        <div class="card mt-3">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="bi bi-star"></i> Contenu vedette ok</h5>
            </div>
            <div class="card-body">
                <h6>{{ Str::limit($contenuVedette->titre, 50) }}</h6>
                <p class="text-muted mb-2">{{ Str::limit(strip_tags($contenuVedette->texte), 80) }}</p>
                {{-- <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="bi bi-chat-left-text"></i> {{ $contenuVedette->commentaires->count() }}
                    </small>
                    <a href="{{ route('contenus.show.public', $contenuVedette) }}" class="btn btn-sm btn-outline-warning">
                        Lire
                    </a>
                </div> --}}
                <div class="d-flex justify-content-between align-items-center">
    <small class="text-muted d-block">
        @if(isset($contenu) && $contenu)
            <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}
        @else
            <i class="bi bi-calendar"></i> Date non disponible
        @endif
    </small>
    
    @if(auth()->check())
        @php
            // Vérifier si la variable $contenu existe
            if (isset($contenu) && $contenu) {
                $hasPaid = App\Models\Paiement::where('contenu_id', $contenu->id)
                    ->where('user_id', auth()->id())
                    ->where('statut', 'completed')
                    ->exists();
            } else {
                $hasPaid = false;
            }
        @endphp
        
        @if($hasPaid)
            <a href="{{ route('contenushow.public', $contenu) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-book"></i> Lire plus
            </a>
        @else
            @if(isset($contenu) && $contenu)
                <a href="{{ route('contenus.paiement.form', $contenu) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-credit-card"></i> 100 FCFA
                </a>
            @else
                <button type="button" class="btn btn-secondary btn-sm" disabled>
                    <i class="bi bi-credit-card"></i> Indisponible
                </button>
            @endif
        @endif
    @else
        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="bi bi-lock"></i> 100 FCFA
        </button>
    @endif
</div>
            </div>
        </div>
        @endif
    </div>

    <!-- Liste des contenus -->
    <div class="col-md-9">
        <!-- Vue en grille/table -->
        <div class="mb-3">
            <div class="btn-group" role="group">
                <button type="button" id="gridView" class="btn btn-outline-primary active">
                    <i class="bi bi-grid-3x3-gap"></i> Grille
                </button>
                <button type="button" id="listView" class="btn btn-outline-primary">
                    <i class="bi bi-list"></i> Liste
                </button>
            </div>
        </div>
        
        <!-- Vue Grille -->
        <div id="gridViewContent">
            <div class="row">
                @forelse($contenus as $contenu)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        @if($contenu->medias->first())
                            <img src="{{ $contenu->medias->first()->chemin }}" 
                                 class="card-img-top" 
                                 alt="{{ $contenu->titre }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="bi bi-image text-white display-4"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($contenu->titre, 50) }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit(strip_tags($contenu->texte), 100) }}
                            </p>
                            
                            <div class="mb-3">
                                <span class="badge bg-info">{{ $contenu->typeContenu->nom_contentu }}</span>
                                <span class="badge bg-success">{{ $contenu->region->nom_region }}</span>
                                <span class="badge bg-warning">{{ $contenu->langue->nom_langue }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted d-block">
    <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}
</small>
                                {{-- <a href="{{ route('contenus.show.public', $contenu) }}" class="btn btn-primary btn-sm">
                                    Lire
                                </a> --}}
                                @if(auth()->check())
        @php
            // Vérifier si la variable $contenu existe
            if (isset($contenu) && $contenu) {
                $hasPaid = App\Models\Paiement::where('contenu_id', $contenu->id)
                    ->where('user_id', auth()->id())
                    ->where('statut', 'completed')
                    ->exists();
            } else {
                $hasPaid = false;
            }
        @endphp
        
        @if($hasPaid)
            <a href="{{ route('contenushow.public', $contenu) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-book"></i> Lire plus
            </a>
        @else
            @if(isset($contenu) && $contenu)
                <a href="{{ route('contenus.paiement.form', $contenu) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-credit-card"></i> 100 FCFA
                </a>
            @else
                <button type="button" class="btn btn-secondary btn-sm" disabled>
                    <i class="bi bi-credit-card"></i> Indisponible
                </button>
            @endif
        @endif
    @else
        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="bi bi-lock"></i> 100 FCFA
        </button>
    @endif
</div>
            
    
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">
                                    <i class="bi bi-chat-left-text"></i> {{ $contenu->commentaires->count() }}
                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-eye"></i> {{ rand(100, 1000) }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Aucun contenu trouvé.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Vue Liste (cachée par défaut) -->
        <div id="listViewContent" style="display: none;">
            <div class="list-group">
                @forelse($contenus as $contenu)
                <a href="{{ route('contenushow.public', $contenu) }}" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            @if($contenu->medias->first())
                                <img src="{{ $contenu->medias->first()->chemin }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $contenu->titre }}"
                                     style="height: 100px; width: 100%; object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                     style="height: 100px;">
                                    <i class="bi bi-image text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-1">{{ $contenu->titre }}</h5>
                            <p class="mb-1 text-muted">{{ Str::limit(strip_tags($contenu->texte), 150) }}</p>
                            <small class="text-muted">
                                <span class="badge bg-info">{{ $contenu->typeContenu->nom_contentu }}</span>
                                <span class="badge bg-success">{{ $contenu->region->nom_region }}</span>
                                <span class="badge bg-warning">{{ $contenu->langue->nom_langue }}</span>
                            </small>
                        </div>
                        <div class="col-md-3 text-end">
                            <small class="text-muted d-block">
                                <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}
                            </small>
                            <small class="text-muted">
                                <i class="bi bi-chat-left-text"></i> {{ $contenu->commentaires->count() }} commentaires
                            </small>
                        </div>
                    </div>
                </a>
                @empty
                <div class="list-group-item">
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle"></i> Aucun contenu trouvé.
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($contenus->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Pagination">
                    {{ $contenus->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Types de contenu -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-tags"></i> Explorer par type de contenu</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($typesContenu as $type)
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <i class="bi bi-card-text text-primary display-6 mb-3"></i>
                                <h5>{{ $type->nom_contentu }}</h5>
                                <p class="text-muted">{{ $type->contenus->count() }} contenus</p>
                                <a href="{{ route('contenus.index.public') }}?type_contenu={{ $type->id_type_contenu }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    Explorer
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de connexion -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Connexion requise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Vous devez vous connecter pour accéder à ce contenu.</p>
                <p>Prix d'accès : <strong>100 FCFA</strong></p>
                
                <div class="d-grid gap-2 mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">
                        <i class="bi bi-person-plus"></i> Créer un compte
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gridViewBtn = document.getElementById('gridView');
    const listViewBtn = document.getElementById('listView');
    const gridViewContent = document.getElementById('gridViewContent');
    const listViewContent = document.getElementById('listViewContent');
    
    gridViewBtn.addEventListener('click', function() {
        gridViewContent.style.display = 'block';
        listViewContent.style.display = 'none';
        gridViewBtn.classList.add('active');
        listViewBtn.classList.remove('active');
    });
    
    listViewBtn.addEventListener('click', function() {
        gridViewContent.style.display = 'none';
        listViewContent.style.display = 'block';
        listViewBtn.classList.add('active');
        gridViewBtn.classList.remove('active');
    });
});
</script>
@endpush
@extends('layouts.visiteur')

@section('title', $region->nom_region . ' - Régions du Bénin')

@section('hero-title', $region->nom_region)
@section('hero-subtitle', $region->localisation ? 'Localisation : ' . $region->localisation : '')

@section('content')
<div class="row">
    <!-- Informations principales -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-info-circle"></i> Informations de la région</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Nom :</th>
                                <td><strong>{{ $region->nom_region }}</strong></td>
                            </tr>
                            <tr>
                                <th>Localisation :</th>
                                <td>
                                    @if($region->localisation)
                                        <span class="badge bg-info">{{ $region->localisation }}</span>
                                    @else
                                        <span class="text-muted">Non spécifiée</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Population :</th>
                                <td>
                                    @if($region->population)
                                        <span class="badge bg-success">
                                            {{ number_format($region->population, 0, ',', ' ') }} habitants
                                        </span>
                                    @else
                                        <span class="text-muted">Non disponible</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Superficie :</th>
                                <td>
                                    @if($region->superficie)
                                        <span class="badge bg-warning">
                                            {{ number_format($region->superficie, 0, ',', ' ') }} km²
                                        </span>
                                    @else
                                        <span class="text-muted">Non disponible</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Langues :</th>
                                <td>
                                    <span class="badge bg-danger">{{ $region->langues->count() }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Contenus :</th>
                                <td>
                                    <span class="badge bg-primary">{{ $region->contenus->count() }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($region->description)
                <div class="mt-4">
                    <h5>Description</h5>
                    <p class="lead">{{ $region->description }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Langues parlées dans la région -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-translate"></i> Langues parlées dans cette région</h4>
            </div>
            <div class="card-body">
                @if($region->langues->count() > 0)
                <div class="row">
                    @foreach($region->langues as $langue)
                    <div class="col-md-6 mb-3">
                        <div class="card border-success h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-chat-square-text text-success fs-4 me-3"></i>
                                    <h5 class="mb-0">{{ $langue->nom_langue }}</h5>
                                </div>
                                <p class="mb-2">
                                    <span class="badge bg-info">{{ $langue->code_langue }}</span>
                                </p>
                                @if($langue->description)
                                    <p class="text-muted mb-2">{{ Str::limit($langue->description, 80) }}</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $langue->contenus->count() }} contenus
                                    </small>
                                    <a href="{{ route('langues.show.public', $langue) }}" class="btn btn-sm btn-outline-success">
                                        Voir langue
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Aucune langue enregistrée pour cette région.
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Statistiques -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-graph-up"></i> Statistiques</h5>
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="display-6 text-primary">{{ $region->langues->count() }}</div>
                        <div class="text-muted">Langues</div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="display-6 text-success">{{ $region->contenus->count() }}</div>
                        <div class="text-muted">Contenus</div>
                    </div>
                </div>
                @if($region->population)
                <div class="row">
                    <div class="col-12">
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" 
                                 style="width: {{ min(100, ($region->population / 15000000) * 100) }}%">
                            </div>
                        </div>
                        <small class="text-muted">Pourcentage de la population nationale</small>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Contenus populaires -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="bi bi-fire"></i> Contenus populaires</h5>
            </div>
            <div class="card-body">
                @if($contenusPopulaires->count() > 0)
                    <div class="list-group">
                        @foreach($contenusPopulaires as $contenu)
                        <a href="{{ route('contenus.show.public', $contenu) }}" 
                           class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ Str::limit($contenu->titre, 30) }}</h6>
                                <span class="badge bg-primary">{{ $contenu->commentaires->count() }}</span>
                            </div>
                            <p class="mb-1">{{ Str::limit(strip_tags($contenu->texte), 50) }}</p>
                            <small class="text-muted">
                                <i class="bi bi-translate"></i> {{ $contenu->langue->nom_langue }}
                            </small>
                        </a>
                        @endforeach
                    </div>
                    <div class="text-center mt-2">
                        <a href="{{ route('contenus.index.public') }}?region={{ $region->id_region }}" 
                           class="btn btn-sm btn-outline-warning">
                            Voir tous les contenus
                        </a>
                    </div>
                @else
                    <p class="text-muted text-center">Aucun contenu disponible</p>
                @endif
            </div>
        </div>

        <!-- Régions voisines -->
        @if($regionsVoisines->count() > 0)
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-geo"></i> Régions voisines</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($regionsVoisines as $regionVoisine)
                    <a href="{{ route('regions.show.public', $regionVoisine) }}" 
                       class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ $regionVoisine->nom_region }}</span>
                            <small class="text-muted">
                                {{ number_format($regionVoisine->population ?? 0, 0, ',', ' ') }} hab.
                            </small>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Contenus de la région -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-file-text"></i> Contenus de cette région</h4>
            </div>
            <div class="card-body">
                @if($region->contenus->count() > 0)
                <div class="row">
                    @foreach($region->contenus->take(6) as $contenu)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($contenu->medias->first())
                                <img src="{{ $contenu->medias->first()->chemin }}" 
                                     class="card-img-top" 
                                     alt="{{ $contenu->titre }}"
                                     style="height: 150px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($contenu->titre, 40) }}</h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit(strip_tags($contenu->texte), 80) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-translate"></i> {{ $contenu->langue->nom_langue }}
                                    </small>
                                    <a href="{{ route('contenus.show.public', $contenu) }}" class="btn btn-sm btn-primary">
                                        Lire
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if($region->contenus->count() > 6)
                <div class="text-center mt-3">
                    <a href="{{ route('contenus.index.public') }}?region={{ $region->id_region }}" 
                       class="btn btn-primary">
                        Voir tous les {{ $region->contenus->count() }} contenus
                    </a>
                </div>
                @endif
                
                @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Aucun contenu disponible pour cette région.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Navigation -->
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            @if($previousRegion)
                <a href="{{ route('regions.show.public', $previousRegion) }}" class="btn btn-outline-primary">
                    <i class="bi bi-chevron-left"></i> {{ $previousRegion->nom_region }}
                </a>
            @else
                <span></span>
            @endif
            
            <a href="{{ route('regions.index.public') }}" class="btn btn-primary">
                <i class="bi bi-list"></i> Retour à la liste
            </a>
            
            @if($nextRegion)
                <a href="{{ route('regions.show.public', $nextRegion) }}" class="btn btn-outline-primary">
                    {{ $nextRegion->nom_region }} <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span></span>
            @endif
        </div>
    </div>
</div>
@endsection
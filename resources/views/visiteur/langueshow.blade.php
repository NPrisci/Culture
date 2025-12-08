@extends('layouts.visiteur')

@section('title', $langue->nom_langue . ' - Langues du Bénin')

@section('hero-title', $langue->nom_langue)
@section('hero-subtitle', 'Langue ' . $langue->code_langue)

@section('content')
<div class="row">
    <!-- Informations principales -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-info-circle"></i> Informations</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Nom :</th>
                                <td><strong>{{ $langue->nom_langue }}</strong></td>
                            </tr>
                            <tr>
                                <th>Code :</th>
                                <td><span class="badge bg-info">{{ $langue->code_langue }}</span></td>
                            </tr>
                            <tr>
                                <th>Utilisateurs :</th>
                                <td>
                                    <span class="badge bg-success">{{ $langue->utilisateurs->count() }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Contenus :</th>
                                <td>
                                    <span class="badge bg-warning">{{ $langue->contenus->count() }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Régions :</th>
                                <td>
                                    <span class="badge bg-danger">{{ $langue->regions->count() }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($langue->description)
                <div class="mt-4">
                    <h5>Description</h5>
                    <p class="lead">{{ $langue->description }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Régions où la langue est parlée -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-geo-alt"></i> Régions où cette langue est parlée</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($langue->regions as $region)
                    <div class="col-md-6 mb-3">
                        <div class="card border-success">
                            <div class="card-body">
                                <h5>{{ $region->nom_region }}</h5>
                                <p class="text-muted mb-2">{{ Str::limit($region->description, 80) }}</p>
                                <div class="d-flex justify-content-between">
                                    @if($region->population)
                                        <small class="text-muted">
                                            <i class="bi bi-people"></i> {{ number_format($region->population, 0, ',', ' ') }} hab.
                                        </small>
                                    @endif
                                    <a href="{{ route('regions.show.public', $region) }}" class="btn btn-sm btn-outline-success">
                                        Voir région
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
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
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="display-6 text-primary">{{ $langue->regions->count() }}</div>
                    <div class="text-muted">Régions</div>
                </div>
                <div class="text-center mb-3">
                    <div class="display-6 text-success">{{ $langue->contenus->count() }}</div>
                    <div class="text-muted">Contenus</div>
                </div>
                <div class="text-center">
                    <div class="display-6 text-warning">{{ $langue->utilisateurs->count() }}</div>
                    <div class="text-muted">Utilisateurs</div>
                </div>
            </div>
        </div>

        <!-- Contenus récents -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="bi bi-file-text"></i> Contenus récents</h5>
            </div>
            <div class="card-body">
                @if($langue->contenus->count() > 0)
                    <div class="list-group">
                        @foreach($langue->contenus->take(5) as $contenu)
                        <a href="{{ route('contenus.show.public', $contenu) }}" 
                           class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ Str::limit($contenu->titre, 40) }}</h6>
                                <small class="text-muted">{{ $contenu->date_creation->format('d/m/Y') }}</small>
                            </div>
                            <p class="mb-1">{{ Str::limit(strip_tags($contenu->texte), 60) }}</p>
                            <small class="text-muted">
                                <i class="bi bi-geo-alt"></i> {{ $contenu->region->nom_region }}
                            </small>
                        </a>
                        @endforeach
                    </div>
                    @if($langue->contenus->count() > 5)
                        <div class="text-center mt-2">
                            <a href="{{ route('contenus.index.public') }}?langue={{ $langue->id_langue }}" 
                               class="btn btn-sm btn-outline-warning">
                                Voir tous les contenus
                            </a>
                        </div>
                    @endif
                @else
                    <p class="text-muted text-center">Aucun contenu disponible</p>
                @endif
            </div>
        </div>

        <!-- Partage -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-share"></i> Partager</h5>
            </div>
            <div class="card-body text-center">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary">
                        <i class="bi bi-facebook"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info">
                        <i class="bi bi-twitter"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger">
                        <i class="bi bi-instagram"></i>
                    </button>
                    <button type="button" class="btn btn-outline-success">
                        <i class="bi bi-whatsapp"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation -->
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            @if($previousLangue)
                <a href="{{ route('langues.show.public', $previousLangue) }}" class="btn btn-outline-primary">
                    <i class="bi bi-chevron-left"></i> {{ $previousLangue->nom_langue }}
                </a>
            @else
                <span></span>
            @endif
            
            <a href="{{ route('langues.index.public') }}" class="btn btn-primary">
                <i class="bi bi-list"></i> Retour à la liste
            </a>
            
            @if($nextLangue)
                <a href="{{ route('langues.show.public', $nextLangue) }}" class="btn btn-outline-primary">
                    {{ $nextLangue->nom_langue }} <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span></span>
            @endif
        </div>
    </div>
</div>
@endsection
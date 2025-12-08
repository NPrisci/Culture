@extends('layouts.visiteur')

@section('title', 'Langues du Bénin')

@section('hero-title', 'Langues du Bénin')
@section('hero-subtitle', 'Découvrez la diversité linguistique de notre pays')

@section('hero-search')
<form action="{{ route('langues.index.public') }}" class="row g-3 justify-content-center">
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control form-control-lg" 
                   placeholder="Rechercher une langue..." 
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
                <form method="GET" action="{{ route('langues.index.public') }}">
                    <div class="mb-3">
                        <label for="region" class="form-label">Filtrer par région</label>
                        <select name="region" id="region" class="form-select">
                            <option value="">Toutes les régions</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id_region }}" {{ request('region') == $region->id_region ? 'selected' : '' }}>
                                    {{ $region->nom_region }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Appliquer</button>
                        <a href="{{ route('langues.index.public') }}" class="btn btn-outline-secondary mt-2">Réinitialiser</a>
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
                <p><i class="bi bi-translate"></i> Total : {{ $langues->count() }} langues</p>
                <p><i class="bi bi-people"></i> Langues majeures : {{ $langues->where('code_langue', '!=', 'fr')->count() }}</p>
                <p><i class="bi bi-map"></i> Régions couvertes : {{ $regionsCount }}</p>
            </div>
        </div>
    </div>

    <!-- Liste des langues -->
    <div class="col-md-9">
        <div class="row">
            @forelse($langues as $langue)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-chat-square-text text-primary display-4"></i>
                        </div>
                        <h4 class="card-title">{{ $langue->nom_langue }}</h4>
                        <p class="card-text">
                            <span class="badge bg-info">{{ $langue->code_langue }}</span>
                        </p>
                        @if($langue->description)
                            <p class="text-muted">{{ Str::limit($langue->description, 80) }}</p>
                        @endif
                        
                        <div class="mt-3">
                            <p class="mb-1">
                                <i class="bi bi-people"></i> 
                                {{ $langue->utilisateurs->count() }} utilisateurs
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-file-text"></i> 
                                {{ $langue->contenus->count() }} contenus
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-geo-alt"></i> 
                                {{ $langue->regions->count() }} régions
                            </p>
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ route('langues.show.public', $langue) }}" class="btn btn-primary">
                                <i class="bi bi-eye"></i> Détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Aucune langue trouvée.
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($langues->hasPages())
        <div class="row">
            <div class="col-12">
                <nav aria-label="Pagination">
                    {{ $langues->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Carte des langues par région -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-map"></i> Répartition des langues par région</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Région</th>
                                <th>Langues parlées</th>
                                <th>Population</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($regions as $region)
                            <tr>
                                <td>
                                    <strong>{{ $region->nom_region }}</strong>
                                </td>
                                <td>
                                    @foreach($region->langues->take(3) as $langue)
                                        <span class="badge bg-primary me-1">{{ $langue->nom_langue }}</span>
                                    @endforeach
                                    @if($region->langues->count() > 3)
                                        <span class="text-muted">+{{ $region->langues->count() - 3 }} autres</span>
                                    @endif
                                </td>
                                <td>
                                    @if($region->population)
                                        {{ number_format($region->population, 0, ',', ' ') }} hab.
                                    @else
                                        <span class="text-muted">Non disponible</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('regions.show.public', $region) }}" class="btn btn-sm btn-outline-primary">
                                        Voir région
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
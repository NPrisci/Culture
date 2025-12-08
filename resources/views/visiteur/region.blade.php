@extends('layouts.visiteur')

@section('title', 'Régions du Bénin')

@section('hero-title', 'Régions du Bénin')
@section('hero-subtitle', 'Découvrez la diversité géographique et culturelle de notre pays')

@section('hero-search')
<form action="{{ route('regions.index.public') }}" class="row g-3 justify-content-center">
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control form-control-lg" 
                   placeholder="Rechercher une région..." 
                   name="search" value="{{ request('search') }}">
            <button class="btn btn-primary btn-lg" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</form>
@endsection

{{-- @section('content')
<div class="row">
    <!-- Filtres -->
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-filter"></i> Filtres</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Trier par :</label>
                    <div class="list-group">
                        <a href="{{ route('regions.index.public', ['sort' => 'nom']) }}" 
                           class="list-group-item list-group-item-action {{ request('sort') == 'nom' ? 'active' : '' }}">
                            <i class="bi bi-sort-alpha-down"></i> Nom A-Z
                        </a>
                        <a href="{{ route('regions.index.public', ['sort' => 'population_desc']) }}" 
                           class="list-group-item list-group-item-action {{ request('sort') == 'population_desc' ? 'active' : '' }}">
                            <i class="bi bi-people"></i> Population (décroissant)
                        </a>
                        <a href="{{ route('regions.index.public', ['sort' => 'superficie_desc']) }}" 
                           class="list-group-item list-group-item-action {{ request('sort') == 'superficie_desc' ? 'active' : '' }}">
                            <i class="bi bi-globe"></i> Superficie (décroissant)
                        </a>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Localisation :</label>
                    <div class="list-group">
                        <a href="{{ route('regions.index.public', ['localisation' => 'Nord']) }}" 
                           class="list-group-item list-group-item-action {{ request('localisation') == 'Nord' ? 'active' : '' }}">
                            <i class="bi bi-compass"></i> Nord
                        </a>
                        <a href="{{ route('regions.index.public', ['localisation' => 'Sud']) }}" 
                           class="list-group-item list-group-item-action {{ request('localisation') == 'Sud' ? 'active' : '' }}">
                            <i class="bi bi-compass"></i> Sud
                        </a>
                        <a href="{{ route('regions.index.public', ['localisation' => 'Centre']) }}" 
                           class="list-group-item list-group-item-action {{ request('localisation') == 'Centre' ? 'active' : '' }}">
                            <i class="bi bi-compass"></i> Centre
                        </a>
                    </div>
                </div>
                
                <div class="d-grid">
                    <a href="{{ route('regions.index.public') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-graph-up"></i> Statistiques</h5>
            </div>
            <div class="card-body">
                <p><i class="bi bi-map"></i> Total : {{ $regions->count() }} régions</p>
                <p><i class="bi bi-people"></i> Population totale : {{ number_format($totalPopulation, 0, ',', ' ') }}</p>
                <p><i class="bi bi-globe"></i> Superficie totale : {{ number_format($totalSuperficie, 0, ',', ' ') }} km²</p>
                <p><i class="bi bi-translate"></i> Langues totales : {{ $totalLangues }}</p>
            </div>
        </div>
        
        <!-- Région la plus peuplée -->
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-trophy"></i> Région la plus peuplée</h5>
            </div>
            <div class="card-body text-center">
                @if($regionPlusPeuplee)
                <h4>{{ $regionPlusPeuplee->nom_region }}</h4>
                <p class="display-6 text-primary">{{ number_format($regionPlusPeuplee->population, 0, ',', ' ') }}</p>
                <p class="text-muted">habitants</p>
                <a href="{{ route('regions.show.public', $regionPlusPeuplee) }}" class="btn btn-sm btn-outline-success">
                    Découvrir
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Liste des régions -->
    <div class="col-md-9">
        <div class="row">
            @forelse($regions as $region)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="bi bi-geo-alt text-primary display-4"></i>
                        </div>
                        <h4 class="card-title text-center">{{ $region->nom_region }}</h4>
                        
                        @if($region->localisation)
                        <div class="text-center mb-3">
                            <span class="badge bg-info">
                                <i class="bi bi-compass"></i> {{ $region->localisation }}
                            </span>
                        </div>
                        @endif
                        
                        <div class="region-info mb-3">
                            @if($region->population)
                            <p class="mb-1">
                                <i class="bi bi-people text-success"></i> 
                                <strong>Population :</strong> {{ number_format($region->population, 0, ',', ' ') }}
                            </p>
                            @endif
                            
                            @if($region->superficie)
                            <p class="mb-1">
                                <i class="bi bi-globe text-warning"></i> 
                                <strong>Superficie :</strong> {{ number_format($region->superficie, 0, ',', ' ') }} km²
                            </p>
                            @endif
                            
                            <p class="mb-1">
                                <i class="bi bi-translate text-danger"></i> 
                                <strong>Langues :</strong> {{ $region->langues->count() }}
                            </p>
                            
                            <p class="mb-1">
                                <i class="bi bi-file-text text-primary"></i> 
                                <strong>Contenus :</strong> {{ $region->contenus->count() }}
                            </p>
                        </div>
                        
                        @if($region->description)
                        <p class="card-text text-muted">
                            {{ Str::limit($region->description, 80) }}
                        </p>
                        @endif
                        
                        <div class="mt-3 text-center">
                            <a href="{{ route('regions.show.public', $region) }}" class="btn btn-primary">
                                <i class="bi bi-eye"></i> Découvrir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Aucune région trouvée.
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($regions->hasPages())
        <div class="row">
            <div class="col-12">
                <nav aria-label="Pagination">
                    {{ $regions->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Carte des régions -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-map"></i> Vue d'ensemble des régions</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Région</th>
                                <th>Localisation</th>
                                <th>Population</th>
                                <th>Superficie</th>
                                <th>Langues</th>
                                <th>Contenus</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($regions as $region)
                            <tr>
                                <td>
                                    <strong>{{ $region->nom_region }}</strong>
                                    @if($region->description)
                                    <br><small class="text-muted">{{ Str::limit($region->description, 50) }}</small>
                                    @endif
                                </td>
                                <td>{{ $region->localisation ?: '-' }}</td>
                                <td>
                                    @if($region->population)
                                        {{ number_format($region->population, 0, ',', ' ') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($region->superficie)
                                        {{ number_format($region->superficie, 0, ',', ' ') }} km²
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $region->langues->count() }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning">{{ $region->contenus->count() }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('regions.show.public', $region) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
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
@endsection --}}
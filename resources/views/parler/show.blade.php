@extends('layouts.admin')

@section('title', 'Détails de la Relation Région-Langue')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails de la Relation Région-Langue</h3>
                    <div class="card-tools">
                        <a href="{{ route('parler.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">Région</h5>
                                </div>
                                <div class="card-body">
                                    <h4>{{ $parler->region->nom_region }}</h4>
                                    @if($parler->region->description)
                                        <p class="text-muted">{{ $parler->region->description }}</p>
                                    @endif
                                    <div class="mt-3">
                                        @if($parler->region->population)
                                            <p><i class="bi bi-people"></i> Population : {{ number_format($parler->region->population, 0, ',', ' ') }} habitants</p>
                                        @endif
                                        @if($parler->region->superficie)
                                            <p><i class="bi bi-globe"></i> Superficie : {{ number_format($parler->region->superficie, 0, ',', ' ') }} km²</p>
                                        @endif
                                        @if($parler->region->localisation)
                                            <p><i class="bi bi-geo-alt"></i> Localisation : {{ $parler->region->localisation }}</p>
                                        @endif
                                    </div>
                                    <a href="{{ route('regions.show', $parler->region) }}" class="btn btn-outline-primary btn-sm mt-2">
                                        <i class="bi bi-eye"></i> Voir la région
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="card-title mb-0">Langue</h5>
                                </div>
                                <div class="card-body">
                                    <h4>{{ $parler->langue->nom_langue }}</h4>
                                    <p class="text-muted">
                                        Code : <span class="badge bg-secondary">{{ $parler->langue->code_langue }}</span>
                                    </p>
                                    @if($parler->langue->description)
                                        <p class="text-muted">{{ $parler->langue->description }}</p>
                                    @endif
                                    <div class="mt-3">
                                        <p><i class="bi bi-people"></i> Utilisateurs : {{ $parler->langue->utilisateurs->count() }}</p>
                                        <p><i class="bi bi-file-text"></i> Contenus : {{ $parler->langue->contenus->count() }}</p>
                                        <p><i class="bi bi-geo-alt"></i> Régions : {{ $parler->langue->regions->count() }}</p>
                                    </div>
                                    <a href="{{ route('langues.show', $parler->langue) }}" class="btn btn-outline-info btn-sm mt-2">
                                        <i class="bi bi-eye"></i> Voir la langue
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> 
                            Cette relation indique que la langue <strong>{{ $parler->langue->nom_langue }}</strong> 
                            est parlée dans la région <strong>{{ $parler->region->nom_region }}</strong>.
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('parler.edit', $parler) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('parler.destroy', $parler) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette relation ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
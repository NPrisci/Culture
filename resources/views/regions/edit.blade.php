@extends('layouts.admin')

@section('title', 'Modifier la Région')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier la Région : {{ $region->nom_region }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('regions.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('regions.update', $region->id_region) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom_region" class="form-label">Nom de la région *</label>
                                    <input type="text" class="form-control @error('nom_region') is-invalid @enderror" 
                                           id="nom_region" name="nom_region" value="{{ old('nom_region', $region->nom_region) }}" required>
                                    @error('nom_region')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="localisation" class="form-label">Localisation</label>
                                    <input type="text" class="form-control @error('localisation') is-invalid @enderror" 
                                           id="localisation" name="localisation" value="{{ old('localisation', $region->localisation) }}">
                                    @error('localisation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="population" class="form-label">Population</label>
                                    <input type="number" class="form-control @error('population') is-invalid @enderror" 
                                           id="population" name="population" value="{{ old('population', $region->population) }}">
                                    @error('population')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="superficie" class="form-label">Superficie (km²)</label>
                                    <input type="number" step="0.01" class="form-control @error('superficie') is-invalid @enderror" 
                                           id="superficie" name="superficie" value="{{ old('superficie', $region->superficie) }}">
                                    @error('superficie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $region->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Ajouter un Contenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ajouter un Nouveau Contenu</h3>
                    <div class="card-tools">
                        <a href="{{ route('contenus.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('contenus.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre *</label>
                                    <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                           id="titre" name="titre" value="{{ old('titre') }}" required>
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="statut" class="form-label">Statut *</label>
                                    <select class="form-control @error('statut') is-invalid @enderror" 
                                            id="statut" name="statut" required>
                                        <option value="">Sélectionner un statut</option>
                                        <option value="brouillon" {{ old('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                        <option value="publié" {{ old('statut') == 'publié' ? 'selected' : '' }}>Publié</option>
                                        <option value="archivé" {{ old('statut') == 'archivé' ? 'selected' : '' }}>Archivé</option>
                                    </select>
                                    @error('statut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_region" class="form-label">Région *</label>
                                    <select class="form-control @error('id_region') is-invalid @enderror" 
                                            id="id_region" name="id_region" required>
                                        <option value="">Sélectionner une région</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id_region }}" {{ old('id_region') == $region->id_region ? 'selected' : '' }}>
                                                {{ $region->nom_region }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_region')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_langue" class="form-label">Langue *</label>
                                    <select class="form-control @error('id_langue') is-invalid @enderror" 
                                            id="id_langue" name="id_langue" required>
                                        <option value="">Sélectionner une langue</option>
                                        @foreach($langues as $langue)
                                            <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                                {{ $langue->nom_langue }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_langue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_type_contenu" class="form-label">Type de contenu *</label>
                                    <select class="form-control @error('id_type_contenu') is-invalid @enderror" 
                                            id="id_type_contenu" name="id_type_contenu" required>
                                        <option value="">Sélectionner un type</option>
                                        @foreach($typesContenu as $type)
                                            <option value="{{ $type->id_type_contenu }}" {{ old('id_type_contenu') == $type->id_type_contenu ? 'selected' : '' }}>
                                                {{ $type->nom_contentu }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_type_contenu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="texte" class="form-label">Contenu *</label>
                            <textarea class="form-control @error('texte') is-invalid @enderror" 
                                      id="texte" name="texte" rows="10" required>{{ old('texte') }}</textarea>
                            @error('texte')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Créer le contenu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

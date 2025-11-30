@extends('layouts.admin')

@section('title', 'Ajouter un Commentaire')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ajouter un Nouveau Commentaire</h3>
                    <div class="card-tools">
                        <a href="{{ route('commentaires.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('commentaires.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_utilisateur" class="form-label">Utilisateur *</label>
                                    <select class="form-control @error('id_utilisateur') is-invalid @enderror" 
                                            id="id_utilisateur" name="id_utilisateur" required>
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach($utilisateurs as $utilisateur)
                                            <option value="{{ $utilisateur->id_utilisateur }}" {{ old('id_utilisateur') == $utilisateur->id_utilisateur ? 'selected' : '' }}>
                                                {{ $utilisateur->prenom }} {{ $utilisateur->nom }} ({{ $utilisateur->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_utilisateur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_contentu" class="form-label">Contenu *</label>
                                    <select class="form-control @error('id_contentu') is-invalid @enderror" 
                                            id="id_contentu" name="id_contentu" required>
                                        <option value="">Sélectionner un contenu</option>
                                        @foreach($contenus as $contenu)
                                            <option value="{{ $contenu->id_contenu }}" {{ old('id_contentu') == $contenu->id_contenu ? 'selected' : '' }}>
                                                {{ $contenu->titre }} ({{ $contenu->region->nom_region }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_contentu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="texte" class="form-label">Commentaire *</label>
                            <textarea class="form-control @error('texte') is-invalid @enderror" 
                                      id="texte" name="texte" rows="5" required 
                                      placeholder="Saisissez le commentaire...">{{ old('texte') }}</textarea>
                            @error('texte')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Note (optionnelle)</label>
                                    <select class="form-control @error('note') is-invalid @enderror" 
                                            id="note" name="note">
                                        <option value="">Sans note</option>
                                        <option value="1" {{ old('note') == '1' ? 'selected' : '' }}>⭐ (1/5)</option>
                                        <option value="2" {{ old('note') == '2' ? 'selected' : '' }}>⭐⭐ (2/5)</option>
                                        <option value="3" {{ old('note') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3/5)</option>
                                        <option value="4" {{ old('note') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4/5)</option>
                                        <option value="5" {{ old('note') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5/5)</option>
                                    </select>
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Créer le commentaire
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
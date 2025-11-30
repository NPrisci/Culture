@extends('layouts.admin')

@section('title', 'Modifier le Type de Média')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier le Type de Média : {{ $typeMedia->nom_media }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('typemedias.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('typemedias.update', $typeMedia) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom_media" class="form-label">Nom du type de média *</label>
                            <input type="text" class="form-control @error('nom_media') is-invalid @enderror" 
                                   id="nom_media" name="nom_media" value="{{ old('nom_media', $typeMedia->nom_media) }}" required
                                   placeholder="ex: Image, Vidéo, Audio, Document...">
                            @error('nom_media')
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

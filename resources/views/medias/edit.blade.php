@extends('layouts.admin')

@section('title', 'Modifier le Média')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier le Média</h3>
                    <div class="card-tools">
                        <a href="{{ route('medias.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('medias.update', $media) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="chemin" class="form-label">Chemin du fichier *</label>
                                    <input type="text" class="form-control @error('chemin') is-invalid @enderror" 
                                           id="chemin" name="chemin" value="{{ old('chemin', $media->chemin) }}" required 
                                           placeholder="ex: /uploads/images/photo.jpg">
                                    @error('chemin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_type_media" class="form-label">Type de média *</label>
                                    <select class="form-control @error('id_type_media') is-invalid @enderror" 
                                            id="id_type_media" name="id_type_media" required>
                                        <option value="">Sélectionner un type</option>
                                        @foreach($typesMedia as $type)
                                            <option value="{{ $type->id_type_media }}" {{ old('id_type_media', $media->id_type_media) == $type->id_type_media ? 'selected' : '' }}>
                                                {{ $type->nom_media }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_type_media')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="id_contentu" class="form-label">Contenu associé *</label>
                            <select class="form-control @error('id_contentu') is-invalid @enderror" 
                                    id="id_contentu" name="id_contentu" required>
                                <option value="">Sélectionner un contenu</option>
                                @foreach($contenus as $contenu)
                                    <option value="{{ $contenu->id_contenu }}" {{ old('id_contentu', $media->id_contentu) == $contenu->id_contenu ? 'selected' : '' }}>
                                        {{ $contenu->titre }} ({{ $contenu->region->nom_region }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_contentu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $media->description) }}</textarea>
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
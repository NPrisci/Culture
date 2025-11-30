@extends('layouts.admin')

@section('title', 'Modifier le Type de Contenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier le Type de Contenu : {{ $typeContenu->nom_contenu }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('typecontenus.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('typecontenus.update', $typeContenu) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom_contenu" class="form-label">Nom du type de contenu *</label>
                            <input type="text" class="form-control @error('nom_contenu') is-invalid @enderror" 
                                   id="nom_contenu" name="nom_contenu" value="{{ old('nom_contenu', $typeContenu->nom_contenu) }}" required
                                   placeholder="ex: Article, Actualité, Document...">
                            @error('nom_contenu')
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
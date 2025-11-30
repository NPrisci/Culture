@extends('layouts.admin')

@section('title', 'Modifier la Langue')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier la Langue</h3>
                    <div class="card-tools">
                        <a href="{{ route('langues.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('langues.update', $langue->id_langue) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom_langue" class="form-label">Nom *</label>
                                    <input type="text" class="form-control @error('nom_langue') is-invalid @enderror" 
                                           id="nom_langue" name="nom_langue" value="{{ old('nom_langue', $langue->nom_langue) }}" required>
                                    @error('nom_langue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code_langue" class="form-label">Code *</label>
                                    <input type="text" class="form-control @error('code_langue') is-invalid @enderror" 
                                           id="code_langue" name="code_langue" value="{{ old('code_langue', $langue->code_langue) }}" required>
                                    @error('code_langue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $langue->description) }}</textarea>
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
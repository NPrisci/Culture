@extends('layouts.admin')

@section('title', 'Modifier la Relation Région-Langue')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier la Relation Région-Langue</h3>
                    <div class="card-tools">
                        <a href="{{ route('parler.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('parler.update', $parler) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_region" class="form-label">Région *</label>
                                    <select class="form-control @error('id_region') is-invalid @enderror" 
                                            id="id_region" name="id_region" required>
                                        <option value="">Sélectionner une région</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id_region }}" {{ old('id_region', $parler->id_region) == $region->id_region ? 'selected' : '' }}>
                                                {{ $region->nom_region }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_region')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_langue" class="form-label">Langue *</label>
                                    <select class="form-control @error('id_langue') is-invalid @enderror" 
                                            id="id_langue" name="id_langue" required>
                                        <option value="">Sélectionner une langue</option>
                                        @foreach($langues as $langue)
                                            <option value="{{ $langue->id_langue }}" {{ old('id_langue', $parler->id_langue) == $langue->id_langue ? 'selected' : '' }}>
                                                {{ $langue->nom_langue }} ({{ $langue->code_langue }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_langue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> 
                            Cette relation indique qu'une langue est parlée dans une région spécifique.
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
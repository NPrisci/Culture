@extends('layouts.admin')

@section('title', 'Modifier le Rôle')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier le Rôle : {{ $role->nom_role }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom_role" class="form-label">Nom du rôle *</label>
                            <input type="text" class="form-control @error('nom_role') is-invalid @enderror" 
                                   id="nom_role" name="nom_role" value="{{ old('nom_role', $role->nom_role) }}" required
                                   placeholder="ex: Administrateur, Modérateur, Utilisateur...">
                            @error('nom_role')
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
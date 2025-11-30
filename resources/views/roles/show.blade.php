@extends('layouts.admin')

@section('title', 'Détails du Rôle')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails du Rôle : {{ $role->nom_role }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">ID :</th>
                                    <td>{{ $role->id_role }}</td>
                                </tr>
                                <tr>
                                    <th>Nom :</th>
                                    <td><strong>{{ $role->nom_role }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Nombre d'utilisateurs :</th>
                                    <td>
                                        <span class="badge bg-primary">{{ $role->utilisateurs->count() }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($role->utilisateurs->count() > 0)
                    <div class="mt-4">
                        <h5>Utilisateurs avec ce rôle</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom & Prénom</th>
                                        <th>Email</th>
                                        <th>Statut</th>
                                        <th>Date d'inscription</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role->utilisateurs->take(5) as $utilisateur)
                                    <tr>
                                        <td>{{ $utilisateur->id_utilisateur }}</td>
                                        <td>
                                            <a href="{{ route('utilisateurs.show', $utilisateur) }}">
                                                {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
                                            </a>
                                        </td>
                                        <td>{{ $utilisateur->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $utilisateur->statut == 'actif' ? 'success' : 'danger' }}">
                                                {{ $utilisateur->statut }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($utilisateur->sexe_date_inscription)
                                                {{ \Carbon\Carbon::parse($utilisateur->sexe_date_inscription)->format('d/m/Y') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($role->utilisateurs->count() > 5)
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    ... et {{ $role->utilisateurs->count() - 5 }} autres utilisateurs
                                </small>
                            </div>
                        @endif
                    </div>
                    @else
                    <div class="alert alert-info mt-4">
                        <i class="bi bi-info-circle"></i> Aucun utilisateur n'a ce rôle pour le moment.
                    </div>
                    @endif
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ? Cette action supprimera tous les utilisateurs associés.')">
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
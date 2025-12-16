@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Utilisateurs</h3>
                    <div class="card-tools">
                        <a href="{{ route('utilisateurs.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouvel Utilisateur
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom & Prénom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Langue</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($utilisateurs as $utilisateur)
                                <tr>
                                    <td>{{ $utilisateur->id_utilisateur }}</td>
                                    <td>
                                        <strong>{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</strong>
                                        @if($utilisateur->date_naissance)
                                            <br>
                                            <small class="text-muted">
                                                Né le {{ \Carbon\Carbon::parse($utilisateur->date_naissance)->format('d/m/Y') }}
                                            </small>
                                        @endif
                                    </td>
                                    <td>{{ $utilisateur->email }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $utilisateur->role->nom_role }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $utilisateur->langue->nom_langue ?? 'Non défini'}}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $utilisateur->statut == 'actif' ? 'success' : 'danger' }}">
                                            {{ $utilisateur->statut }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('utilisateurs.show', $utilisateur) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('utilisateurs.edit', $utilisateur) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('utilisateurs.destroy', $utilisateur) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Aucun utilisateur trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $utilisateurs->count() }} utilisateur(s)</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
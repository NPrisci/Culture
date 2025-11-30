@extends('layouts.admin')

@section('title', 'Rôles')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Rôles</h3>
                    <div class="card-tools">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouveau Rôle
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
                                    <th>Nom du Rôle</th>
                                    <th>Nombre d'Utilisateurs</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                <tr>
                                    <td>{{ $role->id_role }}</td>
                                    <td>
                                        <strong>{{ $role->nom_role }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $role->utilisateurs->count() }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('roles.show', $role) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun rôle trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $roles->count() }} rôle(s)</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
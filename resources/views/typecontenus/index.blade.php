@extends('layouts.admin')

@section('title', 'Types de Contenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Types de Contenu</h3>
                    <div class="card-tools">
                        <a href="{{ route('typecontenus.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouveau Type
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
                                    <th>Nom du Type</th>
                                    <th>Nombre de Contenus</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($typesContenu as $type)
                                <tr>
                                    <td>{{ $type->id_type_contenu }}</td>
                                    <td>
                                        <strong>{{ $type->nom_contenu }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $type->contenus->count() }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('typecontenus.show', $type) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('typecontenus.edit', $type) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('typecontenus.destroy', $type) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de contenu ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun type de contenu trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $typesContenu->count() }} type(s) de contenu</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
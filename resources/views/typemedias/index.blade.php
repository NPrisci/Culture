@extends('layouts.admin')

@section('title', 'Types de Média')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Types de Média</h3>
                    <div class="card-tools">
                        <a href="{{ route('typemedias.create') }}" class="btn btn-primary">
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
                                    <th>Nombre de Médias</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($typesMedia as $type)
                                <tr>
                                    <td>{{ $type->id_type_media }}</td>
                                    <td>
                                        <strong>{{ $type->nom_media }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $type->medias->count() }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('typemedias.show', $type) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('typemedias.edit', $type) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('typemedias.destroy', $type) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de média ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun type de média trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $typesMedia->count() }} type(s) de média</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
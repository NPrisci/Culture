@extends('layouts.admin')

@section('title', 'Relations Région-Langue')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Relations Région-Langue</h3>
                    <div class="card-tools">
                        <a href="{{ route('parler.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouvelle Relation
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
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Région</th>
                                    <th>Région</th>
                                    <th>ID Langue</th>
                                    <th>Langue</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($parlers as $parler)
                                <tr>
                                    <td>{{ $parler->id_region }}</td>
                                    <td>
                                        <strong>{{ $parler->region->nom_region }}</strong>
                                    </td>
                                    <td>{{ $parler->id_langue }}</td>
                                    <td>
                                        <strong>{{ $parler->langue->nom_langue }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $parler->langue->code_langue }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('parler.show', $parler) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('parler.edit', $parler) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('parler.destroy', $parler) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette relation ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Aucune relation région-langue trouvée</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $parlers->count() }} relation(s)</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
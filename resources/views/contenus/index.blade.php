@extends('layouts.admin')

@section('title', 'Contenus')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Contenus</h3>
                    <div class="card-tools">
                        <a href="{{ route('contenus.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouveau Contenu
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
                                    <th>Titre</th>
                                    <th>Région</th>
                                    <th>Langue</th>
                                    <th>Type</th>
                                    <th>Statut</th>
                                    <th>Date création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contenus as $contenu)
                                <tr>
                                    <td>{{ $contenu->id_contenu }}</td>
                                    <td>
                                        <strong>{{ Str::limit($contenu->titre, 40) }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit(strip_tags($contenu->texte), 50) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $contenu->region->nom_region }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $contenu->langue->nom_langue }}</span>
                                    </td>
                                    <td>{{ $contenu->typeContenu->nom_contentu }}</td>
                                    <td>
                                        <span class="badge bg-{{ $contenu->statut == 'publié' ? 'success' : ($contenu->statut == 'brouillon' ? 'warning' : 'secondary') }}">
                                            {{ $contenu->statut }}
                                        </span>
                                    </td>
                                    <td>{{ $contenu->date_creation->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('contenus.show', $contenu) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('contenus.edit', $contenu) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('contenus.destroy', $contenu) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Aucun contenu trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $contenus->count() }} contenu(s)</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
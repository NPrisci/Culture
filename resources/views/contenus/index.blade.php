@extends('layouts.admin')

@section('title', 'Liste des Contenus')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Contenus</h3>
                    <div class="card-tools">
                        <a href="{{ route('contenus.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Ajouter un contenu
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Région</th>
                                    <th>Langue</th>
                                    <th>Statut</th>
                                    <th>Date création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contenus as $contenu)
                                <tr>
                                    <td>{{ $contenu->id_contenu }}</td>
                                    <td>{{ Str::limit($contenu->titre, 50) }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $contenu->typeContenu->nom_contenu ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $contenu->region->nom_region ?? 'N/A' }}</td>
                                    <td>{{ $contenu->langue->nom_langue ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $contenu->statut == 'publié' ? 'success' : ($contenu->statut == 'brouillon' ? 'warning' : 'secondary') }}">
                                            {{ $contenu->statut }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}</td> <!-- CORRIGÉ ICI -->
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
                                    <td colspan="8" class="text-center">Aucun contenu trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $contenus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
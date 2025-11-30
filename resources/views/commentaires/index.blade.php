@extends('layouts.admin')

@section('title', 'Commentaires')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des Commentaires</h3>
                    <div class="card-tools">
                        <a href="{{ route('commentaires.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouveau Commentaire
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
                                    <th>Commentaire</th>
                                    <th>Utilisateur</th>
                                    <th>Contenu</th>
                                    <th>Note</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($commentaires as $commentaire)
                                <tr>
                                    <td>{{ $commentaire->id_commentaire }}</td>
                                    <td>{{ Str::limit($commentaire->texte, 50) }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ Str::limit($commentaire->contenu->titre, 20) }}</span>
                                    </td>
                                    <td>
                                        @if($commentaire->note)
                                            <div class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill' : '' }}"></i>
                                                @endfor
                                                <small class="text-muted">({{ $commentaire->note }}/5)</small>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $commentaire->date->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('commentaires.show', $commentaire) }}" class="btn btn-info" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('commentaires.edit', $commentaire) }}" class="btn btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('commentaires.destroy', $commentaire) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Aucun commentaire trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Total : {{ $commentaires->count() }} commentaire(s)</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
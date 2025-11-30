@extends('layouts.admin')

@section('title', 'Détails du Commentaire')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails du Commentaire</h3>
                    <div class="card-tools">
                        <a href="{{ route('commentaires.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text">{{ $commentaire->texte }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">ID :</th>
                                        <td>{{ $commentaire->id_commentaire }}</td>
                                    </tr>
                                    <tr>
                                        <th>Utilisateur :</th>
                                        <td>
                                            <a href="{{ route('utilisateurs.show', $commentaire->utilisateur) }}">
                                                {{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Contenu :</th>
                                        <td>
                                            <a href="{{ route('contenus.show', $commentaire->contenu) }}">
                                                {{ $commentaire->contenu->titre }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Note :</th>
                                        <td>
                                            @if($commentaire->note)
                                                <div class="text-warning">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill' : '' }}"></i>
                                                    @endfor
                                                    <span class="text-muted ms-2">({{ $commentaire->note }}/5)</span>
                                                </div>
                                            @else
                                                <span class="text-muted">Aucune note</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date :</th>
                                        <td>{{ $commentaire->date->format('d/m/Y à H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('commentaires.edit', $commentaire) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('commentaires.destroy', $commentaire) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
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
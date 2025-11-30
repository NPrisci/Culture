@extends('layouts.admin')

@section('title', 'Détails du Contenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails du Contenu : {{ $contenu->titre }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('contenus.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>{{ $contenu->titre }}</h4>
                            <div class="mb-3">
                                <span class="badge bg-{{ $contenu->statut == 'publié' ? 'success' : ($contenu->statut == 'brouillon' ? 'warning' : 'secondary') }}">
                                    {{ $contenu->statut }}
                                </span>
                                <span class="badge bg-info">{{ $contenu->typeContenu->nom_contentu }}</span>
                            </div>
                            
                            <div class="content-text mt-4">
                                {!! nl2br(e($contenu->texte)) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Informations</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr>
                                            <th>ID :</th>
                                            <td>{{ $contenu->id_contenu }}</td>
                                        </tr>
                                        <tr>
                                            <th>Région :</th>
                                            <td>{{ $contenu->region->nom_region }}</td>
                                        </tr>
                                        <tr>
                                            <th>Langue :</th>
                                            <td>{{ $contenu->langue->nom_langue }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date création :</th>
                                            <td>{{ $contenu->date_creation->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @if($contenu->date_validation)
                                        <tr>
                                            <th>Date validation :</th>
                                            <td>{{ $contenu->date_validation->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @endif
                                        @if($contenu->auteur)
                                        <tr>
                                            <th>Auteur :</th>
                                            <td>{{ $contenu->auteur->prenom }} {{ $contenu->auteur->nom }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Statistiques</h5>
                                </div>
                                <div class="card-body">
                                    <p><i class="bi bi-image"></i> Médias : {{ $contenu->medias->count() }}</p>
                                    <p><i class="bi bi-chat-left-text"></i> Commentaires : {{ $contenu->commentaires->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('contenus.edit', $contenu) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('contenus.destroy', $contenu) }}" method="POST" class="d-inline">
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
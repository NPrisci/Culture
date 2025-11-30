@extends('layouts.admin')

@section('title', 'Détails de l\'Utilisateur')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails de l'Utilisateur</h3>
                    <div class="card-tools">
                        <a href="{{ route('utilisateurs.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour à la liste
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">ID :</th>
                                    <td>{{ $utilisateur->id_utilisateur }}</td>
                                </tr>
                                <tr>
                                    <th>Nom :</th>
                                    <td>{{ $utilisateur->nom }}</td>
                                </tr>
                                <tr>
                                    <th>Prénom :</th>
                                    <td>{{ $utilisateur->prenom ?? 'Non spécifié' }}</td>
                                </tr>
                                <tr>
                                    <th>Email :</th>
                                    <td>{{ $utilisateur->email }}</td>
                                </tr>
                                <tr>
                                    <th>Rôle :</th>
                                    <td>
                                        @if($utilisateur->role)
                                            <span class="badge bg-primary">{{ $utilisateur->role->nom_role }}</span>
                                        @else
                                            <span class="badge bg-warning">Aucun rôle</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Langue :</th>
                                    <td>
                                        @if($utilisateur->langue)
                                            <span class="badge bg-info">{{ $utilisateur->langue->nom_langue }}</span>
                                        @else
                                            <span class="badge bg-warning">Aucune langue</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Statut :</th>
                                    <td>
                                        <span class="badge bg-{{ $utilisateur->statut == 'actif' ? 'success' : 'danger' }}">
                                            {{ $utilisateur->statut ?? 'Non défini' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date d'inscription :</th>
                                    <td>
                                        @if($utilisateur->date_inscription)
                                            {{ \Carbon\Carbon::parse($utilisateur->date_inscription)->format('d/m/Y') }}
                                        @else
                                            Non spécifiée
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email vérifié :</th>
                                    <td>
                                        @if($utilisateur->email_verified_at)
                                            <span class="badge bg-success">
                                                Oui ({{ \Carbon\Carbon::parse($utilisateur->email_verified_at)->format('d/m/Y') }})
                                            </span>
                                        @else
                                            <span class="badge bg-warning">Non</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($utilisateur->date_naissance)
                                <tr>
                                    <th>Date de naissance :</th>
                                    <td>
                                        {{ \Carbon\Carbon::parse($utilisateur->date_naissance)->format('d/m/Y') }}
                                    </td>
                                </tr>
                                @endif
                                @if($utilisateur->sexe)
                                <tr>
                                    <th>Genre :</th>
                                    <td>{{ ucfirst($utilisateur->sexe) }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-4">
                            <!-- Statistiques ou informations supplémentaires -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Statistiques</h5>
                                </div>
                                <div class="card-body">
                                    <p><i class="bi bi-file-text"></i> Contenus créés : {{ $utilisateur->contenus->count() }}</p>
                                    <p><i class="bi bi-chat-left-text"></i> Commentaires : {{ $utilisateur->commentaires->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('utilisateurs.edit', $utilisateur->id_utilisateur) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('utilisateurs.destroy', $utilisateur->id_utilisateur) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
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
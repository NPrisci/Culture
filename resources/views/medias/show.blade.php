@extends('layouts.admin')

@section('title', 'Détails du Média')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails du Média</h3>
                    <div class="card-tools">
                        <a href="{{ route('medias.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h4>Informations du média</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">ID :</th>
                                        <td>{{ $media->id_media }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chemin :</th>
                                        <td><code>{{ $media->chemin }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Type :</th>
                                        <td>
                                            <span class="badge bg-info">{{ $media->typeMedia->nom_media }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Contenu associé :</th>
                                        <td>
                                            @if($media->contenu)
                                                <a href="{{ route('contenus.show', $media->contenu) }}">
                                                    {{ $media->contenu->titre }}
                                                </a>
                                            @else
                                                <span class="text-muted">Aucun contenu associé</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description :</th>
                                        <td>{{ $media->description ?: '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <!-- Aperçu du média -->
                            <div class="mt-4">
                                <h5>Aperçu</h5>
                                @if(Str::contains($media->chemin, ['.jpg', '.png', '.gif', '.jpeg']))
                                    <div class="text-center">
                                        <img src="{{ $media->chemin }}" alt="{{ $media->description }}" 
                                             class="img-fluid rounded" style="max-height: 300px;">
                                        <p class="text-muted mt-2">Image - {{ $media->typeMedia->nom_media }}</p>
                                    </div>
                                @elseif(Str::contains($media->chemin, ['.mp4', '.avi', '.mov']))
                                    <div class="text-center">
                                        <div class="bg-dark rounded p-4">
                                            <i class="bi bi-camera-video text-white" style="font-size: 3rem;"></i>
                                            <p class="text-white mt-2">Vidéo - {{ $media->typeMedia->nom_media }}</p>
                                        </div>
                                    </div>
                                @elseif(Str::contains($media->chemin, ['.mp3', '.wav']))
                                    <div class="text-center">
                                        <div class="bg-primary rounded p-4">
                                            <i class="bi bi-music-note-beamed text-white" style="font-size: 3rem;"></i>
                                            <p class="text-white mt-2">Audio - {{ $media->typeMedia->nom_media }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <div class="bg-secondary rounded p-4">
                                            <i class="bi bi-file-earmark text-white" style="font-size: 3rem;"></i>
                                            <p class="text-white mt-2">Fichier - {{ $media->typeMedia->nom_media }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex gap-2">
                            <a href="{{ route('medias.edit', $media) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('medias.destroy', $media) }}" method="POST" class="d-inline">
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
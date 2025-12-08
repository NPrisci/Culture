@extends('layouts.admin')

@section('title', 'Détails du Contenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Détails du Contenu</h3>
                    <div class="card-tools">
                        <a href="{{ route('contenus.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ $contenu->titre }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        {!! $contenu->texte !!}
                                    </div>
                                    
                                    @if($contenu->image)
                                    <div class="mb-4">
                                        <h5>Image :</h5>
                                        <img src="{{ asset('storage/' . $contenu->image) }}" 
                                             alt="{{ $contenu->alt_image ?? $contenu->titre }}" 
                                             class="img-fluid rounded" style="max-height: 400px;">
                                        @if($contenu->alt_image)
                                            <p class="text-muted mt-2"><small>{{ $contenu->alt_image }}</small></p>
                                        @endif
                                    </div>
                                    @endif
                                    
                                    @if($contenu->lien_video || $contenu->video_file)
                                    <div class="mb-4">
                                        <h5>Vidéo :</h5>
                                        @if($contenu->lien_video)
                                            <div class="ratio ratio-16x9">
                                                @if(str_contains($contenu->lien_video, 'youtube.com') || str_contains($contenu->lien_video, 'youtu.be'))
                                                    <!-- YouTube -->
                                                    <iframe src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast(parse_url($contenu->lien_video, PHP_URL_PATH), '/') }}" 
                                                            frameborder="0" allowfullscreen></iframe>
                                                @elseif(str_contains($contenu->lien_video, 'vimeo.com'))
                                                    <!-- Vimeo -->
                                                    <iframe src="https://player.vimeo.com/video/{{ \Illuminate\Support\Str::afterLast($contenu->lien_video, '/') }}" 
                                                            frameborder="0" allowfullscreen></iframe>
                                                @else
                                                    <a href="{{ $contenu->lien_video }}" target="_blank" class="btn btn-primary">
                                                        <i class="bi bi-play-circle"></i> Voir la vidéo
                                                    </a>
                                                @endif
                                            </div>
                                        @elseif($contenu->video_file)
                                            <video controls class="w-100 rounded" style="max-height: 400px;">
                                                <source src="{{ asset('storage/' . $contenu->video_file) }}" type="video/mp4">
                                                Votre navigateur ne supporte pas la lecture de vidéos.
                                            </video>
                                        @endif
                                        @if($contenu->titre_video)
                                            <p class="mt-2"><strong>{{ $contenu->titre_video }}</strong></p>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Informations</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>ID :</th>
                                            <td>{{ $contenu->id_contenu }}</td>
                                        </tr>
                                        <tr>
                                            <th>Statut :</th>
                                            <td>
                                                <span class="badge bg-{{ $contenu->statut == 'publié' ? 'success' : ($contenu->statut == 'brouillon' ? 'warning' : 'secondary') }}">
                                                    {{ $contenu->statut }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Type :</th>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $contenu->typeContenu->nom_contenu ?? 'N/A' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Région :</th>
                                            <td>{{ $contenu->region->nom_region ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Langue :</th>
                                            <td>{{ $contenu->langue->nom_langue }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date création :</th>
                                            <td>{{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y H:i') }}</td> <!-- CORRIGÉ ICI -->
                                        </tr>
                                        @if($contenu->date_validation)
                                        <tr>
                                            <th>Date validation :</th>
                                            <td>{{ \Carbon\Carbon::parse($contenu->date_validation)->format('d/m/Y H:i') }}</td> <!-- CORRIGÉ ICI AUSSI -->
                                        </tr>
                                        @endif
                                        @if($contenu->auteur)
                                        <tr>
                                            <th>Auteur :</th>
                                            <td>{{ $contenu->auteur }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Créé le :</th>
                                            <td>{{ $contenu->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Modifié le :</th>
                                            <td>{{ $contenu->updated_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="btn-group w-100">
                                        <a href="{{ route('contenus.edit', $contenu) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </a>
                                        <form action="{{ route('contenus.destroy', $contenu) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu ?')">
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
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .ratio-16x9 {
        --bs-aspect-ratio: 56.25%; /* 16:9 Aspect Ratio */
    }
    
    img.img-fluid, video {
        max-width: 100%;
        height: auto;
    }
</style>
@endsection
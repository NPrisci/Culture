@extends('layouts.visiteur')

@section('title', $contenu->titre . ' - Bénin Culture')

@section('hero-title', $contenu->titre)
{{-- @section('hero-subtitle', 'Publié le ' . $contenu->date_creation->format('d/m/Y')) --}}
@section('hero-subtitle', 'Publié le ' . \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y'))

@section('content')
<div class="row">
    <!-- Contenu principal -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <!-- Médias -->
            @if($contenu->medias->count() > 0)
            <div id="contenuCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($contenu->medias as $index => $media)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        @if(Str::contains($media->chemin, ['.jpg', '.png', '.gif', '.jpeg']))
                            <img src="{{ $media->chemin }}" class="d-block w-100" alt="{{ $media->description }}" style="height: 400px; object-fit: cover;">
                        @elseif(Str::contains($media->chemin, ['.mp4', '.avi', '.mov']))
                            <div class="d-block w-100 bg-dark text-center py-5" style="height: 400px;">
                                <i class="bi bi-play-circle text-white display-1"></i>
                                <p class="text-white mt-3">Vidéo - {{ $media->typeMedia->nom_media }}</p>
                            </div>
                        @else
                            <div class="d-block w-100 bg-secondary text-center py-5" style="height: 400px;">
                                <i class="bi bi-file-earmark text-white display-1"></i>
                                <p class="text-white mt-3">{{ $media->typeMedia->nom_media }}</p>
                            </div>
                        @endif
                        @if($media->description)
                        <div class="carousel-caption d-none d-md-block">
                            <p>{{ $media->description }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @if($contenu->medias->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#contenuCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#contenuCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Suivant</span>
                </button>
                @endif
            </div>
            @endif
            
            <div class="card-body">
                <!-- Métadonnées -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-primary">{{ $contenu->typeContenu->nom_contentu }}</span>
                        <span class="badge bg-success">{{ $contenu->region->nom_region }}</span>
                        <span class="badge bg-warning">{{ $contenu->langue->nom_langue }}</span>
                        <span class="badge bg-info">{{ $contenu->statut }}</span>
                    </div>
                    
                    <div class="row text-muted">
                        <div class="col-md-6">
    <p><i class="bi bi-calendar"></i> 
        Publié : {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y à H:i') }}
    </p>
    
    @if($contenu->date_validation)
        <p><i class="bi bi-check-circle"></i> 
            Validé : {{ \Carbon\Carbon::parse($contenu->date_validation)->format('d/m/Y') }}
        </p>
    @endif
</div>
                        <div class="col-md-6">
                            @if($contenu->auteur)
                                <p><i class="bi bi-person"></i> Auteur : {{ $contenu->auteur->prenom }} {{ $contenu->auteur->nom }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Contenu textuel -->
                <article class="contenu-article">
                    {!! nl2br(e($contenu->texte)) !!}
                </article>
                
                <!-- Actions -->
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-between">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary">
                                <i class="bi bi-hand-thumbs-up"></i> J'aime
                            </button>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#shareModal">
                                <i class="bi bi-share"></i> Partager
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('contenus.index.public') }}?region={{ $contenu->region->id_region }}" 
                               class="btn btn-outline-success btn-sm">
                                <i class="bi bi-geo-alt"></i> Plus de contenus de {{ $contenu->region->nom_region }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commentaires -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="bi bi-chat-left-text"></i> Commentaires ({{ $contenu->commentaires->count() }})</h4>
            </div>
            <div class="card-body">
                @if($contenu->commentaires->count() > 0)
                    <div class="comments-section">
                        @foreach($contenu->commentaires as $commentaire)
                        <div class="comment mb-3 pb-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    @if($commentaire->utilisateur->photo)
                                        <img src="{{ $commentaire->utilisateur->photo }}" 
                                             alt="{{ $commentaire->utilisateur->prenom }}" 
                                             class="rounded-circle" width="40" height="40">
                                    @else
                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="bi bi-person text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">{{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}</h6>
                                        <small class="text-muted">{{ $commentaire->date->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <p class="mb-1">{{ $commentaire->texte }}</p>
                                    @if($commentaire->note)
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill' : '' }}"></i>
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Aucun commentaire pour le moment. Soyez le premier à commenter !
                    </div>
                @endif
                
                <!-- Formulaire de commentaire (pour utilisateurs connectés) -->
                <div class="mt-4">
                    <h5>Ajouter un commentaire</h5>
                    <form action="{{ route('commentaires.store.public') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_contentu" value="{{ $contenu->id_contenu }}">
                        <div class="mb-3">
                            <textarea class="form-control" name="texte" rows="3" 
                                      placeholder="Votre commentaire..." required></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Note (optionnelle)</label>
                                <select class="form-select" name="note">
                                    <option value="">Pas de note</option>
                                    <option value="1">⭐ (1/5)</option>
                                    <option value="2">⭐⭐ (2/5)</option>
                                    <option value="3">⭐⭐⭐ (3/5)</option>
                                    <option value="4">⭐⭐⭐⭐ (4/5)</option>
                                    <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Publier le commentaire
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Informations -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informations</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th><i class="bi bi-geo-alt"></i> Région :</th>
                        <td>
                            <a href="{{ route('regions.show.public', $contenu->region) }}" 
                               class="text-decoration-none">
                                {{ $contenu->region->nom_region }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-translate"></i> Langue :</th>
                        <td>
                            <a href="{{ route('langues.show.public', $contenu->langue) }}" 
                               class="text-decoration-none">
                                {{ $contenu->langue->nom_langue }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-tag"></i> Type :</th>
                        <td>{{ $contenu->typeContenu->nom_contentu }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-calendar"></i> Date :</th>
                        <td>{{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-chat-left-text"></i> Commentaires :</th>
                        <td>{{ $contenu->commentaires->count() }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-eye"></i> Vues :</th>
                        <td>{{ rand(500, 5000) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Auteur -->
        @if($contenu->auteur)
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-person"></i> À propos de l'auteur</h5>
            </div>
            <div class="card-body text-center">
                @if($contenu->auteur->photo)
                    <img src="{{ $contenu->auteur->photo }}" 
                         alt="{{ $contenu->auteur->prenom }}" 
                         class="rounded-circle mb-3" width="80" height="80">
                @else
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="bi bi-person text-white display-6"></i>
                    </div>
                @endif
                <h5>{{ $contenu->auteur->prenom }} {{ $contenu->auteur->nom }}</h5>
                <p class="text-muted">
                    <i class="bi bi-translate"></i> {{ $contenu->auteur->langue->nom_langue }}
                </p>
                <div class="d-grid">
                    <a href="#" class="btn btn-outline-success btn-sm">Voir le profil</a>
                </div>
            </div>
        </div>
        @endif

        <!-- Contenus similaires -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Contenus similaires</h5>
            </div>
            <div class="card-body">
                @if($contenusSimilaires->count() > 0)
                    <div class="list-group">
                        @foreach($contenusSimilaires as $contenuSimilaire)
                        <a href="{{ route('contenus.show.public', $contenuSimilaire) }}" 
                           class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ Str::limit($contenuSimilaire->titre, 40) }}</h6>
                                <small class="text-muted">{{ $contenuSimilaire->date_creation->format('d/m') }}</small>
                            </div>
                            <p class="mb-1">{{ Str::limit(strip_tags($contenuSimilaire->texte), 60) }}</p>
                            <small class="text-muted">
                                <i class="bi bi-geo-alt"></i> {{ $contenuSimilaire->region->nom_region }}
                            </small>
                        </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">Aucun contenu similaire</p>
                @endif
            </div>
        </div>

        <!-- Partage -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-share"></i> Partager</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary">
                            <i class="bi bi-facebook"></i>
                        </button>
                        <button type="button" class="btn btn-outline-info">
                            <i class="bi bi-twitter"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger">
                            <i class="bi bi-instagram"></i>
                        </button>
                        <button type="button" class="btn btn-outline-success">
                            <i class="bi bi-whatsapp"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="copyLink()">
                            <i class="bi bi-link-45deg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de partage -->
<div class="modal fade" id="shareModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Partager ce contenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="shareLink" 
                           value="{{ url()->current() }}" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="copyLink()">
                        <i class="bi bi-clipboard"></i>
                    </button>
                </div>
                <div class="text-center">
                    <button class="btn btn-outline-primary m-1">
                        <i class="bi bi-facebook"></i> Facebook
                    </button>
                    <button class="btn btn-outline-info m-1">
                        <i class="bi bi-twitter"></i> Twitter
                    </button>
                    <button class="btn btn-outline-success m-1">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation -->
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            @if($previousContenu)
                <a href="{{ route('contenus.show.public', $previousContenu) }}" class="btn btn-outline-primary">
                    <i class="bi bi-chevron-left"></i> Contenu précédent
                </a>
            @else
                <span></span>
            @endif
            
            <a href="{{ route('contenus.index.public') }}" class="btn btn-primary">
                <i class="bi bi-list"></i> Retour à la liste
            </a>
            
            @if($nextContenu)
                <a href="{{ route('contenus.show.public', $nextContenu) }}" class="btn btn-outline-primary">
                    Contenu suivant <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span></span>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyLink() {
    const linkInput = document.getElementById('shareLink');
    linkInput.select();
    linkInput.setSelectionRange(0, 99999);
    document.execCommand('copy');
    
    // Notification
    alert('Lien copié dans le presse-papier !');
}
</script>

<style>
.contenu-article {
    font-size: 1.1rem;
    line-height: 1.8;
}

.contenu-article p {
    margin-bottom: 1.5rem;
}

.contenu-article img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 1rem 0;
}
</style>
@endpush 
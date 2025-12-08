@extends('layouts.admin')

@section('title', 'Ajouter un Contenu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ajouter un Nouveau Contenu</h3>
                    <div class="card-tools">
                        <a href="{{ route('contenus.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('contenus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre *</label>
                                    <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                           id="titre" name="titre" value="{{ old('titre') }}" required>
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="statut" class="form-label">Statut *</label>
                                    <select class="form-control @error('statut') is-invalid @enderror" 
                                            id="statut" name="statut" required>
                                        <option value="">Sélectionner un statut</option>
                                        <option value="brouillon" {{ old('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                        <option value="publié" {{ old('statut') == 'publié' ? 'selected' : '' }}>Publié</option>
                                        <option value="archivé" {{ old('statut') == 'archivé' ? 'selected' : '' }}>Archivé</option>
                                    </select>
                                    @error('statut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_region" class="form-label">Région *</label>
                                    <select class="form-control @error('id_region') is-invalid @enderror" 
                                            id="id_region" name="id_region" required>
                                        <option value="">Sélectionner une région</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id_region }}" {{ old('id_region') == $region->id_region ? 'selected' : '' }}>
                                                {{ $region->nom_region }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_region')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_langue" class="form-label">Langue *</label>
                                    <select class="form-control @error('id_langue') is-invalid @enderror" 
                                            id="id_langue" name="id_langue" required>
                                        <option value="">Sélectionner une langue</option>
                                        @foreach($langues as $langue)
                                            <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                                {{ $langue->nom_langue }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_langue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_type_contenu" class="form-label">Type de contenu *</label>
                                    <select class="form-control @error('id_type_contenu') is-invalid @enderror" 
                                            id="id_type_contenu" name="id_type_contenu" required>
                                        <option value="">Sélectionner un type</option>
                                        @foreach($typesContenu as $type)
                                            <option value="{{ $type->id_type_contenu }}" {{ old('id_type_contenu') == $type->id_type_contenu ? 'selected' : '' }}>
                                                {{ $type->nom_contenu }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_type_contenu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section Image -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Formats acceptés: JPG, PNG, GIF, WEBP. Max: 5MB</small>
                                    
                                    <!-- Prévisualisation de l'image -->
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img id="previewImage" src="#" alt="Prévisualisation" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lien_video" class="form-label">Lien Vidéo (YouTube/Vimeo)</label>
                                    <input type="url" class="form-control @error('lien_video') is-invalid @enderror" 
                                           id="lien_video" name="lien_video" value="{{ old('lien_video') }}" 
                                           placeholder="https://www.youtube.com/watch?v=...">
                                    @error('lien_video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Collez le lien YouTube ou Vimeo</small>
                                    
                                    <!-- Alternative: Upload direct de vidéo -->
                                    <div class="mt-2">
                                        <label for="video_file" class="form-label">OU Télécharger une vidéo</label>
                                        <input type="file" class="form-control @error('video_file') is-invalid @enderror" 
                                               id="video_file" name="video_file" accept="video/*">
                                        @error('video_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Formats acceptés: MP4, AVI, MOV, MKV. Max: 50MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section Description Image/Video -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="alt_image" class="form-label">Texte alternatif (Image)</label>
                                    <input type="text" class="form-control @error('alt_image') is-invalid @enderror" 
                                           id="alt_image" name="alt_image" value="{{ old('alt_image') }}"
                                           placeholder="Description de l'image pour l'accessibilité">
                                    @error('alt_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titre_video" class="form-label">Titre de la vidéo</label>
                                    <input type="text" class="form-control @error('titre_video') is-invalid @enderror" 
                                           id="titre_video" name="titre_video" value="{{ old('titre_video') }}"
                                           placeholder="Titre de la vidéo">
                                    @error('titre_video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="texte" class="form-label">Contenu *</label>
                            <textarea class="form-control @error('texte') is-invalid @enderror" 
                                      id="texte" name="texte" rows="10" required>{{ old('texte') }}</textarea>
                            @error('texte')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Créer le contenu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script pour la prévisualisation de l'image -->
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prévisualisation de l'image
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        });

        // Validation de la taille du fichier image
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const maxSize = 5 * 1024 * 1024; // 5MB en bytes
                if (file.size > maxSize) {
                    alert('Le fichier est trop volumineux (max 5MB).');
                    this.value = '';
                    imagePreview.style.display = 'none';
                }
            }
        });

        // Validation de la taille du fichier vidéo
        const videoFileInput = document.getElementById('video_file');
        videoFileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const maxSize = 50 * 1024 * 1024; // 50MB en bytes
                if (file.size > maxSize) {
                    alert('Le fichier vidéo est trop volumineux (max 50MB).');
                    this.value = '';
                }
            }
        });

        // Gestion des liens YouTube/Vimeo
        const videoLinkInput = document.getElementById('lien_video');
        videoLinkInput.addEventListener('change', function() {
            const url = this.value;
            if (url) {
                // Extraire l'ID de la vidéo YouTube
                if (url.includes('youtube.com') || url.includes('youtu.be')) {
                    let videoId = '';
                    
                    if (url.includes('youtube.com/watch?v=')) {
                        videoId = url.split('v=')[1];
                        const ampersandPosition = videoId.indexOf('&');
                        if (ampersandPosition !== -1) {
                            videoId = videoId.substring(0, ampersandPosition);
                        }
                    } else if (url.includes('youtu.be/')) {
                        videoId = url.split('youtu.be/')[1];
                    }
                    
                    if (videoId) {
                        // Vous pouvez ici afficher un aperçu si nécessaire
                        console.log('ID YouTube détecté:', videoId);
                    }
                }
                // Gestion Vimeo
                else if (url.includes('vimeo.com')) {
                    const videoId = url.split('vimeo.com/')[1];
                    if (videoId) {
                        console.log('ID Vimeo détecté:', videoId);
                    }
                }
            }
        });
    });
</script>
@endsection
@endsection
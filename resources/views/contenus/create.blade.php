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

                        <!-- Section Médias -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Médias</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Colonne Image -->
                                    <div class="col-md-4">
                                        <div class="border p-3 rounded h-100">
                                            <h6 class="text-center mb-3">Image</h6>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Fichier Image</label>
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                       id="image" name="image" accept="image/*">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted d-block mt-1">Formats: JPG, PNG, GIF, WEBP<br>Max: 5MB</small>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="alt_image" class="form-label">Texte alternatif</label>
                                                <input type="text" class="form-control @error('alt_image') is-invalid @enderror" 
                                                       id="alt_image" name="alt_image" value="{{ old('alt_image') }}"
                                                       placeholder="Description pour l'accessibilité">
                                                @error('alt_image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <!-- Prévisualisation de l'image -->
                                            <div class="mt-2" id="imagePreview" style="display: none;">
                                                <img id="previewImage" src="#" alt="Prévisualisation" class="img-thumbnail" style="max-width: 100%; max-height: 150px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Colonne Vidéo -->
                                    <div class="col-md-4">
                                        <div class="border p-3 rounded h-100">
                                            <h6 class="text-center mb-3">Vidéo</h6>
                                            <div class="mb-3">
                                                <label for="lien_video" class="form-label">Lien externe</label>
                                                <input type="url" class="form-control @error('lien_video') is-invalid @enderror" 
                                                       id="lien_video" name="lien_video" value="{{ old('lien_video') }}" 
                                                       placeholder="https://www.youtube.com/watch?v=...">
                                                @error('lien_video')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted d-block mt-1">YouTube, Vimeo, etc.</small>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="video_file" class="form-label">OU Fichier vidéo</label>
                                                <input type="file" class="form-control @error('video_file') is-invalid @enderror" 
                                                       id="video_file" name="video_file" accept="video/*">
                                                @error('video_file')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted d-block mt-1">Formats: MP4, AVI, MOV<br>Max: 50MB</small>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="titre_video" class="form-label">Titre de la vidéo</label>
                                                <input type="text" class="form-control @error('titre_video') is-invalid @enderror" 
                                                       id="titre_video" name="titre_video" value="{{ old('titre_video') }}"
                                                       placeholder="Titre optionnel">
                                                @error('titre_video')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Colonne Audio (NOUVEAU) -->
                                    <div class="col-md-4">
                                        <div class="border p-3 rounded h-100">
                                            <h6 class="text-center mb-3">Audio</h6>
                                            <div class="mb-3">
                                                <label for="audio_file" class="form-label">Fichier Audio *</label>
                                                <input type="file" class="form-control @error('audio_file') is-invalid @enderror" 
                                                       id="audio_file" name="audio_file" accept="audio/*">
                                                @error('audio_file')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted d-block mt-1">Formats: MP3, WAV, M4A, OGG<br>Max: 20MB</small>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="titre_audio" class="form-label">Titre de l'audio</label>
                                                <input type="text" class="form-control @error('titre_audio') is-invalid @enderror" 
                                                       id="titre_audio" name="titre_audio" value="{{ old('titre_audio') }}"
                                                       placeholder="Titre du fichier audio">
                                                @error('titre_audio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="duree_audio" class="form-label">Durée (minutes)</label>
                                                <input type="number" class="form-control @error('duree_audio') is-invalid @enderror" 
                                                       id="duree_audio" name="duree_audio" value="{{ old('duree_audio') }}"
                                                       min="1" max="360" step="1" placeholder="Ex: 5">
                                                @error('duree_audio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted d-block mt-1">Durée en minutes</small>
                                            </div>
                                            
                                            <!-- Prévisualisation audio -->
                                            <div class="mt-2" id="audioPreview" style="display: none;">
                                                <audio id="previewAudio" controls style="width: 100%;">
                                                    <source id="audioSource" src="#" type="audio/mpeg">
                                                    Votre navigateur ne supporte pas l'élément audio.
                                                </audio>
                                            </div>
                                        </div>
                                    </div>
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
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-x-circle"></i> Annuler
                            </button>
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

        // Prévisualisation de l'audio
        const audioInput = document.getElementById('audio_file');
        const audioPreview = document.getElementById('audioPreview');
        const audioSource = document.getElementById('audioSource');
        const previewAudio = document.getElementById('previewAudio');
        
        audioInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const url = URL.createObjectURL(this.files[0]);
                audioSource.src = url;
                previewAudio.load();
                audioPreview.style.display = 'block';
                
                // Récupérer la durée automatiquement si possible
                const audio = new Audio(url);
                audio.addEventListener('loadedmetadata', function() {
                    const minutes = Math.floor(audio.duration / 60);
                    if (minutes > 0 && !document.getElementById('duree_audio').value) {
                        document.getElementById('duree_audio').value = minutes;
                    }
                });
            } else {
                audioPreview.style.display = 'none';
            }
        });

        // Validation de la taille des fichiers
        function validateFileSize(input, maxSizeMB, inputName) {
            if (input.files && input.files[0]) {
                const maxSize = maxSizeMB * 1024 * 1024;
                if (input.files[0].size > maxSize) {
                    alert(`Le fichier ${inputName} est trop volumineux (max ${maxSizeMB}MB).`);
                    input.value = '';
                    return false;
                }
            }
            return true;
        }

        // Validation image (5MB)
        imageInput.addEventListener('change', function() {
            validateFileSize(this, 5, 'image');
        });

        // Validation vidéo (50MB)
        const videoFileInput = document.getElementById('video_file');
        videoFileInput.addEventListener('change', function() {
            validateFileSize(this, 50, 'vidéo');
        });

        // Validation audio (20MB)
        audioInput.addEventListener('change', function() {
            validateFileSize(this, 20, 'audio');
        });

        // Validation exclusive : soit lien vidéo, soit fichier vidéo
        videoLinkInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                videoFileInput.disabled = true;
                videoFileInput.value = '';
            } else {
                videoFileInput.disabled = false;
            }
        });

        videoFileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                videoLinkInput.disabled = true;
                videoLinkInput.value = '';
            } else {
                videoLinkInput.disabled = false;
            }
        });

        // Auto-détection YouTube/Vimeo
        const videoLinkInput = document.getElementById('lien_video');
        videoLinkInput.addEventListener('blur', function() {
            const url = this.value.trim();
            if (url) {
                let videoId = '';
                let platform = '';
                
                if (url.includes('youtube.com/watch?v=') || url.includes('youtu.be/')) {
                    platform = 'YouTube';
                    if (url.includes('youtube.com/watch?v=')) {
                        videoId = url.split('v=')[1].split('&')[0];
                    } else if (url.includes('youtu.be/')) {
                        videoId = url.split('youtu.be/')[1];
                    }
                } else if (url.includes('vimeo.com/')) {
                    platform = 'Vimeo';
                    videoId = url.split('vimeo.com/')[1];
                }
                
                if (videoId) {
                    console.log(`${platform} ID détecté:`, videoId);

                }
            }
        });
    });
</script>
@endsection
@endsection
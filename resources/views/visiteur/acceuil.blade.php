@extends('layouts.visiteur')

@section('title', 'Accueil - Bénin Culture')

@section('hero-title', 'Découvrez la richesse culturelle du Bénin')
@section('hero-subtitle', 'Explorez les langues, régions et traditions du Bénin')

@section('content')
<div class="row mb-5">
    <div class="col-md-4 mb-4">
        <div class="card language-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-translate display-1 mb-3"></i>
                <h3>Langues</h3>
                <p>Découvrez la diversité linguistique du Bénin avec plus de 50 langues locales.</p>
                <a href="{{ route('langues.index.public') }}" class="btn btn-light">Explorer les langues</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card region-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-geo-alt display-1 mb-3"></i>
                <h3>Régions</h3>
                <p>Explorez les 12 départements et leurs spécificités culturelles.</p>
                <a href="{{ route('regions.index.public') }}" class="btn btn-light">Explorer les régions</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card content-card h-100">
            <div class="card-body text-center">
                <i class="bi bi-file-text display-1 mb-3"></i>
                <h3>Contenus</h3>
                <p>Accédez à une riche bibliothèque de contenus culturels et éducatifs.</p>
                <a href="{{ route('contenus.index.public') }}" class="btn btn-light">Explorer les contenus</a>
            </div>
        </div>
    </div>
</div>

<!-- Langues populaires -->
<div class="row mb-5">
    <div class="col-12">
        <h2 class="mb-4">Langues populaires</h2>
        <div class="row">
            @foreach($languesPopulaires as $langue)
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-chat-square-text text-primary display-6 mb-2"></i>
                        <h5>{{ $langue->nom_langue }}</h5>
                        <p class="text-muted">{{ $langue->code_langue }}</p>
                        <a href="{{ route('langues.show.public', $langue) }}" class="btn btn-outline-primary btn-sm">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Régions -->
<div class="row mb-5">
    <div class="col-12">
        <h2 class="mb-4">Régions du Bénin</h2>
        <div class="row">
            @foreach($regions as $region)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $region->nom_region }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($region->description, 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">
                                <i class="bi bi-people"></i> {{ number_format($region->population, 0, ',', ' ') }}
                            </span>
                            <a href="{{ route('regions.show.public', $region) }}" class="btn btn-primary btn-sm">
                                Découvrir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Contenus récents -->
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Contenus récents</h2>
        <div class="row">
            @foreach($contenusRecents as $contenu)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if($contenu->medias->first())
                                <img src="{{ $contenu->medias->first()->chemin }}" 
                                     class="img-fluid rounded-start h-100" 
                                     alt="{{ $contenu->titre }}"
                                     style="object-fit: cover;">
                            @else
                                <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-white display-4"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($contenu->titre, 50) }}</h5>
                                <p class="card-text">{{ Str::limit(strip_tags($contenu->texte), 100) }}</p>
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt"></i> {{ $contenu->region->nom_region }}
                                    </small>
                                      @if(auth()->check())
        @php
            // Vérifier si la variable $contenu existe
            if (isset($contenu) && $contenu) {
                $hasPaid = App\Models\Paiement::where('contenu_id', $contenu->id)
                    ->where('user_id', auth()->id())
                    ->where('statut', 'completed')
                    ->exists();
            } else {
                $hasPaid = false;
            }
        @endphp
        
        @if($hasPaid)
            <a href="{{ route('contenushow.public', $contenu) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-book"></i> Lire plus
            </a>
        @else
            @if(isset($contenu) && $contenu)
                <a href="{{ route('contenus.paiement.form', $contenu) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-credit-card"></i> Lire plus
                </a>
            @else
                <button type="button" class="btn btn-secondary btn-sm" disabled>
                    <i class="bi bi-credit-card"></i> Indisponible
                </button>
            @endif
        @endif
    @else
        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="bi bi-lock"></i> Lire plus
        </button>
    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
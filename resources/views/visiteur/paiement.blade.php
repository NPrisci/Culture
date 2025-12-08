@extends('layouts.visiteur')

@section('title', 'Paiement - ' . $contenu->titre)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-credit-card"></i> Paiement requis
                    </h4>
                </div>
                
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($contenu->medias->first())
                                <img src="{{ $contenu->medias->first()->chemin }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $contenu->titre }}">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                     style="height: 150px; width: 100%;">
                                    <i class="bi bi-image text-white display-4"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h5>{{ $contenu->titre }}</h5>
                            <p class="text-muted">{{ Str::limit(strip_tags($contenu->texte), 200) }}</p>
                            <div class="mb-2">
                                <span class="badge bg-info">{{ $contenu->typeContenu->nom_contentu }}</span>
                                <span class="badge bg-success">{{ $contenu->region->nom_region }}</span>
                                <span class="badge bg-warning">{{ $contenu->langue->nom_langue }}</span>
                            </div>
                            <p>
                                <strong>Prix d'accès :</strong> 
                                <span class="text-success h4">100 FCFA</span>
                            </p>
                        </div>
                    </div>
                    
                    <form action="{{ route('contenus.paiement.process', $contenu) }}" method="POST" id="paymentForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Numéro de téléphone *</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   placeholder="Ex: 22912345678" required
                                   pattern="229[0-9]{8}"
                                   title="Format: 229 suivi de 8 chiffres (ex: 22912345678)">
                            <div class="form-text">Format: 229XXXXXXXX (sans espaces)</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Méthode de paiement *</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="">Sélectionnez une méthode</option>
                                <option value="mtn">MTN Mobile Money</option>
                                <option value="moov">Moov Money</option>
                                <option value="card">Carte bancaire</option>
                            </select>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> 
                            Après soumission, vous recevrez une demande de paiement sur votre téléphone.
                            Montant à payer : <strong>100 FCFA</strong>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-credit-card"></i> Payer 100 FCFA
                            </button>
                            <a href="{{ route('contenus.index.public') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Retour aux contenus
                            </a>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer">
                    <small class="text-muted">
                        <i class="bi bi-shield-check"></i> Paiement sécurisé par FedaPay
                    </small>
                </div>
            </div>
            
            <!-- Informations de paiement -->
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-question-circle"></i> Comment ça marche ?</h6>
                </div>
                <div class="card-body">
                    <ol class="mb-0">
                        <li>Remplissez le formulaire avec votre numéro de téléphone</li>
                        <li>Choisissez votre méthode de paiement</li>
                        <li>Vous serez redirigé vers FedaPay</li>
                        <li>Validez le paiement de 100 FCFA sur votre mobile</li>
                        <li>Vous serez automatiquement redirigé vers le contenu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('phone');
    
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (!value.startsWith('229') && value.length > 0) {
            value = '229' + value;
        }
        
        if (value.length > 11) {
            value = value.substring(0, 11);
        }
        
        e.target.value = value;
    });
});
</script>
@endpush
@endsection
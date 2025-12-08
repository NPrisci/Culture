<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Manuel - Culture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .payment-card { border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .step-icon { width: 40px; height: 40px; background: #0d6efd; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; }
        .info-box { background: #e7f1ff; border-left: 4px solid #0d6efd; }
        .important { background: #fff3cd; border-left: 4px solid #ffc107; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card payment-card border-0">
                    <div class="card-header bg-primary text-white py-4">
                        <div class="d-flex align-items-center">
                            <div class="step-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                            <div>
                                <h1 class="h3 mb-0">Paiement Manuel Requis</h1>
                                <p class="mb-0 opacity-75">Veuillez suivre les instructions ci-dessous</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Message d'alerte -->
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">Système de paiement temporairement indisponible</h5>
                                <p class="mb-0">Nous rencontrons des difficultés techniques avec notre passerelle de paiement automatique.</p>
                            </div>
                        </div>
                        
                        <!-- Détails de la transaction -->
                        <div class="info-box p-4 mb-4">
                            <h5 class="mb-3"><i class="fas fa-receipt me-2"></i>Détails de la transaction</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Montant :</strong> <span class="text-success fw-bold">{{ $montant ?? 5000 }} FCFA</span></p>
                                    <p><strong>Fréquence :</strong> {{ $frequence ?? 'Mensuel' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date :</strong> {{ $date ?? now()->format('d/m/Y H:i') }}</p>
                                    <p><strong>Référence :</strong> <code>{{ $reference ?? 'AB-' . date('YmdHis') }}</code></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Étapes de paiement -->
                        <h5 class="mb-3"><i class="fas fa-list-ol me-2"></i>Instructions de paiement</h5>
                        <div class="important p-4 mb-4">
                            <div class="d-flex mb-3">
                                <div class="step-icon">
                                    <span>1</span>
                                </div>
                                <div>
                                    <h6 class="mb-1">Effectuez le transfert Mobile Money</h6>
                                    <p class="mb-0">
                                        Transférez <strong>{{ $montant ?? 5000 }} FCFA</strong> au numéro :
                                        <span class="badge bg-success fs-6 ms-2">{{ $numero_paiement ?? '+229 XX XX XX XX' }}</span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-3">
                                <div class="step-icon">
                                    <span>2</span>
                                </div>
                                <div>
                                    <h6 class="mb-1">Notez la référence</h6>
                                    <p class="mb-0">Dans la description du transfert, indiquez : <code>{{ $reference ?? 'AB-' . date('YmdHis') }}</code></p>
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="step-icon">
                                    <span>3</span>
                                </div>
                                <div>
                                    <h6 class="mb-1">Envoyez la confirmation</h6>
                                    <p class="mb-0">Envoyez une capture d'écran du reçu à : <strong>{{ $email_support ?? 'support@culture.com' }}</strong></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Note importante -->
                        <div class="alert alert-info">
                            <div class="d-flex">
                                <i class="fas fa-info-circle fa-2x me-3"></i>
                                <div>
                                    <h6 class="alert-heading">Information importante</h6>
                                    <p class="mb-0">Votre abonnement sera activé manuellement dans les 24 heures suivant la réception de votre paiement. Vous recevrez un email de confirmation.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="mailto:{{ $email_support ?? 'support@culture.com' }}?subject=Paiement%20manuel%20{{ $reference ?? '' }}" 
                               class="btn btn-success btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Contacter le support
                            </a>
                            <div>
                                <a href="{{ url('/') }}" class="btn btn-outline-primary btn-lg me-2">
                                    <i class="fas fa-home me-2"></i>Accueil
                                </a>
                                <button onclick="window.print()" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-print me-2"></i>Imprimer
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light py-3 text-center">
                        <small class="text-muted">
                            <i class="fas fa-phone me-1"></i> Support téléphonique : +229 XX XX XX XX | 
                            <i class="fas fa-clock ms-3 me-1"></i> Lundi - Vendredi, 8h - 18h
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
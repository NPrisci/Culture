@extends('layouts.ap')

@section('content')
<div class="container py-5">

    <div class="card shadow-lg p-4" style="border-radius: 16px;">
        <h3 class="mb-3">Paiement de l’abonnement</h3>

        <p class="mb-1">
            <strong>Email :</strong> {{ $subscription->email }}
        </p>

        <p class="mb-1">
            <strong>Plan :</strong> {{ ucfirst($subscription->plan) }}
        </p>

        <p class="mb-1">
            <strong>Montant :</strong>
            {{ number_format($subscription->amount) }} {{ $subscription->currency }}
        </p>

        <hr>

        <p class="text-muted">
            Cliquez sur le bouton ci-dessous pour procéder au paiement.
        </p>

        <!-- Bouton FedaPay -->
        <button id="payBtn" class="btn btn-primary w-100" style="font-size: 18px; padding: 12px;">
            Payer maintenant
        </button>
    </div>

</div>
@endsection


@section('scripts')
<!-- Widget FedaPay -->
<script src="https://cdn.fedapay.com/checkout.js"></script>

<script>
document.getElementById('payBtn').addEventListener('click', function () {
    FedaPay.init({
        public_key: "{{ config('services.fedapay.public') }}",
        transaction: {
            token: "{{ $token }}",
        },
        // callback après paiement
        onComplete: function (response) {
            console.log("Paiement terminé :", response);

            // redirection vers une route Laravel
            window.location.href = "{{ route('payment.success', $subscription->id) }}";
        },
        onError: function (error) {
            console.error("Erreur paiement :", error);
            alert("Impossible de lancer le paiement. Vérifiez votre connexion.");
        }
    });

    FedaPay.open();
});
</script>
@endsection

@extends('layouts.visiteur')

@section('title', 'Paiement réussi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success display-1"></i>
                    </div>
                    <h2 class="card-title mb-3">Paiement réussi !</h2>
                    <p class="card-text mb-4">
                        Vous avez payé <strong>100 FCFA</strong> avec succès.
                        Vous pouvez maintenant accéder au contenu.
                    </p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('contenus.show.public', $contenu) }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-book"></i> Accéder au contenu
                        </a>
                        <a href="{{ route('contenus.index.public') }}" class="btn btn-outline-secondary">
                            Retour à la liste
                        </a>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Une confirmation a été envoyée à votre email.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'À propos | Culture Bénin')

@section('content')

<section id="about" class="about section">

    <div class="container" data-aos="fade-up">

        <div class="row align-items-center">

            <div class="col-lg-6">
                <h2 class="section-heading mb-4">À propos du Bénin</h2>
                <p class="lead-text">
                    Le Bénin est un pays riche en culture, traditions, langues et diversité artistique.
                    Berceau du royaume du Danxomè et centre historique du culte Vodoun.
                </p>
                <p>
                    Notre plateforme met en lumière l’héritage culturel béninois à travers les arts, les langues,
                    les rites, les célébrations, les rois et les royaumes légendaires.
                </p>

                <a href="{{ url('/services') }}" class="btn btn-primary mt-3">
                    Découvrir les richesses culturelles
                </a>
            </div>

            <div class="col-lg-6">
                <img src="{{ asset('assets/img/construction/project-4.webp') }}" class="img-fluid rounded">
            </div>

        </div>

    </div>

</section>

@endsection

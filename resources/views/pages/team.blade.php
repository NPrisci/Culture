@extends('layouts.app')

@section('title', 'Acteurs de la Culture | Culture Bénin')

@section('content')

<section id="team" class="team section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Figures culturelles</h2>
        <p>Les personnes qui préservent et transmettent le patrimoine béninois</p>
    </div>

    <div class="container">

        <div class="row gy-5">

            <div class="col-lg-4 col-md-6">
                <div class="team-member">
                    <img src="{{ asset('assets/img/construction/team-1.webp') }}" class="img-fluid">
                    <div class="member-info mt-3">
                        <h4>Maître Tola</h4>
                        <span>Artisan sculpteur</span>
                        <p>Connu pour ses statues traditionnelles Fon et Yoruba.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="team-member">
                    <img src="{{ asset('assets/img/construction/team-3.webp') }}" class="img-fluid">
                    <div class="member-info mt-3">
                        <h4>Yayi Houénou</h4>
                        <span>Historienne culturelle</span>
                        <p>Spécialiste de l’histoire du Danxomè et des amazones.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="team-member">
                    <img src="{{ asset('assets/img/construction/team-5.webp') }}" class="img-fluid">
                    <div class="member-info mt-3">
                        <h4>Baba Sossa</h4>
                        <span>Prêtre Vodoun</span>
                        <p>Grand connaisseur des rites et traditions ancestrales.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection

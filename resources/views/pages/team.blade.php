@extends('layouts.ap')

@section('title', 'Acteurs de la Culture | Culture Bénin')

@section('content')

<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('assets/img/construction/drapeau.jpg') }});">
  <div class="container position-relative">
    
        <h2>Figures culturelles</h2>
        <p>Les personnes qui préservent et transmettent le patrimoine béninois</p>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="current">Communauté</li>
      </ol>
    </nav>
  </div>
</div>

<section id="team" class="team section">

    <div class="container section-title" data-aos="fade-up">
    </div>

    <div class="container">

        <div class="row gy-5">

            <div class="col-lg-4 col-md-6">
                <div class="team-member">
                    <img src="{{ asset('assets/img/construction/team2.webp') }}" class="img-fluid">
                    <div class="member-info mt-3">
                        <h4>Maître Tola</h4>
                        <span>Artisan sculpteur</span>
                        <p>Connu pour ses statues traditionnelles Fon et Yoruba.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="team-member">
                    <img src="{{ asset('assets/img/construction/team3.webp') }}" class="img-fluid">
                    <div class="member-info mt-3">
                        <h4>Yayi Houénou</h4>
                        <span>Historienne culturelle</span>
                        <p>Spécialiste de l’histoire du Danxomè et des amazones.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="team-member">
                    <img src="{{ asset('assets/img/construction/team5.jpg') }}" class="img-fluid">
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

@extends('layouts.ap')

@section('title', 'Services culturels | Culture Bénin')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('assets/img/construction/drapeau.jpg') }});">
  <div class="container position-relative">
    
        <h2>Richesses Culturelles</h2>
        <p>Explorez les grandes dimensions culturelles du Bénin</p>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="current">Galerie</li>
      </ol>
    </nav>
  </div>
</div>

<section id="services" class="services section light-background">

    <div class="container section-title" data-aos="fade-up">
    </div>

    <div class="container">

        <div class="services-grid">

            <div class="service-item">
                <h3>Langues du Bénin</h3>
                <p>Fon, Yoruba, Dendi, Mina, Lokpa, Adja, Bariba…</p>
                <a href="{{ url('/service-details') }}" class="service-cta">
                    En savoir plus
                </a>
            </div>

            <div class="service-item">
                <h3>Royaumes & Histoire</h3>
                <p>Danxomè, Nikki, Porto-Novo, Allada…</p>
                <a href="{{ url('/service-details') }}" class="service-cta">
                    Explorer
                </a>
            </div>

            <div class="service-item">
                <h3>Art et Artisanat</h3>
                <p>Masques, sculptures, textiles, bronzes, perles…</p>
                <a href="{{ url('/service-details') }}" class="service-cta">
                    Voir les artisans
                </a>
            </div>

            <div class="service-item">
                <h3>Culture Vodoun</h3>
                <p>Rites, divinités, cérémonies, temples sacrés…</p>
                <a href="{{ url('/service-details') }}" class="service-cta">
                    Découvrir
                </a>
            </div>

        </div>
    </div>

</section>

@endsection

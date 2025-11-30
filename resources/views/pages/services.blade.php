@extends('layouts.app')

@section('title', 'Services culturels | Culture Bénin')

@section('content')

<section id="services" class="services section light-background">

    <div class="container section-title" data-aos="fade-up">
        <h2>Richesses Culturelles</h2>
        <p>Explorez les grandes dimensions culturelles du Bénin</p>
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

@extends('layouts.ap')

@section('title', 'À propos | Culture Bénin')

@section('content')

<!-- ======= Page Title (même style que Contact) ======= -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('assets/img/construction/drapeau.jpg') }});">
  <div class="container position-relative">
    <h1>À propos</h1>
    <p>Découvrez l'histoire, les valeurs et la mission qui portent Culture Bénin.</p>

    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li class="current">À propos</li>
      </ol>
    </nav>
  </div>
</div>

<!-- ======= About Section ======= -->
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
        <img src="{{ asset('assets/img/construction/benin.webp') }}" class="img-fluid rounded" alt="À propos du Bénin">
      </div>

    </div>

  </div>
</section>

<!-- ======= Values Section ======= -->
<section id="values" class="values section light-background">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Nos Valeurs</h2>
      <p>Les principes qui guident notre action au quotidien</p>
    </div>

    <div class="row gy-4">

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="value-card">
          <div class="value-icon">
            <i class="bi bi-heart-fill"></i>
          </div>
          <h3>Respect</h3>
          <p>Respect des traditions, des communautés et des pratiques culturelles dans leur diversité et leur authenticité.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="value-card">
          <div class="value-icon">
            <i class="bi bi-shield-check"></i>
          </div>
          <h3>Intégrité</h3>
          <p>Approche éthique et transparente dans la documentation et la présentation du patrimoine culturel.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="value-card">
          <div class="value-icon">
            <i class="bi bi-people-fill"></i>
          </div>
          <h3>Collaboration</h3>
          <p>Travail en partenariat avec les communautés locales, les experts et les institutions culturelles.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ======= History Section ======= -->
<section id="history" class="history section">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Notre Histoire</h2>
      <p>Un parcours dédié à la culture béninoise depuis 2010</p>
    </div>

    <div class="timeline" data-aos="fade-up">

      <div class="timeline-item" data-aos="fade-right">
        <div class="timeline-year">2010</div>
        <div class="timeline-content">
          <h4>Fondation</h4>
          <p>Création de Culture Bénin par un groupe d'anthropologues passionnés.</p>
        </div>
      </div>

      <div class="timeline-item" data-aos="fade-left">
        <div class="timeline-year">2013</div>
        <div class="timeline-content">
          <h4>Premier Inventaire</h4>
          <p>Réalisation du premier inventaire complet des sites culturels du Sud Bénin.</p>
        </div>
      </div>

      <div class="timeline-item" data-aos="fade-right">
        <div class="timeline-year">2016</div>
        <div class="timeline-content">
          <h4>Reconnaissance UNESCO</h4>
          <p>Participation active au classement de sites béninois au patrimoine mondial.</p>
        </div>
      </div>

      <div class="timeline-item" data-aos="fade-left">
        <div class="timeline-year">2020</div>
        <div class="timeline-content">
          <h4>Plateforme Numérique</h4>
          <p>Lancement de la plateforme digitale pour un accès global à la culture béninoise.</p>
        </div>
      </div>

    </div>

  </div>
</section>

@endsection

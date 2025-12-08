@extends('layouts.ap')

@section('title', 'Détails du Patrimoine | Culture Bénin')

@section('content')
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('assets/img/construction/drapeau.jpg') }});">
  <div class="container position-relative">
    <h1>Détails du Patrimoine</h1>
    <p>Découvrez l'histoire, les valeurs et la mission qui portent Culture Bénin.</p>

    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li class="current">Détails du Patrimoine</li>
      </ol>
    </nav>
  </div>
</div>

<section id="project-details" class="project-details section">

    <div class="container" data-aos="fade-up">

        <h2 class="mb-4">Palais Royal d’Abomey</h2>

        <div class="row gy-4">

            <div class="col-lg-8">
                <img src="{{ asset('assets/img/construction/project-3.webp') }}" class="img-fluid rounded mb-4">

                <p>
                    Le Palais Royal d’Abomey est l’un des sites les plus importants du Bénin.
                    Il fut le centre politique du Royaume du Danxomè et abrite encore aujourd’hui
                    des symboles puissants de l’identité et de la résistance béninoise.
                </p>

                <p>
                    Inscrit au patrimoine mondial de l’UNESCO, le palais est composé de plusieurs musées,
                    temples et salles royales retraçant les traditions des rois Houégbadja, Agadja,
                    Guézo, Glèlè et Béhanzin.
                </p>
            </div>

            <div class="col-lg-4">
                <div class="info-box p-3 border rounded">
                    <h4>Informations</h4>
                    <ul class="list-unstyled">
                        <li><strong>Localisation :</strong> Abomey</li>
                        <li><strong>Période :</strong> XVIIe - XIXe siècle</li>
                        <li><strong>Classement :</strong> UNESCO</li>
                        <li><strong>Thème :</strong> Royaume du Danxomè</li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection

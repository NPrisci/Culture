@extends('layouts.ap')

@section('title', 'Patrimoine & Sites historiques | Culture Bénin')

@section('content')
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('assets/img/construction/drapeau.jpg') }});">
  <div class="container position-relative">
     <h2>Sites historiques & Patrimoine</h2>
        <p>Découvrez les lieux symboliques qui racontent l’histoire du Bénin</p>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ url('/') }}">Accueil</a></li>
        <li class="current">Patrimoine</li>
      </ol>
    </nav>
  </div>
</div>

<section id="projects" class="projects section">

    <div class="container section-title" data-aos="fade-up">
        
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

            <div class="col-lg-4 col-md-6">
                <div class="project-card">
                    <div class="project-image">
                        <img src="{{ asset('assets/img/construction/non-retour1.webp') }}" class="img-fluid">
                        <div class="project-overlay">
                            <a href="{{ url('/project-details') }}" class="btn-project">Voir détails</a>
                        </div>
                    </div>
                    <div class="project-info">
                        <h4 class="project-title">La Porte du Non-Retour</h4>
                        <p>Mémorial emblématique de Ouidah retraçant la traite négrière.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="project-card">
                    <div class="project-image">
                        <img src="{{ asset('assets/img/construction/abomey1.webp') }}" class="img-fluid">
                        <div class="project-overlay">
                            <a href="{{ url('/project-details') }}" class="btn-project">Voir détails</a>
                        </div>
                    </div>
                    <div class="project-info">
                        <h4 class="project-title">Le Palais Royal d’Abomey</h4>
                        <p>Patrimoine mondial de l’UNESCO et ancien siège du Danxomè.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="project-card">
                    <div class="project-image">
                        <img src="{{ asset('assets/img/construction/project-11.webp') }}" class="img-fluid">
                        <div class="project-overlay">
                            <a href="{{ url('/project-details') }}" class="btn-project">Voir détails</a>
                        </div>
                    </div>
                    <div class="project-info">
                        <h4 class="project-title">La Route des Esclaves</h4>
                        <p>Parcours historique retraçant les derniers pas des esclaves.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection

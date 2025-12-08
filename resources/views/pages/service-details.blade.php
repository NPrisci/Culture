@extends('layouts.ap')

@section('title', 'À propos | Culture Bénin')

@section('content')
    <!-- Page Title -->
    <section class="page-title-section dark-background">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-title-content text-center">
              <h1 data-aos="fade-up">Architecture Traditionnelle</h1>
              <p data-aos="fade-up" data-aos-delay="100">L'art de bâtir à travers les âges au Bénin</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Hero Image -->
    <section class="service-hero-image">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="hero-image-container" data-aos="zoom-in">
              <img src="assets/img/culture/architecture-hero.webp" alt="Architecture Béninoise" class="img-fluid w-100">
              <div class="hero-overlay">
                <div class="hero-badge">
                  <i class="bi bi-award"></i>
                  Patrimoine UNESCO
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contenu Principal -->
    <section class="service-content section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="main-content">
              <h2 data-aos="fade-up">L'Héritage Architectural du Bénin</h2>
              <p data-aos="fade-up" data-aos-delay="100" class="lead">L'architecture traditionnelle béninoise témoigne d'un savoir-faire ancestral et d'une adaptation remarquable aux contraintes environnementales et culturelles. Des palais royaux aux cases sacrées, chaque construction raconte une partie de l'histoire du peuple béninois et incarne l'ingéniosité de nos ancêtres.</p>

              <div class="content-section" data-aos="fade-up" data-aos-delay="200">
                <h3><i class="bi bi-building me-2"></i>Palais Royaux d'Abomey</h3>
                <p>Les palais royaux d'Abomey, classés au patrimoine mondial de l'UNESCO depuis 1985, représentent l'apogée de l'architecture traditionnelle fon. Construits entre le XVIIe et le XIXe siècle, ces ensembles architecturaux témoignent de la puissance et de la sophistication du royaume du Dahomey.</p>
                
                <div class="architecture-features mt-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="feature-highlight">
                        <i class="bi bi-bricks text-primary"></i>
                        <div>
                          <h5>Construction en Terre</h5>
                          <p>Murs en terre stabilisée décorés de bas-reliefs symboliques racontant l'histoire du royaume</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="feature-highlight">
                        <i class="bi bi-diagram-3 text-primary"></i>
                        <div>
                          <h5>Organisation Spatiale</h5>
                          <p>Cours intérieures organisées hiérarchiquement selon les fonctions et le statut social</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="feature-highlight">
                        <i class="bi bi-shield-check text-primary"></i>
                        <div>
                          <h5>Systèmes Défensifs</h5>
                          <p>Murailles impressionnantes et dispositifs de protection sophistiqués</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="feature-highlight">
                        <i class="bi bi-gear text-primary"></i>
                        <div>
                          <h5>Fonctionnalité</h5>
                          <p>Espaces cérémoniels, administratifs et résidentiels clairement distincts</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-section" data-aos="fade-up" data-aos-delay="300">
                <h3><i class="bi bi-house-door me-2"></i>Cases Tata Somba</h3>
                <p>L'architecture vernaculaire des Tata Somba, dans le nord-ouest du Bénin, est un exemple remarquable d'adaptation à l'environnement. Ces maisons-forteresses en terre, uniques en Afrique de l'Ouest, représentent une solution ingénieuse aux défis climatiques et sécuritaires.</p>
                
                <div class="features-grid mt-4">
                  <div class="row text-center">
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                      <div class="feature-item">
                        <div class="feature-icon">
                          <i class="bi bi-house-check"></i>
                        </div>
                        <h5>Structure Défensive</h5>
                        <p>Maisons-forteresses avec étages et meurtrières pour la protection</p>
                      </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                      <div class="feature-item">
                        <div class="feature-icon">
                          <i class="bi bi-thermometer-sun"></i>
                        </div>
                        <h5>Régulation Thermique</h5>
                        <p>Murs épais en terre assurant une isolation naturelle contre la chaleur</p>
                      </div>
                    </div>
                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                      <div class="feature-item">
                        <div class="feature-icon">
                          <i class="bi bi-people"></i>
                        </div>
                        <h5>Organisation Familiale</h5>
                        <p>Espaces distincts pour les humains et les animaux dans un même ensemble</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-section" data-aos="fade-up" data-aos-delay="400">
                <h3><i class="bi bi-water me-2"></i>Architecture Lacustre de Ganvié</h3>
                <p>Surnommée "la Venise de l'Afrique", Ganvié est le plus grand village lacustre d'Afrique. Son architecture unique sur pilotis représente une adaptation exceptionnelle à l'environnement aquatique du lac Nokoué.</p>
                
                <div class="architecture-types mt-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="type-card">
                        <h5>Maisons sur Pilotis</h5>
                        <p>Construction sur des pieux en bois avec accès par pirogue</p>
                        <ul>
                          <li>Matériaux locaux : bois, bambou, paille</li>
                          <li>Toits de chaume pentus</li>
                          <li>Planchers surélevés contre les inondations</li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="type-card">
                        <h5>Infrastructures Flottantes</h5>
                        <p>Marchés, écoles et lieux de culte adaptés au milieu aquatique</p>
                        <ul>
                          <li>Écoles sur plateformes flottantes</li>
                          <li>Marchés en pleine eau</li>
                          <li>Lieux de culte centraux</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="content-section" data-aos="fade-up" data-aos-delay="500">
                <h3><i class="bi bi-tools me-2"></i>Techniques de Construction</h3>
                <p>Les techniques de construction traditionnelles au Bénin reposent sur l'utilisation de matériaux locaux et de savoir-faire transmis de génération en génération.</p>
                
                <div class="techniques-grid">
                  <div class="technique-item">
                    <h5>Terre Crue</h5>
                    <p>Utilisation de la terre stabilisée avec des liants naturels pour une construction durable et écologique</p>
                  </div>
                  <div class="technique-item">
                    <h5>Bois et Végétaux</h5>
                    <p>Exploitation raisonnée des ressources forestières pour les charpentes et les toitures</p>
                  </div>
                  <div class="technique-item">
                    <h5>Ventilation Naturelle</h5>
                    <p>Conception bioclimatique optimisant les courants d'air et l'éclairage naturel</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="sidebar">
              <div class="info-card" data-aos="fade-left">
                <h4><i class="bi bi-info-circle me-2"></i>Informations Clés</h4>
                <div class="info-group">
                  <div class="info-item">
                    <strong>Période :</strong>
                    <span>XVIIe - XXIe siècle</span>
                  </div>
                  <div class="info-item">
                    <strong>Régions :</strong>
                    <span>Tout le Bénin</span>
                  </div>
                  <div class="info-item">
                    <strong>Matériaux Principaux :</strong>
                    <span>Terre, bois, paille, pierre</span>
                  </div>
                  <div class="info-item">
                    <strong>Statut UNESCO :</strong>
                    <span class="unesco-status">Classé (Abomey)</span>
                  </div>
                  <div class="info-item">
                    <strong>Styles Majeurs :</strong>
                    <span>Fon, Somba, Lacustre</span>
                  </div>
                </div>
              </div>

              <div class="cta-card" data-aos="fade-left" data-aos-delay="100">
                <h4><i class="bi bi-calendar-check me-2"></i>Visitez les Sites</h4>
                <p>Organisez votre visite guidée des sites architecturaux remarquables du Bénin avec nos experts en patrimoine.</p>
                <a href="quote.html" class="btn-primary w-100 mb-3">
                  <span>Planifier une visite</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
                <small class="text-muted">Visites disponibles toute l'année</small>
              </div>

              <div class="resources-card" data-aos="fade-left" data-aos-delay="200">
                <h4><i class="bi bi-journal-text me-2"></i>Ressources</h4>
                <ul class="resources-list">
                  <li><a href="#"><i class="bi bi-file-pdf"></i> Guide architectural (PDF)</a></li>
                  <li><a href="#"><i class="bi bi-camera-video"></i> Documentaire vidéo</a></li>
                  <li><a href="#"><i class="bi bi-map"></i> Carte des sites</a></li>
                  <li><a href="#"><i class="bi bi-book"></i> Bibliographie</a></li>
                </ul>
              </div>

              <div class="expert-card" data-aos="fade-left" data-aos-delay="300">
                <h4><i class="bi bi-person-gear me-2"></i>Expert du Patrimoine</h4>
                <div class="expert-info">
                  <img src="assets/img/culture/expert-architecture.webp" alt="Expert Architecture" class="expert-photo">
                  <div class="expert-details">
                    <h5>Dr. Kossi Adé</h5>
                    <p>Archéologue et spécialiste de l'architecture traditionnelle ouest-africaine</p>
                    <a href="team.html" class="expert-link">Voir le profil</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Galerie Associée -->
    <section class="related-gallery section light-background">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Galerie d'Architecture</h2>
          <p>Quelques exemples remarquables du patrimoine architectural béninois</p>
        </div>
        
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="gallery-item">
              <img src="assets/img/culture/architecture-palais.webp" alt="Palais Royal" class="img-fluid">
              <div class="gallery-caption">
                <h5>Palais Royal d'Abomey</h5>
                <span>Architecture Fon classée UNESCO</span>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="gallery-item">
              <img src="assets/img/culture/architecture-tata.webp" alt="Case Tata" class="img-fluid">
              <div class="gallery-caption">
                <h5>Case Tata Somba</h5>
                <span>Architecture défensive du Nord-Bénin</span>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="gallery-item">
              <img src="assets/img/culture/architecture-ganvie.webp" alt="Ganvié" class="img-fluid">
              <div class="gallery-caption">
                <h5>Village Lacustre de Ganvié</h5>
                <span>Architecture sur pilotis unique</span>
              </div>
            </div>
          </div>
        </div>
        
        <div class="text-center mt-5" data-aos="fade-up">
          <a href="projects.html" class="btn-secondary">
            <span>Voir toute la galerie</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Navigation entre pages -->
    <section class="page-navigation section">
      <div class="container">
        <div class="row">
          <div class="col-6">
            <a href="services.html" class="nav-link prev">
              <i class="bi bi-arrow-left"></i>
              <div>
                <span>Précédent</span>
                <strong>Retour au Patrimoine</strong>
              </div>
            </a>
          </div>
          <div class="col-6 text-end">
            <a href="project-details.html" class="nav-link next">
              <div>
                <span>Suivant</span>
                <strong>Artisanat Traditionnel</strong>
              </div>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </section>


@endsection

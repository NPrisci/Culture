@extends('layouts.app')

@section('title', 'Accueil | Culture Bénin')

@section('content')

    {{-- HERO --}}
    <section id="hero" class="hero section dark-background">

        <div class="hero-video-container">
            <video autoplay muted loop>
                <source src="{{ asset('assets/img/construction/video-2.mp4') }}" type="video/mp4">
            </video>
            <div class="hero-overlay"></div>
        </div>

        <div class="container" data-aos="fade-up">
           <div class="row justify-content-center text-center">
          <div class="col-lg-8">
            <div class="hero-content">
              <h1 data-aos="fade-up" data-aos-delay="200">Découvrez la Richesse Culturelle du Bénin</h1>
              <p data-aos="fade-up" data-aos-delay="300">Plongez au cœur des traditions ancestrales, de l'histoire fascinante et du patrimoine unique du Bénin. Explorez la diversité culturelle qui fait la renommée de cette terre d'accueil et de spiritualité.</p>

              <div class="hero-actions" data-aos="fade-up" data-aos-delay="400">
                <a href="quote.html" class="btn btn-primary">Visiter le Bénin</a>
                <a href="projects.html" class="btn btn-secondary">Galerie Culturelle</a>
              </div>

              <div class="hero-stats" data-aos="fade-up" data-aos-delay="500">
                <div class="row">
                  <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                      <span class="stat-number" data-purecounter-start="0" data-purecounter-end="60" data-purecounter-duration="2">60</span>
                      <span class="stat-label">Groupes Ethniques</span>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                      <span class="stat-number" data-purecounter-start="0" data-purecounter-end="2" data-purecounter-duration="2">2</span>
                      <span class="stat-label">Sites UNESCO</span>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                      <span class="stat-number" data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="2">50</span>
                      <span class="stat-label">Festivals Annuels</span>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                      <span class="stat-number" data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="2">12</span>
                      <span class="stat-label">Royaumes Historiques</span>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        </div>
    </section>

    {{-- ABOUT --}}
   <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">

          <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
            <div class="content">
              <h2 class="section-heading mb-4">Une Culture Millénaire, Une Identité Unique</h2>
              <p class="lead-text mb-4">Le Bénin, berceau du Vodoun et terre des royaumes historiques, possède un patrimoine culturel d'une richesse exceptionnelle qui continue de fasciner le monde entier.</p>
              <p class="description-text mb-5">De la Route des Esclaves à Ouidah aux palais royaux d'Abomey, en passant par les traditions vivantes des peuples du Nord, la culture béninoise est un témoignage vivant de l'histoire et de la résilience des peuples africains. Notre mission est de préserver et de partager ce trésor culturel avec les générations futures.</p>

              <div class="stats-grid">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                  <div class="stat-number">12+</div>
                  <div class="stat-label">Royaumes Historiques</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="350">
                  <div class="stat-number">60+</div>
                  <div class="stat-label">Langues Parlées</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                  <div class="stat-number">2</div>
                  <div class="stat-label">Sites UNESCO</div>
                </div>
              </div>

              <div class="cta-section" data-aos="fade-up" data-aos-delay="450">
                <a href="#services" class="cta-link">
                  Explorer notre Patrimoine
                  <i class="bi bi-arrow-right ms-2"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="200">
            <div class="image-section">
              <div class="main-image">
                <img src="assets/img/construction/amazone2.jpg" alt="Portrait traditionnel béninois" class="img-fluid">
              </div>
              <div class="floating-badge" data-aos="zoom-in" data-aos-delay="500">
                <div class="badge-content">
                  <i class="bi bi-award"></i>
                  <div class="badge-text">
                    <span class="badge-title">Patrimoine UNESCO</span>
                    <span class="badge-subtitle">Depuis 1985</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Patrimoine Culturel</h2>
        <p>Découvrez les trésors culturels qui font la renommée du Bénin à travers le monde</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="services-grid">

          <div class="service-item" data-aos="fade-up" data-aos-delay="150">
            <div class="service-number">01</div>
            <div class="service-icon">
              <i class="bi bi-buildings"></i>
            </div>
            <h3>Patrimoine Architectural</h3>
            <p>Découvrez les palais royaux, les cases sacrées et l'architecture traditionnelle qui racontent l'histoire des royaumes béninois.</p>
            <a href="service-details.html" class="service-cta">
              <span>Explorer</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>

          <div class="service-item" data-aos="fade-up" data-aos-delay="200">
            <div class="service-number">02</div>
            <div class="service-icon">
              <i class="bi bi-music-note-beamed"></i>
            </div>
            <h3>Arts & Musique</h3>
            <p>Explorez la richesse des expressions artistiques béninoises, des rythmes traditionnels aux œuvres contemporaines.</p>
            <a href="service-details.html" class="service-cta">
              <span>Explorer</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>

          <div class="service-item featured" data-aos="fade-up" data-aos-delay="250">
            <div class="featured-badge">Spécial</div>
            <div class="service-number">03</div>
            <div class="service-icon">
              <i class="bi bi-gear-wide-connected"></i>
            </div>
            <h3>Traditions Vodoun</h3>
            <p>Plongez dans l'univers spirituel du Vodoun, patrimoine immatériel unique au monde et pilier de la culture béninoise.</p>
            <a href="quote.html" class="service-cta">
              <span>En savoir plus</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>

          <div class="service-item" data-aos="fade-up" data-aos-delay="300">
            <div class="service-number">04</div>
            <div class="service-icon">
              <i class="bi bi-basket"></i>
            </div>
            <h3>Artisanat Local</h3>
            <p>Admirez le savoir-faire exceptionnel des artisans béninois à travers le tissage, la poterie, la vannerie et la sculpture.</p>
            <a href="service-details.html" class="service-cta">
              <span>Explorer</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>

          <div class="service-item" data-aos="fade-up" data-aos-delay="350">
            <div class="service-number">05</div>
            <div class="service-icon">
              <i class="bi bi-calendar-event"></i>
            </div>
            <h3>Festivals & Célébrations</h3>
            <p>Participez aux festivals colorés et aux cérémonies traditionnelles qui rythment la vie culturelle béninoise.</p>
            <a href="service-details.html" class="service-cta">
              <span>Explorer</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>

          <div class="service-item" data-aos="fade-up" data-aos-delay="400">
            <div class="service-number">06</div>
            <div class="service-icon">
              <i class="bi bi-book"></i>
            </div>
            <h3>Histoire & Mémoire</h3>
            <p>Retracez l'histoire fascinante du Bénin, de la période précoloniale à l'indépendance et au-delà.</p>
            <a href="service-details.html" class="service-cta">
              <span>Explorer</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Services Alt Section -->
    <section id="services-alt" class="services-alt section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-5">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item">
              <div class="service-visual">
                <img src="assets/img/construction/non-retour1.webp" alt="Route des Esclaves à Ouidah" class="img-fluid">
              </div>
              <div class="service-content">
                <h3>Route des Esclaves</h3>
                <p>Parcourez le chemin historique de Ouidah, site mémoriel de la traite négrière et lieu de réconciliation. Ce parcours émouvant relie les anciens comptoirs aux portes de non-retour sur la côte atlantique.</p>
                <a href="#" class="service-link">
                  <span>En savoir plus</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item 1 -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-visual">
                <img src="assets/img/construction/lacustre2.webp" alt="Village lacustre de Ganvié" class="img-fluid">
              </div>
              <div class="service-content">
                <h3>Ganvié - La Venise Africaine</h3>
                <p>Découvrez le plus grand village lacustre d'Afrique, construit sur pilotis au milieu du lac Nokoué. Cette merveille d'adaptation humaine est classée au patrimoine mondial de l'UNESCO.</p>
                <a href="#" class="service-link">
                  <span>En savoir plus</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item 2 -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item">
              <div class="service-visual">
                <img src="assets/img/construction/pendjari1.jpg" alt="Parc de la Pendjari" class="img-fluid">
              </div>
              <div class="service-content">
                <h3>Parc National de la Pendjari</h3>
                <p>Explorez l'une des plus importantes réserves animalières d'Afrique de l'Ouest, sanctuaire de la biodiversité et lieu de traditions de chasse ancestrales des populations locales.</p>
                <a href="#" class="service-link">
                  <span>En savoir plus</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item 3 -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="350">
            <div class="service-item">
              <div class="service-visual">
                <img src="assets/img/construction/abomey1.webp" alt="Palais royaux d'Abomey" class="img-fluid">
              </div>
              <div class="service-content">
                <h3>Palais Royaux d'Abomey</h3>
                <p>Visitez les anciens palais des rois du Dahomey, site UNESCO qui témoigne de la puissance et du raffinement de l'un des plus grands royaumes d'Afrique précoloniale.</p>
                <a href="#" class="service-link">
                  <span>En savoir plus</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item 4 -->

        </div>

        <div class="row mt-5" data-aos="fade-up" data-aos-delay="400">
          <div class="col-lg-12 text-center">
            <div class="cta-section">
              <h4>Prêt à découvrir le Bénin?</h4>
              <p>Contactez-nous pour organiser votre voyage culturel au cœur des traditions béninoises.</p>
              <a href="quote.html" class="btn-primary">
                <span>Planifier ma visite</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Alt Section -->

    <!-- Projects Section -->
    <section id="projects" class="projects section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Galerie Culturelle</h2>
        <p>Explorez la diversité et la beauté des expressions culturelles béninoises</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="project-card">
              <div class="project-image">
                <img src="assets/img/construction/masque3.webp" alt="Masques traditionnels" class="img-fluid">
                <div class="project-overlay">
                  <div class="project-status completed">Patrimoine</div>
                  <div class="project-actions">
                    <a href="project-details.html" class="btn-project">Voir détails</a>
                  </div>
                </div>
              </div>
              <div class="project-info">
                <div class="project-category">Arts Traditionnels</div>
                <h4 class="project-title">Masques & Statues</h4>
                <p class="project-description">Collection exceptionnelle de masques cérémoniels et statues rituelles des différentes ethnies béninoises.</p>
                <div class="project-meta">
                  <span class="location"><i class="bi bi-geo-alt"></i> Tout le Bénin</span>
                  <span class="timeline"><i class="bi bi-calendar"></i> Patrimoine vivant</span>
                </div>
              </div>
            </div>
          </div><!-- End Project Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="project-card">
              <div class="project-image">
                <img src="assets/img/construction/festival3.webp" alt="Festival Vodoun" class="img-fluid">
                <div class="project-overlay">
                  <div class="project-status in-progress">Annuel</div>
                  <div class="project-actions">
                    <a href="project-details.html" class="btn-project">Voir détails</a>
                  </div>
                </div>
              </div>
              <div class="project-info">
                <div class="project-category">Festivals</div>
                <h4 class="project-title">Fête du Vodoun</h4>
                <p class="project-description">Célébration annuelle du patrimoine spirituel vodoun avec danses, rituels et processions colorées.</p>
                <div class="project-meta">
                  <span class="location"><i class="bi bi-geo-alt"></i> Ouidah, Bénin</span>
                  <span class="timeline"><i class="bi bi-calendar"></i> 10 Janvier</span>
                </div>
              </div>
            </div>
          </div><!-- End Project Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="project-card">
              <div class="project-image">
                <img src="assets/img/construction/textile2.webp" alt="Textiles béninois" class="img-fluid">
                <div class="project-overlay">
                  <div class="project-status completed">Artisanat</div>
                  <div class="project-actions">
                    <a href="project-details.html" class="btn-project">Voir détails</a>
                  </div>
                </div>
              </div>
              <div class="project-info">
                <div class="project-category">Textiles</div>
                <h4 class="project-title">Tissages Traditionnels</h4>
                <p class="project-description">Techniques ancestrales de tissage et teinture qui produisent des étoffes uniques et symboliques.</p>
                <div class="project-meta">
                  <span class="location"><i class="bi bi-geo-alt"></i> Abomey, Bénin</span>
                  <span class="timeline"><i class="bi bi-calendar"></i> Patrimoine vivant</span>
                </div>
              </div>
            </div>
          </div><!-- End Project Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="project-card">
              <div class="project-image">
                <img src="assets/img/construction/cuisine1.webp" alt="Cuisine béninoise" class="img-fluid">
                <div class="project-overlay">
                  <div class="project-status completed">Gastronomie</div>
                  <div class="project-actions">
                    <a href="project-details.html" class="btn-project">Voir détails</a>
                  </div>
                </div>
              </div>
              <div class="project-info">
                <div class="project-category">Arts Culinaires</div>
                <h4 class="project-title">Saveurs du Bénin</h4>
                <p class="project-description">Découverte des plats traditionnels et techniques culinaires qui racontent l'histoire des régions.</p>
                <div class="project-meta">
                  <span class="location"><i class="bi bi-geo-alt"></i> Tout le Bénin</span>
                  <span class="timeline"><i class="bi bi-calendar"></i> Patrimoine vivant</span>
                </div>
              </div>
            </div>
          </div><!-- End Project Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="project-card">
              <div class="project-image">
                <img src="assets/img/construction/musique.webp" alt="Musique traditionnelle" class="img-fluid">
                <div class="project-overlay">
                  <div class="project-status planning">Spectacles</div>
                  <div class="project-actions">
                    <a href="project-details.html" class="btn-project">Voir détails</a>
                  </div>
                </div>
              </div>
              <div class="project-info">
                <div class="project-category">Arts Scéniques</div>
                <h4 class="project-title">Rythmes & Danses</h4>
                <p class="project-description">Expressions chorégraphiques et musicales qui accompagnent les cérémonies et célébrations.</p>
                <div class="project-meta">
                  <span class="location"><i class="bi bi-geo-alt"></i> Tout le Bénin</span>
                  <span class="timeline"><i class="bi bi-calendar"></i> Événements réguliers</span>
                </div>
              </div>
            </div>
          </div><!-- End Project Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="project-card">
              <div class="project-image">
                <img src="assets/img/construction/archi.jpg" alt="Architecture traditionnelle" class="img-fluid">
                <div class="project-overlay">
                  <div class="project-status completed">Architecture</div>
                  <div class="project-actions">
                    <a href="project-details.html" class="btn-project">Voir détails</a>
                  </div>
                </div>
              </div>
              <div class="project-info">
                <div class="project-category">Habitat Traditionnel</div>
                <h4 class="project-title">Cases & Tata Somba</h4>
                <p class="project-description">Architectures vernaculaires adaptées aux climats et modes de vie des différentes régions béninoises.</p>
                <div class="project-meta">
                  <span class="location"><i class="bi bi-geo-alt"></i> Nord Bénin</span>
                  <span class="timeline"><i class="bi bi-calendar"></i> Patrimoine vivant</span>
                </div>
              </div>
            </div>
          </div><!-- End Project Item -->

        </div>

      </div>

    </section><!-- /Projects Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Témoignages</h2>
        <p>Découvrez les expériences de ceux qui ont exploré la culture béninoise</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="testimonial-masonry">

          <div class="testimonial-item" data-aos="fade-up">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Ma visite au Bénin a transformé ma compréhension de l'Afrique. La richesse des traditions et l'authenticité des rencontres resteront gravées dans ma mémoire.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/construction/archi1.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Marie Dubois</h3>
                  <span class="position">Anthropologue, France</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Le festival Vodoun à Ouidah fut une expérience spirituelle intense. La connexion avec les traditions ancestrales et l'accueil chaleureux des communautés locales ont dépassé toutes mes attentes.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/construction/festival2.jpg" alt="Client">
                </div>
                <div class="client-details">
                  <h3>James Wilson</h3>
                  <span class="position">Photographe, États-Unis</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Les palais royaux d'Abomey sont un témoignage poignant de l'histoire africaine. Chaque détail architectural raconte une partie de cette histoire fascinante.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/construction/abomey1.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Fatou Diop</h3>
                  <span class="position">Historienne, Sénégal</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>L'artisanat béninois est d'une qualité exceptionnelle. J'ai été particulièrement impressionné par le travail des tisserands et des forgerons qui perpétuent des techniques ancestrales.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/construction/masque1.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Luca Bianchi</h3>
                  <span class="position">Designer, Italie</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="400">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Mon séjour au village lacustre de Ganvié fut une révélation. Voir comment une communauté entière vit en harmonie avec son environnement depuis des siècles est une leçon d'adaptation et de résilience.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/lacustre1.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Sophie Martin</h3>
                  <span class="position">Écologiste, Canada</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item" data-aos="fade-up" data-aos-delay="500">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>La musique et les danses traditionnelles béninoises sont d'une énergie contagieuse. J'ai été captivé par la complexité des rythmes et la grâce des mouvements chorégraphiques.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/sagbohan.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Carlos Rodriguez</h3>
                  <span class="position">Musicien, Espagne</span>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Certifications Section -->
    <section id="certifications" class="certifications section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Reconnaissances & Partenariats</h2>
        <p>Le Bénin, terre de culture reconnue internationalement pour son patrimoine exceptionnel</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5 mt-4">

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="certification-item">
              <div class="certification-badge">
                <img src="assets/img/construction/unesco.jpg" alt="Patrimoine UNESCO" class="img-fluid">
              </div>
              <h4>Patrimoine UNESCO</h4>
              <p>Reconnaissance internationale pour les Palais Royaux d'Abomey et la Route de l'Esclave à Ouidah.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="certification-item">
              <div class="certification-badge">
                <img src="assets/img/construction/patrimoine.webp" alt="Patrimoine Culturel" class="img-fluid">
              </div>
              <h4>Patrimoine Immatériel</h4>
              <p>Reconnaissance du Vodoun comme patrimoine culturel immatériel de l'humanité.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="certification-item">
              <div class="certification-badge">
                <img src="assets/img/construction/ecotourisme.jpg" alt="Écotourisme" class="img-fluid">
              </div>
              <h4>Destination Écotouristique</h4>
              <p>Reconnu pour ses initiatives de tourisme durable et de préservation de l'environnement.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="certification-item">
              <div class="certification-badge">
                <img src="assets/img/construction/art.webp" alt="Arts Vivants" class="img-fluid">
              </div>
              <h4>Arts Vivants</h4>
              <p>Reconnaissance internationale pour la vitalité des expressions artistiques contemporaines.</p>
            </div>
          </div>

        </div>

        <div class="row mt-5" data-aos="fade-up" data-aos-delay="500">
          <div class="col-12">
            <div class="certification-stats">
              <div class="row text-center">
                <div class="col-lg-3 col-md-6 mb-4">
                  <div class="stat-item">
                    <h3>2</h3>
                    <p>Sites UNESCO</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                  <div class="stat-item">
                    <h3>60+</h3>
                    <p>Groupes Ethniques</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                  <div class="stat-item">
                    <h3>50+</h3>
                    <p>Festivals Annuels</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                  <div class="stat-item">
                    <h3>12</h3>
                    <p>Royaumes Historiques</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Certifications Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Communauté & Experts</h2>
        <p>Rencontrez les gardiens de la tradition et les passionnés de la culture béninoise</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">

          <div class="col-lg-4 col-md-6">
            <div class="team-member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="assets/img/culture/gardien-tradition.webp" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Koffi Gnonlonfoun</h4>
                <span>Gardien de Tradition</span>
                <p>Détenteur des savoirs ancestraux et des rituels vodoun, il transmet depuis 40 ans les traditions orales de sa communauté.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-envelope"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6">
            <div class="team-member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="assets/img/culture/artisane.webp" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Adjoa Sènami</h4>
                <span>Maître Artisane</span>
                <p>Spécialiste du tissage et de la teinture traditionnelle, elle perpétue les techniques ancestrales des textiles béninois.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6">
            <div class="team-member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="assets/img/culture/historien.webp" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Dr. Patrice Hountondji</h4>
                <span>Historien & Chercheur</span>
                <p>Spécialiste de l'histoire précoloniale du Bénin et des royaumes africains, auteur de plusieurs ouvrages de référence.</p>
                <div class="social">
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-envelope"></i></a>
                  <a href=""><i class="bi bi-phone"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6">
            <div class="team-member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="assets/img/culture/musicien.webp" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Sèdo Gbedjinon</h4>
                <span>Maître Tambourinaire</span>
                <p>Virtuose des rythmes traditionnels, il enseigne les langages des tambours parlants et leur signification culturelle.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6">
            <div class="team-member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="assets/img/culture/guide.webp" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Rachida Orou</h4>
                <span>Guide Culturelle</span>
                <p>Passionnée par le patrimoine béninois, elle accompagne les visiteurs dans leur découverte des sites historiques.</p>
                <div class="social">
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-envelope"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6">
            <div class="team-member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="assets/img/culture/chef-cuisine.webp" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>Mariam Traoré</h4>
                <span>Cheffe Traditionnelle</span>
                <p>Experte en cuisine béninoise, elle valorise les produits locaux et les recettes transmises de génération en génération.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                  <a href=""><i class="bi bi-envelope"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">

          <div class="col-lg-10">
            <div class="cta-header text-center" data-aos="fade-up" data-aos-delay="200">
              <h2>Vivez l'Expérience Culturelle du Bénin</h2>
              <p>Le Bénin vous ouvre ses portes pour un voyage au cœur de traditions vivantes et d'un patrimoine exceptionnel. Des palais royaux aux villages lacustres, des cérémonies vodoun aux marchés artisanaux, découvrez une culture authentique et accueillante.</p>
            </div>
          </div>

        </div>

        <div class="cta-main" data-aos="fade-up" data-aos-delay="300">
          <div class="row align-items-center g-5">

            <div class="col-lg-6">
              <div class="achievements-grid">
                <div class="achievement-item" data-aos="zoom-in" data-aos-delay="400">
                  <div class="achievement-icon">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="achievement-info">
                    <h3>60+</h3>
                    <span>Groupes Ethniques</span>
                  </div>
                </div>

                <div class="achievement-item" data-aos="zoom-in" data-aos-delay="450">
                  <div class="achievement-icon">
                    <i class="bi bi-mic-fill"></i>
                  </div>
                  <div class="achievement-info">
                    <h3>50+</h3>
                    <span>Langues Parlées</span>
                  </div>
                </div>

                <div class="achievement-item" data-aos="zoom-in" data-aos-delay="500">
                  <div class="achievement-icon">
                    <i class="bi bi-award-fill"></i>
                  </div>
                  <div class="achievement-info">
                    <h3>2</h3>
                    <span>Sites UNESCO</span>
                  </div>
                </div>

                <div class="achievement-item" data-aos="zoom-in" data-aos-delay="550">
                  <div class="achievement-icon">
                    <i class="bi bi-calendar-heart"></i>
                  </div>
                  <div class="achievement-info">
                    <h3>12</h3>
                    <span>Royaumes Historiques</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="action-panel" data-aos="fade-left" data-aos-delay="350">

                <div class="panel-content">
                  <h3>Prêt à Découvrir le Bénin?</h3>
                  <p>Que vous soyez passionné d'histoire, amateur d'art ou simplement curieux de nouvelles cultures, le Bénin a tant à offrir. Contactez-nous pour organiser votre voyage culturel sur mesure.</p>

                  <div class="action-buttons">
                    <a href="quote.html" class="btn-primary">
                      <span>Planifier ma visite</span>
                      <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#portfolio" class="btn-secondary">
                      <span>Voir la galerie</span>
                      <i class="bi bi-eye"></i>
                    </a>
                  </div>
                </div>

                <div class="contact-quick">
                  <div class="contact-row">
                    <i class="bi bi-telephone-fill"></i>
                    <div class="contact-details">
                      <span class="contact-label">Ligne directe</span>
                      <span class="contact-value">+229 21 30 05 06</span>
                    </div>
                  </div>

                  <div class="contact-row">
                    <i class="bi bi-envelope-fill"></i>
                    <div class="contact-details">
                      <span class="contact-label">Email</span>
                      <span class="contact-value">contact@culturebenin.bj</span>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section -->


@endsection

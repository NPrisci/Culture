<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
  <title>@yield('title', 'Culture Bénin')</title>

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="@yield('body-class')">

  <!-- ===== Header ===== -->
  {{-- <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">iConstruction</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/about') }}">About</a></li>
          <li><a href="{{ url('/services') }}">Services</a></li>
          <li><a href="{{ url('/projects') }}">Projects</a></li>
          <li><a href="{{ url('/team') }}">Team</a></li>
          <li><a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted d-none d-sm-block" href="{{ url('/quote') }}">Request Quote</a>

    </div>
  </header> --}}
  <!-- End Header -->

  {{-- <main class="main">
      @yield('content')
  </main> --}}
      <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">Culture Bénin</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}">Accueil</a></li>

        <li><a href="{{ route('a-propos') }}">About</a></li>

        <li><a href="{{ route('patrimoine') }}">Patrimoine</a></li>

        <li><a href="{{ route('galerie') }}">Galerie</a></li>

        <li><a href="{{ route('communaute') }}">Communaute</a></li>

         <li><a href="{{ route('contact') }}">Contact</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <div class="user-profile-menu ms-3">
                <div class="dropdown">
                    <button class="user-menu-btn btn btn-link p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar-sm">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" id="userDropdownMenu">
                        <!-- Le contenu du menu sera généré dynamiquement par JavaScript -->
                        <div class="d-flex gap-2">
            @auth
    <div class="d-flex gap-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-warning">Déconnexion</button>
        </form>

        <a href="{{ route('profile.edit') }}" class="btn btn-danger">Edit</a>
       </div>
       @else
       <a href="{{ route('login') }}" class="btn btn-outline-success me-2">Connexion</a>
       <a href="{{ route('register') }}" class="btn btn-benin">S’inscrire</a>
       @endauth

        </div>
                    </ul>
                </div>
            </div>
     </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="main">
        @yield('content')
    </main>


  <!-- ===== Footer ===== -->
  {{-- <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-5">

        <div class="col-lg-4">
          <div class="footer-brand">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center mb-3">
              <span class="sitename">iConstruction</span>
            </a>
            <p class="tagline">Innovating the digital landscape with elegant solutions and timeless design.</p>

            <div class="social-links mt-4">
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-dribbble"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="row">
            <div class="col-6 col-md-4">
              <h5>Company</h5>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Our Team</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Newsroom</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-4">
              <h5>Services</h5>
              <ul class="list-unstyled">
                <li><a href="#">Web Development</a></li>
                <li><a href="#">UI/UX Design</a></li>
                <li><a href="#">Digital Strategy</a></li>
                <li><a href="#">Branding</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-4">
              <h5>Support</h5>
              <ul class="list-unstyled">
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="footer-cta">
            <h5>Let's Connect</h5>
            <a href="{{ url('/contact') }}" class="btn btn-outline">Get in Touch</a>
          </div>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container text-center">
        <p class="mb-0">© <span class="sitename">Myebsite</span>. All rights reserved.</p>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>

  </footer> --}}

    <footer id="footer" class="footer small-footer dark-background">

  <div class="container py-4">
    <div class="row gy-4">

      <div class="col-lg-3 col-md-6">
        <h4 class="sitename mb-2">Culture Bénin</h4>
        <p class="tagline small">
          Préserver et partager la richesse du patrimoine culturel béninois.
        </p>

        <div class="social-links mt-3">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
          <a href="#"><i class="bi bi-twitter-x"></i></a>
          <a href="#"><i class="bi bi-youtube"></i></a>
        </div>
      </div>

      <div class="col-lg-6 col-md-6">
        <div class="row">

          <div class="col-4">
            <h6>Culture</h6>
            <ul class="list-unstyled small">
              <li><a href="#">À propos</a></li>
              <li><a href="#">Mission</a></li>
              <li><a href="#">Événements</a></li>
              <li><a href="#">Actualités</a></li>
            </ul>
          </div>

          <div class="col-4">
            <h6>Patrimoine</h6>
            <ul class="list-unstyled small">
              <li><a href="#">Sites UNESCO</a></li>
              <li><a href="#">Vodoun</a></li>
              <li><a href="#">Artisanat</a></li>
              <li><a href="#">Musique & Danse</a></li>
            </ul>
          </div>

          <div class="col-4">
            <h6>Support</h6>
            <ul class="list-unstyled small">
              <li><a href="#">Aide</a></li>
              <li><a href="#">Contact</a></li>
              <li><a href="#">Confidentialité</a></li>
              <li><a href="#">Conditions</a></li>
            </ul>
          </div>

        </div>
      </div>

      <div class="col-lg-3 col-md-6 text-lg-end">
        <h6>Restons connectés</h6>
        <a href="contact.html" class="btn btn-outline btn-sm mt-2">Nous contacter</a>
      </div>

    </div>
  </div>

  <div class="footer-bottom py-2">
    <div class="container text-center small">
      © Culture Bénin — Tous droits réservés.  
      <br>
      Conçu par <a href="https://benin.bj/">Culture Bénin</a>
    </div>
  </div>

</footer>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>

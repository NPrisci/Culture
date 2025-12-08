{{-- @extends('layouts.app')

@section('title', 'Contact | Culture Bénin')

@section('content')

<section id="contact" class="contact section">

     <!-- Page Title -->
    <div class="page-title dark-background hero-video-container" data-aos="fade" style="background-image: url(assets/img/construction/showcase-2.webp);">
      <div class="container position-relative">
        <h1>Contact</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container section-title" data-aos="fade-up">
        <h2>Contactez-nous</h2>
        <p>Une question ? Une suggestion ? Nous sommes à votre écoute.</p>
    </div>

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-6">
                <form action="#" method="post" class="php-email-form">
                    @csrf

                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Votre nom" required>
                        </div>

                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Votre email" required>
                        </div>

                        <div class="col-12">
                            <input type="text" name="subject" class="form-control" placeholder="Sujet" required>
                        </div>

                        <div class="col-12">
                            <textarea name="message" class="form-control" rows="6" placeholder="Message" required></textarea>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>

                    </div>

                </form>
            </div>

            <div class="col-lg-6">
                <h4>Informations</h4>
                <p><strong>Email :</strong> contact@culture-benin.com</p>
                <p><strong>Téléphone :</strong> +229 60 00 00 00</p>
                <p><strong>Adresse :</strong> Cotonou, Bénin</p>
            </div>

        </div>

    </div>

</section>

@endsection --}}

@extends('layouts.ap')

@section('title', 'Contact')
@section('body-class', 'contact-page')

@section('content')

<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('assets/img/construction/drapeau.jpg') }});">
  <div class="container position-relative">
    <h1>Contact</h1>
    <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>

    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="current">Contact</li>
      </ol>
    </nav>
  </div>
</div>

<!-- Contact Section -->
<section id="contact" class="contact section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="contact-main-wrapper">

      <div class="map-wrapper">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14..." width="100%" height="100%" style="border:0;" allowfullscreen=""></iframe>
      </div>

      <div class="contact-content">

        <div class="contact-cards-container" data-aos="fade-up" data-aos-delay="300">

          <div class="contact-card">
            <div class="icon-box">
              <i class="bi bi-geo-alt"></i>
            </div>
            <div class="contact-text">
              <h4>Location</h4>
              <p>8721 Broadway Avenue, New York, NY 10023</p>
            </div>
          </div>

          <div class="contact-card">
            <div class="icon-box">
              <i class="bi bi-envelope"></i>
            </div>
            <div class="contact-text">
              <h4>Email</h4>
              <p>info@examplecompany.com</p>
            </div>
          </div>

          <div class="contact-card">
            <div class="icon-box">
              <i class="bi bi-telephone"></i>
            </div>
            <div class="contact-text">
              <h4>Call</h4>
              <p>+1 (212) 555-7890</p>
            </div>
          </div>

          <div class="contact-card">
            <div class="icon-box">
              <i class="bi bi-clock"></i>
            </div>
            <div class="contact-text">
              <h4>Open Hours</h4>
              <p>Monday-Friday: 9AM - 6PM</p>
            </div>
          </div>

        </div>

        <div class="contact-form-container" data-aos="fade-up" data-aos-delay="400">
          <h3>Get in Touch</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

          <form action="#" method="post" class="php-email-form">
            @csrf

            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
              </div>
            </div>

            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" placeholder="Subject" required>
            </div>

            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>

            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>

            <div class="form-submit">
              <button type="submit">Send Message</button>
            </div>
          </form>

        </div>

      </div>

    </div>
  </div>

</section>

@endsection


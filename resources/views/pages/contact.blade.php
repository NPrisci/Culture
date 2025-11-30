@extends('layouts.app')

@section('title', 'Contact | Culture Bénin')

@section('content')

<section id="contact" class="contact section">

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

@endsection

{{-- <x-guest-layout> --}}
    {{-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="prenom" :value="__('prenom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}
    {{-- <div class="card-body">
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom *</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                           id="nom" name="nom" value="{{ old('nom') }}" required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom *</label>
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                           id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mot_de_passe" class="form-label">Mot de passe *</label>
                                    <input type="password" class="form-control @error('mot_de_passe') is-invalid @enderror" 
                                           id="mot_de_passe" name="mot_de_passe" required>
                                    @error('mot_de_passe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Minimum 6 caractères</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_role" class="form-label">Rôle *</label>
                                    <select class="form-control @error('id_role') is-invalid @enderror" 
                                            id="id_role" name="id_role" required>
                                        <option value="">Sélectionner un rôle</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id_role }}" {{ old('id_role') == $role->id_role ? 'selected' : '' }}>
                                                {{ $role->nom_role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_langue" class="form-label">Langue *</label>
                                    <select class="form-control @error('id_langue') is-invalid @enderror" 
                                            id="id_langue" name="id_langue" required>
                                        <option value="">Sélectionner une langue</option>
                                        @foreach($langues as $langue)
                                            <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                                {{ $langue->nom_langue }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_langue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_naissance" class="form-label">Date de naissance</label>
                                    <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                           id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                                    @error('date_naissance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="text" class="form-control @error('photo') is-invalid @enderror" 
                                           id="photo" name="photo" value="{{ old('photo') }}" 
                                           placeholder="ex: /uploads/photos/user.jpg">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Créer l'utilisateur
                            </button>
                        </div>
                    </form>
                </div>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Bénin Culture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            /* background: linear-gradient(135deg, #0f8a1f, #1e7e34); */
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }
        .strength-weak { background-color: #dc3545; width: 25%; }
        .strength-medium { background-color: #ffc107; width: 50%; }
        .strength-strong { background-color: #28a745; width: 75%; }
        .strength-very-strong { background-color: #20c997; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card register-card">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h3 class="mb-2">
                            <i class="bi bi-globe"></i> Bénin Culture
                        </h3>
                        <p class="mb-0">Rejoignez notre plateforme culturelle</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Messages de statut -->
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Messages d'erreur -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Veuillez corriger les erreurs suivantes :</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prenom" class="form-label">Prénom *</label>
                                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                               id="prenom" name="prenom" value="{{ old('prenom') }}" required 
                                               placeholder="Votre prénom">
                                        @error('prenom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                               id="nom" name="nom" value="{{ old('nom') }}" required 
                                               placeholder="Votre nom">
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required 
                                       placeholder="votre@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    {{-- <div class="mb-3">
                                        <label for="sexe" class="form-label">Genre</label>
                                        <select class="form-control @error('sexe') is-invalid @enderror" 
                                                id="sexe" name="sexe">
                                            <option value="">Sélectionner</option>
                                            <option value="homme" {{ old('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
                                            <option value="femme" {{ old('sexe') == 'femme' ? 'selected' : '' }}>Femme</option>
                                            <option value="autre" {{ old('sexe') == 'autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('sexe')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        
                                    </div> --}}
                                    <!-- Dans la section sexe, remplacez par : -->
<div class="mb-3">
    <label for="sexe" class="form-label">Genre</label>
    <select class="form-control @error('sexe') is-invalid @enderror" 
            id="sexe" name="sexe">
        <option value="">Sélectionner</option>
        <option value="H" {{ old('sexe') == 'H' ? 'selected' : '' }}>Homme</option>
        <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Femme</option>
        <option value="A" {{ old('sexe') == 'A' ? 'selected' : '' }}>Autre</option>
    </select>
    @error('sexe')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_naissance" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                               id="date_naissance" name="date_naissance" 
                                               value="{{ old('date_naissance') }}"
                                               max="{{ date('Y-m-d', strtotime('-1 day')) }}">
                                        @error('date_naissance')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="id_langue" class="form-label">Langue préférée</label>
                                <select class="form-control @error('id_langue') is-invalid @enderror" 
                                        id="id_langue" name="id_langue">
                                    <option value="">Sélectionner une langue</option>
                                    @foreach($langues as $langue)
                                        <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                            {{ $langue->nom_langue }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_langue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required 
                                       placeholder="Minimum 8 caractères">
                                <div class="password-strength mt-1" id="passwordStrength"></div>
                                <small class="form-text text-muted">
                                    Le mot de passe doit contenir au moins 8 caractères.
                                </small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required 
                                       placeholder="Répétez votre mot de passe">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" 
                                       id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="terms">
                                    J'accepte les <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">conditions d'utilisation</a> *
                                </label>
                                @error('terms')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <span id="submitText">Créer mon compte</span>
                                    <div id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="visually-hidden">Chargement...</span>
                                    </div>
                                </button>
                            </div>

                            <div class="text-center mt-3">
                                <p class="mb-0">
                                    Déjà inscrit ? 
                                    <a href="{{ route('login') }}" class="text-decoration-none">Se connecter</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Conditions d'utilisation -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Conditions d'utilisation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>1. Acceptation des conditions</h6>
                    <p>En créant un compte sur Bénin Culture, vous acceptez de respecter les conditions d'utilisation suivantes.</p>
                    
                    <h6>2. Utilisation du compte</h6>
                    <p>Vous êtes responsable de la confidentialité de votre compte et de votre mot de passe.</p>
                    
                    <h6>3. Contenu utilisateur</h6>
                    <p>Vous êtes responsable du contenu que vous publiez sur la plateforme.</p>
                    
                    <h6>4. Respect de la communauté</h6>
                    <p>Vous vous engagez à respecter les autres membres de la communauté.</p>
                    
                    <h6>5. Protection des données</h6>
                    <p>Vos données personnelles sont protégées conformément à notre politique de confidentialité.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const passwordStrength = document.getElementById('passwordStrength');
            const registerForm = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');

            // Vérification de la force du mot de passe
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;

                // Longueur
                if (password.length >= 8) strength += 1;
                
                // Lettres minuscules et majuscules
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 1;
                
                // Chiffres
                if (password.match(/\d/)) strength += 1;
                
                // Caractères spéciaux
                if (password.match(/[^a-zA-Z\d]/)) strength += 1;

                // Mettre à jour l'indicateur visuel
                passwordStrength.className = 'password-strength';
                if (password.length === 0) {
                    passwordStrength.style.display = 'none';
                } else {
                    passwordStrength.style.display = 'block';
                    if (strength <= 1) {
                        passwordStrength.classList.add('strength-weak');
                    } else if (strength === 2) {
                        passwordStrength.classList.add('strength-medium');
                    } else if (strength === 3) {
                        passwordStrength.classList.add('strength-strong');
                    } else {
                        passwordStrength.classList.add('strength-very-strong');
                    }
                }
            });

            // Gestion de la soumission du formulaire
            registerForm.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                const terms = document.getElementById('terms').checked;

                // Vérification côté client
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Les mots de passe ne correspondent pas.');
                    return;
                }

                if (!terms) {
                    e.preventDefault();
                    alert('Veuillez accepter les conditions d\'utilisation.');
                    return;
                }

                // Désactiver le bouton et montrer le spinner
                submitBtn.disabled = true;
                submitText.textContent = 'Création du compte...';
                submitSpinner.classList.remove('d-none');
            });

            // Calcul automatique de l'âge maximum (18 ans minimum)
            const dateNaissanceInput = document.getElementById('date_naissance');
            const today = new Date();
            const maxDate = new Date(today.getFullYear() - 13, today.getMonth(), today.getDate());
            dateNaissanceInput.max = maxDate.toISOString().split('T')[0];
        });
    </script>
</body>
</html>
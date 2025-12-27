<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\TypeContenuController;
use App\Http\Controllers\TypeMediaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParlerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\PaiementController;

/*
|--------------------------------------------------------------------------
| Routes Publiques (Accessibles à tous)
|--------------------------------------------------------------------------
*/

// Page de test/check
Route::get('/check', function () {
    return view('checkout');
});

// Accueil et pages statiques publiques
Route::get('/', [HomeController::class, 'inde'])->name('acceuil');
Route::get('/a-propos', [HomeController::class, 'aPropos'])->name('a-propos');
Route::get('/patrimoine', [HomeController::class, 'patrimoine'])->name('patrimoine');
Route::get('/patrimoine/{slug}', [HomeController::class, 'patrimoineDetails'])->name('patrimoine.details');
Route::get('/galerie', [HomeController::class, 'galerie'])->name('galerie');
Route::get('/communaute', [HomeController::class, 'communaute'])->name('communaute');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Routes VisiteurController (public)
Route::prefix('public')->group(function () {
    Route::get('/', [VisiteurController::class, 'accueil'])->name('accue');
    Route::get('/a-propos', [VisiteurController::class, 'aPropos'])->name('apropos');
    Route::get('/contact', [VisiteurController::class, 'contact'])->name('contactpublic');
    Route::post('/contact', [VisiteurController::class, 'soumettreContact'])->name('contact.submit');
    Route::get('/politique-confidentialite', [VisiteurController::class, 'politiqueConfidentialite'])->name('politique');
    Route::get('/conditions-utilisation', [VisiteurController::class, 'conditionsUtilisation'])->name('conditions');

    Route::get('/recherche', [VisiteurController::class, 'recherche'])->name('recherche');

    // Langues publiques
    Route::get('/langues', [VisiteurController::class, 'indexlangue'])->name('langues.index.public');
    Route::get('/langues/{langue}', [VisiteurController::class, 'showlangue'])->name('langues.show.public');

    // Régions publiques
    Route::get('/regions', [VisiteurController::class, 'indexregion'])->name('regions.index.public');
    Route::get('/regions/{region}', [VisiteurController::class, 'showregion'])->name('regions.show.public');

    // Contenus publics
    Route::get('/contenus', [VisiteurController::class, 'indexcontenu'])->name('contenus.index.public');

    // Commentaires (store seulement)
    Route::post('/commentaires', [VisiteurController::class, 'storeCommentaire'])->name('commentaires.store.public');
});

/*
|--------------------------------------------------------------------------
| Routes d'Abonnement et Paiement
|--------------------------------------------------------------------------
*/

// Abonnement
Route::get('/subscribe', [AbonnementController::class, 'showForm'])->name('subscribe.form');
Route::post('/subscribe', [AbonnementController::class, 'createPayment'])->name('subscribe.pay');
Route::get('/payment-success/{id}', [AbonnementController::class, 'success'])->name('payment.success');

// Paiement général
Route::post('/paiement', [AbonnementController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/callback', [AbonnementController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/payment/manuel', [AbonnementController::class, 'manualPayment'])->name('payment.manual');

// Webhook (doit être public)
Route::post('/webhook/fedapay', [AbonnementController::class, 'webhook'])->name('fedapay.webhook');

// Pages de résultat de paiement
Route::get('/payment/failed', function () {
    return view('payment.failed');
})->name('payment.failed');

/*
|--------------------------------------------------------------------------
| Routes Authentifiées (Nécessite une connexion)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard selon le rôle
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/moderateur/dashboard', [HomeController::class, 'indexModerateur'])->name('moderateur');
    Route::get('/user/dashboard', [HomeController::class, 'indexuser'])->name('user');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Routes CRUD Administratives
    |--------------------------------------------------------------------------
    */

    // Langues
    Route::resource('langues', LangueController::class)->parameters(['langues' => 'id']);
    Route::get('langues/datatable', [LangueController::class, 'datatable'])->name('langues.datatable');

    // Régions
    Route::resource('regions', RegionController::class)->parameters(['regions' => 'id']);

    // Contenus
    Route::resource('contenus', ContenuController::class)->parameters(['contenus' => 'id']);

    // Commentaires
    Route::resource('commentaires', CommentaireController::class)->parameters(['commentaires' => 'id']);

    // Médias
    Route::resource('medias', MediaController::class)->parameters(['medias' => 'id']);

    // Types de contenu
    Route::resource('typecontenus', TypeContenuController::class)->parameters(['typecontenus' => 'id']);

    // Types de média
    Route::resource('typemedias', TypeMediaController::class)->parameters(['typemedias' => 'id']);

    // Rôles
    Route::resource('roles', RoleController::class)->parameters(['roles' => 'id']);

    // Utilisateurs
    Route::resource('utilisateurs', UserController::class)->parameters(['utilisateurs' => 'id']);

    // Parler
    Route::resource('parler', ParlerController::class)->parameters(['parler' => 'id']);

    /*
    |--------------------------------------------------------------------------
    | Routes de Paiement pour Contenus
    |--------------------------------------------------------------------------
    */
    Route::get('/contenus/{contenu}/paiement', [PaiementController::class, 'showPaiementForm'])
        ->name('contenus.paiement.form');

    Route::post('/contenus/{contenu}/paiement', [PaiementController::class, 'processPaiement'])
        ->name('contenus.paiement.process');

});

/*
|--------------------------------------------------------------------------
| Routes avec Middleware Spéciaux
|--------------------------------------------------------------------------
*/

// Route pour voir un contenu (nécessite auth + vérification paiement)
Route::get('/conte/{contenu}', [VisiteurController::class, 'showcontenu'])
    ->name('contenushow.public')
    ->middleware(['auth', 'payment.verified']);

/*
|--------------------------------------------------------------------------
| Routes Techniques et Tests
|--------------------------------------------------------------------------
*/

// Test d'authentification
Route::get('/test-login', function() {
    $credentials = [
        'email' => 'admin@beninculture.com',
        'password' => 'password123'
    ];

    if (Auth::attempt($credentials)) {
        return response()->json([
            'success' => true,
            'message' => 'Authentification réussie',
            'user' => Auth::user()
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Échec de l\'authentification'
        ]);
    }
});

// Callback de paiement (public)
Route::get('/paiement/callback', [PaiementController::class, 'callback'])
    ->name('paiement.callback');

require __DIR__.'/auth.php';

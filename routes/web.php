<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

Route::get('/check', function () {
    return view('checkout');
});

Route::get('/', [HomeController::class, 'inde'])->name('acceuil');
Route::get('/a-propos', [HomeController::class, 'aPropos'])->name('a-propos');
Route::get('/patrimoine', [HomeController::class, 'patrimoine'])->name('patrimoine');
Route::get('/patrimoine/{slug}', [HomeController::class, 'patrimoineDetails'])->name('patrimoine.details');
Route::get('/galerie', [HomeController::class, 'galerie'])->name('galerie');
Route::get('/communaute', [HomeController::class, 'communaute'])->name('communaute');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
//Route::get('/dashboard', 
// function () {
//     return view('dashboard');
// }
// [HomeController::class, 'index']
//)->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    Route::get('/moderateur/dashboard', [HomeController::class, 'indexModerateur'])
        ->name('moderateur');

    Route::get('/user/dashboard', [HomeController::class, 'indexuser'])
        ->name('user');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
     
    // Routes avec paramètres explicites
    Route::resource('langues', LangueController::class)->parameters([
        'langues' => 'id'
    ]);
    Route::get('langues/datatable', [LangueController::class, 'datatable'])->name('langues.datatable');
    
    Route::resource('regions', RegionController::class)->parameters([
        'regions' => 'id'
    ]);
    
    Route::resource('contenus', ContenuController::class)->parameters([
        'contenus' => 'id'
    ]);
    
    Route::resource('commentaires', CommentaireController::class)->parameters([
        'commentaires' => 'id'
    ]);
    
    Route::resource('medias', MediaController::class)->parameters([
        'medias' => 'id'
    ]);
    
    Route::resource('typecontenus', TypeContenuController::class)->parameters([
        'typecontenus' => 'id'
    ]);
    
    Route::resource('typemedias', TypeMediaController::class)->parameters([
        'typemedias' => 'id'
    ]);
    
    Route::resource('roles', RoleController::class)->parameters([
        'roles' => 'id'
    ]);
    
    Route::resource('utilisateurs', UserController::class)->parameters([
        'utilisateurs' => 'id'
    ]);
    
    Route::resource('parler', ParlerController::class)->parameters([
        'parler' => 'id'
    ]);
});

// Route de test d'authentification
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/subscribe', [AbonnementController::class, 'showForm'])->name('subscribe.form');
Route::post('/subscribe', [AbonnementController::class, 'createPayment'])->name('subscribe.pay');
// webhook (POST) - public endpoint
Route::post('/webhook/fedapay', [AbonnementController::class, 'webhook'])->name('fedapay.webhook');

Route::get('/payment-success/{id}', [AbonnementController::class, 'success'])
    ->name('payment.success');



    // Accueil
    Route::get('/public', [VisiteurController::class, 'accueil'])->name('accue');
    
    // Pages statiques
    Route::get('/public/a-propos', [VisiteurController::class, 'aPropos'])->name('a-propos');
    Route::get('/public/contact', [VisiteurController::class, 'contact'])->name('contact');
    Route::post('/public/contact', [VisiteurController::class, 'soumettreContact'])->name('contact.submit');
    Route::get('/public/politique-confidentialite', [VisiteurController::class, 'politiqueConfidentialite'])->name('politique');
    Route::get('/public/conditions-utilisation', [VisiteurController::class, 'conditionsUtilisation'])->name('conditions');
    
    // Recherche
    Route::get('/public/recherche', [VisiteurController::class, 'recherche'])->name('recherche');
    
    // Langues
    Route::get('/public/langues', [VisiteurController::class, 'indexlangue'])->name('langues.index.public');
    Route::get('/public/langues/{langue}', [VisiteurController::class, 'showlangue'])->name('langues.show.public');
    
    // Régions
    Route::get('/public/regions', [VisiteurController::class, 'indexregion'])->name('regions.index.public');
    Route::get('/public/regions/{region}', [VisiteurController::class, 'showregion'])->name('regions.show.public');
    
    // Contenus
    Route::get('/public/contenus', [VisiteurController::class, 'indexcontenu'])->name('contenus.index.public');
    Route::get('/public/contenus/{contenu}', [VisiteurController::class, 'showcontenu'])->name('contenus.show.public');
    
    // Commentaires
    Route::post('/public/commentaires', [VisiteurController::class, 'storeCommentaire'])->name('commentaires.store.public');



// Paiement
Route::post('/paiement', [AbonnementController::class, 'createPayment'])
    ->name('payment.create');

// Callback FedaPay
Route::get('/paiement/callback', [AbonnementController::class, 'paymentCallback'])
    ->name('payment.callback');

// Pages de résultat
Route::get('/paiement/success', function () {
    return view('payment.success');
})->name('payment.success');

Route::get('/paiement/failed', function () {
    return view('payment.failed');
})->name('payment.failed');

Route::get('/paiement/manuel', [AbonnementController::class, 'manualPayment'])
    ->name('payment.manual');

    Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'timestamp' => now(),
        'services' => [
            'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
            'cache' => Cache::get('health_check') === 'ok' ? 'working' : 'not working',
        ]
    ]);
});


// Routes de paiement
Route::middleware(['auth'])->group(function () {
    Route::get('/contenus/{contenu}/paiement', [PaiementController::class, 'showPaiementForm'])
        ->name('contenus.paiement.form');
    
    Route::post('/contenus/{contenu}/paiement', [PaiementController::class, 'processPaiement'])
        ->name('contenus.paiement.process');
});

// Route de callback (accessible sans auth)
Route::get('/paiement/callback', [PaiementController::class, 'callback'])
    ->name('paiement.callback');

// Route pour voir un contenu (avec vérification de paiement)
Route::get('/contenus/{contenu}', [ContenuController::class, 'show'])
    ->name('contenus.show.public')
    ->middleware(['auth', 'payment.verified']);
require __DIR__.'/auth.php';

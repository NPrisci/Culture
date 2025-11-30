<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', [HomeController::class, 'accueil'])->name('accueil');
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

    Route::get('/moderateur/dashboard', [HomeController::class, 'indexmoderateur'])
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

require __DIR__.'/auth.php';
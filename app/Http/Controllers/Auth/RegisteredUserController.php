<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use App\Models\Role;
// use App\Models\Langue;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Display the registration view.
//      */
//     public function create(): View
//     {
//         $roles = Role::all();
//         $langues = Langue::all();

//         return view('auth.register', compact('roles', 'langues'));
//     }

//     /**
//      * Handle an incoming registration request.
//      *
//      * @throws \Illuminate\Validation\ValidationException
//      */
//     public function store(Request $request): RedirectResponse
//     {
//         $request->validate([
//             'nom' => ['required', 'string', 'max:255'],
//             'prenom' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//             'id_role' => 'nullable|exists:roles,id_role',
//             'id_langue' => 'nullable|exists:langues,id_langue',
//             'statut' => 'required|string|in:actif,inactif'
//         ]);

//         $user = User::create([
//             'nom' => $request->nom,
//             'prenom' => $request->prenom,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//              'id_role' => $request->id_role,
//             'id_langue' => $request->id_langue,
//             'statut' => $request->statut,
//             'date_inscription' => now(),

//         ]);

//         event(new Registered($user));

//         Auth::login($user);

//         return redirect(route('dashboard', absolute: false));
//     }
// }

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Afficher le formulaire d'inscription
     */
    public function create()
    {
        $roles = Role::all();
        $langues = Langue::all();
        return view('auth.register', compact('roles', 'langues'));
    }

    /**
     * Traiter l'inscription
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'sexe' => 'nullable|string|in:H,F,A',
            'date_naissance' => 'nullable|date|before:today',
            'id_langue' => 'nullable|exists:langues,id_langue',
            'terms' => 'required|accepted',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'terms.required' => 'Vous devez accepter les conditions d\'utilisation.',
            'date_naissance.before' => 'La date de naissance doit être dans le passé.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Créer l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sexe' => $request->sexe,
            'date_naissance' => $request->date_naissance,
            'id_langue' => $request->id_langue,
            'id_role' => 2, // Rôle "Utilisateur" par défaut
            'statut' => 'actif',
            'date_inscription' => now(),
        ]);

        // Déclencher l'événement d'inscription
        event(new Registered($user));

        // Connecter automatiquement l'utilisateur
        Auth::login($user);

        return redirect()->route('accue')
            ->with('success', 'Votre compte a été créé avec succès ! Bienvenue ' . $user->prenom . ' !');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('dashboard', absolute: false));
    // }

       public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = Auth::user();

    

    // Redirection personnalisée selon le rôle
//     if ($user->id_role === 1) {
//     return $user->id === 1
//         ? redirect()->route('dashboard')
//         : redirect()->route('moderateur');
// }
//  elseif ($user->id_role === 2) {
//         return redirect()->route('user');
//     } else {
//         return redirect('/');
//     }
// Utiliser un switch pour plus de clarté
switch ($user->id_role) {
    case 1: // Admin
        return redirect()->route('dashboard');
    case 2: // Modérateur
        return redirect()->route('moderateur');
    case 3: // User
        return redirect()->route('accue');
    default:
        return redirect('/');
}
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
{
    if ($user->role->nom_role === 'administrateur') {
        return redirect()->route('dashboard');
    }

    if ($user->role->nom_role === 'visiteur') {
        return redirect()->route('moderateur');
    }

    return redirect()->route('user');
}


}
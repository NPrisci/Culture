<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paiement;

class VerifyPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Récupérer le contenu depuis la route
        $contenu = $request->route('contenu');
        
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez vous connecter pour accéder à ce contenu.');
        }
        
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
        
        // Vérifier si l'utilisateur est admin
        // Adaptez cette vérification selon votre logique métier
        if (isset($user->role) && $user->role_id === 1) {
            return $next($request);
        }
        
        // Vérifier si l'utilisateur a payé pour ce contenu
        $hasPaid = Paiement::where('contenu_id', $contenu->id)
            ->where('user_id', $user->id)
            ->where('statut', 'completed')
            ->exists();
        
        // Si l'utilisateur a payé, autoriser l'accès
        if ($hasPaid) {
            return $next($request);
        }
        
        // Rediriger vers le formulaire de paiement
        return redirect()->route('contenus.paiement.form', $contenu)
            ->with('error', 'Vous devez payer 100 FCFA pour accéder à ce contenu.');
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            $role = Auth::user()->role->nom_role;

            switch ($role) {
                case 'admin':
                    return redirect()->route('dashboard');

                case 'moderateur':
                    return redirect()->route('moderateur.dashboard');

                case 'utilisateur':
                    return redirect()->route('user.dashboard');

                default:
                    return redirect()->url('/');
            }
        }

        return $next($request);

    }
}

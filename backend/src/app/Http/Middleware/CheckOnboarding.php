<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOnboarding
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Si l'utilisateur n'est pas connecté → laisse passer
        if (!$user) {
            return $next($request);
        }

        // Autorise toutes les routes onboarding et logout pour éviter la boucle
        if ($request->is('onboarding*') || $request->is('logout')) {
            return $next($request);
        }

        // Si onboarding pas terminé → redirige vers la page 1
        if (!$user->onboarding_completed) {
            return redirect()->route('onboarding.1')
                ->with('warning', 'Vous devez terminer l’onboarding pour accéder à cette page.');
        }

        // Vérifie si profile incomplet → redirige vers profile
        if (!$user->name || !$user->email || !$user->birthdate) {
            return redirect()->route('onboarding.profile');
        }

        return $next($request);
    }
}

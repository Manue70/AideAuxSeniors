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

        // Pas connecté → laisser passer
        if (!$user) {
            return $next($request);
        }

        // Routes à exclure pour éviter les boucles
        $excludedRoutes = [
            'logout',
            'onboarding.1',
            'onboarding.profile',
            'onboarding.complete'
        ];

        // Laisser passer si la route actuelle est dans la liste
        if (in_array($request->route()->getName(), $excludedRoutes)) {
            return $next($request);
        }

        // Si onboarding complet → laisser passer
        if ($user->onboarding_completed) {
            return $next($request);
        }

        // Si profile incomplet → rediriger vers profile
        if (!$user->name || !$user->email || !$user->birthdate) {
            return redirect()->route('onboarding.profile');
        }

        // Sinon, rediriger vers la première page du onboarding
        return redirect()->route('onboarding.1')
            ->with('warning', 'Vous devez terminer l’onboarding pour accéder à cette page.');
    }
}

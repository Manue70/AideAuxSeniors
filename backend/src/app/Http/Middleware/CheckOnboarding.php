<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOnboarding
{
    public function handle(Request $request, Closure $next)
    {
        // Si l'utilisateur est connecté mais n'a pas fini le onboarding
        if (Auth::check() && !Auth::user()->onboarding_completed) {
            // Redirige vers la première page de l'onboarding
            return redirect()->route('onboarding.1')
                ->with('warning', 'Vous devez terminer l’onboarding pour accéder à cette page.');
        }

        // Sinon laisse passer
        return $next($request);
    }
}

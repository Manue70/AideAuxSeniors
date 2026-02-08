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

        // Si l'utilisateur est connecté mais n'a pas fini le onboarding
        if (Auth::check() 
            && !$user->onboarding_completed
            && !$request->is('onboarding*') // autorise toutes les pages onboarding
        ) {
            return redirect()->route('onboarding.1')
                ->with('warning', 'Vous devez terminer l’onboarding pour accéder à cette page.');
        }

        // Si certaines infos du profile sont manquantes → page profile
        if ($user && (!$user->birthdate || !$user->name || !$user->email)) {
            // On autorise la page profile et la page1, sinon redirection
            if (!$request->is('onboarding/profile') && !$request->is('onboarding/1')) {
                return redirect()->route('onboarding.profile');
            }
        }

        return $next($request);
    }
}

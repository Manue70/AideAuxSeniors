<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOnboarding
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->onboarding_completed) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

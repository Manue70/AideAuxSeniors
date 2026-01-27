<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Affiche le formulaire de login
    public function showLoginForm()
    {
        return view('auth.login'); // auth/login.blade.php
    }

    // Traitement du login
    public function login(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Récupération des identifiants
        $credentials = $request->only('email', 'password');

        // Tentative d'authentification
        if (Auth::attempt($credentials)) {
            // Regénère la session pour éviter le session fixation attack
            $request->session()->regenerate();

            $user = Auth::user();

            // Admin → redirection vers admin dashboard
            if ($user->is_admin) {
                return redirect()->route('admin');
            }

            // Si onboarding pas terminé → redirige vers la première page de l’onboarding
            if (!$user->onboarding_completed) {
                return redirect()->route('onboarding.1');
            }

            // Sinon → dashboard
            return redirect()->route('dashboard');
        }

        // Si échec : retour avec message d'erreur
        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->withInput(); // conserve l'email rempli
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}


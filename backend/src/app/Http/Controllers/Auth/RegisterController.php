<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate(
            [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed', // nécessite password_confirmation
            ],
            [
                'password.confirmed' => 'Les mots de passe ne correspondent pas.',
                'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            ]
        );

        // Création de l'utilisateur
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'onboarding_completed' => false,
        ]);

        // Connexion automatique
        Auth::login($user);

        return redirect()->route('onboarding.1');
    }
}

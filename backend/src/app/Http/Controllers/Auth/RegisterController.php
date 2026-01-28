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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0; padding-left:1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        $request->validate(
            [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'password.confirmed' => 'Les mots de passe ne correspondent pas.',
                'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            ]
        );

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'onboarding_completed' => false,
        ]);

        Auth::login($user);

    

        return redirect()->route('onboarding.1');
    }
}


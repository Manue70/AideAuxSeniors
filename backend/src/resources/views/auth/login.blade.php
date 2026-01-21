@extends('layouts.app')

@section('title', 'Connexion – SeniorAide')
<link rel="stylesheet" href="{{ asset('css/login-page.css') }}">

@section('content')
<div class="login-background">
    <!-- Texte au-dessus du formulaire -->
    <div class="login-header-text">
        <h1>SeniorAide</h1>
        <h3>Bienvenue</h3>
        <p>Connectez-vous ou créez votre compte</p>
    </div>

    @if ($errors->any())
        <div class="login-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Formulaire avec son propre container -->
    <div class="login-container">
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required placeholder="votre email">

            <div class="password-wrapper">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required placeholder="votre mot de passe">
                <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
            </div>

            <div class="login-buttons">
                <button type="submit" class="btn btn-secondary">
                    Se connecter
                </button>
                <a href="{{ route('register') }}" class="btn btn-secondary">
                    Créer un compte
                </a>
            </div>

        </form>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const btn = document.querySelector('.toggle-password');
    if(passwordInput.type === 'password') {
        passwordInput.type = 'text';
        btn.textContent = '🙈'; // change l'icône
    } else {
        passwordInput.type = 'password';
        btn.textContent = '👁️';
    }
}
</script>

@endsection


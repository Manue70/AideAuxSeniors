@extends('layouts.app')

@section('title', 'Créer un compte – SeniorAide')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/login-page.css') }}">
@endpush

@section('content')
<div class="login-background">
    <!-- Texte au-dessus du formulaire -->
    <div class="login-header-text">
        <h1>SeniorAide</h1>
        <h3>Créer un compte</h3>
        <p>Remplissez les champs ci-dessous pour vous inscrire</p>
    </div>

    <!-- Formulaire avec container -->
    <div class="login-container">
        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required placeholder="Votre email" value="{{ old('email') }}">

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required placeholder="Votre mot de passe">

            <label for="password_confirmation">Confirmer le mot de passe :</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirmez le mot de passe">

            <div class="login-buttons">
                <button type="submit" class="btn btn-secondary">Créer mon compte</button>
                <a href="{{ route('login') }}" class="btn btn-secondary">Se connecter</a>
            </div>
        </form>
    </div>
</div>
@endsection

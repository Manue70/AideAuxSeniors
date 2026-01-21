@extends('layouts.app')

@section('title', 'Cookies')

@section('content')

<main class="info-page {{ session('theme', 'clair') }}">
    
    <h1 class="info-title">Cookies</h1>

    <div class="info-container">
        <p><strong>Données Collectés :</strong> Nous utilisons des cookies pour améliorer l’expérience utilisateur et mémoriser vos préférences. </p>
        <p><strong>Types de cookies :</strong> Cookies fonctionnels, analytiques et de performance.</p>
        <p><strong>Gestion :</strong> Vous pouvez désactiver certains cookies via les paramètres de votre navigateur.</p>
        <p><strong>Droits utilisateurs RGPD :</strong> L’utilisation continue de l’application implique votre consentement à l’utilisation des cookies.</p>
    </div>

    <div class="info-buttons">
        <a href="{{ route('parametres') }}" class="btn btn-primary">Retour aux paramètres</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

</main>

@vite('resources/css/info-pages.css')

@endsection


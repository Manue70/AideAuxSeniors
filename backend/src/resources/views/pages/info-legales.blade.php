@extends('layouts.app')

@section('title', 'Info Légales')

@section('content')
<main class="info-page {{ session('theme', 'clair') }}">
    
    <h1 class="info-title">Info Légales</h1>

    <div class="info-container">
        <p><strong>Nom de l'application :</strong> SeniorAide</p>
        <p><strong>Responsable du projet :</strong> Manuela </p>
        <p><strong>Contact :</strong> contact@example.com</p>
        <p><strong>Hébergeur :</strong> Render / Autre</p>
        <p><strong>Propriétés intellectuelles :</strong> Tous droits réservés</p>
    </div>

    <div class="info-buttons">
        <a href="{{ route('parametres') }}" class="btn btn-primary">Retour aux paramètres</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

</main>

 @vite('resources/css/info-pages.css')
@endsection


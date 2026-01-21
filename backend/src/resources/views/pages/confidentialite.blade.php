@extends('layouts.app')

@section('title', 'Confidentialité')

@section('content')

<main class="info-page {{ session('theme', 'clair') }}">

    <h1 class="info-title">Confidentialité</h1>

    <div class="info-container">
        <p><strong>Collecte des données :</strong> Nous collectons uniquement les informations nécessaires à l’utilisation de l’application.</p>
        <p><strong>Utilisation des données :</strong> Vos données sont utilisées pour améliorer votre expérience et assurer le suivi des rappels.</p>
        <p><strong>Partage :</strong> Nous ne partageons pas vos données avec des tiers.</p>
        <p><strong>Protection :</strong> Vos données sont stockées de manière sécurisée et confidentielle.</p>
        <p><strong>Droits :</strong> Vous pouvez demander la suppression ou la modification de vos données à tout moment.</p>
    </div>

    <!-- Bouton supprimer compte -->
    <div class="delete-account-container" style="margin-bottom: 30px;">
        <button id="delete-account-btn" class="btn btn-danger">Supprimer mon compte</button>
    </div>

    <!-- Boutons de navigation -->
    <div class="info-buttons">
        <a href="{{ route('parametres') }}" class="btn btn-primary">Retour aux paramètres</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <!-- MODALE SUPPRESSION -->
    <div id="delete-modal" class="modal" style="display:none;">
        <div class="modal-content">
            <h2>Supprimer mon compte</h2>
            <p>Voulez-vous vraiment supprimer votre compte ?</p>
            <div class="modal-buttons">
                <button id="confirm-delete" class="btn btn-danger">Oui</button>
                <button id="cancel-delete" class="btn btn-secondary">Non</button>
            </div>
        </div>
    </div>


    <!-- Formulaire DELETE caché pour Laravel -->
    <form id="delete-account-form" action="{{ route('profile.destroy') }}" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>


</main>

@vite('resources/css/info-pages.css')
@endsection


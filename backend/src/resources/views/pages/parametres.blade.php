@extends('layouts.app')

@section('title', 'Paramètres')

@section('content')
<main class="settings-page {{ session('theme', 'clair') }}">

    <h1 class="settings-title">Paramètres</h1>

    <!-- GRID POUR LES 2 PREMIERES CARDS -->
    <div class="settings-grid">
        <!-- CARTE 1 : PROFIL -->
        <section class="settings-card">

            <h3>Profil</h3>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="field">
                    <label for="nom">Prenom</label>
                    <input
                        type="text"
                        name="prenom"
                        value="{{ old('prenom', auth()->user()->prenom) }}"
                        placeholder="Votre nom"
                    >
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        placeholder="Votre email"
                    >
                </div>

                <div class="field">
                    <label for="telephone">Téléphone</label>
                    <input
                        type="tel"
                        id="telephone"
                        name="telephone"
                        value="{{ old('telephone', auth()->user()->telephone) }}"
                        placeholder="Votre téléphone"
                    >
                </div>

                <button type="submit" class="btn-primary">
                    ENREGISTRER
                </button>
            </form>

        </section>

        <!-- CARTE 2 : PRÉFÉRENCES -->
        <section class="settings-card full-width">
            <h3>Préférences</h3>
            <div class="option">
                <span>Changer le thème</span>
                <a href="{{ route('switch-theme') }}" class="btn btn-primary">Changer</a>
            </div>

            <div class="option">
                <span>Notifications</span>
                <button class="btn btn-primary btn-notif">Configurer</button>
            </div>
        </section>
    </div>

    <!-- TROISIÈME CARD DANS UNE DIV SÉPARÉE POUR CENTRAGE -->
     <div class="settings-grid-single">
        <section class="settings-card full-width">
            <h3>Accessibilité</h3>
            <div class="option">
                <span>Texte plus grand</span>
                <div class="toggle">
                    <button class="btn btn-primary btn-text-larger-oui">Oui</button>
                    <button class="btn btn-secondary btn-text-larger-non">Non</button>
                </div>
            </div>
            <div class="option">
                <span>Contraste plus élevé</span>
                <div class="toggle">
                    <button class="btn btn-primary btn-contrast-oui">Oui</button>
                    <button class="btn btn-secondary btn-contrast-non">Non</button>
                </div>
            </div>
        </section>
    </div>

    <!-- Bouton Déconnexion -->
    <button class="settings-logout">Déconnexion</button>
</main>

<!-- MODALE NOTIFICATIONS -->
<div id="modal-notif" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Notifications</h3>
        <p>Vous recevrez des notifications sur votre numéro de téléphone.</p>
        <div class="modal-buttons">
            <button id="notif-oui" class="btn btn-primary">Oui</button>
            <button id="notif-non" class="btn btn-secondary">Non</button>
        </div>
    </div>
</div>

@endsection

@vite('resources/js/app.js')



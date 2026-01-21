@extends('layouts.app')

@section('title', 'Assistance – SeniorAide')

@section('content')

    <div class="assistant-hero">

    <div class="overlay"></div>

    <!-- Avatar central -->
    <img src="{{ asset('images/icons/avatar.png') }}" class="assistant-bg" alt="Assistant">

    <div class="assistant-content">
        <h2>Je suis là pour vous aider</h2>

        <!-- Bulles assistant à gauche -->
        <div class="chat-message assistant">
            <img src="{{ asset('images/icons/avatar_bulle.png') }}" class="chat-avatar" alt="Assistant">
            <div class="chat-bubble">Bonjour, {{ auth()->user()->prenom ?? '' }} ! Comment vous sentez-vous aujourd’hui ?</div>
        </div>

        <!-- Bulles utilisateur à droite -->
        <div class="chat-message user">
            <img src="{{ asset('images/icons/avatar_user.jpg') }}" class="chat-avatar" alt="Vous">
            <div class="chat-bubble">Je me sens bien, merci</div>
        </div>
    </div>

    <!-- Input en bas -->
    <div class="chat-input">
        <input type="text" id="chat-message" placeholder="Écrivez votre message ici ..." />
        <button id="voice-btn" title="Parler">🎤</button>
        <button id="send-message">➤</button>
        <button id="stop-voice" title="Arrêter la voix">⏹️</button>
        <button id="toggle-voice" data-enabled="true" title="Activer / désactiver la voix">
            🔊
        </button>
    </div>
    <div class="chat-actions">
        <button id="alert-proche">Prévenir un proche</button>
        <button id="call-voice">Appel vocal</button>
    </div>


</div>


@vite('resources/css/assistance.css')

@endsection


@extends('layouts.app')

@section('title', 'Dashboard SeniorAide')

@section('content')
<div class="dashboard-content {{ session('theme', 'clair') }}">
    @php
        $user = auth()->user();
        $prenom = $user ? ucfirst(explode(' ', $user->name)[0]) : 'invité';

        // Heure locale Paris
        $heure = now()->setTimezone('Europe/Paris')->format('H');

        // Définir greeting et emoji
        if ($heure >= 5 && $heure < 12) {
            $greeting = 'Bonjour';
            $emoji = '🌞';
            $message = 'Commencez bien la journée !';
        } elseif ($heure >= 12 && $heure < 18) {
            $greeting = 'Bonjour';
            $emoji = '☀️';
            $message = 'N’oubliez pas de rester hydraté(e) !';
        } else {
            $greeting = 'Bonsoir';
            $emoji = '🌙';
            $message = 'Finissez bien la journée !';
        }
    @endphp

    <div class="dashboard-greeting" style="margin-bottom:1rem;">
        <h2>{{ $greeting }}, {{ $prenom }} {{ $emoji }}</h2>
        <p style="font-size:0.9rem; color:#555;">{{ $message }}</p>
    </div>
        

    <div class="dashboard-cards">
        <!-- Carte Rappels du jour -->
        @foreach($reminders as $reminder) 
        <div class="card">
            <h3>{{ ucfirst($reminder->type) }} Rappels du jour</h3>
            <p> {{ $reminder->message }} – {{ $reminder->heure }} Prendre le médicament du matin</p>
            <form action="{{ route('dashboard.markDone',$reminder->id ) }}" method="POST">
                @csrf
                <input type="hidden" name="task" value="medicament_matin">
                <button type="submit" class="btn-primary">FAIT</button>
            </form>

            
            <a href="{{ route('rappels') }}" class="btn-primary">
                VOIR
            </a>
        </div>
        @endforeach

        <!-- Carte Médicaments -->
        <div class="card">
            <h3>Médicaments</h3>
            <p>Modification du matin</p>
            <button
                 id="btn-oui-medicament"
                type="button"
                class="btn-primary"
            >
                 VOIR / Modifier
            </button>

        </div>

        <!-- Carte Hydratation -->
        @foreach($reminders as $reminder)
        <div class="card">
            <h3>{{ ucfirst($reminder->type) }}Hydratation</h3>
            <p> {{ $reminder->message }} – {{ $reminder->heure }}Prendre 6 verres d'eau</p>
            <form action="{{ route('dashboard.markDone',$reminder->id) }}" method="POST">
                @csrf
                <input type="hidden" name="task" value="hydration">
                <button type="submit" class="btn-primary">FAIT</button>
            </form>

            
            <a href="{{ route('rappels') }}" class="btn-primary">
                VOIR
            </a>

        </div>
        @endforeach

        <!-- Carte Contacts d'urgence -->
        <div class="card">
            <h3>Contacts d'urgence</h3>
            <p>Nom + Téléphone</p>
            <a href="tel:+33123456789" class="btn-primary">APPELER</a>
        </div>
    </div>
</div>
@endsection


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
            <h3> Rappels du jour</h3>
            <p> {{ $reminder->message }} – {{ $reminder->heure }} </p>
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
        @foreach($medicaments as $med)
        <div class="card">
            <h3>Médicaments</h3>
            <strong>{{ $med->nom }}</strong> – {{ $med->dosage }}

            <button class="btn btn-primary btn-open-medicament"
                data-id="{{ $med->id }}"
                data-nom="{{ $med->nom }}"
                data-dosage="{{ $med->dosage }}"
                data-daily="{{ $med->is_daily }}"
            >
                Modifier
            </button>

            <form action="{{ route('medicaments.update', $med->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary">FAIT</button>
            </form>

        </div>
        @endforeach

        <button class="btn btn-success btn-open-medicament" data-id="">
            Ajouter un médicament
        </button>



       

        <!-- Carte Hydratation -->
        @foreach($reminders as $reminder)
        <div class="card">
            <h3>Hydratation</h3>
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

            @if($contactUrgent)
                <p>{{ $contactUrgent->nom }} — {{ $contactUrgent->telephone }} — {{ $contactUrgent->lien }}  </p>

                <a href="tel:{{ $contactUrgent->telephone }}" class="btn-primary">
                    APPELER
                </a>
            @else
                <p>Aucun contact enregistré</p>
            @endif

            <a href="{{ route('contacts.index') }}" class="btn-primary">
                Modifier
            </a>

           @if($contactUrgent)
            <form method="POST" action="{{ route('contacts.destroy', $contactUrgent) }}" style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Voulez-vous vraiment supprimer ce contact ?')">
                    Supprimer
                </button>
            </form>
            @endif

        </div>

            
    </div>
@endsection

@include('partials.modal-medicament')

<script src="/js/medicament-modal.js"></script>



@extends('layouts.app')

@section('title', 'Dashboard SeniorAide')

@section('content')
<div class="dashboard-content {{ session('theme', 'clair') }}">
    <h2>Bonjour, [Prénom]</h2>

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


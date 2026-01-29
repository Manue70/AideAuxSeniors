@extends('layouts.app')

@section('title', 'Dashboard SeniorAide')

@section('content')
<div class="dashboard-content {{ session('theme', 'clair') }}">
    <h2>Bonjour, [Prénom]</h2>

    <div class="dashboard-cards">
        <!-- Carte Rappels du jour -->
        <div class="card">
            <h3>Rappels du jour</h3>
            <p>Prendre le médicament du matin</p>
            <form action="{{ route('dashboard.markDone') }}" method="POST">
                @csrf
                <input type="hidden" name="task" value="medicament_matin">
                <button type="submit" class="btn-primary">FAIT</button>
            </form>

            
            <a href="{{ route('rappels') }}" class="btn-primary">
                VOIR
            </a>
        </div>

        <!-- Carte Médicaments -->
        <div class="card">
            <h3>Médicaments</h3>
            <p>Modification du matin</p>
            <a href="{{ route('rappels') }}" class="btn-primary">VOIR / Modifier</a>

        </div>

        <!-- Carte Hydratation -->
        <div class="card">
            <h3>Hydratation</h3>
            <p>Prendre 6 verres d'eau</p>
            <form action="{{ route('dashboard.markDone') }}" method="POST">
                @csrf
                <input type="hidden" name="task" value="hydration">
                <button type="submit" class="btn-primary">FAIT</button>
            </form>

            
            <a href="{{ route('rappels') }}" class="btn-primary">
                VOIR
            </a>

        </div>

        <!-- Carte Contacts d'urgence -->
        <div class="card">
            <h3>Contacts d'urgence</h3>
            <p>Nom + Téléphone</p>
            <a href="tel:+33123456789" class="btn-primary">APPELER</a>
        </div>
    </div>
</div>
@endsection


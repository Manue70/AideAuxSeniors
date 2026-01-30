@extends('layouts.app')

@section('title', 'Rappels')

@section('content')

<main class="info-page {{ session('theme', 'clair') }}">

    <h1 class="info-title">Mes rappels du jour</h1>

    <div class="info-container">

        {{-- Message flash --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        
        <button id="btn-oui-reminder" class="btn btn-primary" type="button">
            ajouter un rappel
        </button>

        {{-- Tableau des rappels si existants --}}
        @if(!$reminders->isEmpty())
            <table class="reminders-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Message</th>
                        <th>Heure</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reminders as $reminder)
                        <tr class="{{ $reminder->est_effectue ? 'done' : '' }}">
                            <td>{{ ucfirst($reminder->type) }}</td>
                            <td>{{ $reminder->message }}</td>
                            <td>{{ substr($reminder->heure, 0, 5) }}</td>
                            <td>
                                <span class="status {{ $reminder->est_effectue ? 'done' : 'todo' }}">
                                    {{ $reminder->est_effectue ? 'Fait' : 'À faire' }}
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('rappels.toggle', $reminder->id) }}">
                                    @csrf
                                    <button class="btn btn-small btn-primary">
                                        {{ $reminder->est_effectue ? 'Annuler' : 'Valider' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucun rappel enregistré pour le moment.</p>
        @endif

    </div>
    {{--bouteau nouveau rappel--}}
    <div> {{-- Bouton Nouveau Rappel --}}
        <button id="btn-new-reminder" class="btn btn-primary">Ajouter un rappel
        </button>
    </div>

    <button id="btn-new-medication" data-redirect="{{ route('rappels') }}" class="btn btn-primary">
        Ajouter un médicament
    </button>



    {{-- Retour au dashboard --}}
    <div class="info-buttons">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
    

</main>

<!-- MODALE POUR NOUVEAU MÉDICAMENT -->
<div id="modal-medicament" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Nouveau médicament</h3>

        <form method="POST" action="{{ route('medicaments.store') }}" id="medicament-form">
            @csrf

            <input type="hidden" name="redirect_after" id="redirect_medication">


            <label for="nom">Nom du médicament :</label>
            <input type="text" name="nom" id="nom" required>

            <label for="dose">Dose :</label>
            <input type="text" name="dose" id="dose" required>

            <!-- Choix Matin/Midi/Soir -->
            <p>Prise :</p>

            <!-- Boutons Oui/Non -->
            <div class="prise-buttons">
                <span>Prendre ce médicament ?</span>
                <button type="button" class="btn-prise btn-oui">Oui</button>
                <button type="button" class="btn-prise btn-non">Non</button>
            </div>

            <!-- Tableau des horaires, caché par défaut -->
            <div class="prise-horaires" style="display:none; margin-top:20px;">
                <div class="hour-input">
                    <label for="matin_time">Matin :</label>
                    <input type="time" name="matin_time" id="matin_time" value="08:00">
                    <button type="button" class="remove-hour">×</button>
                </div>
                <div class="hour-input">
                    <label for="midi_time">Midi :</label>
                    <input type="time" name="midi_time" id="midi_time" value="12:00">
                    <button type="button" class="remove-hour">×</button>
                </div>
                <div class="hour-input">
                    <label for="soir_time">Soir :</label>
                    <input type="time" name="soir_time" id="soir_time" value="19:00">
                    <button type="button" class="remove-hour">×</button>
                </div>
            </div>

             <div style="margin-top:1rem;">
                <label style="display:flex; align-items:center; gap:0.5rem;">
                    <input type="checkbox" name="is_daily" value="1">
                        Traitement quotidien
                </label>
            </div>

            <!-- Boutons du bas -->
            <div class="modal-buttons">

                <input type="hidden" name="matin" id="input-matin" value="non">
                <input type="hidden" name="midi" id="input-midi" value="non">
                <input type="hidden" name="soir" id="input-soir" value="non">


                <button type="submit" class="btn btn-primary">Enregistrer le rappel</button>
                <button type="button" id="add-medicament" class="btn btn-secondary">Ajouter un autre médicament</button>
            </div>
        </form>
    </div>
</div>

@include('partials.modal-reminder')


@vite('resources/css/reminders.css')
@endsection 
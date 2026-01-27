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

        
        <!-- Bouton ajouter : ouvre la modale -->
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
        <button id="btn-oui-reminder" class="btn btn-primary">Ajouter un rappel
        </button>
    </div>

    <button id="btn-new-medication" data-redirect="{{ route('rappels.index') }}" class="btn btn-secondary">
        Ajouter un médicament
    </button>



    {{-- Retour au dashboard --}}
    <div class="info-buttons">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>
    

</main>

@include('partials.modal-reminder')


@vite('resources/css/reminders.css')
@endsection


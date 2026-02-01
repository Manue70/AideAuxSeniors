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

        <button class="btn btn-primary  btn-reminder" type="button">
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
        <button class="btn btn-primary btn-open-reminder">Ajouter un rappel
        </button>
    </div>

        <!-- Medicament -->
    <div>
        <button class="btn btn-primary btn-open-medicament">Ajouter un médicament</button>
    </div>

    

    {{-- Retour au dashboard --}}
    <div class="info-buttons">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>
    </div>

    <form method="POST" action="{{ route('rappels.clearDone') }}">
     @csrf
        <button type="submit" class="btn btn-warning">
            Vider les rappels effectués
        </button>
    </form>

 
</main>   

@include('partials.modal-medicament')
@include('partials.modal-reminder')

@endsection


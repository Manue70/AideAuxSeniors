@extends('layouts.app')

@section('content')
<main class="info-page clair">
    <h1 class="info-title">Ajouter un contact</h1>

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Téléphone :</label>
            <input type="tel" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="relation">Relation :</label>
            <input type="text" name="relation" id="relation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Ajouter</button>
    </form>

    <a href="{{ url('/contacts') }}" class="btn btn-secondary mt-2">Retour aux contacts</a>
</main>
@endsection

@section('scripts')
    @vite('resources/css/info-pages.css')
    @vite('resources/js/app.js') 
@endsection

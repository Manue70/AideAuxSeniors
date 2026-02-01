@extends('layouts.app')

@section('title', 'Contacts')

@section('content')

<main class="info-page {{ session('theme', 'clair') }}">

    <h1 class="info-title">Contacts d'urgence</h1>

    <div class="info-contacts">

        <table class="contacts-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Téléphone</th>
                

                </tr>
            </thead>

            <tbody>

                @forelse($contacts as $contact)
                    <tr>
                        <td>
                            {{ $contact->nom }}
                            @if($contact->prioritaire)
                                ⭐
                            @endif
                        </td>
                        <td>
                            <a href="tel:{{ $contact->telephone }}" class="contact-link">
                                {{ $contact->telephone }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Aucun contact enregistré</td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    <div class="info-buttons">

        <a href="{{ route('parametres') }}" class="btn btn-primary">Retour aux paramètres</a>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>

        <button class="btn btn-success btn-open-contact">
            Ajouter un contact
        </button>

    </div>

</main>

@include('partials.modal-contacts')
@vite('resources/css/info-pages.css')
@endsection

        
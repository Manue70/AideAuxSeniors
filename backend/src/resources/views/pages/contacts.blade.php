@extends('layouts.app')

@section('title', 'Contacts')

@section('content')

<main class="info-page {{ session('theme', 'clair') }}">
    
    <h1 class="info-title">Contacts d'urgence</h1>

    <div class="info-contacts">
        <table class="contacts-table">
            <thead>
                <tr>
                    <th>Profession</th>
                    <th>Nom</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Urgences</td>
                    <td>Appeller</td>
                    <td><a href="tel:112" class="contact-link urgent">112</a></td>
                </tr>
                <tr>
                    <td>Contact familial 1</td>
                    <td>(Nom)</td>
                    <td><a href="tel:+33000000000" class="contact-link">+33 1 00 00 00 00</a></td>
                </tr>
                <tr>
                    <td>Contact familial 2</td>
                    <td>(Nom)</td>
                    <td><a href="tel:+330101010101" class="contact-link">+33 01 01 01 01</a></td>
                </tr>
                <tr>
                    <td>Médecin traitant</td>
                    <td>Dr. Doe </td>
                    <td><a href="tel:+33103030303" class="contact-link">+33 1 03 03 03 03</a></td>

                </tr>
                <tr>
                    <td>Pharmacie de garde</td>
                    <td>Pharmacie Centrale </td>
                    <td><a href="tel:+33102020202" class="contact-link">+33 1 02 02 02 02</a></td>

                </tr>
            </tbody>
        </table>
    </div>



    <div class="info-buttons">
        
            <a href="{{ route('parametres') }}" class="btn btn-primary">Retour aux paramètres</a>
        
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Retour au tableau de bord</a>

            @auth
                <a href="{{ route('contacts.create') }}" class="btn btn-success">
                    Ajouter un contact
                </a>
            @endauth
        
    </div>


</main>

@vite('resources/css/info-pages.css')
@endsection
        
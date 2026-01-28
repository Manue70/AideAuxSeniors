@extends('layouts.app')

@section('title', 'Onboarding - Contacts')

@section('content')

@php $step = 4; @endphp
@include('partials.progress')

<div class="onboarding-content">
    <div class="onboarding-header">  
        <h1>Contacts</h1>
    </div>  

    <div class="onboarding-question">
        <p>Souhaitez-vous ajouter un contact ?</p>
    </div>
    
    <div class="onboarding-form">
       <form method="POST" action="{{ route('contacts.store') }}">
            @csrf

            <input type="hidden" name="redirect_after" id="contact_redirect_after">

            <div id="contacts-container">
                <div class="contact-line" style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
                    <input type="text" name="nom[]" placeholder="Nom" required>
                    <input type="text" name="telephone[]" placeholder="Téléphone" required>
                    <button type="button" class="btn btn-danger btn-remove-contact">×</button>
                </div>
            </div>

            <button
                type="button"
                id="add-contact"
                class="btn btn-secondary"
                data-redirect="{{ route('onboarding.5') }}"
            >
                 Ajouter un contact
            </button>

            <button type="submit" class="btn btn-primary">
                Enregistrer
            </button>
        </form>

    </div>

    <div class="onboarding-continue">
        <a href="{{ route('onboarding.5') }}" class="btn btn-primary">
            Continuer
        </a>
    </div>
    
</div>

@endsection




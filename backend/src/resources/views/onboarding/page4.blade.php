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
    
    <div class="onboarding-buttons">
        <!-- Bouton Oui : ouvre la modale -->
        <button class="btn btn-primary btn-open-contact">
                Oui
        </button>


        <!-- Bouton Non : fait comme Continuer -->
        <a href="{{ route('onboarding.3') }}" class="btn btn-secondary">
            Non
        </a>
    </div>

    <div class="onboarding-continue">
        <a href="{{ route('onboarding.5') }}" class="btn btn-primary">
            Continuer
        </a>
    </div>
    
</div>


@include('partials.modal-contacts')

@endsection
    




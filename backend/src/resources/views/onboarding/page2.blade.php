@extends('layouts.app')

@section('title', 'Onboarding - Rappels')

@section('content')

@php $step = 2; @endphp
@include('partials.progress')

<div class="onboarding-content">
    <div class="onboarding-header">
        <h1>Rappels</h1>
    </div>

    <div class="onboarding-question">
        <p>Souhaitez-vous recevoir des rappels ?</p>
    </div>   

    <div class="onboarding-buttons">
        <!-- Bouton Oui : ouvre la modale -->
        <button id="btn-oui-reminder" class="btn btn-primary" type="button">
            Oui
        </button>

        <!-- Bouton Non : fait comme Continuer -->
        <a href="{{ route('onboarding.3') }}" class="btn btn-secondary">
            Non
        </a>
    </div>

    

    
    <div class="onboarding-continue">
        <a href="{{ route('onboarding.3') }}" class="btn btn-primary">
            Continuer
        </a>
    </div>
    
</div>

@include('partials.modal-reminder')


@endsection

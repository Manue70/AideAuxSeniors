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
        <button class="btn btn-primary btn-open-reminder">
                Oui
        </button>


        <!-- Bouton Non : fait comme Continuer -->
        <a href="{{ route('onboarding.3') }}" class="btn btn-secondary">
            Non
        </a>
    </div>

    <div style="margin-top:1rem;">
        <label style="display:flex; align-items:center; gap:0.5rem;">
            <input type="checkbox" name="is_daily" value="1">
                Rappel quotidien
        </label>
    </div>


    
    <div class="onboarding-continue">
        <a href="{{ route('onboarding.3') }}" class="btn btn-primary">
            Continuer
        </a>
    </div>
    
</div>

@include('partials.modal-reminder')


@endsection

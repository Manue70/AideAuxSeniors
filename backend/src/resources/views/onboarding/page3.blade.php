@extends('layouts.app')

@section('title', 'Onboarding - Médicaments')

@section('content')

@php $step = 4; @endphp
@include('partials.progress')

<div class="onboarding-content">
    <div class="onboarding-header">
        <h1>Médicaments</h1>
    </div>

    <div class="onboarding-question">
        <p>Prenez-vous des médicaments régulièrement ?</p>
    </div>
    
    <div class="onboarding-buttons">
        <!-- Bouton Oui : ouvre la modale -->
        <button class="btn btn-primary btn-open-medicament">Oui</button>

        <!-- Bouton Non : redirige vers page 4 -->
        <a href="{{ route('onboarding.page4') }}" class="btn btn-secondary">Non</a>
    </div>
      
    <div class="onboarding-continue">
        <a href="{{ route('onboarding.4') }}" class="btn btn-primary">
            Continuer
        </a>
    </div>

</div>


@include('partials.modal-medicament')

@endsection

@extends('layouts.app')

@section('title', 'Onboarding terminé – SeniorAide')

@section('content')

@php $step = 5; @endphp
@include('partials.progress')

<div class="onboarding-content">
    <div class="onboarding-header">
        <h1>Merci, votre espace est prêt !</h1>
    </div>

    <div class="onboarding-question">
        <p>
            Votre compte a été configuré avec succès.<br>
            Vous pouvez maintenant accéder à votre tableau de bord.
        </p>
    </div>

    <div class="onboarding-continue">
        <form method="POST" action="{{ route('onboarding.complete') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                Accéder à mon espace
            </button>
        </form>
    </div>

</div>

@endsection


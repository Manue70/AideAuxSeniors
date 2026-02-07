@extends('layouts.app')

@section('title', 'Onboarding terminé – SeniorAide')

@section('content')

@php $step = 6; @endphp
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

@auth
@if(auth()->user()->onboarding_completed)
<script>
    // Redirection automatique après 5 secondes
    setTimeout(() => {
        window.location.href = "{{ route('dashboard') }}";
    }, 8000); // 8000ms = 8 secondes
</script>
@endif
@endauth


@endsection


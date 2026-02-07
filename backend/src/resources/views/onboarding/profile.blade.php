@extends('layouts.app')

@section('title', 'Onboarding - Profile')

@section('content')

@php $step = 2; @endphp
@include('partials.progress')

div class="onboarding-content">
        <div class="onboarding-header">
            <h1>Faisons connaissance</h1>
        </div>

     <form method="POST" action="{{ route('onboarding.profile.store') }}">
        @csrf

        <input
            type="text"
            name="name"
            placeholder="Votre nom"
            value="{{ old('name', auth()->user()->name) }}"
            required
        >
        <input
            type="email"
            name="email"
            value="{{ old('email', auth()->user()->email) }}"
            required
        >

        <input
            type="telephone"
            name="telephone"
            value="{{ old('telephone', auth()->user()->email) }}"
            required
        >

        <input
            type="date"
            name="birthdate"
            value="{{ old('birthdate', auth()->user()->birthdate) }}"
        >


        <button type="submit">Continuer</button>
    </form>

</div>


@endsection

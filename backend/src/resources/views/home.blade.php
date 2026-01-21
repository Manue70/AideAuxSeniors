@extends('layouts.app')

@section('title', 'Accueil – SeniorAide')

@section('content')

<div class="hero {{ $theme }}">
    <div class="overlay"></div>

    <picture>
        {{-- Mobile --}}
        <source media="(max-width: 768px)" 
            srcset="{{ asset(($theme ?? 'clair') === 'clair' ? 'images/background/tree_bg-mobile.webp' : 'images/background/dragon_bg-mobile.webp') }}">
        {{-- Desktop --}}
        <img src="{{ asset(($theme ?? 'clair') === 'clair' ? 'images/background/tree_bg.webp' : 'images/background/dragon_bg.webp') }}"
             class="hero-bg"
             alt="Fond"
             width="1600"
             height="900"
             fetchpriority="high">
    </picture>

    <div class="hero-content">
        <h1>Bienvenue sur SeniorAide</h1>
        <div class="actions">
            <a href="{{ route('login') }}" class="btn">Connexion</a>
            <a href="{{ route('switch-theme') }}" class="btn">Changer le thème</a>
        </div>
    </div>
</div>

@endsection






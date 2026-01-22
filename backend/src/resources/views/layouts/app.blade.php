<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="SeniorAide est une application d’assistance dédiée aux seniors : rappels, contacts d’urgence, accompagnement et aide numérique.">
    <meta name="author" content="SeniorAide">
    <meta name="application-name" content="SeniorAide">

    <meta property="og:title" content="SeniorAide">
    <meta property="og:description" content="Une application simple et sécurisée pour accompagner les seniors au quotidien.">
    <meta property="og:image" content="{{ asset('images/logo/logo.png') }}">
    <meta property="og:type" content="website">


@if (request()->routeIs('home'))
    {{-- Preload Desktop --}}
    <link
        rel="preload"
        as="image"
        media="(min-width: 769px)"
        href="{{ asset(($theme ?? 'clair') === 'clair' ? 'images/background/tree_bg.webp' : 'images/background/dragon_bg.webp') }}"
    >
    {{-- Preload Mobile --}}
    <link
        rel="preload"
        as="image"
        media="(max-width: 768px)"
        href="{{ asset(($theme ?? 'clair') === 'clair' ? 'images/background/tree_bg-mobile.webp' : 'images/background/dragon_bg-mobile.webp') }}"
    >
@endif


    @vite('resources/js/app.js')


    <title>@yield('title', 'SeniorAide')</title>
</head>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif


<body class="{{ session('theme', 'clair') }}">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

   {{-- 🔽 MODALE MENU --}}
    <div id="menuModal" class="menu-modal">
        <div class="menu-overlay"></div> <!-- overlay qui recouvre tout -->

        <div class="menu-panel">
            <a href="{{ route('dashboard') }}" class="btn btn-dark">Tableau de bord</a>
            <a href="{{ route('rappels') }}" class="btn btn-light">Mes rappels</a>
            <a href="{{ route('contacts') }}" class="btn btn-dark">Contacts d'urgence</a>
            <a href="{{ route('assistance') }}" class="btn btn-light">Assistance / Chat</a>
            <a href="{{ route('parametres') }}" class="btn btn-dark">Paramètres</a>
            <a href="{{ route('info-legales') }}" class="btn btn-light">Mentions légales</a>
            <a href="{{ route('confidentialite') }}" class="btn btn-light">Confidentialité</a>
            <a href="{{ route('cookies') }}" class="btn btn-light">Cookies</a>

            {{-- Déconnexion --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <button type="submit" class="btn btn-light">Déconnexion</button>
            </form>
        </div>
    </div>





</body>

</html>

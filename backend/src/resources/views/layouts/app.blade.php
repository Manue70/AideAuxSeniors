<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">

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

@if (auth()->check() && auth()->user()->is_admin)
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endif





    {{-- CSS compilés par Vite --}}
    @vite([
        'resources/css/app.css',
        'resources/css/login-page.css',
        'resources/css/header-footer.css',
        'resources/css/onboarding.css',
        'resources/css/dashboard.css',
        'resources/css/info-pages.css',
        'resources/css/reminders.css',
        'resources/css/assistance.css',
        'resources/css/admin.css',
    ])

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


{{-- JS à la fin pour DOM ready --}}
@vite('resources/js/app.js')



</body>

</html>

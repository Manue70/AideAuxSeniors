@extends('layouts.app')

@section('title', 'Onboarding - Profile')

@section('content')

@php $step = 2; @endphp
@include('partials.progress')

@push('styles')
<link rel="stylesheet" href="{{ asset('build/assets/onboarding-profile.css') }}">
@endpush

<div class="onboarding-content onboarding-profile">

    <div class="onboarding-header">
        <h1>Faisons connaissance</h1>
        <p>Ces informations nous aideront à mieux vous accompagner.</p>
    </div>

    <form method="POST" action="{{ route('onboarding.profile.store') }}" class="profile-form">
        @csrf

        <div class="form-group">
            <label for="name">Nom complet</label>
             <div class="form-group">
                <label for="name">Nom complet</label>
                <span class="input-icon">👤</span>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    required
                    @error('name') class="has-error" @enderror
                >

             
            
            
            @error('name')
                <div class="form-error">
                    <span class="error-icon">⚠️</span>
                    {{ $message }}
                </div>
            @enderror
        </div>



        <div class="form-group">
            <label for="email">Adresse e-mail</label>

            <div class="input-wrapper">
                    <span class="input-icon">📧</span>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        required
                    >
                </div>

            
            @error('name')
                <div class="form-error">
                    <span class="error-icon">⚠️</span>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>

            <div class="input-wrapper">
                <span class="input-icon">📞</span>
                <input
                    id="telephone"
                    type="tel"
                    name="telephone"
                    inputmode="tel"
                    placeholder="06 00 00 00 00"
                    value="{{ old('telephone', auth()->user()->telephone) }}"
                    required
                >
            </div>

             <p class="input-hint">
                Exemple : 06 12 34 56 78
            </p>

            @error('name')
                <div class="form-error">
                    <span class="error-icon">⚠️</span>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Date de naissance</label>
            <span class="input-icon">🎂</span>

            <div class="date-wrapper">
                <select name="birth_day" required>
                    <option value="">Jour</option>
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <select name="birth_month" required>
                    <option value="">Mois</option>
                    @foreach ([
                        '01' => 'Janvier', '02' => 'Février', '03' => 'Mars',
                        '04' => 'Avril', '05' => 'Mai', '06' => 'Juin',
                        '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre',
                        '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
                    ] as $key => $month)
                        <option value="{{ $key }}">{{ $month }}</option>
                    @endforeach
                </select>

                <select name="birth_year" required>
                    <option value="">Année</option>
                    @for ($y = now()->year - 100; $y <= now()->year - 10; $y++)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>




                
            
            

            <div class="form-actions">
                <button type="submit" class="btn-primary btn-large">
                    Continuer
                </button>
            </div>

     </form>

</div>

@endsection

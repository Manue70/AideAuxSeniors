@extends('layouts.app')

@section('title', 'Onboarding - Bienvenue')

@section('content')

@php $step = 1; @endphp
@include('partials.progress')

    <div class="onboarding-content">
        <div class="onboarding-header">
            <h1>Bienvenue sur SeniorAide</h1>
        </div>

        <div class="onboarding-question">
            <p>Nous allons vous poser quelques questions pour mieux vous accompagner</p>
        </div>
    

        <div class="onboarding-continue">
            <a href="{{ route('onboarding.2') }}" class="btn btn-primary">
             Continuer
            </a>
        </div>
    </div>


@endsection


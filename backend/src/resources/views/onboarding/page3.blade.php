@extends('layouts.app')

@section('title', 'Onboarding - Médicaments')

@section('content')

@php $step = 3; @endphp
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
        <button id="btn-oui-medicament" class="btn btn-primary">Oui</button>

        <!-- Bouton Non : redirige vers page 4 -->
        <a href="{{ route('onboarding.4') }}" class="btn btn-secondary">Non</a>
    </div>
      
    <div class="onboarding-continue">
        <a href="{{ route('onboarding.4') }}" class="btn btn-primary">
            Continuer
        </a>
    </div>

</div>

<!-- MODALE POUR NOUVEAU MÉDICAMENT -->
<div id="modal-medicament" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Nouveau médicament</h3>

        <form method="POST" action="{{ route('medicaments.store') }}" id="medicament-form">
            @csrf

            <input type="hidden" name="redirect_after" id="redirect_medication">


            <label for="nom">Nom du médicament :</label>
            <input type="text" name="nom" id="nom" required>

            <label for="dose">Dose :</label>
            <input type="text" name="dose" id="dose" required>

            <!-- Choix Matin/Midi/Soir -->
            <p>Prise :</p>

            <!-- Boutons Oui/Non -->
            <div class="prise-buttons">
                <span>Prendre ce médicament ?</span>
                <button type="button" class="btn-prise btn-oui">Oui</button>
                <button type="button" class="btn-prise btn-non">Non</button>
            </div>

            <!-- Tableau des horaires, caché par défaut -->
            <div class="prise-horaires" style="display:none; margin-top:20px;">
                <div class="ligne-prise">
                    <label for="matin_time">Matin :</label>
                    <input type="time" name="matin_time" id="matin_time" value="08:00">
                </div>
                <div class="ligne-prise">
                    <label for="midi_time">Midi :</label>
                    <input type="time" name="midi_time" id="midi_time" value="12:00">
                </div>
                <div class="ligne-prise">
                    <label for="soir_time">Soir :</label>
                    <input type="time" name="soir_time" id="soir_time" value="19:00">
                </div>
            </div>

             <div style="margin-top:1rem;">
                <label style="display:flex; align-items:center; gap:0.5rem;">
                    <input type="checkbox" name="is_daily" value="1">
                        Traitement quotidien
                </label>
            </div>

            <!-- Boutons du bas -->
            <div class="modal-buttons">

                <input type="hidden" name="matin" id="input-matin" value="non">
                <input type="hidden" name="midi" id="input-midi" value="non">
                <input type="hidden" name="soir" id="input-soir" value="non">


                <button type="submit" class="btn btn-primary">Enregistrer le rappel</button>
                <button type="button" id="add-medicament" class="btn btn-secondary">Ajouter un autre médicament</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('modal-medicament');
    const redirectInput = document.getElementById('redirect_medication');

    document.querySelectorAll('#btn-new-medication').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            modal.style.display = 'flex';

            redirectInput.value = btn.dataset.redirect || '';
        });
    });

    modal.querySelector('.close').addEventListener('click', () => {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', e => {
        if (!modal.querySelector('.modal-content').contains(e.target)) {
            modal.style.display = 'none';
        }
    });

});
</script>


        

@endsection

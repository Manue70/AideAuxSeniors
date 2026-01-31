<!-- MODALE MÉDICAMENT -->
<div id="modal-medicament" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h3>Nouveau médicament</h3>

        <form method="POST" action="{{ route('medicaments.store') }}" id="medicament-form">
            @csrf

            <!-- Redirection après enregistrement -->
            <input type="hidden" name="redirect_after" value="{{ url()->current() }}">

            <!-- Nom -->
            <label for="nom">Nom du médicament :</label>
            <input type="text" name="nom" id="nom" required>

            <!-- Dosage -->
            <label for="dosage">Dose :</label>
            <input type="text" name="dosage" id="dosage" required>

            <!-- Traitement quotidien -->
            <div style="margin-top:1rem;">
                <label style="display:flex; align-items:center; gap:0.5rem;">
                    <input type="checkbox" name="is_daily" value="1">
                    Traitement quotidien
                </label>
            </div>

            <!-- Choix Matin/Midi/Soir -->
            <p>Prise :</p>
            <div class="prise-buttons">
                <button type="button" class="btn-prise btn-oui">Oui</button>
                <button type="button" class="btn-prise btn-non">Non</button>
            </div>

            <div class="prise-horaires" style="display:none; margin-top:20px;">
                <div class="hour-input">
                    <label for="matin">Matin :</label>
                    <input type="hidden" name="matin" value="non">
                    <input type="checkbox" id="matin_checkbox" value="oui">
                </div>
                <div class="hour-input">
                    <label for="midi">Midi :</label>
                    <input type="hidden" name="midi" value="non">
                    <input type="checkbox" id="midi_checkbox" value="oui">
                </div>
                <div class="hour-input">
                    <label for="soir">Soir :</label>
                    <input type="hidden" name="soir" value="non">
                    <input type="checkbox" id="soir_checkbox" value="oui">
                </div>
            </div>

            <div class="modal-buttons" style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Enregistrer le médicament</button>
                <button type="button" id="add-medicament" class="btn btn-secondary">Ajouter un autre médicament</button>
            </div>
        </form>
    </div>
</div>


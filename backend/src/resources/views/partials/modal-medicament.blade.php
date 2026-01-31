<div id="modal-medicament" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h3>Nouveau médicament</h3>

        <form method="POST" action="{{ route('medicaments.store') }}" id="medicament-form">
            @csrf

            <input type="hidden" name="redirect_after" id="redirect_medication">

            <label for="nom">Nom du médicament :</label>
            <input type="text" name="nom" id="nom" required>

            <label for="dosage">Dose :</label>
            <input type="text" name="dosage" id="dosage" required>

            <!-- Choix Matin/Midi/Soir -->
            <p>Prise :</p>
            <div class="prise-buttons">
                <span>Prendre ce médicament ?</span>
                <button type="button" class="btn-prise btn-oui">Oui</button>
                <button type="button" class="btn-prise btn-non">Non</button>
            </div>

            <div class="prise-horaires" style="display:none; margin-top:20px;">
                <div class="hour-input">
                    <label for="matin_time">Matin :</label>
                    <input type="time" name="matin_time" id="matin_time" value="08:00">
                    <button type="button" class="remove-hour">×</button>
                </div>
                <div class="hour-input">
                    <label for="midi_time">Midi :</label>
                    <input type="time" name="midi_time" id="midi_time" value="12:00">
                    <button type="button" class="remove-hour">×</button>
                </div>
                <div class="hour-input">
                    <label for="soir_time">Soir :</label>
                    <input type="time" name="soir_time" id="soir_time" value="19:00">
                    <button type="button" class="remove-hour">×</button>
                </div>
            </div>

            <div style="margin-top:1rem;">
                <label style="display:flex; align-items:center; gap:0.5rem;">
                    <input type="checkbox" name="is_daily" value="1">
                    Traitement quotidien
                </label>
            </div>

            <div class="modal-buttons">
                <input type="hidden" name="matin" id="input-matin" value="non">
                <input type="hidden" name="midi" id="input-midi" value="non">
                <input type="hidden" name="soir" id="input-soir" value="non">

                <button type="submit" class="btn btn-primary">Enregistrer le médicament</button>
                <button type="button" id="add-medicament" class="btn btn-secondary">Ajouter un autre médicament</button>
            </div>
        </form>
    </div>
</div>

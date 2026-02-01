<!-- MODALE MÉDICAMENT -->
<div id="modal-medicament" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h3>Nouveau médicament</h3>

        <form method="POST" action="{{ route('medicaments.store') }}">
            @csrf

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
            
            <div class="hour-input">
                <label>Matin :</label>
                <input type="hidden" name="matin" value="non">
                <input type="checkbox" name="matin" value="oui">
            </div>

            <div class="hour-input">
                <label>Midi :</label>
                <input type="hidden" name="midi" value="non">
                <input type="checkbox" name="midi" value="oui">
            </div>

            <div class="hour-input">
                <label>Soir :</label>
                <input type="hidden" name="soir" value="non">
                <input type="checkbox" name="soir" value="oui">
            </div>

             <div style="margin-top: 1rem;">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>


        </form>
    </div>
</div>


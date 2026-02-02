<div id="modal-medicament" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h3 id="modal-title">Nouveau médicament</h3>

        <form id="medication-form" method="POST" action="{{ route('medicaments.store') }}">
            @csrf
            <input type="hidden" name="_method"  id="form-method">
            <input type="hidden" name="redirect_after" value="{{ url()->current() }}">
            <input type="hidden" name="medication_id" id="medication-id">

            <!-- Nom -->
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="medication-nom" required>

            <!-- Dosage -->
            <label for="dosage">Dosage :</label>
            <input type="text" name="dosage" id="medication-dosage" required>

            <!-- Traitement quotidien -->
            <label>
                <input type="checkbox" name="is_daily" id="medication-daily" value="1">
                Traitement quotidien
            </label>

            <!-- Choix Matin/Midi/Soir -->
            <p>Prise :</p>
            <div class="prise-buttons">
                <button type="button" class="btn-prise btn-oui">Oui</button>
                <button type="button" class="btn-prise btn-non">Non</button>
            </div>

            <div class="prise-horaires" style="display:none; margin-top:10px;">
                <label>
                    <input type="checkbox" name="matin" id="medication-matin" value="oui"> Matin
                </label>
                <label>
                    <input type="checkbox" name="midi" id="medication-midi" value="oui"> Midi
                </label>
                <label>
                    <input type="checkbox" name="soir" id="medication-soir" value="oui"> Soir
                </label>
            </div>

            <div class="modal-buttons" style="margin-top:10px;">
                <button type="submit" class="btn btn-primary" id="save-medication">Enregistrer</button>
                <button type="button" class="btn btn-danger" id="delete-medication" style="display:none;">Supprimer</button>
            </div>
        </form>
    </div>
</div>


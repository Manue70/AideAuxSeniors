<div id="modal-medicament" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <h2 id="modal-title">Nouveau médicament</h2>

        <form method="POST" id="medication-form">
            @csrf
            <input type="hidden" name="_method" id="form-method">
            <input type="hidden" name="medication_id" id="medication-id">
            <input type="hidden" name="redirect_after" value="{{ url()->current() }}">

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" id="medication-nom" required>
            </div>

            <div class="form-group">
                <label>Dosage</label>
                <input type="text" name="dosage" id="medication-dosage" required>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_daily" id="medication-daily">
                    Traitement quotidien
                </label>
            </div>

            <div class="form-group">
                <label>Prise :</label>
                <button type="button" class="btn btn-primary btn-oui">Oui</button>
                <button type="button" class="btn btn-secondary btn-non">Non</button>
            </div>

            <div class="prise-horaires" style="display:none;">
                <label><input type="checkbox" name="matin" id="medication-matin"> Matin</label>
                <label><input type="checkbox" name="midi" id="medication-midi"> Midi</label>
                <label><input type="checkbox" name="soir" id="medication-soir"> Soir</label>
            </div>

            <div class="info-buttons" style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary" id="btn-save-medication">Enregistrer</button>
                <button type="button" class="btn btn-secondary btn-close-medication">Annuler</button>
                <button type="button" class="btn btn-danger" id="delete-medication" style="display:none;">Supprimer</button>
            </div>
        </form>
    </div>
</div>

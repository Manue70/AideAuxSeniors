<div id="modal-medicament" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <h2 id="modal-title">Ajouter un médicament</h2>

        <form id="medication-form" method="POST">
            @csrf
            <input type="hidden" name="_method" id="form-method">
            <input type="hidden" name="id" id="medication-id">

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
                <label>Prise quotidienne ?</label>
                <button type="button" class="btn btn-primary btn-oui">Oui</button>
                <button type="button" class="btn btn-secondary btn-non">Non</button>
            </div>

            <div class="prise-horaires" style="display:none;">
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

            <div class="info-buttons" style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <button type="button" class="btn btn-secondary modal-close">Annuler</button>
                <button type="button" class="btn btn-danger" id="delete-medication" style="display:none;">Supprimer</button>
            </div>
        </form>
    </div>
</div>

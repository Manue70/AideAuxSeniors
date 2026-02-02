<div id="modal-contact" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <h2 id="modal-title">Ajouter un contact</h2>

        <form method="POST" id="contact-form">
            @csrf
            <input type="hidden" name="_method" id="form-method">
            <input type="hidden" name="contact_id" id="contact-id">
            <input type="hidden" name="redirect_after" value="{{ url()->current() }}">

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" id="contact-nom" required>
            </div>

            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" name="telephone" id="contact-telephone" required>
            </div>

            <div class="form-group">
                <label>Lien</label>
                <input type="text" name="lien" id="contact-lien">
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="prioritaire" id="contact-prioritaire">
                    Contact prioritaire
                </label>
            </div>

            <div class="info-buttons" style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary" id="btn-save-contact">Enregistrer</button>
                <button type="button" class="btn btn-secondary btn-close-contact">Annuler</button>
                <button type="button" class="btn btn-danger" id="btn-delete-contact" style="display:none;">Supprimer</button>
            </div>

        </form>
    </div>
</div>

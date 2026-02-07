<div id="modal-hydration" class="modal">

    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <h3>Ajouter un rappel hydratation</h3>

        <form method="POST" action="{{ route('rappels.store') }}">
            @csrf

            <input type="hidden" name="type" value="hydration">

            <label>Heure</label>
            <input type="time" name="heure" required>

            <label>Message</label>
            <input type="text" name="message" value="Boire un verre d’eau" required>

            <button type="submit" class="btn-primary">
                Enregistrer
            </button>
        </form>

    </div>
</div>

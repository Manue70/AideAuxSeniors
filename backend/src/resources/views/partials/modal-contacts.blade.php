<div id="modal-contact" class="modal">

    <div class="modal-content">

        <span class="modal-close">&times;</span>

        <h2>Ajouter un contact</h2>

        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf

            {{-- redirection dynamique --}}
            <input type="hidden" name="redirect_after" value="{{ url()->current() }}">

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" required>
            </div>

            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" name="telephone" required>
            </div>

            <div class="form-group">
                <label>Lien</label>
                <input type="text" name="lien">
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="prioritaire" value="1" {{ old('prioritaire') ? 'checked' : '' }}>
                    Contact prioritaire
                </label>
            </div>


            <button class="btn btn-primary">Enregistrer</button>

        </form>

    </div>

</div>

<div id="modal-reminder" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2>Ajouter un rappel</h2>

        @php
            $routeStore = route('rappels.store');
        @endphp

        <form id="reminderForm" action="{{ route('rappels.store') }}" method="POST">
            @csrf

            <input type="hidden" name="redirect_after" value="{{ url()->current() }}">

            <div class="form-group">
                <label>Type :</label>
                <input type="text" name="type" required>
            </div>

            <div class="form-group">
                <label>Message :</label>
                <input type="text" name="message" required>
            </div>

            <div id="hours-container">
                <div class="hour-input">
                    <input type="time" name="heure[]" required>
                    <button type="button" class="remove-hour btn btn-danger btn-sm">×</button>
                </div>
            </div>
            <button type="button" id="add-hour" class="btn btn-secondary">Ajouter une heure</button>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_daily" value="1">
                    Rappel quotidien
                </label>
            </div>

            <!-- Champ caché pour redirection -->
            <input type="hidden" name="redirect_after" id="redirect_after" value="{{ url()->current() }}">

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>








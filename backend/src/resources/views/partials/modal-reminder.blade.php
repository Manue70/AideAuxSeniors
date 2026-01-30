<div id="modal-reminder" class="modal" style="display:none;">
    <div class="modal-content">

        <span
            id="close-modal"
            class="modal-close"
            style="float:right; cursor:pointer; font-size:1.5rem; font-weight:bold;"
        >
            &times;
        </span>


        <form method="POST" action="{{ route('rappels.store') }}" id="reminderForm"> >
            @csrf

            <!-- redirect dynamique -->
            <input type="hidden" name="from_onboarding" value="{{ request()->is('onboarding/*') ? 1 : 0 }}">

            <label for="type">Type</label>
            <select name="type" id="type" required>
                
                <option value="hydratation">Hydratation</option>
                <option value="exercice">Exercice</option>
                <option value="reveil">Réveil</option>
                <option value="autre">Autre</option>
            </select>

            <label for="message">Nom / Message</label>
            <input type="text" name="message" id="message" required>

            <label>Heure(s)</label>
            <div id="hours-container">
                <div class="hour-input">
                    <input type="time" name="heure[]" value="08:00" required>
                    <button type="button" class="remove-hour btn btn-danger btn-sm">×</button>
                </div>

                <div class="hour-input">
                    <input type="time" name="heure[]" value="12:00">
                    <button type="button" class="remove-hour btn btn-danger btn-sm">×</button>
                </div>

                <div class="hour-input">
                    <input type="time" name="heure[]" value="20:00">
                    <button type="button" class="remove-hour btn btn-danger btn-sm">×</button>
                </div>
            </div>

            


            <button type="button" class="btn btn-secondary" id="add-hour" style="margin-top:0.5rem;">
                + Ajouter une heure
            </button>

            <div style="margin-top:1rem;">
                <label style="display:flex; align-items:center; gap:0.5rem;">
                    <input type="checkbox" name="is_daily" value="1">
                        Rappel quotidien
                </label>
            </div>

            <button class="btn btn-primary">
                Ajouter le rappel
            </button>
        </form>

    </div>
</div>







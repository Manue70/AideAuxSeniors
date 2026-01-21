<div id="modal-reminder" class="modal" style="display:none;">
    <div class="modal-content">

        <span
            id="close-modal"
            class="modal-close"
            style="float:right; cursor:pointer; font-size:1.5rem; font-weight:bold;"
        >
            &times;
        </span>


        <form method="POST" action="{{ route('rappels.store') }}">
            @csrf

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



            <button class="btn btn-primary">
                Ajouter le rappel
            </button>
        </form>

    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('modal-reminder');
    const hoursContainer = document.getElementById('hours-container');
    const addHourBtn = document.getElementById('add-hour');

    if (!modal || !hoursContainer || !addHourBtn) return;

    /* =========================
       SUPPRESSION D’UNE HEURE
    ========================= */
    hoursContainer.addEventListener('click', function (e) {

        const removeBtn = e.target.closest('.remove-hour');
        if (!removeBtn) return;

        e.preventDefault();
        e.stopPropagation();

        const hourInput = removeBtn.closest('.hour-input');
        if (!hourInput) return;

        // Empêche de supprimer la dernière heure
        if (hoursContainer.querySelectorAll('.hour-input').length <= 1) {
            alert("Au moins une heure est nécessaire.");
            return;
        }

        hourInput.remove();
    });

    /* =========================
       AJOUT D’UNE HEURE
    ========================= */
    addHourBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const hourDiv = document.createElement('div');
        hourDiv.className = 'hour-input';
        hourDiv.innerHTML = `
            <input type="time" name="heure[]" required>
            <button type="button" class="remove-hour btn btn-danger btn-sm">×</button>
        `;

        hoursContainer.appendChild(hourDiv);
    });

    /* =========================
       SUBMIT FORM (sécurisé)
    ========================= */
    const form = modal.querySelector('form');
    form.addEventListener('submit', function (e) {
        e.stopPropagation(); // empêche la modale de manger le submit
        // PAS de preventDefault ici → Laravel reçoit bien le POST
    });

});
</script>


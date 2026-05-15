<div class="step-header">
    <h2>Schritt 2: Fahrzeugdaten</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Fahrzeug</p>
    <div class="form-row">
        <div class="form-field form-field--grow">
            <label for="fahrzeug_typ_modell">Typ / Modell *</label>
            <input type="text" id="fahrzeug_typ_modell" name="fahrzeug_typ_modell" required placeholder="z.B. BMW 3er F30">
        </div>
        <div class="form-field">
            <label for="kennzeichen">Amtliches Kennzeichen</label>
            <input type="text" id="kennzeichen" name="kennzeichen" style="text-transform:uppercase" placeholder="z.B. M-AB 1234">
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="km_stand">KM-Stand</label>
            <input type="number" id="km_stand" name="km_stand" min="0" step="1" placeholder="z.B. 85000">
        </div>
        <div class="form-field">
            <label for="motor_nummer">Motor-Nr.</label>
            <input type="text" id="motor_nummer" name="motor_nummer">
        </div>
        <div class="form-field">
            <label for="fahrzeug_ident_nummer">Fahrzeug-Ident-Nr. (FIN)</label>
            <input type="text" id="fahrzeug_ident_nummer" name="fahrzeug_ident_nummer" maxlength="17" pattern="[A-HJ-NPR-Za-hj-npr-z0-9]{17}" placeholder="17 Zeichen" data-error-message="FIN muss genau 17 Zeichen haben (keine I, O, Q)">
        </div>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Termine</p>
    <div class="form-row">
        <div class="form-field">
            <label for="annahmetermin">Annahmetermin *</label>
            <input type="datetime-local" id="annahmetermin" name="annahmetermin" required>
        </div>
        <div class="form-field">
            <label for="abholtermin_werkstatt">Voraussichtlicher Abholtermin</label>
            <input type="datetime-local" id="abholtermin_werkstatt" name="abholtermin_werkstatt">
        </div>
    </div>
</div>

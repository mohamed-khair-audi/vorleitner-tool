<div class="form-section">
    <p class="form-section-legend">Kundendaten / Auftraggeber</p>
    <div class="form-row">
        <div class="form-field">
            <label for="kunde_nachname">Name *</label>
            <input type="text" id="kunde_nachname" name="kunde_nachname" required autocomplete="family-name">
        </div>
        <div class="form-field">
            <label for="kunde_vorname">Vorname *</label>
            <input type="text" id="kunde_vorname" name="kunde_vorname" required autocomplete="given-name">
        </div>
    </div>
    <div class="form-row">
        <div class="form-field form-field--grow">
            <label for="kunde_strasse">Straße *</label>
            <input type="text" id="kunde_strasse" name="kunde_strasse" required autocomplete="street-address">
        </div>
        <div class="form-field form-field--hausnr">
            <label for="kunde_hausnummer">Hausnr. *</label>
            <input type="text" id="kunde_hausnummer" name="kunde_hausnummer" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field form-field--narrow">
            <label for="kunde_plz">PLZ *</label>
            <input type="text" id="kunde_plz" name="kunde_plz" required pattern="[0-9]{5}" inputmode="numeric" maxlength="5" data-error-message="PLZ muss genau 5 Ziffern enthalten">
        </div>
        <div class="form-field form-field--grow">
            <label for="kunde_ort">Wohnort *</label>
            <input type="text" id="kunde_ort" name="kunde_ort" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="kunde_telefon">Telefonnummer (Handy) *</label>
            <input type="tel" id="kunde_telefon" name="kunde_telefon" required autocomplete="tel"
                inputmode="tel" pattern="[+]?[0-9][0-9\s\-]{5,}" maxlength="50"
                data-error-message="Bitte eine gültige Telefonnummer (nur Ziffern, Leerzeichen, optional + am Anfang)">
        </div>
        <div class="form-field">
            <label for="kunde_email">E-Mail *</label>
            <input type="email" id="kunde_email" name="kunde_email" required autocomplete="email">
        </div>
    </div>
</div>

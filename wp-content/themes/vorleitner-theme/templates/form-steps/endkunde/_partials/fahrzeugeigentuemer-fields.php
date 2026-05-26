<div class="form-section">
    <p class="form-section-legend">Ich bin der Fahrzeugeigentümer</p>
    <div class="radio-group" role="radiogroup" aria-required="true">
        <label class="radio-option">
            <input type="radio" name="ist_fahrzeugeigentuemer" value="ja" required>
            <span>Ja</span>
        </label>
        <label class="radio-option">
            <input type="radio" name="ist_fahrzeugeigentuemer" value="nein" required>
            <span>Nein</span>
        </label>
    </div>
</div>

<div class="conditional-block" data-show-if="ist_fahrzeugeigentuemer" data-show-value="nein" hidden>
    <div class="form-section">
        <p class="form-section-legend">Wer ist der Fahrzeugeigentümer? Bitte Daten angeben:</p>
        <div class="form-field">
            <label for="eigentuemer_name">Name *</label>
            <input type="text" id="eigentuemer_name" name="eigentuemer_name" data-required-when-visible>
        </div>
        <div class="form-row">
            <div class="form-field form-field--grow">
                <label for="eigentuemer_strasse">Straße *</label>
                <input type="text" id="eigentuemer_strasse" name="eigentuemer_strasse" data-required-when-visible>
            </div>
            <div class="form-field form-field--hausnr">
                <label for="eigentuemer_hausnummer">Hausnr. *</label>
                <input type="text" id="eigentuemer_hausnummer" name="eigentuemer_hausnummer" data-required-when-visible>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field form-field--narrow">
                <label for="eigentuemer_plz">PLZ *</label>
                <input type="text" id="eigentuemer_plz" name="eigentuemer_plz" pattern="[0-9]{5}" maxlength="5" data-required-when-visible data-error-message="PLZ muss genau 5 Ziffern enthalten">
            </div>
            <div class="form-field form-field--grow">
                <label for="eigentuemer_ort">Wohnort *</label>
                <input type="text" id="eigentuemer_ort" name="eigentuemer_ort" data-required-when-visible>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field">
                <label for="eigentuemer_telefon">Telefonnummer *</label>
                <input type="tel" id="eigentuemer_telefon" name="eigentuemer_telefon" data-required-when-visible
                    inputmode="tel" pattern="[+]?[0-9][0-9\s\-]{5,}" maxlength="50" autocomplete="tel"
                    data-error-message="Bitte eine gültige Telefonnummer (nur Ziffern, Leerzeichen, optional + am Anfang)">
            </div>
            <div class="form-field">
                <label for="eigentuemer_email">E-Mail *</label>
                <input type="email" id="eigentuemer_email" name="eigentuemer_email" data-required-when-visible>
            </div>
        </div>
    </div>
</div>

<div class="step-header">
    <h2>Schritt 1: Auftragsgeber & Kundendaten</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Auftragsgeber *</p>
    <div class="radio-group">
        <?php foreach (AbschleppFieldLabels::auftragsart() as $dfValue => $dfLabel): ?>
            <label class="radio-label">
                <input type="radio" name="auftragsart" value="<?= $dfValue ?>" required> <?= $dfLabel ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Kundendaten</p>
    <div class="form-row">
        <div class="form-field">
            <label for="kunde_vorname">Vorname *</label>
            <input type="text" id="kunde_vorname" name="kunde_vorname" required autocomplete="given-name">
        </div>
        <div class="form-field">
            <label for="kunde_nachname">Nachname *</label>
            <input type="text" id="kunde_nachname" name="kunde_nachname" required autocomplete="family-name">
        </div>
    </div>
    <div class="form-row">
        <div class="form-field form-field--grow">
            <label for="kunde_strasse">Straße</label>
            <input type="text" id="kunde_strasse" name="kunde_strasse" autocomplete="street-address">
        </div>
        <div class="form-field form-field--narrow">
            <label for="kunde_hausnummer">Nr.</label>
            <input type="text" id="kunde_hausnummer" name="kunde_hausnummer">
        </div>
    </div>
    <div class="form-row">
        <div class="form-field form-field--narrow">
            <label for="kunde_plz">PLZ</label>
            <input type="text" id="kunde_plz" name="kunde_plz" pattern="[0-9]{5}" inputmode="numeric" autocomplete="postal-code" maxlength="5" data-error-message="PLZ muss genau 5 Ziffern enthalten">
        </div>
        <div class="form-field form-field--grow">
            <label for="kunde_ort">Ort</label>
            <input type="text" id="kunde_ort" name="kunde_ort" autocomplete="address-level2">
        </div>
    </div>
    <div class="form-field">
        <label for="kunde_telefon">Telefon</label>
        <input type="tel" id="kunde_telefon" name="kunde_telefon" autocomplete="tel">
    </div>
</div>

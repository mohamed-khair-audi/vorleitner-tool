<div class="step-header">
    <h2>Schritt 3: Auftragsdetails</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Ersatzfahrzeug</p>
    <div class="radio-group">
        <?php foreach (WerkstattFieldLabels::ersatzfahrzeugTyp() as $dfValue => $dfLabel): ?>
            <label class="radio-label">
                <input type="radio" name="ersatzfahrzeug_typ" value="<?= $dfValue ?>" <?= $dfValue === 'keines' ? 'checked' : '' ?>>
                <?= $dfLabel ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Kundenbeanstandung</p>
    <div class="form-field">
        <label for="kundenbeanstandung">Beschreibung des Problems</label>
        <textarea id="kundenbeanstandung" name="kundenbeanstandung" rows="4" placeholder="Was hat der Kunde beanstandet?"></textarea>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Kostenangebot</p>
    <div class="form-field">
        <label for="kostenangebot_euro">Kostenangebot (€)</label>
        <input type="number" id="kostenangebot_euro" name="kostenangebot_euro" step="0.01" min="0" placeholder="0,00">
    </div>
</div>

<div class="step-header">
    <h2>Schritt 3: Auftragsdetails</h2>
</div>

<!-- Entspricht PDF-Abschnitt: Mietfahrzeug / Werkstattersatzfahrzeug / Clubmobil -->
<div class="form-section">
    <p class="form-section-legend">Mietfahrzeug / Werkstattersatzfahrzeug / Clubmobil</p>
    <div class="radio-group">
        <?php foreach (WerkstattFieldLabels::ersatzfahrzeugTyp() as $dfValue => $dfLabel): ?>
            <label class="radio-label">
                <input type="radio" name="ersatzfahrzeug_typ" value="<?= $dfValue ?>" <?= $dfValue === 'keines' ? 'checked' : '' ?>>
                <?= $dfLabel ?>
            </label>
        <?php endforeach; ?>
    </div>
    <div class="form-field" style="margin-top:0.75rem">
        <label for="ersatzfahrzeug_info">Zusatzinformation (Kennzeichen, Modell o.&auml;.)</label>
        <input type="text" id="ersatzfahrzeug_info" name="ersatzfahrzeug_info" placeholder="z.B. M-XY 1234 – BMW 1er">
    </div>
</div>

<!-- Entspricht PDF-Abschnitt: Kundenberater + Zuständiger Monteur -->
<div class="form-section">
    <p class="form-section-legend">Kundenberater &amp; Monteur</p>
    <div class="form-row">
        <div class="form-field">
            <label for="kundenberater_name">Kundenberater</label>
            <input type="text" id="kundenberater_name" name="kundenberater_name">
        </div>
        <div class="form-field">
            <label for="zustaendiger_monteur_name">Zuständiger Monteur</label>
            <input type="text" id="zustaendiger_monteur_name" name="zustaendiger_monteur_name">
        </div>
    </div>
</div>

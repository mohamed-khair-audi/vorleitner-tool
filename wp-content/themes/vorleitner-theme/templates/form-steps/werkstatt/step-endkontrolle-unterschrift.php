<div class="step-header">
    <h2>Schritt 6: Endkontrolle & Unterschrift</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Endkontrolle</p>
    <div class="radio-group">
        <label class="radio-label radio-label--large">
            <input type="radio" name="endkontrolle_fahrzeug_abholbereit" value="1">
            <strong>✓ Fahrzeug abholbereit</strong>
        </label>
        <label class="radio-label radio-label--large radio-label--warning">
            <input type="radio" name="endkontrolle_fahrzeug_abholbereit" value="0">
            <strong>✗ Nicht abholbereit – darf nicht bewegt werden</strong>
        </label>
    </div>
    <div class="form-field" style="margin-top:1rem">
        <label for="naechste_hauptuntersuchung">Nächste Hauptuntersuchung (HU)</label>
        <input type="date" id="naechste_hauptuntersuchung" name="naechste_hauptuntersuchung">
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Interne Notizen</p>
    <div class="form-field">
        <textarea id="werkstatt_notizen" name="werkstatt_notizen" rows="3" placeholder="Nur intern sichtbar"></textarea>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">AGB & Datenschutz</p>
    <p class="agb-hinweis-text">
        Mit der Unterschrift bestätigen Sie, dass wir Ihr KFZ reparieren dürfen.
        Die Fehlersuche und Schadensfeststellung ist kostenpflichtig.
        Falls Ihr Fahrzeug nicht bis zur vollen Fahrtüchtigkeit repariert wird, fallen ab dem fünften Tag Standgebühren an.
    </p>
    <div class="form-field">
        <label class="checkbox-label">
            <input type="checkbox" name="agb_akzeptiert" value="1" required>
            Ich habe die <a href="https://www.vorleitner.de/impressum" target="_blank">AGB</a> und
            <a href="https://www.vorleitner.de/datenschutz" target="_blank">Datenschutzbestimmungen</a>
            gelesen und akzeptiere diese. *
        </label>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Unterschrift *</p>
    <div class="signature-pad-wrapper">
        <canvas id="werkstatt-signature-canvas" class="signature-pad-canvas"></canvas>
        <div class="signature-pad-toolbar">
            <span>Bitte hier mit Finger oder Maus unterschreiben</span>
            <button type="button" class="btn-clear-signature" data-action="clear-signature">Löschen</button>
        </div>
    </div>
    <input type="hidden" name="unterschrift_base64" id="unterschrift_base64">
    <p class="signature-required-note">Die Unterschrift bestätigt die Auftragserteilung.</p>
</div>

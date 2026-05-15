<div class="step-header">
    <h2>Schritt 6: Unterschrift & Bestätigung</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Interne Notizen</p>
    <div class="form-field">
        <textarea id="interne_notizen" name="interne_notizen" rows="3" placeholder="Nur intern sichtbar"></textarea>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">AGB & Datenschutz</p>
    <p class="agb-hinweis-text">
        Wir möchten Sie darauf hinweisen, dass für Ihr abgestelltes Fahrzeug Standgeld verrechnet wird.
        Die Herausgabe des Fahrzeugs kann nur an den Eigentümer oder eine bevollmächtigte Person erfolgen.
        Bei Abholung müssen alle angefallenen Kosten beglichen werden.
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
        <canvas id="abschlepp-signature-canvas" class="signature-pad-canvas"></canvas>
        <div class="signature-pad-toolbar">
            <span>Bitte hier mit Finger oder Maus unterschreiben</span>
            <button type="button" class="btn-clear-signature" data-action="clear-signature">Löschen</button>
        </div>
    </div>
    <input type="hidden" name="unterschrift_base64" id="unterschrift_base64">
    <p class="signature-required-note">Die Unterschrift bestätigt die Auftragserteilung.</p>
</div>

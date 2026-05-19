<div class="step-header">
    <h2>Schritt 5: Checkliste &amp; Endkontrolle</h2>
</div>

<!-- Entspricht PDF-Abschnitt: Endkontrolle / Checkliste (linke Spalte) -->
<div class="form-section">
    <p class="form-section-legend">Checkliste – Kontrolle</p>

    <!-- Probefahrt + Minuten (Minuten nur aktiv wenn Probefahrt = Ja) -->
    <div class="form-row">
        <div class="form-field">
            <label>Probefahrt durchgeführt</label>
            <div class="radio-group">
                <label class="radio-label"><input type="radio" name="probefahrt_durchgefuehrt" value="1"> Ja</label>
                <label class="radio-label"><input type="radio" name="probefahrt_durchgefuehrt" value="0" checked> Nein</label>
            </div>
        </div>
        <div class="form-field">
            <label for="probefahrt_minuten">Dauer (Minuten)</label>
            <input type="number" id="probefahrt_minuten" name="probefahrt_minuten" min="1" step="1"
                   data-depends-on="probefahrt_durchgefuehrt" data-depends-value="1" disabled>
        </div>
    </div>

    <?php
    /* Linke Spalte: alle checklistItems() minus Probefahrt (speziell) und rechte-Spalten-Items */
    $dfRightKeys = ['fahrzeug_gereinigt_innen_aussen', 'motoroel_stand_ok',
                    'kuehlmittel_ok', 'frostschutz_ok', 'endkontrolle_durchgefuehrt'];
    $dfLeftItems = array_diff_key(
        WerkstattFieldLabels::checklistItems(),
        array_flip(array_merge(['probefahrt_durchgefuehrt'], $dfRightKeys))
    );
    ?>
    <div class="checklist-table">
        <div class="checklist-header">
            <span>Punkt</span><span>Ja</span><span>Nein</span>
        </div>
        <?php foreach ($dfLeftItems as $dfFieldName => $dfLabel): ?>
            <div class="checklist-row">
                <span><?= esc_html($dfLabel) ?></span>
                <label><input type="radio" name="<?= $dfFieldName ?>" value="1"> Ja</label>
                <label><input type="radio" name="<?= $dfFieldName ?>" value="0" checked> Nein</label>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="form-row" style="margin-top:0.75rem">
        <div class="form-field">
            <label for="radschrauben_angezogen_durch">Radschrauben/Muttern angezogen durch</label>
            <input type="text" id="radschrauben_angezogen_durch" name="radschrauben_angezogen_durch">
        </div>
        <div class="form-field">
            <label for="oelablassschraube_nachgezogen_durch">Ölablassschraube nachgezogen durch</label>
            <input type="text" id="oelablassschraube_nachgezogen_durch" name="oelablassschraube_nachgezogen_durch">
        </div>
    </div>
</div>

<!-- Entspricht PDF-Abschnitt: Endkontrolle / Checkliste (rechte Spalte) -->
<div class="form-section">
    <p class="form-section-legend">Checkliste – Flüssigkeiten &amp; Reinigung</p>

    <div class="checklist-table">
        <div class="checklist-header">
            <span>Punkt</span><span>Ja</span><span>Nein</span>
        </div>
        <?php
        $dfAllItems = WerkstattFieldLabels::checklistItems();
        foreach (['fahrzeug_gereinigt_innen_aussen', 'motoroel_stand_ok', 'kuehlmittel_ok', 'frostschutz_ok'] as $dfKey):
            $dfLabel = $dfAllItems[$dfKey] ?? $dfKey;
        ?>
        <div class="checklist-row">
            <span><?= esc_html($dfLabel) ?></span>
            <label><input type="radio" name="<?= $dfKey ?>" value="1"> Ja</label>
            <label><input type="radio" name="<?= $dfKey ?>" value="0" checked> Nein</label>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="form-row" style="margin-top:0.75rem">
        <div class="form-field">
            <label for="motoroel_korrigiert_liter">Motoröl korrigiert (Liter)</label>
            <input type="number" id="motoroel_korrigiert_liter" name="motoroel_korrigiert_liter" step="0.1" min="0"
                   data-depends-on="motoroel_stand_ok" data-depends-value="0" disabled>
        </div>
        <div class="form-field form-field--grow">
            <label for="motoroel_spezifikation">Motoröl-Spezifikation</label>
            <input type="text" id="motoroel_spezifikation" name="motoroel_spezifikation" placeholder="z.B. 5W-30 LL"
                   data-depends-on="motoroel_stand_ok" data-depends-value="0" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="kuehlmittel_korrigiert_liter">Kühlmittel korrigiert (Liter)</label>
            <input type="number" id="kuehlmittel_korrigiert_liter" name="kuehlmittel_korrigiert_liter" step="0.1" min="0"
                   data-depends-on="kuehlmittel_ok" data-depends-value="0" disabled>
        </div>
        <div class="form-field">
            <label for="frostschutz_temperatur_grad">Frostschutz bis (°C)</label>
            <input type="number" id="frostschutz_temperatur_grad" name="frostschutz_temperatur_grad" step="1"
                   data-depends-on="frostschutz_ok" data-depends-value="0" disabled>
        </div>
    </div>
</div>

<!-- Endkontrolle -->
<div class="form-section">
    <p class="form-section-legend">Endkontrolle</p>

    <div class="checklist-table" style="margin-bottom:0.75rem">
        <div class="checklist-header">
            <span>Punkt</span><span>Ja</span><span>Nein</span>
        </div>
        <?php $dfEkLabel = WerkstattFieldLabels::checklistItems()['endkontrolle_durchgefuehrt'] ?? 'Endkontrolle'; ?>
        <div class="checklist-row">
            <span><?= esc_html($dfEkLabel) ?></span>
            <label><input type="radio" name="endkontrolle_durchgefuehrt" value="1"> Ja</label>
            <label><input type="radio" name="endkontrolle_durchgefuehrt" value="0" checked> Nein</label>
        </div>
    </div>

    <div class="radio-group">
        <label class="radio-label radio-label--large">
            <input type="radio" name="endkontrolle_fahrzeug_abholbereit" value="1">
            <strong>&#10003; Fahrzeug abholbereit</strong>
        </label>
        <label class="radio-label radio-label--large radio-label--warning">
            <input type="radio" name="endkontrolle_fahrzeug_abholbereit" value="0">
            <strong>&#10007; Nicht abholbereit – darf nicht bewegt werden</strong>
        </label>
    </div>

    <div class="form-field" style="margin-top:1rem">
        <label for="naechste_hauptuntersuchung">Nächste Hauptuntersuchung (HU)</label>
        <input type="date" id="naechste_hauptuntersuchung" name="naechste_hauptuntersuchung">
    </div>
</div>

<script>
(function () {
    /**
     * Scannt alle Inputs mit data-depends-on und aktiviert/deaktiviert sie
     * je nach aktuellem Zustand des zugehörigen Radio-Feldes.
     * Wird bei change, nach Testdaten-Fill und beim ersten Laden aufgerufen.
     */
    function dfUpdateConditionals() {
        document.querySelectorAll('[data-depends-on]').forEach(function (dfEl) {
            var dfName    = dfEl.dataset.dependsOn;
            var dfReqVal  = dfEl.dataset.dependsValue !== undefined ? dfEl.dataset.dependsValue : '1';
            var dfMatch   = document.querySelector(
                'input[name="' + dfName + '"][value="' + dfReqVal + '"]:checked'
            );
            var dfActive  = !!dfMatch;
            dfEl.disabled = !dfActive;
            if (!dfActive) dfEl.value = '';
            var dfWrap = dfEl.closest('.form-field');
            if (dfWrap) dfWrap.style.opacity = dfActive ? '1' : '0.4';
        });
    }

    /* Auf Radio-Änderungen reagieren */
    document.addEventListener('change', function (dfEvent) {
        if (dfEvent.target.type === 'radio') dfUpdateConditionals();
    });

    /* Beim Testdaten-Fill (input-Event auf dem Form) ebenfalls aktualisieren */
    document.addEventListener('input', function (dfEvent) {
        if (dfEvent.target.tagName === 'FORM' || dfEvent.target.closest('form')) {
            dfUpdateConditionals();
        }
    });

    /* Initialzustand setzen */
    dfUpdateConditionals();

    /* Global verfügbar für FormTestData.fill() */
    window.dfUpdateConditionals = dfUpdateConditionals;
}());
</script>

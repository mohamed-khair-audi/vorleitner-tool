<div class="step-header">
    <h2>Schritt 5: Checkliste</h2>
</div>

<?php
// Probefahrt ist im Formular separat – hier nur die reinen Checklisten-Punkte (ohne probefahrt + kuehlmittel_ok)
$dfChecklistItems = array_diff_key(
    WerkstattFieldLabels::checklistItems(),
    array_flip(['probefahrt_durchgefuehrt', 'kuehlmittel_ok'])
);
?>

<div class="form-section">
    <p class="form-section-legend">Kontrollliste (Ja / Nein)</p>
    <div class="checklist-table">
        <div class="checklist-header">
            <span>Punkt</span><span>Ja</span><span>Nein</span>
        </div>
        <?php foreach ($dfChecklistItems as $dfFieldName => $dfLabel): ?>
            <div class="checklist-row">
                <span><?= esc_html($dfLabel) ?></span>
                <label><input type="radio" name="<?= $dfFieldName ?>" value="1"> Ja</label>
                <label><input type="radio" name="<?= $dfFieldName ?>" value="0" checked> Nein</label>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Probefahrt</p>
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
            <input type="number" id="probefahrt_minuten" name="probefahrt_minuten" min="0" step="1">
        </div>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Schmierstoffe & Kühlung</p>
    <div class="form-row">
        <div class="form-field"><label for="motoroel_korrigiert_liter">Motoröl korrigiert (Liter)</label><input type="number" id="motoroel_korrigiert_liter" name="motoroel_korrigiert_liter" step="0.1" min="0"></div>
        <div class="form-field form-field--grow"><label for="motoroel_spezifikation">Motoröl-Spezifikation</label><input type="text" id="motoroel_spezifikation" name="motoroel_spezifikation" placeholder="z.B. 5W-30 LL"></div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label>Kühlmittel ok?</label>
            <div class="radio-group">
                <label class="radio-label"><input type="radio" name="kuehlmittel_ok" value="1"> Ja</label>
                <label class="radio-label"><input type="radio" name="kuehlmittel_ok" value="0" checked> Nein</label>
            </div>
        </div>
        <div class="form-field"><label for="kuehlmittel_korrigiert_liter">Kühlmittel korrigiert (Liter)</label><input type="number" id="kuehlmittel_korrigiert_liter" name="kuehlmittel_korrigiert_liter" step="0.1" min="0"></div>
        <div class="form-field"><label for="frostschutz_temperatur_grad">Frostschutz bis (°C)</label><input type="number" id="frostschutz_temperatur_grad" name="frostschutz_temperatur_grad" step="1"></div>
    </div>
    <div class="form-row">
        <div class="form-field"><label for="radschrauben_angezogen_durch">Radschrauben angezogen durch</label><input type="text" id="radschrauben_angezogen_durch" name="radschrauben_angezogen_durch"></div>
        <div class="form-field"><label for="oelablassschraube_nachgezogen_durch">Ölablassschraube nachgezogen durch</label><input type="text" id="oelablassschraube_nachgezogen_durch" name="oelablassschraube_nachgezogen_durch"></div>
    </div>
</div>

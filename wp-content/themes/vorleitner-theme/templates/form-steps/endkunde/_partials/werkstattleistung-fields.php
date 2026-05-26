<div class="form-section">
    <p class="form-section-legend">Werkstattleistung: Reparatur oder Diagnose gewünscht?</p>
    <div class="radio-group" role="radiogroup">
        <label class="radio-option">
            <input type="radio" name="werkstattleistung_gewuenscht" value="ja" required>
            <span>Ja</span>
        </label>
        <label class="radio-option">
            <input type="radio" name="werkstattleistung_gewuenscht" value="nein" required>
            <span>Nein</span>
        </label>
    </div>
</div>

<div class="conditional-block" data-show-if="werkstattleistung_gewuenscht" data-show-value="ja" hidden>
    <div class="form-section">
        <p class="form-section-legend">Wenn ja – bitte auswählen:</p>
        <div class="radio-group radio-group--stacked" role="radiogroup">
            <label class="radio-option">
                <input type="radio" name="werkstattleistung_option" value="nur_diagnose" data-required-when-visible>
                <span>Wollen Sie vorerst die Diagnose (71,00&nbsp;–&nbsp;238,00&nbsp;Euro, Kosten ist zu rechnen)</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="werkstattleistung_option" value="nur_anruf" data-required-when-visible>
                <span>Wollen Sie erstmal nur einen Anruf?</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="werkstattleistung_option" value="beauftragung" data-required-when-visible>
                <span>Hiermit beauftrag ich die Firma Vorleitner mit der Reparatur, Diagnose und Ersatzteile Bestellung</span>
            </label>
        </div>
    </div>
</div>

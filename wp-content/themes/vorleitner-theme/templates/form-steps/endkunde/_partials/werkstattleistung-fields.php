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
            <?php foreach (EndkundeFieldLabels::werkstattOption() as $dfValue => $dfLabel): ?>
                <label class="radio-option">
                    <input type="radio" name="werkstattleistung_option" value="<?= esc_attr($dfValue) ?>" data-required-when-visible>
                    <span><?= esc_html($dfLabel) ?></span>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
</div>

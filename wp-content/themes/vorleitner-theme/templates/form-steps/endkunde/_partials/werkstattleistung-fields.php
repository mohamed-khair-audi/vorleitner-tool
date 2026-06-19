<div class="conditional-block" data-show-if="beauftragte_leistungen[]" data-show-value="werkstattauftrag" hidden>
    <div class="form-section">
        <p class="form-section-legend">Welchen Umfang wünschen Sie für den Werkstattauftrag?</p>
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

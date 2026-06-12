<div class="form-section">
    <p class="form-section-legend">Unfall oder Panne?</p>
    <div class="radio-group" role="radiogroup">
        <label class="radio-option">
            <input type="radio" name="unfall_oder_panne" value="unfall" required>
            <span>Unfall</span>
        </label>
        <label class="radio-option">
            <input type="radio" name="unfall_oder_panne" value="panne" required>
            <span>Panne</span>
        </label>
    </div>
</div>

<div class="conditional-block" data-show-if="unfall_oder_panne" data-show-value="unfall" hidden>
    <div class="form-section">
        <p class="form-section-legend">Schuldfrage</p>
        <div class="radio-group" role="radiogroup">
            <?php foreach (EndkundeFieldLabels::unfallSchuld() as $dfValue => $dfLabel): ?>
                <label class="radio-option">
                    <input type="radio" name="unfall_schuldfrage" value="<?= esc_attr($dfValue) ?>" data-required-when-visible>
                    <span><?= esc_html($dfLabel) ?></span>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
</div>

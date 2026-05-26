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
            <label class="radio-option">
                <input type="radio" name="unfall_schuldfrage" value="selbst_schuld" data-required-when-visible>
                <span>Sind Sie selbst schuld?</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="unfall_schuldfrage" value="gegner_schuld" data-required-when-visible>
                <span>Ist der Unfallgegner schuld?</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="unfall_schuldfrage" value="schuld_unklar" data-required-when-visible>
                <span>Schuldfrage unklar?</span>
            </label>
        </div>
    </div>
</div>

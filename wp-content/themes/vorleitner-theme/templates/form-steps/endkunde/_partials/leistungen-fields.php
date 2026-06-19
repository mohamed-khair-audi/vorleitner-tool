<div class="form-section">
    <p class="form-section-legend">Welche Leistungen werden an die Firma Vorleitner beauftragt?</p>
    <p class="form-section-hint">Mehrfachauswahl möglich – bitte mindestens eine Option wählen.</p>
    <div class="checkbox-group" data-checkbox-required>
        <?php foreach (EndkundeFieldLabels::beauftragteLeistungen() as $dfValue => $dfLabel): ?>
            <label class="checkbox-option">
                <input type="checkbox" name="beauftragte_leistungen[]" value="<?= esc_attr($dfValue) ?>">
                <span class="checkbox-option__check" aria-hidden="true"></span>
                <span><?= esc_html($dfLabel) ?></span>
            </label>
        <?php endforeach; ?>
    </div>
</div>

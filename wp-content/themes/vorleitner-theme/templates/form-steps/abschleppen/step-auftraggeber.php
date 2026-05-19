<div class="step-header">
    <h2>Schritt 3: Auftraggeber</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Auftragsgeber *</p>
    <div class="radio-group">
        <?php foreach (AbschleppFieldLabels::auftragsart() as $dfValue => $dfLabel): ?>
            <label class="radio-label">
                <input type="radio" name="auftragsart" value="<?= $dfValue ?>" required>
                <?= $dfLabel ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>

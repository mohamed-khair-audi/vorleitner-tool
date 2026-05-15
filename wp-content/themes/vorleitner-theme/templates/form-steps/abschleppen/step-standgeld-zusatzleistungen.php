<div class="step-header">
    <h2>Schritt 4: Standgeld & Zusatzleistungen</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Auftragsart</p>
    <div class="checkbox-group">
        <?php foreach (AbschleppFieldLabels::einsatzTyp() as $dfValue => $dfLabel): ?>
            <label class="checkbox-label">
                <input type="checkbox" name="einsatz_typ[]" value="<?= $dfValue ?>"> <?= $dfLabel ?>
            </label>
        <?php endforeach; ?>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Standgeld</p>
    <div class="form-row">
        <div class="form-field">
            <label for="standgeld_betrag_euro">Standgeld (€ zzgl. MwSt.)</label>
            <input type="number" id="standgeld_betrag_euro" name="standgeld_betrag_euro" step="0.01" min="0" placeholder="0,00">
        </div>
        <div class="form-field">
            <label for="standgeld_hingewiesen_am">Hingewiesen am</label>
            <input type="date" id="standgeld_hingewiesen_am" name="standgeld_hingewiesen_am">
        </div>
    </div>
    <div class="form-field">
        <label>Hingewiesen per</label>
        <div class="checkbox-group">
            <?php foreach (AbschleppFieldLabels::hinweisPerKanal() as $dfValue => $dfLabel): ?>
                <label class="checkbox-label">
                    <input type="checkbox" name="standgeld_hingewiesen_per[]" value="<?= $dfValue ?>"> <?= $dfLabel ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Zusatzleistungen</p>
    <div class="checkbox-group checkbox-group--grid">
        <?php foreach (AbschleppFieldLabels::zusatzleistungen() as $dfValue => $dfLabel): ?>
            <label class="checkbox-label">
                <input type="checkbox" name="zusatzleistungen[]" value="<?= $dfValue ?>"> <?= $dfLabel ?>
            </label>
        <?php endforeach; ?>
    </div>
    <div class="form-field" style="margin-top:1rem">
        <label for="bergung_stunden_anzahl">Bergung Std. (Anzahl)</label>
        <input type="number" id="bergung_stunden_anzahl" name="bergung_stunden_anzahl" step="0.5" min="0" style="max-width:120px">
    </div>
</div>

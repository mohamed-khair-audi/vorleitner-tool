<div class="step-header">
    <h2>Schritt 5: Leistungen / Checkliste</h2>
</div>

<!-- Linke Spalte: Straßenreinigung bis Bergung -->
<div class="form-section">
    <p class="form-section-legend">Leistungen</p>
    <div class="checkbox-group checkbox-group--grid">
        <?php
        $dfLinksKeys = ['strassenreinigung','reinigung_einsatzfahrzeug','reinigung_standflaeche',
                        'gabelstapler','gdv_pauschale','bergung_stunden',
                        'bergungshelfer','gutachter','schluessel_vorhanden','gewichtszuschlag'];
        foreach (AbschleppFieldLabels::zusatzleistungen() as $dfValue => $dfLabel):
            if (!in_array($dfValue, $dfLinksKeys, true)) continue;
        ?>
            <label class="checkbox-label">
                <input type="checkbox" name="zusatzleistungen[]" value="<?= $dfValue ?>"> <?= $dfLabel ?>
            </label>
        <?php endforeach; ?>
    </div>
    <div class="form-field" style="margin-top:0.75rem">
        <label for="bergung_stunden_anzahl">Bergung – Anzahl Stunden</label>
        <input type="number" id="bergung_stunden_anzahl" name="bergung_stunden_anzahl" step="0.5" min="0" style="max-width:140px" placeholder="z.B. 2.5">
    </div>
</div>

<!-- Freitext-Felder: Miet/Ersatz, Weitertransport, Sammler -->
<div class="form-section">
    <p class="form-section-legend">Weitere Angaben</p>
    <div class="form-row">
        <div class="form-field form-field--grow">
            <label for="miet_ersatzfahrzeug">Miet- / Ersatzfahrzeug</label>
            <input type="text" id="miet_ersatzfahrzeug" name="miet_ersatzfahrzeug" placeholder="Kennzeichen, Modell">
        </div>
        <div class="form-field form-field--grow">
            <label for="weitertransport_ziel">Weitertransport (Ziel)</label>
            <input type="text" id="weitertransport_ziel" name="weitertransport_ziel" placeholder="Adresse / Werkstatt">
        </div>
        <div class="form-field">
            <label for="sammler">Sammler</label>
            <input type="text" id="sammler" name="sammler">
        </div>
    </div>
</div>

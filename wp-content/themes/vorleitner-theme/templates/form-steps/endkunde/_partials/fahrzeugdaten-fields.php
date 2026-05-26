<div class="form-section">
    <p class="form-section-legend">Fahrzeugdaten</p>
    <div class="form-row">
        <div class="form-field">
            <label for="fahrzeug_hersteller">Hersteller *</label>
            <input type="text" id="fahrzeug_hersteller" name="fahrzeug_hersteller" required placeholder="z.&nbsp;B. BMW, VW, Mercedes">
        </div>
        <div class="form-field">
            <label for="fahrzeug_typ">Typ *</label>
            <input type="text" id="fahrzeug_typ" name="fahrzeug_typ" required placeholder="z.&nbsp;B. 320d, Golf">
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="kennzeichen">Kennzeichen *</label>
            <input type="text" id="kennzeichen" name="kennzeichen" required>
        </div>
        <div class="form-field">
            <label for="km_stand">Kilometerstand (circa, optional)</label>
            <input type="number" id="km_stand" name="km_stand" min="0" step="1" inputmode="numeric">
        </div>
    </div>
</div>

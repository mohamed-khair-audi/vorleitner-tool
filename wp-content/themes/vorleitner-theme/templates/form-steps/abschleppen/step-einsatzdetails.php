<div class="step-header">
    <h2>Schritt 3: Einsatzdetails</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Einsatz</p>
    <div class="form-field">
        <label for="einsatzort">Einsatzort</label>
        <textarea id="einsatzort" name="einsatzort" rows="2" placeholder="Straße, Ort"></textarea>
    </div>
    <div class="form-field">
        <label for="schaden_beschreibung">Schaden / Bemerkung</label>
        <textarea id="schaden_beschreibung" name="schaden_beschreibung" rows="3"></textarea>
    </div>
    <div class="form-field">
        <label for="sonstiges_bemerkung">Sonstiges</label>
        <textarea id="sonstiges_bemerkung" name="sonstiges_bemerkung" rows="2"></textarea>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Einsatzzeit & Personal</p>
    <div class="form-row">
        <div class="form-field">
            <label for="einsatz_beginn">Einsatzbeginn</label>
            <input type="datetime-local" id="einsatz_beginn" name="einsatz_beginn">
        </div>
        <div class="form-field">
            <label for="einsatz_ende">Einsatzende</label>
            <input type="datetime-local" id="einsatz_ende" name="einsatz_ende">
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="fahrer_name">Fahrer</label>
            <input type="text" id="fahrer_name" name="fahrer_name">
        </div>
        <div class="form-field">
            <label for="einsatz_fahrzeug_bezeichnung">Einsatzfahrzeug</label>
            <input type="text" id="einsatz_fahrzeug_bezeichnung" name="einsatz_fahrzeug_bezeichnung">
        </div>
    </div>
    <div class="form-row">
        <div class="form-field">
            <label for="miet_ersatzfahrzeug">Miet- / Ersatzfahrzeug</label>
            <input type="text" id="miet_ersatzfahrzeug" name="miet_ersatzfahrzeug">
        </div>
        <div class="form-field">
            <label for="weitertransport_ziel">Weitertransport (Ziel)</label>
            <input type="text" id="weitertransport_ziel" name="weitertransport_ziel">
        </div>
        <div class="form-field">
            <label for="sammler">Sammler</label>
            <input type="text" id="sammler" name="sammler">
        </div>
    </div>
</div>

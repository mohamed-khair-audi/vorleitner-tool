<div class="step-header">
    <h2>Schritt 2: Fahrzeugdaten</h2>
</div>

<div class="form-section">
    <p class="form-section-legend">Fahrzeug</p>
    <div class="form-row">
        <div class="form-field form-field--grow">
            <label for="fahrzeug_typ">Fahrzeug Typ / Modell</label>
            <input type="text" id="fahrzeug_typ" name="fahrzeug_typ" placeholder="z.B. VW Golf 7">
        </div>
        <div class="form-field">
            <label for="kennzeichen">Kennzeichen *</label>
            <input type="text" id="kennzeichen" name="kennzeichen" required style="text-transform:uppercase" placeholder="z.B. M-AB 1234">
        </div>
    </div>
    <div class="form-field">
        <label for="fahrzeug_gewicht_zulaessig">Zul. ges. Gesamtgewicht (kg)</label>
        <input type="number" id="fahrzeug_gewicht_zulaessig" name="fahrzeug_gewicht_zulaessig" step="1" min="0" max="50000" placeholder="z.B. 1800">
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Termin</p>
    <div class="form-row">
        <div class="form-field">
            <label for="datum">Auftragsdatum *</label>
            <input type="date" id="datum" name="datum" required>
        </div>
        <div class="form-field">
            <label for="abholtermin">Abholtermin</label>
            <input type="date" id="abholtermin" name="abholtermin">
        </div>
        <div class="form-field">
            <label for="abholzeit">Uhrzeit</label>
            <input type="time" id="abholzeit" name="abholzeit">
        </div>
    </div>
</div>

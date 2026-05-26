<div class="form-section">
    <p class="form-section-legend">Wünschen Sie ein Ersatzfahrzeug / Mietfahrzeug?</p>
    <div class="radio-group">
        <label class="radio-option"><input type="radio" name="ersatzfahrzeug_gewuenscht" value="ja" required><span>Ja</span></label>
        <label class="radio-option"><input type="radio" name="ersatzfahrzeug_gewuenscht" value="nein" required><span>Nein</span></label>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Ich hole das Auto selbst ab</p>
    <div class="radio-group">
        <label class="radio-option"><input type="radio" name="auto_selbst_abholung" value="ja" required><span>Ja</span></label>
        <label class="radio-option"><input type="radio" name="auto_selbst_abholung" value="nein" required><span>Nein</span></label>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Es wird einen Sammeltransport über ADAC oder andere Versicherung geben</p>
    <div class="radio-group">
        <label class="radio-option"><input type="radio" name="sammeltransport_geplant" value="ja" required><span>Ja</span></label>
        <label class="radio-option"><input type="radio" name="sammeltransport_geplant" value="nein" required><span>Nein</span></label>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Befinden sich Wertgegenstände im Fahrzeug?</p>
    <div class="radio-group">
        <label class="radio-option"><input type="radio" name="wertgegenstaende_im_fzg" value="ja" required><span>Ja</span></label>
        <label class="radio-option"><input type="radio" name="wertgegenstaende_im_fzg" value="nein" required><span>Nein</span></label>
    </div>
</div>

<div class="conditional-block" data-show-if="wertgegenstaende_im_fzg" data-show-value="ja" hidden>
    <div class="form-section">
        <div class="form-field">
            <label for="wertgegenstaende_beschreibung">Wenn ja, welche Wertgegenstände? *</label>
            <textarea id="wertgegenstaende_beschreibung" name="wertgegenstaende_beschreibung" rows="3" data-required-when-visible></textarea>
        </div>
    </div>
</div>

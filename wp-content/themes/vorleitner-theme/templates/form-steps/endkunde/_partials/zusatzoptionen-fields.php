<div class="form-section">
    <p class="form-section-legend">Ich wünsche ein Ersatzfahrzeug / Mietfahrzeug</p>
    <div class="radio-group">
        <label class="radio-option"><input type="radio" name="ersatzfahrzeug_gewuenscht" value="ja" required><span>Ja</span></label>
        <label class="radio-option"><input type="radio" name="ersatzfahrzeug_gewuenscht" value="nein" required><span>Nein</span></label>
    </div>
</div>

<div class="form-section">
    <p class="form-section-legend">Ich hole das Fahrzeug selbst ab</p>
    <div class="radio-group">
        <label class="radio-option"><input type="radio" name="auto_selbst_abholung" value="ja" required><span>Ja</span></label>
        <label class="radio-option"><input type="radio" name="auto_selbst_abholung" value="nein" required><span>Nein</span></label>
    </div>
</div>

<div class="conditional-block" data-show-if="auto_selbst_abholung" data-show-value="nein" hidden>
    <div class="form-section">
        <p class="form-section-legend">Daten des Abholers</p>
        <div class="form-field">
            <label for="abholer_name">Name des Abholers *</label>
            <input type="text" id="abholer_name" name="abholer_name" data-required-when-visible autocomplete="off">
        </div>
        <div class="form-row">
            <div class="form-field form-field--grow">
                <label for="abholer_strasse">Straße *</label>
                <input type="text" id="abholer_strasse" name="abholer_strasse" data-required-when-visible>
            </div>
            <div class="form-field form-field--hausnr">
                <label for="abholer_hausnummer">Hausnr. *</label>
                <input type="text" id="abholer_hausnummer" name="abholer_hausnummer" data-required-when-visible>
            </div>
        </div>
        <div class="form-row">
            <div class="form-field form-field--narrow">
                <label for="abholer_plz">PLZ *</label>
                <input type="text" id="abholer_plz" name="abholer_plz" pattern="[0-9]{5}" inputmode="numeric" maxlength="5" data-required-when-visible data-error-message="PLZ muss genau 5 Ziffern enthalten">
            </div>
            <div class="form-field form-field--grow">
                <label for="abholer_ort">Ort *</label>
                <input type="text" id="abholer_ort" name="abholer_ort" data-required-when-visible>
            </div>
        </div>
        <div class="form-field">
            <label for="abholer_telefon">Telefonnummer des Abholers *</label>
            <input type="tel" id="abholer_telefon" name="abholer_telefon" inputmode="tel" pattern="[+]?[0-9][0-9\s\-]{5,}" maxlength="50" data-required-when-visible data-error-message="Bitte eine gültige Telefonnummer eingeben">
        </div>
        <div class="consent-box consent-box--compact" style="margin-top:1rem">
            <label class="consent-box__label" for="abholer_vollmacht">
                <input type="checkbox" id="abholer_vollmacht" name="abholer_vollmacht" value="1" class="consent-box__input" data-required-when-visible>
                <span class="consent-box__check" aria-hidden="true"></span>
                <span class="consent-box__content">
                    <span class="consent-box__text">Hiermit bevollmächtige ich die oben genannte Person, mein Fahrzeug bei der Firma Vorleitner abzuholen.</span>
                </span>
            </label>
        </div>
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

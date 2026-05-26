<div class="step-header">
    <h2>Abschluss &amp; Unterschrift</h2>
    <p class="step-subtitle">Anmerkungen, Infotext lesen und akzeptieren, dann unterschreiben</p>
</div>

<?php include get_template_directory() . '/templates/form-steps/endkunde/_partials/anmerkungen-fields.php'; ?>

<div class="form-section form-section--legal">
    <p class="form-section-legend">Infotext</p>
    <div class="legal-text-box" tabindex="0" aria-label="Infotext und Bedingungen">
        <?= EndkundeLegalText::html() ?>
    </div>
</div>

<div class="consent-box" id="consent-box">
    <label class="consent-box__label" for="agb_akzeptiert">
        <input type="checkbox" id="agb_akzeptiert" name="agb_akzeptiert" value="1" required class="consent-box__input">
        <span class="consent-box__check" aria-hidden="true"></span>
        <span class="consent-box__content">
            <strong class="consent-box__title">Infotext gelesen und akzeptiert</strong>
            <span class="consent-box__text">Ich habe den Infotext gelesen und akzeptiere ihn. Es gelten die AGB und Datenschutzbestimmungen (siehe Infotext oben).</span>
        </span>
    </label>
    <p class="consent-box__meta">Pflichtfeld – ohne Bestätigung ist kein Absenden möglich.</p>
</div>

<div class="form-section form-section--signature">
    <p class="form-section-legend">Unterschrift</p>
    <p class="signature-hint">Unterschreiben Sie mit dem Finger (Handy/Tablet) oder der Maus im Feld unten.</p>
    <div class="signature-pad-wrapper is-empty" id="signature-pad-wrapper">
        <div class="signature-pad-canvas-wrap">
            <span class="signature-pad-placeholder" aria-hidden="true">Hier unterschreiben</span>
            <canvas id="endkunde-signature-canvas" class="signature-pad-canvas" aria-label="Unterschriftsfeld"></canvas>
        </div>
        <div class="signature-pad-toolbar">
            <span class="signature-pad-status">Noch keine Unterschrift</span>
            <button type="button" class="btn-clear-signature" data-action="clear-signature">Unterschrift löschen</button>
        </div>
    </div>
    <input type="hidden" id="unterschrift_base64" name="unterschrift_base64" value="">
</div>

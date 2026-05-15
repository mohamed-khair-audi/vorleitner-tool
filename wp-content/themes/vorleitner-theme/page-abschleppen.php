<?php
/*
 * Template Name: Auftragskarte Abschleppdienst
 */
get_header();
?>

<main class="auftrag-form-container">
    <h1 class="auftrag-form-title">Auftragskarte Abschleppdienst</h1>
    <?php if (current_user_can('manage_options')): ?>
        <button id="fill-test-data-btn" class="btn-test-data">🧪 Testdaten ausfüllen</button>
    <?php endif; ?>

    <?php
    $dfAbschleppStepLabels = [
        'step-auftragsart-kundendaten'        => 'Auftragsgeber & Kunde',
        'step-fahrzeugdaten'                  => 'Fahrzeugdaten',
        'step-einsatzdetails'                 => 'Einsatzdetails',
        'step-standgeld-zusatzleistungen'     => 'Standgeld',
        'step-sicherstellung-versicherung'    => 'Versicherung',
        'step-unterschrift-bestaetigung'      => 'Unterschrift',
    ];
    $dfStepSlugs  = array_keys($dfAbschleppStepLabels);
    $dfStepLabels = array_values($dfAbschleppStepLabels);
    $dfTotalSteps = count($dfStepSlugs);
    ?>

    <div class="form-progress-indicator" data-total-steps="<?= $dfTotalSteps ?>">
        <?php foreach ($dfStepLabels as $dfStepIndex => $dfStepLabel): ?>
            <div class="progress-step <?= $dfStepIndex === 0 ? 'active' : '' ?>" data-step="<?= $dfStepIndex + 1 ?>">
                <span class="progress-step-number"><?= $dfStepIndex + 1 ?></span>
                <span class="progress-step-label"><?= esc_html($dfStepLabel) ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <form id="abschlepp-auftrag-form" class="multi-step-form" novalidate data-form-type="abschleppen">
        <?php foreach ($dfStepSlugs as $dfStepIndex => $dfStepSlug): ?>
            <div class="form-step" data-step="<?= $dfStepIndex + 1 ?>" style="<?= $dfStepIndex > 0 ? 'display:none' : '' ?>">
                <?php include get_template_directory() . '/templates/form-steps/abschleppen/' . $dfStepSlug . '.php'; ?>

                <div class="step-navigation">
                    <?php if ($dfStepIndex > 0): ?>
                        <button type="button" class="btn-previous">← Zurück</button>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>

                    <?php if ($dfStepIndex < $dfTotalSteps - 1): ?>
                        <button type="button" class="btn-next">Weiter →</button>
                    <?php else: ?>
                        <button type="submit" class="btn-submit">Auftrag absenden</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="form-success-message" style="display:none">
            <div class="success-icon">&#10003;</div>
            <h2>Auftrag erfolgreich übermittelt!</h2>
            <p>Der Auftrag wurde erfasst und das PDF per E-Mail an uns weitergeleitet.</p>

            <div class="pdf-actions-block" style="display:none">
                <a href="#" id="pdf-download-btn" class="btn-pdf btn-pdf--view" target="_blank">&#128065; PDF anschauen</a>
            </div>
        </div>
    </form>
</main>

<?php get_footer(); ?>

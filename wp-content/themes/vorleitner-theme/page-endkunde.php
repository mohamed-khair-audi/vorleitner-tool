<?php
/**
 * Template Name: Kundenformular
 * Template Post Type: page
 */
defined('ABSPATH') || exit;

get_header();
?>

<main class="auftrag-form-container auftrag-form-container--public">
    <header class="kundenformular-hero">
        <h1 class="kundenformular-hero__title">
            <span class="kundenformular-hero__brand">Autohaus Vorleitner</span>
            <span class="kundenformular-hero__sep">·</span>
            Kundenauftrag
        </h1>
        <p class="kundenformular-hero__intro">Schritt für Schritt ausfüllen und absenden.</p>
    </header>
    <?php if (AuftragSettings::isTestdatenAktiv()): ?>
        <button id="fill-test-data-btn" class="btn-test-data">&#129514; Testdaten ausf&uuml;llen</button>
    <?php endif; ?>

    <?php
    $dfEndkundeStepLabels = [
        'step-kontakt'           => 'Kundendaten',
        'step-eigentuemer'       => 'Eigentümer',
        'step-fahrzeug'          => 'Fahrzeug',
        'step-schaden'           => 'Unfall/Panne',
        'step-leistung-optionen' => 'Werkstatt',
        'step-abschluss'         => 'Unterschrift',
    ];
    $dfStepSlugs  = array_keys($dfEndkundeStepLabels);
    $dfStepLabels = array_values($dfEndkundeStepLabels);
    $dfTotalSteps = count($dfStepSlugs);
    ?>

    <div class="form-progress-compact" data-total-steps="<?= $dfTotalSteps ?>" data-step-labels="<?= esc_attr(wp_json_encode($dfStepLabels)) ?>">
        <div class="form-progress-compact__meta">
            <span class="form-progress-text">Schritt 1 von <?= $dfTotalSteps ?></span>
            <span class="form-progress-label"><?= esc_html($dfStepLabels[0]) ?></span>
        </div>
        <div class="form-progress-bar" role="progressbar" aria-valuemin="1" aria-valuemax="<?= $dfTotalSteps ?>" aria-valuenow="1">
            <div class="form-progress-bar__fill" style="width:<?= round(100 / $dfTotalSteps) ?>%"></div>
        </div>
        <div class="form-progress-dots" aria-hidden="true">
            <?php foreach ($dfStepLabels as $dfStepIndex => $dfStepLabel): ?>
                <span class="form-progress-dot <?= $dfStepIndex === 0 ? 'is-active' : '' ?>" title="<?= esc_attr($dfStepLabel) ?>"></span>
            <?php endforeach; ?>
        </div>
    </div>

    <form id="endkunde-form" class="multi-step-form" novalidate data-form-type="endkunde" data-public-form="1">
        <?php foreach ($dfStepSlugs as $dfStepIndex => $dfStepSlug): ?>
            <div class="form-step" data-step="<?= $dfStepIndex + 1 ?>" style="<?= $dfStepIndex > 0 ? 'display:none' : '' ?>">
                <?php include get_template_directory() . '/templates/form-steps/endkunde/' . $dfStepSlug . '.php'; ?>

                <div class="step-navigation">
                    <?php if ($dfStepIndex > 0): ?>
                        <button type="button" class="btn-previous">← Zurück</button>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>

                    <?php if ($dfStepIndex < $dfTotalSteps - 1): ?>
                        <button type="button" class="btn-next">Weiter →</button>
                    <?php else: ?>
                        <button type="submit" class="btn-submit">Anfrage absenden</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="form-success-message" style="display:none">
            <div class="success-icon">&#10003;</div>
            <h2>Vielen Dank!</h2>
            <p>Ihre Anfrage wurde erfolgreich übermittelt. Wir haben Ihre Daten erhalten und melden uns bei Ihnen.</p>
        </div>
    </form>
</main>

<?php get_footer(); ?>

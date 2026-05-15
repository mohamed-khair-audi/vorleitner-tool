<?php
defined('ABSPATH') || exit;

$dfFormClassFiles = [
    'post-types/AuftragConstants.php',
    'helpers/PodsPickOptions.php',
    'form-handling/AbschleppValidationRules.php',
    'form-handling/WerkstattValidationRules.php',
    'form-handling/FormDataValidator.php',
    'form-handling/FormDataSanitizer.php',
    'form-handling/FormSubmitOrchestrator.php',
    'post-creation/AuftragPostFactory.php',
    'post-creation/AuftragPdfAttachment.php',
    'pdf-generation/PdfFieldOutput.php',
    'pdf-generation/PdfGenerator.php',
    'pdf-generation/PdfTokenStore.php',
    'pdf-generation/PdfCleanup.php',
    'pdf-generation/PdfRegenerator.php',
    'pdf-generation/AbschleppFieldLabels.php',
    'pdf-generation/WerkstattFieldLabels.php',
    'pdf-generation/AbschleppPdfDataPreparer.php',
    'pdf-generation/WerkstattPdfDataPreparer.php',
    'email/EmailSender.php',
    'email/AbschleppEmailContent.php',
    'email/WerkstattEmailContent.php',
    'rest-api/FormRestPermission.php',
    'rest-api/RestApiRouter.php',
    'rest-api/AbschleppRestEndpoint.php',
    'rest-api/WerkstattRestEndpoint.php',
    'rest-api/PdfDownloadEndpoint.php',
    'rest-api/PdfEmailEndpoint.php',
    'admin-settings/AuftragSettings.php',
];

foreach ($dfFormClassFiles as $dfClassFile) {
    require_once __DIR__ . '/' . $dfClassFile;
}

require_once __DIR__ . '/assets.php';

// Priorität 20 – nach Pods (Priorität 11) damit CPT + Taxonomie bereits registriert sind
add_action('init', function () {
    AuftragSettings::registerDefaults();
    // Taxonomie mit dem CPT verknüpfen (Pods importiert diese Verbindung nicht automatisch)
    register_taxonomy_for_object_type(AuftragConstants::TAXONOMY_SLUG, AuftragConstants::POST_TYPE_SLUG);

    if (!term_exists('abschleppen', AuftragConstants::TAXONOMY_SLUG)) {
        wp_insert_term('Abschleppen', AuftragConstants::TAXONOMY_SLUG, ['slug' => 'abschleppen']);
    }
    if (!term_exists('werkstatt', AuftragConstants::TAXONOMY_SLUG)) {
        wp_insert_term('Werkstatt', AuftragConstants::TAXONOMY_SLUG, ['slug' => 'werkstatt']);
    }
}, 20);

add_action('rest_api_init', function () {
    (new RestApiRouter())->registerAllRoutes();
});

PdfCleanup::register();

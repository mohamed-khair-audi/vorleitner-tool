<?php
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {
    $dfFormTemplates = ['page-abschleppen.php', 'page-werkstatt.php', 'page-endkunde.php'];
    if (!is_page_template($dfFormTemplates)) {
        return;
    }

    $dfThemeUri     = get_template_directory_uri();
    $dfThemeVersion = wp_get_theme()->get('Version');

    wp_enqueue_style('vorleitner-form-steps', $dfThemeUri . '/assets/css/form-steps.css', [], $dfThemeVersion);
    wp_enqueue_style('vorleitner-signature-pad', $dfThemeUri . '/assets/css/signature-pad.css', [], $dfThemeVersion);

    wp_enqueue_script(
        'signature-pad-vendor',
        'https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js',
        [],
        '4.1.7',
        true
    );

    $dfIsEndkunde = is_page_template('page-endkunde.php');
    if (!$dfIsEndkunde) {
        wp_enqueue_script('vorleitner-form-persistence', $dfThemeUri . '/assets/js/form-persistence.js', [], $dfThemeVersion, true);
    }
    wp_enqueue_script('vorleitner-form-pdf-actions',   $dfThemeUri . '/assets/js/form-pdf-actions.js',   [], $dfThemeVersion, true);
    wp_enqueue_script('vorleitner-form-conditional-fields', $dfThemeUri . '/assets/js/form-conditional-fields.js', [], $dfThemeVersion, true);
    wp_enqueue_script('vorleitner-form-steps-navigation', $dfThemeUri . '/assets/js/form-steps-navigation.js', ['vorleitner-form-conditional-fields'], $dfThemeVersion, true);
    wp_enqueue_script('vorleitner-signature-pad-integration', $dfThemeUri . '/assets/js/signature-pad-integration.js', ['signature-pad-vendor'], $dfThemeVersion, true);
    wp_enqueue_script('vorleitner-form-ajax-submit', $dfThemeUri . '/assets/js/form-ajax-submit.js', ['vorleitner-form-steps-navigation'], $dfThemeVersion, true);
    $dfTestdatenAktiv = AuftragSettings::isTestdatenAktiv();
    if ($dfTestdatenAktiv) {
        wp_enqueue_script('vorleitner-form-test-data', $dfThemeUri . '/assets/js/form-test-data.js', [], $dfThemeVersion, true);
    }
    $dfAutoInitDeps = [
        'vorleitner-form-ajax-submit',
        'vorleitner-form-conditional-fields',
        'vorleitner-signature-pad-integration',
    ];
    if (!$dfIsEndkunde) {
        $dfAutoInitDeps[] = 'vorleitner-form-persistence';
        $dfAutoInitDeps[] = 'vorleitner-form-pdf-actions';
    }
    if ($dfTestdatenAktiv) {
        $dfAutoInitDeps[] = 'vorleitner-form-test-data';
    }
    wp_enqueue_script('vorleitner-form-auto-init', $dfThemeUri . '/assets/js/form-auto-init.js', $dfAutoInitDeps, $dfThemeVersion, true);

    wp_localize_script('vorleitner-form-ajax-submit', 'vorleitnerFormConfig', [
        'restUrl' => rest_url(AuftragConstants::REST_NAMESPACE . '/'),
        'nonce'   => wp_create_nonce('wp_rest'),
    ]);
});

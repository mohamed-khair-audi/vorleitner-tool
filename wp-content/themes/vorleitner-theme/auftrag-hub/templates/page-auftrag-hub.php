<?php
/**
 * Template Name: Auftrag starten (Hub)
 */
defined('ABSPATH') || exit;

get_header();

$dfAbs  = AuftragHub::pageUrlByTemplate('page-abschleppen.php');
$dfWs   = AuftragHub::pageUrlByTemplate('page-werkstatt.php');
$dfIn   = is_user_logged_in();
$dfMsg  = isset($_GET['anmeldung_erforderlich']) && $_GET['anmeldung_erforderlich'] === '1';
$dfLogo = get_template_directory() . '/assets/imgs/logo_vorleitner.png';
?>

<main class="auftrag-hub">
    <div class="auftrag-form-container">
        <div class="form-step auftrag-hub__panel">
            <header class="auftrag-hub__header">
                <?php if (file_exists($dfLogo)): ?>
                    <img class="auftrag-hub__logo" src="<?= esc_url(get_template_directory_uri() . '/assets/imgs/logo_vorleitner.png') ?>" height="40" alt="Vorleitner">
                <?php endif; ?>
                <div class="auftrag-hub__header-copy">
                    <h1 class="auftrag-form-title auftrag-hub__title">Auftrag erfassen</h1>
                    <p class="auftrag-hub__lead">
                        <?= $dfIn ? 'Wählen Sie die passende Auftragskarte.' : 'Bitte melden Sie sich an, um fortzufahren.' ?>
                    </p>
                </div>
            </header>

            <?php if ($dfMsg && !$dfIn): ?>
                <div class="auftrag-hub__alert" role="status">Anmeldung erforderlich, um die Formulare zu öffnen.</div>
            <?php endif; ?>

            <?php if ($dfIn): ?>
                <p class="auftrag-hub__section-label">Formular öffnen</p>
                <div class="auftrag-hub__grid">
                    <?php if ($dfAbs): ?>
                        <a class="auftrag-hub__tile auftrag-hub__tile--abschlepp" href="<?= esc_url($dfAbs) ?>">
                            <span class="auftrag-hub__tile-icon" aria-hidden="true">A</span>
                            <span class="auftrag-hub__tile-body">
                                <span class="auftrag-hub__tile-title">Abschleppdienst</span>
                                <span class="auftrag-hub__tile-desc">Auftragskarte Abschleppen</span>
                            </span>
                            <span class="auftrag-hub__tile-chevron" aria-hidden="true"></span>
                        </a>
                    <?php else: ?>
                        <div class="auftrag-hub__tile auftrag-hub__tile--missing">Seite mit Vorlage „Auftragskarte Abschleppdienst“ fehlt.</div>
                    <?php endif; ?>

                    <?php if ($dfWs): ?>
                        <a class="auftrag-hub__tile auftrag-hub__tile--werkstatt" href="<?= esc_url($dfWs) ?>">
                            <span class="auftrag-hub__tile-icon" aria-hidden="true">W</span>
                            <span class="auftrag-hub__tile-body">
                                <span class="auftrag-hub__tile-title">Werkstatt</span>
                                <span class="auftrag-hub__tile-desc">Auftragskarte Werkstatt</span>
                            </span>
                            <span class="auftrag-hub__tile-chevron" aria-hidden="true"></span>
                        </a>
                    <?php else: ?>
                        <div class="auftrag-hub__tile auftrag-hub__tile--missing">Seite mit Vorlage „Auftragskarte Werkstatt“ fehlt.</div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="auftrag-hub__guest">
                    <a class="btn-next auftrag-hub__login" href="<?= esc_url(wp_login_url(get_permalink())) ?>">Anmelden</a>
                    <p class="auftrag-hub__guest-note">Nach der Anmeldung erscheinen hier die beiden Auftragskarten.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer();

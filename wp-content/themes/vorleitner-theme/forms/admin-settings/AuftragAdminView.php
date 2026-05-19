<?php
defined('ABSPATH') || exit;

/**
 * Zeigt PDF-Links in der Auftrags-Listenansicht und als Meta Box.
 */
class AuftragAdminView
{
    public static function register(): void
    {
        $dfCpt = AuftragConstants::POST_TYPE_SLUG;

        // Spalte in der Auftragsliste
        add_filter("manage_{$dfCpt}_posts_columns",       [self::class, 'addPdfColumn']);
        add_action("manage_{$dfCpt}_posts_custom_column", [self::class, 'renderPdfColumn'], 10, 2);
        add_filter("manage_{$dfCpt}_posts_sortable_columns", fn($dfC) => $dfC);

        // Meta Box auf dem Edit-Screen
        add_action('add_meta_boxes', [self::class, 'registerMetaBox']);

        // Inline-CSS für Admin-Ansicht
        add_action('admin_head', [self::class, 'adminStyles']);
    }

    /* ── Spalte ──────────────────────────────────────────────────── */

    public static function addPdfColumn(array $dfColumns): array
    {
        // Nach "title" einfügen
        $dfNew = [];
        foreach ($dfColumns as $dfKey => $dfLabel) {
            $dfNew[$dfKey] = $dfLabel;
            if ($dfKey === 'title') {
                $dfNew['auftrag_pdf'] = '📄 PDF';
            }
        }
        return $dfNew;
    }

    public static function renderPdfColumn(string $dfColumn, int $dfPostId): void
    {
        if ($dfColumn !== 'auftrag_pdf') return;

        if (!get_post_meta($dfPostId, 'auftrag_form_data_json', true)) {
            echo '<span class="auftrag-pdf-none">–</span>';
            return;
        }

        $dfUrl = self::getAdminPdfUrl($dfPostId, 'inline');
        echo '<a href="' . esc_url($dfUrl) . '" target="_blank" class="auftrag-pdf-link" title="PDF öffnen">📄 Öffnen</a>';
    }

    /* ── Meta Box ────────────────────────────────────────────────── */

    public static function registerMetaBox(): void
    {
        add_meta_box(
            'auftrag_pdf_box',
            'Auftragsdokument',
            [self::class, 'renderMetaBox'],
            AuftragConstants::POST_TYPE_SLUG,
            'side',
            'high'
        );
    }

    public static function renderMetaBox(\WP_Post $dfPost): void
    {
        if (!get_post_meta($dfPost->ID, 'auftrag_form_data_json', true)) {
            echo '<p style="color:#999;font-size:12px;">Keine Formulardaten vorhanden.</p>';
            return;
        }

        $dfViewUrl     = self::getAdminPdfUrl($dfPost->ID, 'inline');
        $dfDownloadUrl = self::getAdminPdfUrl($dfPost->ID, 'download');

        echo '<div class="auftrag-pdf-metabox">';
        echo '<a href="' . esc_url($dfViewUrl) . '" target="_blank" class="button button-primary" style="width:100%;text-align:center;margin-bottom:8px">';
        echo '📄 PDF anschauen</a>';
        echo '<a href="' . esc_url($dfDownloadUrl) . '" class="button" style="width:100%;text-align:center">';
        echo '⬇ PDF herunterladen</a>';
        echo '<p style="margin-top:8px;font-size:11px;color:#888">PDF wird bei Klick live generiert.</p>';
        echo '</div>';
    }

    /* ── Styles ──────────────────────────────────────────────────── */

    public static function adminStyles(): void
    {
        $dfScreen = get_current_screen();
        if (!$dfScreen || $dfScreen->post_type !== AuftragConstants::POST_TYPE_SLUG) return;
        ?>
        <style>
        .auftrag-pdf-link {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 2px 8px; border-radius: 4px;
            background: #D92B1A; color: #fff; text-decoration: none;
            font-size: 12px; font-weight: 600;
        }
        .auftrag-pdf-link:hover { background: #b32215; color: #fff; }
        .auftrag-pdf-none { color: #ccc; }
        .auftrag-pdf-metabox .button { box-sizing: border-box; }
        </style>
        <?php
    }

    /* ── Helper ──────────────────────────────────────────────────── */

    private static function getAdminPdfUrl(int $dfPostId, string $dfMode = 'inline'): string
    {
        return add_query_arg(
            [
                'post_id' => $dfPostId,
                'mode'    => $dfMode,
                '_wpnonce' => wp_create_nonce('wp_rest'),
            ],
            rest_url(AuftragConstants::REST_NAMESPACE . '/pdf/admin')
        );
    }
}

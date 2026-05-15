<?php
defined('ABSPATH') || exit;

class AuftragHub
{
    public static function register(): void
    {
        add_filter('theme_page_templates', function (array $dfT): array {
            $dfT['auftrag-hub/templates/page-auftrag-hub.php'] = 'Auftrag starten (Hub)';
            return $dfT;
        });
        add_action('template_redirect', [self::class, 'redirectGuestsFromFormPages']);
        add_action('wp_enqueue_scripts', [self::class, 'enqueueHubStyles']);
    }

    public static function pageUrlByTemplate(string $dfTpl): string
    {
        $dfIds = get_posts(['post_type'=>'page','post_status'=>'publish','posts_per_page'=>1,'meta_key'=>'_wp_page_template','meta_value'=>$dfTpl,'fields'=>'ids']);
        return !empty($dfIds) ? (string) get_permalink((int) $dfIds[0]) : '';
    }

    public static function hubPageUrl(): string
    {
        return self::pageUrlByTemplate('auftrag-hub/templates/page-auftrag-hub.php') ?: home_url('/');
    }

    public static function redirectGuestsFromFormPages(): void
    {
        if (is_user_logged_in() || !is_page()) return;
        $dfS = (string) get_page_template_slug();
        if ($dfS !== 'page-abschleppen.php' && $dfS !== 'page-werkstatt.php') return;
        wp_safe_redirect(add_query_arg('anmeldung_erforderlich', '1', self::hubPageUrl()));
        exit;
    }

    public static function enqueueHubStyles(): void
    {
        if (!is_page_template('auftrag-hub/templates/page-auftrag-hub.php')) return;
        $dfV = wp_get_theme()->get('Version');
        wp_enqueue_style('vorleitner-form-steps', get_template_directory_uri() . '/assets/css/form-steps.css', [], $dfV);
        wp_enqueue_style('vorleitner-auftrag-hub', get_template_directory_uri() . '/auftrag-hub/hub.css', ['vorleitner-form-steps'], $dfV);
    }
}

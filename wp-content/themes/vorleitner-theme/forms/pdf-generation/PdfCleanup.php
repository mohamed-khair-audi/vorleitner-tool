<?php
defined('ABSPATH') || exit;

class PdfCleanup
{
    private const CRON_HOOK = 'vorleitner_pdf_cleanup';

    public static function register(): void
    {
        add_action(self::CRON_HOOK, [self::class, 'run']);
        if (!wp_next_scheduled(self::CRON_HOOK)) {
            wp_schedule_event(time(), 'daily', self::CRON_HOOK);
        }
    }

    public static function run(): void
    {
        $dfPosts = get_posts([
            'post_type'      => AuftragConstants::POST_TYPE_SLUG,
            'posts_per_page' => 200,
            'meta_query'     => [['key' => 'auftrag_pdf_token', 'compare' => 'EXISTS']],
            'date_query'     => [['before' => '48 hours ago', 'column' => 'post_date']],
        ]);

        foreach ($dfPosts as $dfPost) {
            PdfTokenStore::invalidate($dfPost->ID);
        }
    }
}

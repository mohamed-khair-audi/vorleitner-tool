<?php
defined('ABSPATH') || exit;

class PdfTokenStore
{
    private const TOKEN_META = 'auftrag_pdf_token';

    public static function generateAndSave(int $dfPostId): string
    {
        $dfToken = bin2hex(random_bytes(16));
        update_post_meta($dfPostId, self::TOKEN_META, $dfToken);
        return $dfToken;
    }

    public static function validate(int $dfPostId, string $dfToken): bool
    {
        $dfStored = (string) get_post_meta($dfPostId, self::TOKEN_META, true);
        return !empty($dfStored) && hash_equals($dfStored, $dfToken);
    }

    public static function invalidate(int $dfPostId): void
    {
        delete_post_meta($dfPostId, self::TOKEN_META);
    }
}

<?php
defined('ABSPATH') || exit;

class FormRestPermission
{
    public static function verify(WP_REST_Request $dfRequest): bool
    {
        return is_user_logged_in()
            && (bool) wp_verify_nonce($dfRequest->get_header('X-WP-Nonce'), 'wp_rest');
    }
}

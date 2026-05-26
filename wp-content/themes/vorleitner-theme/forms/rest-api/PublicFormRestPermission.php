<?php
defined('ABSPATH') || exit;

class PublicFormRestPermission
{
    public static function verify(WP_REST_Request $dfRequest): bool
    {
        $dfNonce = $dfRequest->get_header('X-WP-Nonce');

        return (bool) wp_verify_nonce($dfNonce, 'wp_rest');
    }
}

<?php
defined('ABSPATH') || exit;

require_once get_template_directory() . '/auftrag-hub/bootstrap.php';
require_once get_template_directory() . '/forms/bootstrap.php';

add_action('after_setup_theme', function () {
    if (!current_user_can('manage_options')) {
        show_admin_bar(false);
    }
});

add_action('init', function () {
    if (is_admin() && !current_user_can('manage_options') && !(defined('DOING_AJAX') && DOING_AJAX)) {
        wp_redirect(home_url());
        exit;
    }
});

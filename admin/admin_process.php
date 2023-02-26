<?php defined('ABSPATH') or die('No script kiddies please!');


add_action('admin_menu', function () {
    global $cptsPageHook;

    $cptsPageHook = add_menu_page(
        __('Custom Post Type Shortcode', 'rsp_shortcode'),
        __('Custom Post Type Shortcode', 'rsp_shortcode'),
        'administrator',
        'cpts',
        function () {
            include(RSP_ADMIN_TEMPLATE_DIR . 'settings.php');
        },
        'dashicons-shortcode'
    );
});

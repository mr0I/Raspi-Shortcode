<?php

/**
 * Plugin Name: Raspi Shortcode
 * Plugin URI: http://localhost
 * Description:
 * Version: 1.0.0
 * Author: ZeroOne
 * Author URI: https://github.com/tuderiewsc
 * Text Domain: rsp_shortcode
 * Domain Path: /l10n
 */
defined('ABSPATH') or die('No script kiddies please!');
define('RSP_ROOTDIR', plugin_dir_path(__FILE__));
define('RSP_INC', RSP_ROOTDIR . 'includes/');
define('RSP_ADMIN', RSP_ROOTDIR . 'admin/');
define('RSP_ADMIN_TEMPLATE_DIR', RSP_ADMIN . 'templates/');
define('RSP_ADMIN_JS', plugin_dir_url(__FILE__) . 'admin/assets/js/');
define('RSP_ADMIN_CSS', plugin_dir_url(__FILE__) . 'admin/assets/css/');
define('RSP_STATIC', plugin_dir_url(__FILE__) . 'site/static/');
define('RSP_CSS', plugin_dir_url(__FILE__) . 'site/static/css/');
define('RSP_JS', plugin_dir_url(__FILE__) . 'site/static/js/');

add_action('plugins_loaded', function () {
    load_plugin_textdomain('rsp_shortcode', false, basename(RSP_ROOTDIR) . '/l10n/');
});


add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('select2-script', RSP_ADMIN_JS . 'select2.min.js', array(), '4.1.0');
    wp_enqueue_script('rsc-admin-script', RSP_ADMIN_JS . 'admin_scripts.js', array('jquery'), '1.0.0');
    wp_localize_script('rsc-admin-script', 'RSP_ADMIN_Ajax', array(
        'AJAXURL' => admin_url('admin-ajax.php'),
        'SECURITY' => wp_create_nonce('OwpCojMcdGJ-k-o'),
        'REQUEST_TIMEOUT' => 30000,
        'SELECT_POST_LIST_TEXT' => __('Select Post...', 'rsp_shortcode'),
        'SUCCESS_COPY_TO_CLIP' => __('The text copied to clipboard successfully :D', 'rsp_shortcode')
    ));

    wp_enqueue_style('select2-css', RSP_ADMIN_CSS . 'select2.min.css', null);
    wp_enqueue_style('rsc-admin-styles', RSP_ADMIN_CSS . 'admin_styles.css', '1.0.0');
});
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('rsc-script', RSP_JS . 'scripts.js', '1.0.0');
    wp_enqueue_style('rsc-styles', RSP_CSS . 'main.css', '1.0.0');
});
/** Init & Includes */
include(RSP_ROOTDIR . 'base_functions.php');
register_activation_hook(__FILE__, 'RSP_activate_function');
register_deactivation_hook(__FILE__, 'RSP_deactivate_function');
include(RSP_INC . 'shortcodes.php');
if (is_admin()) {
    include(RSP_ADMIN . 'ajax_requests.php');
    include(RSP_ADMIN . 'sp_shortcode_metabox.php');
}

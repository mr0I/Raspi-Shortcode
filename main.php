<?php

/**
 * Plugin Name: Raspi Shortcode
 * Plugin URI: http://localhost
 * Description:
 * Version: 1.0.0
 * Author: ZeroOne
 * Author URI: http://localhost
 * Text Domain: raspi_shortcode
 * Domain Path: /languages
 */


defined('ABSPATH') or die('No script kiddies please!');

define('RSC_ROOTDIR', plugin_dir_path(__FILE__));
define('RSC_INC', RSC_ROOTDIR . 'includes/');



// add_action('admin_enqueue_scripts', function () {
//     wp_enqueue_script('admin-script', RSC_ADMIN_JS . 'admin-scripts.js', array(), '1.0.0');
//     wp_localize_script('admin-script', 'RSC_ADMIN_Ajax', array(
//         'AJAXURL' => admin_url('admin-ajax.php'),
//         'SECURITY' => wp_create_nonce('OwpCojMcdGJ-k-o'),
//         'REQUEST_TIMEOUT' => 30000,
//         'SAVE_TEXT' => __('Save', 'intl_qa_lan'),
//         'SUCCESS_MESSAGE' => __('Successful Operation', 'intl_qa_lan')
//     ));
//     wp_enqueue_style('admin-styles', RSC_ADMIN_CSS . 'admin-styles.css', '1.0.1');
// });


/** Init & Includes */
include(RSC_ROOTDIR . 'base_functions.php');
register_activation_hook(__FILE__, 'RSC_activate_function');
register_deactivation_hook(__FILE__, 'RSC_deactivate_function');
include(RSC_INC . 'shortcodes.php');
// if (is_admin()) {
//     include(RSC_ADMIN . 'admin-proccess.php');
//     include(RSC_ADMIN . 'ajax-requests.php');
// }

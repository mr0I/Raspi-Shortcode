<?php defined('ABSPATH') or die('No script kiddies please!');


function WPE_activate_function()
{
    ob_start();
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    //register_uninstall_hook(__FILE__, 'WPE_uninstall');
    flush_rewrite_rules();
}

function WPE_deactivate_function()
{
    flush_rewrite_rules();
}

// function WPE_uninstall()
// {
//     //
// }

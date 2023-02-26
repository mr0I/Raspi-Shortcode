<?php defined('ABSPATH') or die('No script kiddies please!');

function RSP_activate_function()
{
    register_uninstall_hook(__FILE__, 'RSP_uninstall');
    flush_rewrite_rules();
}

function RSP_deactivate_function()
{
    flush_rewrite_rules();
}

function RSP_uninstall()
{
    delete_option('RSP_postTypes');
}

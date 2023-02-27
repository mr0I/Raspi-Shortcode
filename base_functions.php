<?php defined('ABSPATH') or die('No script kiddies please!');

function RSP_activate_function()
{
    flush_rewrite_rules();
}

function RSP_deactivate_function()
{
    flush_rewrite_rules();
}

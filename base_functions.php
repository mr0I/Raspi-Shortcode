<?php defined('ABSPATH') or die('No script kiddies please!');

function CPTS_activate_function()
{
    flush_rewrite_rules();
}

function CPTS_deactivate_function()
{
    flush_rewrite_rules();
}

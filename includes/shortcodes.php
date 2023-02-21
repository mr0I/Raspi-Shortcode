<?php defined('ABSPATH') or die('No script kiddies please!');


add_action('init', function () {
    add_shortcode('insert_raspi', 'insertRaspi');
});

function insertRaspi($atts, $content = null)
{
    ob_start();
    include(RSC_ROOTDIR . './site/templates/raspi_widget.php');
    return do_shortcode(ob_get_clean());
}

<?php defined('ABSPATH') or die('No script kiddies please!');


add_action('init', function () {
    add_shortcode('insert_rsp', 'insertRaspi');
});

function insertRaspi($atts, $content = null)
{
    ob_start();
    include(RSP_ROOTDIR . './site/templates/customPostType_widget.php');
    return do_shortcode(ob_get_clean());
}

<?php defined('ABSPATH') or die('No script kiddies please!');


add_action('add_meta_boxes', function ($post_type, $post) {
    include(RSP_ROOTDIR . 'helpers/helpers.php');
    $customPostTypes = getPostTypesList();

    add_meta_box(
        'singlePost_shortcode',
        __('Raspi Shortcode', 'rsp_shortcode'),
        function ($post) {
            include(RSP_ADMIN_TEMPLATE_DIR . 'sp_shortcode_metabox_content.php');
        },
        $customPostTypes,
        'side',
        'high'
    );
}, 10, 2);

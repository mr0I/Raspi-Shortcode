<?php

add_action('add_meta_boxes', function ($post_type, $post) {
    add_meta_box(
        'singlePost_shortcode',
        __('shortcode', 'rsp_shortcode'),
        function ($post) {
            include(RSP_ADMIN_TEMPLATE_DIR . 'sp_shortcode_metabox_content.php');
        },
        // 'post',
        gettype(get_option('RSP_postTypes', '')) === 'string'
            ? json_decode(get_option('RSP_postTypes', ''), false)
            : 'post',
        'side',
        'high'
    );
}, 10, 2);

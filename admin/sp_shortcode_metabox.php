<?php

add_action('add_meta_boxes', function ($post_type, $post) {
    add_meta_box(
        'singlePost_shortcode',
        __('shortcode', 'cpt_shortcode'),
        function ($post) {
            include(CPTS_ADMIN_TEMPLATE_DIR . 'sp_shortcode_metabox_content.php');
        },
        'post',
        // array('post', 'raspi'),
        'side',
        'high'
    );
}, 10, 2);

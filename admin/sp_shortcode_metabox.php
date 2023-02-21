<?php

add_action('add_meta_boxes', function ($post_type, $post) {
    add_meta_box(
        'singlePost_shortcode',
        __('shortcode', 'raspi_shortcode'),
        function ($post) {
            include(RSC_ADMIN_TEMPLATE_DIR . 'sp_shortcode_metabox_content.php');
        },
        'post',
        // array('post', 'raspi'),
        'side',
        'high'
    );
}, 10, 2);


add_action('save_post', 'sp_information_save');
add_action('save_edit', 'sp_information_save');
function sp_information_save($post_id)
{
    //
}
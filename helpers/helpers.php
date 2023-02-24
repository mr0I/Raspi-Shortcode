<?php

function getSinglePost($post_id, $post_type)
{
    $args = [
        'p' => $post_id,
        'post_type' => $post_type,
        'posts_per_page' => 1,
        'offset' => 0,
        'post_status' => 'publish'
    ];
    $result = new WP_Query($args);
    return $result->posts;
}

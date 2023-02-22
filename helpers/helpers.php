<?php

function getOnePost($post_id, $post_type)
{
    $args = [
        'p' => $post_id,
        'post_type' => $post_type,
        'posts_per_page' => 1,
        'offset' => 0,
        'post_status' => 'publish'
    ];
    $results = new WP_Query($args);
    return $results->posts;
}

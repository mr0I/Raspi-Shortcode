<?php

if (!function_exists('getAllPosts')) {
    function getAllPosts($post_type)
    {
        $args = [
            'post_type' => $post_type,
            'offset' => 0,
            'post_status' => 'publish'
        ];
        $results = new WP_Query($args);
        return $results->posts;
    }
}

if (!function_exists('getSinglePost')) {
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
}

if (!function_exists('getPostTypesList')) {
    function getPostTypesList()
    {
        $postTypes =  get_post_types([
            'public'   => true,
            '_builtin' => false
        ], 'object');

        $postTypesExceptRaspi = [];
        foreach ($postTypes as $postType) {
            if ($postType->capability_type !== 'post' || $postType->name === 'recipe') {
                continue;
            }

            array_push($postTypesExceptRaspi, $postType->name);
        }

        return $postTypesExceptRaspi;
    }
}

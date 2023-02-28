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

if (!function_exists('getAllPostsByCategory')) {
    function getAllPostsByCategory($post_type, $category_id)
    {

        $appConfig = include(RSP_ROOTDIR . 'config.php');

        $args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => $appConfig['RASPI_TAXONOMY_NAME'],
                    'field' => 'term_id',
                    'terms' => $category_id
                )
            )
        );

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
        $appConfig = include(RSP_ROOTDIR . 'config.php');

        $postTypes =  get_post_types([
            'public'   => true,
            '_builtin' => false
        ], 'object');

        $postTypesExceptRaspi = [];
        foreach ($postTypes as $postType) {
            if ($postType->capability_type !== 'post' || $postType->name === $appConfig['RASPI_POST_TYPE_NAME']) {
                continue;
            }

            array_push($postTypesExceptRaspi, $postType->name);
        }

        return $postTypesExceptRaspi;
    }
}

if (!function_exists('getRaspiCategories')) {
    function getRaspiCategories()
    {
        $appConfig = include(RSP_ROOTDIR . 'config.php');

        $args = array(
            'taxonomy' => $appConfig['RASPI_TAXONOMY_NAME'],
            'orderby' => 'name',
            'order'   => 'ASC'
        );

        return get_categories($args);
    }
}

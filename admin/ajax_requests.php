<?php defined('ABSPATH') or die('No script kiddies please!');

require_once(RSC_ROOTDIR . './helpers/helpers.php');

function fetchPosts_callback()
{
    if (!wp_verify_nonce($_POST['nonce'], 'sp-shortcode-nonce') || !check_ajax_referer('OwpCojMcdGJ-k-o', 'SECURITY')) {
        wp_send_json_error('Forbidden', 403);
        exit();
    }

    $postType = sanitize_text_field($_POST['post_type']);
    $args = [
        'post_type' => $postType,
        // 'posts_per_page' => 1,
        'offset' => 0,
        'post_status' => 'publish'
    ];
    $results = new WP_Query($args);
    $posts = $results->posts;

    wp_send_json(['data' => $posts], 200);
    exit();
}
add_action('wp_ajax_fetchPosts', 'fetchPosts_callback');
add_action('wp_ajax_nopriv_fetchPosts', 'fetchPosts_callback');

function fetchSinglePost_callback()
{
    if (!wp_verify_nonce($_POST['nonce'], 'sp-shortcode-nonce') || !check_ajax_referer('OwpCojMcdGJ-k-o', 'SECURITY')) {
        wp_send_json_error('Forbidden', 403);
        exit();
    }

    $postId = sanitize_text_field($_POST['post_id']);
    $postType = sanitize_text_field($_POST['post_type']);

    // $args = [
    //     'p' => $postId,
    //     'post_type' => $postType,
    //     'posts_per_page' => 1,
    //     'offset' => 0,
    //     'post_status' => 'publish'
    // ];
    // $results = new WP_Query($args);
    // $post = $results->posts;

    $post = getSinglePost($postId, $postType);

    wp_send_json(['data' => $post], 200);
}
add_action('wp_ajax_fetchSinglePost', 'fetchSinglePost_callback');
add_action('wp_ajax_nopriv_fetchSinglePost', 'fetchSinglePost_callback');

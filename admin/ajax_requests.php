<?php defined('ABSPATH') or die('No script kiddies please!');

require_once(RSP_ROOTDIR . './helpers/helpers.php');
$appConfig = include(RSP_ROOTDIR . 'config.php');

function fetchPostsByCategory_callback()
{
    $appConfig = include(RSP_ROOTDIR . 'config.php');

    if (!wp_verify_nonce($_POST['nonce'], 'sp-shortcode-nonce') || !check_ajax_referer('OwpCojMcdGJ-k-o', 'SECURITY')) {
        wp_send_json_error('Forbidden', 403);
        exit();
    }

    $category_id = sanitize_text_field($_POST['category_id']);
    $category_id !== 'all'
        ? $posts = getAllPostsByCategory($appConfig['RASPI_POST_TYPE_NAME'], $category_id)
        : $posts = getAllPosts($appConfig['RASPI_POST_TYPE_NAME']);

    wp_send_json(['data' => $posts], 200);
    exit();
}
add_action('wp_ajax_fetchPostsByCategory', 'fetchPostsByCategory_callback');
add_action('wp_ajax_nopriv_fetchPostsByCategory', 'fetchPostsByCategory_callback');

function fetchSinglePost_callback()
{
    if (!wp_verify_nonce($_POST['nonce'], 'sp-shortcode-nonce') || !check_ajax_referer('OwpCojMcdGJ-k-o', 'SECURITY')) {
        wp_send_json_error('Forbidden', 403);
        exit();
    }

    $postId = sanitize_text_field($_POST['post_id']);
    $postType = sanitize_text_field($_POST['post_type']);
    $post = getSinglePost($postId, $postType);

    wp_send_json(['data' => $post], 200);
}
add_action('wp_ajax_fetchSinglePost', 'fetchSinglePost_callback');
add_action('wp_ajax_nopriv_fetchSinglePost', 'fetchSinglePost_callback');

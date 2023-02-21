<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
$post_id = '';
$post_type = '';
extract(shortcode_atts(array(
    'post_id' => '',
    'post_type' => ''
), $atts));

$args = [
    'p' => $post_id,
    'post_type' => $post_type,
    'posts_per_page' => 1,
    'offset' => 0,
    'post_status' => 'publish'
];
$results = new WP_Query($args);
$posts = $results->posts;

// [insert_raspi post_id="14" post_type="raspi"]


// wp_die(json_encode($posts, JSON_PRETTY_PRINT));

?>


<?php if (sizeof($posts) !== 0) : ?>
    <h1>raspi content</h1>
<?php endif; ?>
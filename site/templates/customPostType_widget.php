<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
require_once(RSC_ROOTDIR . 'helpers/helpers.php');
$post_id = '';
$post_type = '';
extract(shortcode_atts(array(
    'post_id' => '',
    'post_type' => ''
), $atts));

// wp_die(json_encode([
//     'pid' => $post_id,
//     'pt' => $post_type
// ], JSON_PRETTY_PRINT));

$post = [];
if ($post_id !== '' && $post_type !== '') {
    $post = getSinglePost($post_id, $post_type);
}
?>


<?php if (sizeof($post) !== 0) : ?>
    <section class="customTypeWidget">
        <div class="customTypeWidget__container">
            <div class="customTypeWidget__content">
                <p class="customTypeWidget__container"><?= $post[0]->post_content; ?></p>
                <a href="<?= get_permalink($post[0]->ID) ?>"><?= __('Read More...', 'raspi_shortcode') ?></a>
            </div>
            <div class="customTypeWidget__image">
                <figure>
                    <img src="<?= get_the_post_thumbnail_url($post[0]->ID, 'large') ?>" alt="<?= $post[0]->post_title; ?>" />
                </figure>
            </div>
        </div>
    </section>

<?php endif; ?>
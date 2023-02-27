<?php defined('ABSPATH') or die('No script kiddies please!'); ?>

<?php
require_once(RSP_ROOTDIR . 'helpers/helpers.php');
$appConfig = include(RSP_ROOTDIR . 'config.php');

$post_id = '';
extract(shortcode_atts(array(
    'post_id' => ''
), $atts));

$post = [];
if ($post_id !== '') {
    $post = getSinglePost($post_id, $appConfig['RASPI_POST_TYPE_NAME']);
}

$isRtl = !!str_starts_with(get_locale(), 'fa_');
?>

<?php if (sizeof($post) !== 0) :
    $postThumbnailSrc = get_the_post_thumbnail_url($post[0]->ID, 'large') != ''
        ? get_the_post_thumbnail_url($post[0]->ID, 'large')
        : RSP_STATIC . 'images/not_available.jpg';
?>
    <section class="customTypeWidget">
        <div class="customTypeWidget__container">
            <div class="customTypeWidget__content <?= $isRtl ? 'rtl' : 'ltr' ?>">
                <h3><?= $post[0]->post_title; ?></h3>
                <figure id="raspi_thumbnail_mobile" style="display: none;text-align: center;">
                    <img src="<?= $postThumbnailSrc ?>" alt="<?= $post[0]->post_title; ?>" />
                </figure>
                <p><?= mb_strimwidth($post[0]->post_content, 0, 650, '...'); ?></p>
                <a class="customTypeWidget__content__link" href="<?= get_permalink($post[0]->ID) ?>"><?= __('Read More...', 'rsp_shortcode') ?></a>
            </div>
            <div class="customTypeWidget__image">
                <figure id="raspi_thumbnail_desktop">
                    <img src="<?= $postThumbnailSrc ?>" alt="<?= $post[0]->post_title; ?>" />
                </figure>
            </div>
        </div>
    </section>
<?php endif; ?>
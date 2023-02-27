<?php defined('ABSPATH') or die('No script kiddies please!');

$cats = getRaspiCategories();
?>

<div style="padding: 10px 0;">
    <form action="" name="sp_shortcode">
        <select id="cats_list" onchange="changeCatId(event)" style="width: 100%;margin-bottom: 16px;">
            <option value="0" disabled selected><?= __('Select Category...', 'rsp_shortcode') ?></option>
            <?php foreach ($cats as $cat) : ?>
                <option value="<?= $cat->cat_ID ?>"><?= $cat->name; ?></option>
            <?php endforeach; ?>
        </select>
        <select id="sp_posts_list" onchange="changePostId(event)" style="width: 100%;margin-bottom: 16px;">
            <option value="0" disabled selected><?= __('Select Post...', 'rsp_shortcode') ?></option>
        </select>
        <input type="hidden" id="sp_shortcode_nonce" value="<?= wp_create_nonce('sp-shortcode-nonce') ?>">

        <div class="loader-spinner">
            <span class="dashicons dashicons-image-rotate spin"></span>
        </div>
    </form>

    <div class="shortcode">
        <p class="shortcode-value" style="direction: ltr;">
            [insert_rsp post_id="<span id="post_id"></span>"]
        </p>
    </div>
</div>
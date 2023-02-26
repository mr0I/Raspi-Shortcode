<?php defined('ABSPATH') or die('No script kiddies please!');

$posts = getAllPosts('recipe');
?>

<div style="padding: 10px 0;">
    <form action="" name="sp_shortcode">
        <select id="sp_posts_list" onchange="changePostId(event)" style="width: 100%;margin-bottom: 16px;">
            <option value="0" disabled selected><?= __('Select Post...', 'rsp_shortcode') ?></option>
            <?php foreach ($posts as $post) : ?>
                <option value="<?= $post->ID ?>"><?= $post->post_title; ?></option>
            <?php endforeach; ?>

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
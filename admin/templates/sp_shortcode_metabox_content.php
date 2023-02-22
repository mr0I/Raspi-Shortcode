<?php defined('ABSPATH') or die('No script kiddies please!');


$postTypes = get_post_types([
    'public'   => true,
    '_builtin' => false
], 'object');

// wp_die(json_encode($postTypes, JSON_PRETTY_PRINT));

?>
<form action="" name="sp_shortcode">
    <select onchange="changePostType(event)">
        <?php foreach ($postTypes as $postType) : ?>
            <?php if ($postType->capability_type === 'post') : ?>
                <option value="<?= $postType->name; ?>"><?= $postType->label; ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
    </select>
    <input type="hidden" id="sp_shortcode_nonce" value="<?= wp_create_nonce('sp-shortcode-nonce') ?>">
</form>
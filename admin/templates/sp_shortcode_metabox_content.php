<?php defined('ABSPATH') or die('No script kiddies please!');


$postTypes = get_post_types([
    'public'   => true,
    '_builtin' => false
], 'object');

// wp_die(json_encode($postTypes, JSON_PRETTY_PRINT));

?>
<select onchange="changePostType(event)">
    <?php foreach ($postTypes as $postType) : ?>
        <?php if ($postType->capability_type === 'post') : ?>
            <option value="<?= $postType->name; ?>"><?= $postType->label; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
</select>
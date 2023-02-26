<?php defined('ABSPATH') or die('No script kiddies please!');


$customPostTypes = getPostTypesList();
$selectedPostTypes = gettype(get_option('RSP_postTypes', '')) === 'string'
    ? json_decode(get_option('RSP_postTypes', ''), false)
    : [];

if ($_REQUEST['submit']) {
    update_option('RSP_postTypes', []);

    if (isset($_POST['post_types'])) {
        update_option('RSP_postTypes', json_encode($_POST['post_types']));
    }

    echo '<div class="updated" id="message"><p><strong>' . __("Settings Saved.", "rsp_shortcode") . '</strong>.</p></div>';

    $selectedPostTypes = gettype(get_option('RSP_postTypes', '')) === 'string'
        ? json_decode(get_option('RSP_postTypes', ''), false)
        : [];
}
?>

<div class="wrap">
    <h2><?= __('Settings', 'rsp_shortcode') ?></h2>
    <div class="nav-tab-wrapper">
        <a href="?page=cpts&amp;tab=home_page" class="nav-tab"><?= __('Main Settings', 'rsp_shortcode') ?></a>
    </div>

    <form method="post" action="">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row"><?= __('Selected Post Types', 'rsp_shortcode') ?></th>
                    <td>
                        <select id="contained_RSP_select" name="post_types[]" multiple>
                            <?php foreach ($customPostTypes as $postType) :
                                if ($postType->capability_type === 'post') :
                            ?>
                                    <option value="<?= $postType->name; ?>" <?= (in_array($postType->name, $selectedPostTypes)) ? 'selected' : '' ?>>
                                        <?= $postType->label; ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?= __('Save Settings', 'rsp_shortcode') ?>">
        </p>
    </form>
</div>
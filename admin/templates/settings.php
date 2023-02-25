<?php defined('ABSPATH') or die('No script kiddies please!');

$customPostTypes = getPostTypesList();


$selectedPostTypes = gettype(get_option('cpts_postTypes', '')) === 'string'
    ? json_decode(get_option('cpts_postTypes', ''), false)
    : [];
// $selectedPostTypes = json_decode(get_option('cpts_postTypes', ''), false);

if ($_REQUEST['submit']) {
    update_option('cpts_postTypes', []);

    if (isset($_POST['post_types'])) {
        // wp_die(json_encode($_POST['post_types'], JSON_PRETTY_PRINT));
        update_option('cpts_postTypes', json_encode($_POST['post_types']));
    }

    echo '<div class="updated" id="message"><p><strong>' . __("Settings Saved.", "cpt_shortcode") . '</strong>.</p></div>';

    $selectedPostTypes = gettype(get_option('cpts_postTypes', '')) === 'string'
        ? json_decode(get_option('cpts_postTypes', ''), false)
        : [];
}


var_dump($selectedPostTypes);

?>


<div class="wrap">
    <h2><?= __('Settings', 'cpt_shortcode') ?></h2>
    <div class="nav-tab-wrapper">
        <a href="?page=cpts&amp;tab=home_page" class="nav-tab">تنظیمات صفحه اصلی</a>
    </div>

    <form method="post" action="">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">محصولات سایدبار</th>
                    <td>
                        <select id="contained_cpts_select" name="post_types[]" multiple>
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
            <input type="submit" name="submit" id="submit" class="button button-primary" value="ذخیرهٔ تغییرات">
        </p>
    </form>
</div>
jQuery(document).ready(function ($) {
    "use strict";
    /** Inits */
    window.jq = $;
    initSelect2('#contained_RSP_select', RSP_ADMIN_Ajax.Selected_Post_Types_TEXT);
    initSelect2('#cats_list');
    initSelect2('#sp_posts_list');

    /** Copy Shortcode To Clipboard */
    $('.shortcode-value').on('click', async function () {
        const elmText = $(this).text().trim();
        await copyToClipboard(elmText);
        alert(RSP_ADMIN_Ajax.SUCCESS_COPY_TO_CLIP);
    })
});



function changeCatId(event) {
    jq('.shortcode-value').css('display', 'none');
    const catId = event.target.value || event.currentTarget.value;
    const nonce = document.getElementById('sp_shortcode_nonce').value;

    jq.ajax({
        url: RSP_ADMIN_Ajax.AJAXURL,
        type: 'POST',
        data: {
            SECURITY: RSP_ADMIN_Ajax.SECURITY,
            action: 'fetchPostsByCategory',
            nonce: nonce,
            category_id: catId
        },
        beforeSend: () => {
            jq('.loader-spinner').css('display', 'block');
        },
        success: (res, xhr) => {
            const selectedPosts = res.data;
            if (xhr) {
                const selectBoxList = document.getElementById('sp_posts_list');
                jq(selectBoxList).html(`<option value="0" disabled selected>${RSP_ADMIN_Ajax.SELECT_POST_LIST_TEXT}</option>`);
                selectedPosts.forEach(post => {
                    jq(selectBoxList).append(`
                         <option value="${post.ID}">${post.post_title}</option>
                    `);
                });
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.log(errorThrown);
        },
        complete: () => {
            jq('.loader-spinner').css('display', 'none');
        },
        timeout: RSP_ADMIN_Ajax.REQUEST_TIMEOUT
    });


}

function changePostId(event) {
    const postId = event.target.value || event.currentTarget.value;
    const nonce = document.getElementById('sp_shortcode_nonce').value;

    jq.ajax({
        url: RSP_ADMIN_Ajax.AJAXURL,
        type: 'POST',
        data: {
            SECURITY: RSP_ADMIN_Ajax.SECURITY,
            action: 'fetchSinglePost',
            nonce: nonce,
            post_id: postId,
            post_type: RSP_ADMIN_Ajax.RASPI_POST_TYPE_NAME
        },
        beforeSend: () => {
            jq('.loader-spinner').css('display', 'block');
        },
        success: (res, xhr) => {
            const shortcodeValue = jq('.shortcode-value');
            if (xhr) {
                const postData = res.data[0];
                jq(shortcodeValue)
                    .slideDown('fast').delay(400)
                    .find('#post_id').text(postData.ID).end()
                    .find('#post_type').text(postData.post_type);
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.log(errorThrown);
        },
        complete: () => {
            jq('.loader-spinner').css('display', 'none');
        },
        timeout: RSP_ADMIN_Ajax.REQUEST_TIMEOUT
    });


}

const copyToClipboard = async (str) => {
    let el = document.createElement('textarea');
    el.value = str;
    el.setAttribute('readonly', '');
    el.style = { position: 'absolute', left: '-9999px' };
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
}

const initSelect2 = (elm, placeholder = '') => {
    jq(elm).select2({
        language: 'fa',
        dir: 'rtl',
        placeholder: placeholder,
        allowClear: true,
        maximumInputLength: 20,
        closeOnSelect: true
    });
}

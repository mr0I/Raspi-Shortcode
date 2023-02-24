jQuery(document).ready(function ($) {
    /** Inits */
    window.jq = $;

    /** Copy Shortcode To Clipboard */
    $('.shortcode-value').on('click', async function () {
        const elmText = $(this).text().trim();
        await copyToClipboard(elmText);
        alert(CPTS_ADMIN_Ajax.SUCCESS_COPY_TO_CLIP);
    })
});


function changePostType(event) {
    // console.log(event.target.value);
    const postType = event.target.value || event.currentTarget.value;
    const nonce = document.getElementById('sp_shortcode_nonce').value;

    jq.ajax({
        url: CPTS_ADMIN_Ajax.AJAXURL,
        type: 'POST',
        data: {
            SECURITY: CPTS_ADMIN_Ajax.SECURITY,
            action: 'fetchPosts',
            nonce: nonce,
            post_type: postType
        },
        beforeSend: () => {
            //$(submitBtn).val(CPTS_ADMIN_Ajax.SAVING_TEXT).attr('disabled', true);
        },
        success: (res, xhr) => {
            const selectedPosts = res.data;
            if (xhr) {
                const selectBoxList = document.getElementById('sp_posts_list');
                jq(selectBoxList).html(`<option value="0" disabled selected>${CPTS_ADMIN_Ajax.SELECT_POST_LIST_TEXT}</option>`);
                selectedPosts.forEach(post => {
                    jq(selectBoxList).append(`
                         <option value="${post.ID}">${post.post_title}</option>
                    `);
                });
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            // showErrorToast(jqXHR.responseJSON.data);
        },
        complete: () => {
            // $(submitBtn).val(CPTS_ADMIN_Ajax.SAVE_TEXT).attr('disabled', false);
        },
        timeout: CPTS_ADMIN_Ajax.REQUEST_TIMEOUT
    });
}

function changePostId(event) {
    const postId = event.target.value || event.currentTarget.value;
    const postType = document.getElementById('sp_post_types').value;
    const nonce = document.getElementById('sp_shortcode_nonce').value;


    console.log(postId);

    jq.ajax({
        url: CPTS_ADMIN_Ajax.AJAXURL,
        type: 'POST',
        data: {
            SECURITY: CPTS_ADMIN_Ajax.SECURITY,
            action: 'fetchSinglePost',
            nonce: nonce,
            post_id: postId,
            post_type: postType
        },
        beforeSend: () => {
            //$(submitBtn).val(CPTS_ADMIN_Ajax.SAVING_TEXT).attr('disabled', true);
        },
        success: (res, xhr) => {
            const shortcodeValue = jq('.shortcode-value');
            if (xhr) {
                const postData = res.data[0];
                jq(shortcodeValue).find('#post_id').text(postData.ID);
                jq(shortcodeValue).find('#post_type').text(postData.post_type);
                // console.log(jq(shortcodeValue).text().trim());
            }


        },
        error: (jqXHR, textStatus, errorThrown) => {
            // showErrorToast(jqXHR.responseJSON.data);
        },
        complete: () => {
            // $(submitBtn).val(CPTS_ADMIN_Ajax.SAVE_TEXT).attr('disabled', false);
        },
        timeout: CPTS_ADMIN_Ajax.REQUEST_TIMEOUT
    });


}

// function copyShortcode(){

// }
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

// function copyToClipboard(str) {
//     let el = document.createElement('textarea');
//     el.value = str;
//     el.setAttribute('readonly', '');
//     el.style = { position: 'absolute', left: '-9999px' };
//     document.body.appendChild(el);
//     el.select();
//     document.execCommand('copy');
//     document.body.removeChild(el);
// }
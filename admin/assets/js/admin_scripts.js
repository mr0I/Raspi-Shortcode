jQuery(document).ready(function ($) {
    // codes ...
    window.jq = $;
});


function changePostType(event) {
    // console.log(event.target.value);
    const postType = event.target.value || event.currentTarget.value;
    const nonce = document.getElementById('sp_shortcode_nonce').value;

    jq.ajax({
        url: RSC_ADMIN_Ajax.AJAXURL,
        type: 'POST',
        data: {
            SECURITY: RSC_ADMIN_Ajax.SECURITY,
            action: 'fetchPosts',
            nonce: nonce,
            post_type: postType
        },
        beforeSend: () => {
            //$(submitBtn).val(RSC_ADMIN_Ajax.SAVING_TEXT).attr('disabled', true);
        },
        success: (res, xhr) => {
            const selectedPosts = res.data;
            if (xhr) {
                const selectBoxList = document.getElementById('sp_posts_list');
                jq(selectBoxList).html(`<option value="0" disabled selected>${RSC_ADMIN_Ajax.SELECT_POST_LIST_TEXT}</option>`);
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
            // $(submitBtn).val(RSC_ADMIN_Ajax.SAVE_TEXT).attr('disabled', false);
        },
        timeout: RSC_ADMIN_Ajax.REQUEST_TIMEOUT
    });
}

function changePostId(event) {
    const postId = event.target.value || event.currentTarget.value;
    const postType = document.getElementById('sp_post_types').value;
    const nonce = document.getElementById('sp_shortcode_nonce').value;


    console.log(postId);

    jq.ajax({
        url: RSC_ADMIN_Ajax.AJAXURL,
        type: 'POST',
        data: {
            SECURITY: RSC_ADMIN_Ajax.SECURITY,
            action: 'fetchSinglePost',
            nonce: nonce,
            post_id: postId,
            post_type: postType
        },
        beforeSend: () => {
            //$(submitBtn).val(RSC_ADMIN_Ajax.SAVING_TEXT).attr('disabled', true);
        },
        success: (res, xhr) => {
            console.log(res);
            // const selectedPosts = res.data;
            // if (xhr) {
            //     const selectBoxList = document.getElementById('sp_posts_list');
            //     jq(selectBoxList).html(`<option value="0" disabled selected>${RSC_ADMIN_Ajax.SELECT_POST_LIST_TEXT}</option>`);
            //     selectedPosts.forEach(post => {
            //         jq(selectBoxList).append(`
            //              <option value="${post.ID}">${post.post_title}</option>
            //         `);
            //     });
            // }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            // showErrorToast(jqXHR.responseJSON.data);
        },
        complete: () => {
            // $(submitBtn).val(RSC_ADMIN_Ajax.SAVE_TEXT).attr('disabled', false);
        },
        timeout: RSC_ADMIN_Ajax.REQUEST_TIMEOUT
    });


}
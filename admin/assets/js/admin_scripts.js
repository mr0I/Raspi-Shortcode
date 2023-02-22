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
            // question: question,
            // answer: answer,
            // keywords: JSON.stringify(tagsArray)
        },
        beforeSend: () => {
            //$(submitBtn).val(RSC_ADMIN_Ajax.SAVING_TEXT).attr('disabled', true);
        },
        success: (res, xhr) => {
            console.log(res);
            // if (xhr == 'success' && res.success) {
            //     showSuccessToast(RSC_ADMIN_Ajax.SUCCESS_MESSAGE);
            //     $(qaForm).trigger('reset');
            // } else {
            //     showErrorToast(RSC_ADMIN_Ajax.FAILURE_MESSAGE);
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
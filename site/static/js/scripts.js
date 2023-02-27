jQuery(document).ready(function ($) {

    // Raspi Thumnail on mobile size 
    const raspiThumbnailMobile = $('#raspi_thumbnail_mobile');
    const raspiThumbnailDesktop = $('#raspi_thumbnail_desktop');
    if (window.matchMedia('(max-width: 768px)').matches) {
        $(raspiThumbnailDesktop).remove();
        $(raspiThumbnailMobile).show('fast');
    } else {
        $(raspiThumbnailMobile).remove();
    }

})

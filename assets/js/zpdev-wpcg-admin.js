(function ($) {
    $(document).ready(function () {

        var mediaUploader;

        $('.zpwpcg-adm__upload-button').on('click', function (e) {
            e.preventDefault();
            var buttonID = $(this).data('item');

            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose a certificate background picture',
                button: {
                    text: 'Choose Picture'
                },
                multiple: false
            });

            mediaUploader.on('select', function () {
                attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#' + buttonID).val(attachment.url);
                $('#zpwpcg-adm__picture-preview--' + buttonID).attr('src', attachment.url);
            });
            mediaUploader.open();
        });
    })
})(jQuery)
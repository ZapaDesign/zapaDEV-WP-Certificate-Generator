(function ($) {
    $(document).ready(function () {

        var mediaUploader;

        $('.zpwpcg-adm-picture__upload-button').on('click', function (e) {
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
                $('#zpwpcg-adm-picture-src-' + buttonID).val(attachment.url);
                $('#zpwpcg-adm-picture-' + buttonID).attr('src', attachment.url);
            });
            mediaUploader.open();
        });


        $('.repeatable-field-add').click(function() {
            var theField = $(this).closest('div.repeatable-wrap')
                .find('.repeatable-fields-list li:last').clone(true);
            var theLocation = $(this).closest('div.repeatable-wrap')
                .find('.repeatable-fields-list li:last');

            $('input', theField).val('').attr('name', function(index, name) {
                return name.replace(/(\d+)/, function(fullMatch, n) {
                    return Number(n) + 1;
                });
            });
            $('select', theField).val('').attr('name', function(index, name) {
                return name.replace(/(\d+)/, function(fullMatch, n) {
                    return Number(n) + 1;
                });
            });
            theField.insertAfter(theLocation, $(this).closest('div.repeatable-wrap'));
            var fieldsCount = $('.repeatable-field-remove').length;
            if( fieldsCount > 1 ) {
                $('.repeatable-field-remove').css('display','inline');
            }
            return false;
        });

        $('.repeatable-field-remove').click(function(){
            $(this).parent().remove();
            var fieldsCount = $('.repeatable-field-remove').length;
            if( fieldsCount == 1 ) {
                $('.repeatable-field-remove').css('display','none');
            }
            return false;
        });


    })
})(jQuery)
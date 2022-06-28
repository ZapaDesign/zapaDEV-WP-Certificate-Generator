(function ($) {
    $(document).ready(function () {

        // Image upload in ZPdevWPCG Options page
        var mediaUploader;
        $('.zpwpcg-adm-picture__upload-button').on('click', function (e) {
            e.preventDefault()
            var buttonID = $(this).data('item')

            if (mediaUploader) {
                mediaUploader.open()
                return;
            }

            mediaUploader = wp.media({
                title: 'Choose a certificate background picture',
                button: {
                    text: 'Choose Picture'
                },
                multiple: false
            }).on('select', function () {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#zpwpcg-adm-picture-' + buttonID).val(attachment.url);
                $('.zpwpcg-adm-picture__preview--' + buttonID).attr('src', attachment.url);
            })
            mediaUploader.open()
        });


        // Level repeater fields in ZPdevWPCG Options page
        $('.repeatable-field-add').click(function () {
            var theField = $(this).closest('div.repeatable-wrap')
                .find('.repeatable-fields-list li:last').clone(true);
            var theLocation = $(this).closest('div.repeatable-wrap')
                .find('.repeatable-fields-list li:last');

            $('input', theField).val('').attr('name', function (index, name) {
                return name.replace(/(\d+)/, function (fullMatch, n) {
                    return Number(n) + 1;
                });
            });
            $('select', theField).val('').attr('name', function (index, name) {
                return name.replace(/(\d+)/, function (fullMatch, n) {
                    return Number(n) + 1;
                });
            });
            theField.insertAfter(theLocation, $(this).closest('div.repeatable-wrap'));
            var fieldsCount = $('.repeatable-field-remove').length;
            if (fieldsCount > 1) {
                $('.repeatable-field-remove').css('display', 'inline');
            }
            return false;
        });
        $('.repeatable-field-remove').click(function () {
            $(this).parent().remove();
            var fieldsCount = $('.repeatable-field-remove').length;
            if (fieldsCount == 1) {
                $('.repeatable-field-remove').css('display', 'none');
            }
            return false;
        });


        // Certificate list in ZPdevWPCG Options page
        $('.zpwpcg-adm-certlist__item').on('click', '.zpwpcg-adm__btn--del', function (e) {

            if (confirm("Are you sure you want to remove the certificate?")) {

                let cert = $(this).parents('.zpwpcg-adm-certlist__item'),
                    certID = cert.data('id')

                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'remove_certificate',
                        id: certID
                    },
                    dataType: 'text',
                    beforeSend:function() {
                        $('.zpwpcg-ajax__loader').show()
                    },
                    success: function () {
                        $('.zpwpcg-ajax__loader').hide()
                        cert.remove()
                    },
                    error: function (err) {

                    }
                });
            }
        })

    })
})(jQuery)
(function ($) {
    $(document).ready(function () {




        /*
        * Image Canvas
        */
        function renderCanvas() {
            // TODO (УДАЛИТЬ) console.log массив опций переданный в JS фронта
            console.log();

            const canvasAdm = document.getElementById('zpwpcg-canvas'),
                ctx = canvas.getContext('2d')

            let canvasWidth = 2480,
                canvasHeight = 3508,
                heightRatio = canvasHeight / canvasWidth

            canvas.height = canvas.width * heightRatio

            const nameInput = document.getElementById('zpwpcg-front__name-input'),

                certIDInput = document.getElementById('zpwpcg-front__id-input'),
                certIDSwitcher = document.getElementById('zpwpcg-front__id-switcher'),

                startInput = document.getElementById('zpwpcg-front__start-input'),
                finishInput = document.getElementById('zpwpcg-front__finish-input'),
                levelSelect = document.getElementById('zpwpcg-front__level-select'),
                hoursInput = document.getElementById('zpwpcg-front__hours-input'),
                placeInput = document.getElementById('zpwpcg-front__place-input'),
                dateInput = document.getElementById('zpwpcg-front__date-input'),
                downloadBtn = document.getElementById('zpwpcg-front__btn--download')

            const image = new Image(),
                logo = new Image(),
                signature = new Image()

            image.src = options.img
            logo.src = options.logo
            signature.src = options.signature
            image.onload = () => {
                drawImage()
            }

            function drawImage() {
                ctx.drawImage(image, 0, 0, canvas.width, canvas.height)
                drawScaleImage(logo, 15, 88, 400)
                drawScaleImage(signature, 65, 88, 400)

                drawText(certIDInput.value ? certIDInput.value : lastCertID + '/' + new Date().getFullYear().toString().substr(-2), 'center', 54.5, 13.8, 'normal', 60, 'Opinion Pro')
                drawText(options.text.after, 'center', 54.5, 24, 'normal', 130, 'Opinion Pro')
                drawText(nameInput.value, 'center', 54.5, 32, 'bold', 200, 'Opinion Pro', '#333')
                drawText(options.text.before, 'center', 54.5, 40, 'normal', 130, 'Opinion Pro')
                drawText(options.text.before_strong, 'center', 54.5, 46, 'bold', 130, 'Opinion Pro')
                // TODO Ограничить ширину текста адрес
                drawText(options.address, undefined, 15, 93, 'normal', 32, 'Opinion Pro')
                drawText(options.director.value, 'end', 94, 92.5, 'normal', 32, 'Opinion Pro')
                drawText(options.director.label, 'end', 94, 94.5, 'normal', 32, 'Opinion Pro')

                drawText(options.period.label + ': ' + dateFormat(startInput.value, 'month') + ' - ' + dateFormat(finishInput.value, 'month'), undefined, 15, 62, 'normal', 80, 'Opinion Pro')
                drawText(options.levels.label + ': ' + levelSelect.value, undefined, 15, 66, 'normal', 80, 'Opinion Pro')
                drawText(options.hours.label + ': ' + hoursInput.value, undefined, 15, 70, 'normal', 80, 'Opinion Pro')
                drawText(options.place.label + ': ' + placeInput.value, undefined, 15, 74, 'normal', 80, 'Opinion Pro')
                drawText(options.date.label + ': ' + dateFormat(dateInput.value), undefined, 15, 78, 'normal', 80, 'Opinion Pro')
            }

            nameInput.addEventListener('input', () => drawImage())
            certIDSwitcher.addEventListener('change', function () {
                if (this.checked) {
                    certIDInput.addEventListener('input', () => drawImage())
                } else {
                    certIDInput.value = lastCertID + '/' + new Date().getFullYear().toString().substr(-2)
                    drawImage()
                }
            })
            startInput.addEventListener('change', () => drawImage())
            finishInput.addEventListener('change', () => drawImage())
            levelSelect.addEventListener('change', () => drawImage())
            hoursInput.addEventListener('input', () => drawImage())
            placeInput.addEventListener('input', () => drawImage())
            dateInput.addEventListener('change', () => drawImage())

            function drawText(text, alignment = 'start', pX, pY, fontweight, fontsize, fontface, color = '#4c4c4c') {
                if (alignment === 'center') {
                    ctx.save()
                    ctx.font = fontweight + ' ' + fontsize + 'px ' + fontface
                    ctx.textAlign = 'center'
                    ctx.textBaseline = 'middle'
                    ctx.fillStyle = color
                    ctx.fillText(text, canvas.width * pX / 100, canvas.height * pY / 100)
                    ctx.restore()
                }
                if (alignment === 'start') {
                    ctx.save()
                    ctx.font = fontweight + ' ' + fontsize + 'px ' + fontface
                    ctx.fillStyle = color
                    ctx.fillText(text, canvas.width * pX / 100, canvas.height * pY / 100)
                    ctx.restore()
                }
                if (alignment === 'end') {
                    ctx.save()
                    ctx.font = fontweight + ' ' + fontsize + 'px ' + fontface
                    ctx.textAlign = 'end'
                    ctx.textBaseline = 'middle'
                    ctx.fillStyle = color
                    ctx.fillText(text, canvas.width * pX / 100, canvas.height * pY / 100)
                    ctx.restore()
                }
            }

            function drawScaleImage(img, pX = 0, pY = 0, width, height = 0) {
                if (height) {
                    ctx.drawImage(img, canvas.width * pX / 100, canvas.height * pY / 100, width, height)
                } else {
                    ctx.drawImage(img, canvas.width * pX / 100, canvas.height * pY / 100, width, width * img.height / img.width)
                }
            }

            function dateFormat(date, deap) {
                let d = new Date(date),
                    ye = new Intl.DateTimeFormat('en', {year: 'numeric'}).format(d),
                    mo = new Intl.DateTimeFormat('en', {month: 'long'}).format(d),
                    da = new Intl.DateTimeFormat('en', {day: '2-digit'}).format(d)
                return deap === 'month' ? `${mo} ${ye}` : `${da} ${mo} ${ye}`
            }
        }

        // renderCanvas();


















            $('.zpwpcg-tuning__btn--settings').on('click', function (e) {
                e.preventDefault
                $(this).next('.zpwpcg-tuning__body').slideToggle()
            })











        // Image upload in ZPdevWPCG Options page
        var mediaUploader;
        $('.zpwpcg-adm-picture__upload-btn').on('click', function (e) {
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
            var theField = $(this).closest('div.zpwpcg-adm-repeater__wrap')
                .find('.zpwpcg-adm-repeater li:last').clone(true);
            var theLocation = $(this).closest('div.zpwpcg-adm-repeater__wrap')
                .find('.zpwpcg-adm-repeater li:last');

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
            theField.insertAfter(theLocation, $(this).closest('div.zpwpcg-adm-repeater__wrap'));
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
        $('.zpwpcg-table--adm').on('click', '.zpwpcg-btn--del', function (e) {

            if (confirm("Are you sure you want to remove the certificate?")) {

                let cert = $(this).parents('.zpwpcg-table__item'),
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
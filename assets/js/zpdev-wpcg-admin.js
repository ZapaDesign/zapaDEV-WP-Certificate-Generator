(function ($) {
    $(document).ready(function () {



        // Admin Canvas preview

        function renderCanvas() {
            const options = JSON.parse(flow.options),
                canvas = document.getElementById('zpwpcg-adm-canvas'),
                ctx = canvas.getContext('2d')

            // TODO (УДАЛИТЬ) console.log массив опций переданный в JS фронта
            console.log(options)

            let canvasWidth = options.canvas.width ? options.canvas.width : 2480,
                canvasHeight = options.canvas.height ? options.canvas.height : 3508
                // heightRatio = canvasHeight / canvasWidth
                // canvas.height = canvas.width * heightRatio


            const xInput = document.querySelectorAll('.zpwpcg-tuning__field--x[data-field]'),
                  yInput = document.querySelectorAll('.zpwpcg-tuning__field--y[data-field]'),
                  fontSizeInput = document.querySelectorAll('.zpwpcg-tuning__field--font-size[data-field]'),
                  fontWeightInput = document.querySelectorAll('.zpwpcg-tuning__field--font-weight[data-field]'),
                  alignInput = document.querySelectorAll('.zpwpcg-tuning__field--align[data-field]'),

                  inputCanvasWidth = document.querySelector('.zpwpcg-controller--range[data-param=canvas-width]'),
                  inputCanvasHeight = document.querySelector('.zpwpcg-controller--range[data-param=canvas-height]'),

                  inputTextBefore = document.getElementById('zpdevwpcg_text_before'),
                  inputTextAfter = document.getElementById('zpdevwpcg_text_after'),
                  inputTextAfterStrong = document.getElementById('zpdevwpcg_text_after_strong')

                  inputPeriod = document.getElementById('zpdevwpcg_period_label')
                  inputLevel = document.getElementById('zpdevwpcg_level_label')
                  inputHours = document.getElementById('zpdevwpcg_hours_label')
                  inputLocation = document.getElementById('zpdevwpcg_location_label')
                  inputDate = document.getElementById('zpdevwpcg_date_label')

                  inputAddress = document.getElementById('zpdevwpcg_address')
                  // inputDirectorValue = document.getElementById('zpdevwpcg_director_value')
                  // inputDirectorLabel = document.getElementById('zpdevwpcg_director_label')

            inputCanvasWidth.querySelectorAll('input').forEach( el => {
                el.addEventListener('input', (e) => {
                    canvas.width = e.target.value
                    canvasWidth = e.target.value
                    drawCanvas()
                })
            })
            inputCanvasHeight.querySelectorAll('input').forEach( el => {
                el.addEventListener('input', (e) => {
                    canvas.height = e.target.value
                    canvasHeight = e.target.value
                    drawCanvas()
                })
            })
            alignInput.forEach(el => el.addEventListener('change', () =>  drawCanvas()))
            xInput.forEach(el => el.addEventListener('input', () => drawCanvas()))
            yInput.forEach(el => el.addEventListener('input', () => drawCanvas()))
            fontSizeInput.forEach(el => el.addEventListener('input', () => drawCanvas()))
            fontWeightInput.forEach(el => el.addEventListener('input', () => drawCanvas()))
            inputTextBefore.addEventListener('input', () => drawCanvas())
            inputTextAfter.addEventListener('input', () => drawCanvas())
            inputTextAfterStrong.addEventListener('input', () => drawCanvas())
            inputPeriod.addEventListener('input', () => drawCanvas())
            inputLevel.addEventListener('input', () => drawCanvas())
            inputHours.addEventListener('input', () => drawCanvas())
            inputLocation.addEventListener('input', () => drawCanvas())
            inputDate.addEventListener('input', () => drawCanvas())

            inputAddress.addEventListener('input', () => drawCanvas())
            // inputDirectorValue.addEventListener('input', () => drawCanvas())
            // inputDirectorLabel.addEventListener('input', () => drawCanvas())


            const imageCanvas = new Image(),
                logo = new Image(),
                signature = new Image()


            imageCanvas.src = options.img.src
            logo.src = options.logo.src
            signature.src = options.signature.src

            imageCanvas.onload = () => drawCanvas()

            function drawCanvas() {

                ctx.drawImage(imageCanvas, 0, 0, canvasWidth, canvasHeight)

                drawScaleImage(
                    logo,
                    Array.from(xInput).find(item => item.dataset.field === 'logo').value,
                    Array.from(yInput).find(item => item.dataset.field === 'logo').value,
                    400
                )
                drawScaleImage(
                    signature,
                    Array.from(xInput).find(item => item.dataset.field === 'signature').value,
                    Array.from(yInput).find(item => item.dataset.field === 'signature').value,
                    400
                )

                drawText(
                    inputTextBefore.value ? inputTextBefore.value : options.text_before.value,
                    Array.from(alignInput).filter(item => item.dataset.field === 'text_before').find(item => item.checked === true).value,
                    Array.from(xInput).find(item => item.dataset.field === 'text_before').value,
                    Array.from(yInput).find(item => item.dataset.field === 'text_before').value,
                    Array.from(fontWeightInput).find(item => item.dataset.field === 'text_before').value,
                    Array.from(fontSizeInput).find(item => item.dataset.field === 'text_before').value,
                    'Opinion Pro',
                )

                drawText(
                    'Name Surname',
                    Array.from(alignInput).filter(item => item.dataset.field === 'name').find(item => item.checked === true).value,
                    Array.from(xInput).find(item => item.dataset.field === 'name').value,
                    Array.from(yInput).find(item => item.dataset.field === 'name').value,
                    Array.from(fontWeightInput).find(item => item.dataset.field === 'name').value,
                    Array.from(fontSizeInput).find(item => item.dataset.field === 'name').value,
                    'Opinion Pro',
                    '#333'
                )

                drawText(
                    inputTextAfter.value ? inputTextAfter.value : options.text_after.value,
                    Array.from(alignInput).filter(item => item.dataset.field === 'text_after').find(item => item.checked === true).value,
                    Array.from(xInput).find(item => item.dataset.field === 'text_after').value,
                    Array.from(yInput).find(item => item.dataset.field === 'text_after').value,
                    Array.from(fontWeightInput).find(item => item.dataset.field === 'text_after').value,
                    Array.from(fontSizeInput).find(item => item.dataset.field === 'text_after').value,
                    'Opinion Pro',
                )

                drawText(
                    inputTextAfterStrong.value ? inputTextAfterStrong.value : options.text_after_strong.value,
                    options.text_after_strong.align,
                    Array.from(xInput).find(item => item.dataset.field === 'text_after_strong').value,
                    Array.from(yInput).find(item => item.dataset.field === 'text_after_strong').value,
                    Array.from(fontWeightInput).find(item => item.dataset.field === 'text_after_strong').value,
                    Array.from(fontSizeInput).find(item => item.dataset.field === 'text_after_strong').value,
                    'Opinion Pro',
                )

                drawText(
                    inputPeriod.value ? inputPeriod.value + ': ___________ - ___________' : options.period.label + ': ___________ - ___________',
                    'left',
                    15,
                    62,
                    400,
                    '80',
                    'Opinion Pro',
                )

                drawText(
                    inputLevel.value ? inputLevel.value + ': ___________' : options.level.label + ': ___________',
                    'left',
                    15,
                    66,
                    400,
                    '80',
                    'Opinion Pro',
                )

                drawText(
                    inputHours.value ? inputHours.value + ': ___________' : options.hours.label + ': ___________',
                    'left',
                    15,
                    70,
                    400,
                    '80',
                    'Opinion Pro',
                )

                drawText(
                    inputLocation.value ? inputLocation.value + ': ___________' : options.location.label + ': ___________',
                    'left',
                    15,
                    74,
                    400,
                    '80',
                    'Opinion Pro',
                )
                drawText(
                    inputDate.value ? inputDate.value + ': ___________' : options.date.label + ': ___________',
                    'left',
                    15,
                    78,
                    400,
                    '80',
                    'Opinion Pro',
                )

                drawText(
                    inputAddress.value ? inputAddress.value : options.address.value,
                    'left',
                    Array.from(xInput).find(item => item.dataset.field === 'address').value,
                    Array.from(yInput).find(item => item.dataset.field === 'address').value,
                    400,
                    '40',
                    'Opinion Pro',
                )

                // TODO Check director field
                // drawText(
                //     inputDirector.value ? inputDirector.value : options.date.label,
                //     'left',
                //     15,
                //     78,
                //     400,
                //     '80',
                //     'Opinion Pro',
                // )

                drawGrid()
            }

            function drawScaleImage(img, pX = 0, pY = 0, width, height = 0) {
                if (height) {
                    ctx.drawImage(img, canvas.width * pX / 100, canvas.height * pY / 100, width, height)
                } else {
                    ctx.drawImage(img, canvas.width * pX / 100, canvas.height * pY / 100, width, width * img.height / img.width)
                }
            }
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
                if (alignment === 'left') {
                    ctx.save()
                    ctx.font = fontweight + ' ' + fontsize + 'px ' + fontface
                    ctx.fillStyle = color
                    ctx.fillText(text, canvas.width * pX / 100, canvas.height * pY / 100)
                    ctx.restore()
                }
                if (alignment === 'right') {
                    ctx.save()
                    ctx.font = fontweight + ' ' + fontsize + 'px ' + fontface
                    ctx.textAlign = 'end'
                    ctx.textBaseline = 'middle'
                    ctx.fillStyle = color
                    ctx.fillText(text, canvas.width * pX / 100, canvas.height * pY / 100)
                    ctx.restore()
                }
            }
            function drawLine(xStart, yStart, xFinish, yFinish ) {
                ctx.beginPath()
                ctx.moveTo(xStart, yStart)
                ctx.lineWidth = 3
                ctx.strokeStyle = 'rgba(0,0,0,0.3)';
                ctx.lineTo(xFinish, yFinish)
                ctx.stroke()
            }
            function drawGrid() {
                // TODO Global: Add canvas indent functionality
                let indentLeft = 224,
                    indentRight = 0,
                    indentTop = 0,
                    indentBottom = 0

                drawLine(
                    (canvasWidth-indentLeft-indentRight)/2+indentLeft,
                    0,
                    (canvasWidth-indentLeft-indentRight)/2+indentLeft,
                    canvasHeight
                )
                drawLine(
                    (canvasWidth-indentLeft-indentRight)/4+indentLeft,
                    0,
                    (canvasWidth-indentLeft-indentRight)/4+indentLeft,
                    canvasHeight
                )
                drawLine(
                    (canvasWidth-indentLeft-indentRight)/4*3+indentLeft,
                    0,
                    (canvasWidth-indentLeft-indentRight)/4*3+indentLeft,
                    canvasHeight
                )
                drawLine(
                    0,
                    (canvasHeight-indentTop-indentBottom)/2+indentTop,
                    canvasWidth,
                    (canvasHeight-indentTop-indentBottom)/2+indentTop
                )
                drawLine(
                    0,
                    (canvasHeight-indentTop-indentBottom)/4+indentTop,
                    canvasWidth,
                    (canvasHeight-indentTop-indentBottom)/4+indentTop
                )
                drawLine(
                    0,
                    (canvasHeight-indentTop-indentBottom)/4*3+indentTop,
                    canvasWidth,
                    (canvasHeight-indentTop-indentBottom)/4*3+indentTop
                )
            }

        }
        renderCanvas();




        // Add output number for input range
        document.querySelectorAll('.zpwpcg-controller--range').forEach(el => {
            el.querySelector(".zpwpcg-controller--range__range").addEventListener('input',  (i) => {
                i.target.nextElementSibling.value = i.target.value
            }, false);
            el.querySelector(".zpwpcg-controller--range__input").addEventListener('input',  (i) => {
                i.target.previousElementSibling.value = i.target.value
            }, false);
        })



        // Show/Hide field tuning options
        $('.zpwpcg-controller__toggle').on('click', function (e) {
            e.preventDefault
            $(this).nextAll('.zpwpcg-controller__list').slideToggle()
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
                    beforeSend: function () {
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
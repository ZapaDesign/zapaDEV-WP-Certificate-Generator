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


            const fontWeightInput = document.querySelectorAll('.zpwpcg-field-tuning__item--font-weight[data-param]'),
                  alignInput = document.querySelectorAll('.zpwpcg-field-tuning__item--align[data-param]'),

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


            inputCanvasWidth = document.querySelector('.zpwpcg-field-tuning__item--canvas-width')
            inputCanvasWidth.querySelectorAll('input').forEach( el => {
                el.addEventListener('input', (e) => {
                    canvas.width = e.target.value
                    canvasWidth = e.target.value
                    drawCanvas()
                })
            })


            inputCanvasHeight = document.querySelector('.zpwpcg-field-tuning__item--canvas-height')
            inputCanvasHeight.querySelectorAll('input').forEach( el => {
                el.addEventListener('input', (e) => {
                    canvas.height = e.target.value
                    canvasHeight = e.target.value
                    drawCanvas()
                })
            })


            const xInput = document.querySelectorAll('.zpwpcg-field-tuning__item--range-x[data-param]'),
                yInput = document.querySelectorAll('.zpwpcg-field-tuning__item--range-y[data-param]'),
                fontSizeInput = document.querySelectorAll('.zpwpcg-field-tuning__item--font-size[data-param]')
            let rangeInputs = [xInput, yInput, fontSizeInput]

            rangeInputs.forEach( arr => {
                arr.forEach(el => {
                    el.querySelectorAll('input').forEach( elm => {
                        elm.addEventListener('input', () => drawCanvas() )
                    })
                })
            })

            alignInput.forEach(el => el.addEventListener('change', () =>  drawCanvas()))
            fontWeightInput.forEach(el => el.addEventListener('change', () => drawCanvas()))
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
                    Array.from(xInput).find(item => item.dataset.param === 'logo').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(yInput).find(item => item.dataset.param === 'logo').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    400
                )
                drawScaleImage(
                    signature,
                    Array.from(xInput).find(item => item.dataset.param === 'signature').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(yInput).find(item => item.dataset.param === 'signature').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    400
                )

                drawText(
                    inputTextBefore.value ? inputTextBefore.value : options.text_before.value,
                    Array.from(alignInput).filter(item => item.dataset.param === 'text_before').find(item => item.checked === true).value,
                    Array.from(xInput).find(item => item.dataset.param === 'text_before').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(yInput).find(item => item.dataset.param === 'text_before').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(fontWeightInput).find(item => item.dataset.param === 'text_before').value,
                    Array.from(fontSizeInput).find(item => item.dataset.param === 'text_before').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    'opinionpro',
                )

                drawText(
                    'Name Surname',
                    Array.from(alignInput).filter(item => item.dataset.param === 'name').find(item => item.checked === true).value,
                    Array.from(xInput).find(item => item.dataset.param === 'name').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(yInput).find(item => item.dataset.param === 'name').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(fontWeightInput).find(item => item.dataset.param === 'name').value,
                    Array.from(fontSizeInput).find(item => item.dataset.param === 'name').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    'opinionpro',
                    '#333'
                )

                drawText(
                    inputTextAfter.value ? inputTextAfter.value : options.text_after.value,
                    Array.from(alignInput).filter(item => item.dataset.param === 'text_after').find(item => item.checked === true).value,
                    Array.from(xInput).find(item => item.dataset.param === 'text_after').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(yInput).find(item => item.dataset.param === 'text_after').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(fontWeightInput).find(item => item.dataset.param === 'text_after').value,
                    Array.from(fontSizeInput).find(item => item.dataset.param === 'text_after').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    'opinionpro',
                )

                drawText(
                    inputTextAfterStrong.value ? inputTextAfterStrong.value : options.text_after_strong.value,
                    Array.from(alignInput).filter(item => item.dataset.param === 'text_after_strong').find(item => item.checked === true).value,
                    Array.from(xInput).find(item => item.dataset.param === 'text_after_strong').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(yInput).find(item => item.dataset.param === 'text_after_strong').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(fontWeightInput).find(item => item.dataset.param === 'text_after_strong').value,
                    Array.from(fontSizeInput).find(item => item.dataset.param === 'text_after_strong').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    'opinionpro',
                )


                drawText(
                    inputPeriod.value ? inputPeriod.value + ': ___________ - ___________' : options.period.label + ': ___________ - ___________',
                    'left',
                    Array.from(xInput).find(item => item.dataset.param === 'list').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    Array.from(yInput).find(item => item.dataset.param === 'list').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    400,
                    '80',
                    'opinionpro',
                )

                drawText(
                    inputLevel.value ? inputLevel.value + ': ___________' : options.level.label + ': ___________',
                    'left',
                    Array.from(xInput).find(item => item.dataset.param === 'list').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    66,
                    400,
                    '80',
                    'opinionpro',
                )

                drawText(
                    inputHours.value ? inputHours.value + ': ___________' : options.hours.label + ': ___________',
                    'left',
                    Array.from(xInput).find(item => item.dataset.param === 'list').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    70,
                    400,
                    '80',
                    'opinionpro',
                )

                drawText(
                    inputLocation.value ? inputLocation.value + ': ___________' : options.location.label + ': ___________',
                    'left',
                    Array.from(xInput).find(item => item.dataset.param === 'list').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    74,
                    400,
                    '80',
                    'opinionpro',
                )
                drawText(
                    inputDate.value ? inputDate.value + ': ___________' : options.date.label + ': ___________',
                    'left',
                    Array.from(xInput).find(item => item.dataset.param === 'list').querySelector(".zpwpcg-field-tuning__item--range-range").value,
                    78,
                    400,
                    '80',
                    'opinionpro',
                )

                drawText(
                    inputAddress.value ? inputAddress.value : options.address.value,
                    'left',
                    Array.from(xInput).find(item => item.dataset.param === 'address').value,
                    Array.from(yInput).find(item => item.dataset.param === 'address').value,
                    400,
                    '40',
                    'opinionpro',
                )

                // TODO Check director field
                // drawText(
                //     inputDirector.value ? inputDirector.value : options.date.label,
                //     'left',
                //     15,
                //     78,
                //     400,
                //     '80',
                //     'opinionpro',
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

        // Canvas with fabric.js
        // function renderCanvas() {
        //
        //     const options = JSON.parse(flow.options)
        //
        //     var canvas = new fabric.Canvas('zpwpcg-adm-canvas', {
        //         backgroundColor: '#fff',
        //         // backgroundImage: 'options.img.src',
        //     });
        //
        //     // Create a new Text instance
        //     var text = new fabric.Text('Name Surname', {
        //         fontFamily: 'Arial',
        //         fill: '#000',
        //         left: 100,
        //         top: 100,
        //         width: 150,
        //         fontSize: 20
        //     });
        //
        //     // Render the Text on Canvas
        //     canvas.add(text);
        // }

        renderCanvas();




        // Add output number for input range
        document.querySelectorAll('.zpwpcg-field-tuning__item--range').forEach(el => {
            el.querySelector(".zpwpcg-field-tuning__item--range-range").addEventListener('input',  (i) => {
                i.target.nextElementSibling.value = i.target.value
            }, false);
            el.querySelector(".zpwpcg-field-tuning__item--range-input").addEventListener('input',  (i) => {
                i.target.previousElementSibling.value = i.target.value
            }, false);
        })






        // Show/Hide field tuning options
        $('.zpwpcg-field-tuning__toggle').on('click', function (e) {
            e.preventDefault
            $(this).nextAll('.zpwpcg-field-tuning__list').slideToggle()
        })


        $('.zpwpcg-controller__toggle').on('click', function (e) {
            e.preventDefault
            $(this).nextAll('.zpwpcg-tuning__body').slideToggle()
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
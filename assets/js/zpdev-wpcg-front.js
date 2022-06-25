// @param options

(function ($) {
    $( document ).ready(function() {

        /*
        * Image Canvas
        */

        // TODO (УДАЛИТЬ) console.log массив опций переданный в JS фронта
        console.log();

        const canvas = document.getElementById('zpwpcg-canvas'),
            ctx = canvas.getContext('2d')

        let canvasWidth = 2480,
            canvasHeight = 3508,
            heightRatio = canvasHeight / canvasWidth

        canvas.height = canvas.width * heightRatio

        const nameInput = document.getElementById('zpwpcg-front__name-input'),
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

            drawText(options.text.after, 'center', 54.5, 24, 'normal', 130, 'Helvetica')
            drawText(nameInput.value, 'center', 54.5, 32, 'bold', 200, 'Helvetica', '#333')
            drawText(options.text.before, 'center', 54.5, 40, 'normal', 130, 'Helvetica')
            drawText(options.text.before_strong, 'center', 54.5, 46, 'bold', 130, 'Helvetica')
            drawText(options.address, undefined, 15, 93, 'normal', 32, 'Helvetica')
            drawText(options.director.value, 'end', 94, 92.5, 'normal', 32, 'Helvetica')
            drawText(options.director.label, 'end', 94, 94.5, 'normal', 32, 'Helvetica')

            drawText(options.period.label + ': ' + dateFormat(startInput.value, 'month') + ' - ' + dateFormat(finishInput.value, 'month'), undefined, 15, 62, 'normal', 80, 'Helvetica')
            drawText(options.levels.label + ': ' + levelSelect.value, undefined, 15, 66, 'normal', 80, 'Helvetica')
            drawText(options.hours.label + ': ' + hoursInput.value, undefined, 15, 70, 'normal', 80, 'Helvetica')
            drawText(options.place.label + ': ' + placeInput.value, undefined, 15, 74, 'normal', 80, 'Helvetica')
            drawText(options.date.label + ': ' + dateFormat(dateInput.value), undefined, 15, 78, 'normal', 80, 'Helvetica')
        }

        nameInput.addEventListener('input', () => drawImage())
        startInput.addEventListener('change', () => drawImage())
        finishInput.addEventListener('change', () => drawImage())
        levelSelect.addEventListener('change', () => drawImage())
        hoursInput.addEventListener('input', () => drawImage())
        placeInput.addEventListener('input', () => drawImage())
        dateInput.addEventListener('change', () => drawImage())

        downloadBtn.addEventListener('click', function (e) {

            const image = canvas.toDataURL("image/png").replace("image/jpg", "image/octet-stream")
            let element = document.createElement('a'),
                filename = 'Certificate - ' + nameInput.value + '.jpg'
            element.setAttribute('href', image)
            element.setAttribute('download', filename)
            element.click();
        })

        function drawText(text, alignment = 'start', pX, pY, fontweight, fontsize, fontface, color = '#4c4c4c') {
            if (alignment == 'center') {
                ctx.save()
                ctx.font = fontweight + ' ' + fontsize + 'px ' + fontface
                ctx.textAlign = 'center'
                ctx.textBaseline = 'middle'
                ctx.fillStyle = color
                ctx.fillText(text, canvas.width * pX / 100, canvas.height * pY / 100)
                ctx.restore()
            }
            if (alignment == 'start') {
                ctx.save()
                ctx.font = fontweight + ' ' + fontsize + 'px ' + fontface
                ctx.fillStyle = color
                ctx.fillText(text, canvas.width * pX / 100, canvas.height * pY / 100)
                ctx.restore()
            }
            if (alignment == 'end') {
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
            return deap == 'month' ? `${mo} ${ye}` : `${da} ${mo} ${ye}`
        }

        /*
        * Select2 name input
        */

        $('#zpwpcg__form--name').select2({
            placeholder: 'Select an option'
        })

    })
})(jQuery)
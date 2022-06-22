(function ($) {
    $(document).ready(function () {


        console.log(options);

        const canvas = document.getElementById('zpwpcg-canvas')
        const canvasImgSrc = canvas.dataset.imgsrc
        const ctx = canvas.getContext('2d')
        let canvasWidth = 2480,
            canvasHeight = 3508,
            heightRatio = canvasHeight / canvasWidth
        canvas.height = canvas.width * heightRatio

        const nameInput = document.getElementById('zpwpcg__form--name')

        const levelSelect = document.getElementById('zpwpcg-front__level-select')
        const hoursInput = document.getElementById('zpwpcg-front__hours-input')
        const placeInput = document.getElementById('zpwpcg-front__place-input')
        const dateInput = document.getElementById('zpwpcg-front__date-input')


        const downloadBtn = document.getElementById('zpwpcg-front__btn--download')

        const image = new Image()
        image.src = canvasImgSrc
        image.onload = function () {
            drawImage()
        }

        function drawImage() {
            // ctx.textBaseline = 'middle';
            // ctx.textAlign = "center";
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height)

            drawText(options.top_text, canvasWidth / 2 + 112, 900, 'normal', 130, 'Helvetica');
            drawText(nameInput.value, canvasWidth / 2 + 112, 1200, 'bold', 200, 'Helvetica', '#333');
            drawText(options.bottom_text, canvasWidth / 2 + 112, 1500, 'normal', 130, 'Helvetica');
            drawText(options.bottom_strong_text, canvasWidth / 2 + 112, 1700, 'bold', 130, 'Helvetica');

            drawText(options.period.label + ': ', canvasWidth / 2 + 112, canvasHeight - 1500, 'normal', 100, 'Helvetica');
            drawText(options.levels.label + ': ' + levelSelect.value, canvasWidth / 2 + 112, canvasHeight - 1400, 'normal', 100, 'Helvetica');
            drawText(options.hours.label + ': ' + hoursInput.value, canvasWidth / 2 + 112, canvasHeight - 1300, 'normal', 100, 'Helvetica');
            drawText(options.place.label + ': ' + placeInput.value, canvasWidth / 2 + 112, canvasHeight - 1200, 'normal', 100, 'Helvetica');
            drawText(options.date.label + ': ' + dateInput.value, canvasWidth / 2 + 112, canvasHeight - 1100, 'normal', 100, 'Helvetica');
        }

        nameInput.addEventListener('input', () => drawImage())
        levelSelect.addEventListener('change', () => drawImage())
        hoursInput.addEventListener('input', () => drawImage())
        placeInput.addEventListener('input', () => drawImage())
        dateInput.addEventListener('change', () => drawImage())

        downloadBtn.addEventListener('click', function (e) {

            var image = canvas.toDataURL("image/png").replace("image/jpg", "image/octet-stream");
            var element = document.createElement('a');
            var filename = 'Certificate - ' + nameInput.value + '.jpg';
            element.setAttribute('href', image);
            element.setAttribute('download', filename);

            element.click();
        })
        //     downloadBtn.href = canvas.toDataURL(toDataURL('image/jpg'))
        //     downloadBtn.download = 'Certificate - ' + nameInput.value
        // })

        function drawText(text, centerX, centerY, fontweight, fontsize, fontface, color= '#4c4c4c') {
            ctx.save();
            ctx.font = fontweight + ' ' + fontsize + 'px ' + fontface;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillStyle = color;
            ctx.fillText(text, centerX, centerY);
            ctx.restore();
        }


    })
})(jQuery)
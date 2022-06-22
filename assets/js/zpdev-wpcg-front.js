const canvas = document.getElementById('zpwpcg-canvas')
const canvasImgSrc = canvas.dataset.imgsrc
const ctx = canvas.getContext('2d')
let canvasWidth = 2480,
    canvasHeight = 3508,
    heightRatio = canvasHeight/canvasWidth
    canvas.height = canvas.width * heightRatio

const nameInput = document.getElementById('zpwpcg__form--name')
const hoursInput = document.getElementById('zpwpcg__form--hours')
const placeInput = document.getElementById('zpwpcg__form--place')

const downloadBtn = document.getElementById('zpwpcg-front__btn--download')

const image = new Image()
image.src = canvasImgSrc
image.onload = function () {
    drawImage()
}

drawText(nameInput.value,canvasWidth/2,900,200,'verdana');
drawText(hoursInput.value,canvasWidth/2,1200,100,'Courier');

function drawImage() {
    ctx.textBaseline = 'middle';
    ctx.textAlign = "center";
    ctx.drawImage(image, 0, 0, canvas.width, canvas.height)
    drawText(nameInput.value,canvasWidth/2,900,200,'verdana');
    drawText(hoursInput.value,canvasWidth/2,canvasHeight - 1500,100,'Courier');
    drawText(placeInput.value,canvasWidth/2,canvasHeight - 1200,100,'Courier');
}

nameInput.addEventListener('input',  () => drawImage())
hoursInput.addEventListener('input',  () => drawImage())
placeInput.addEventListener('input',  () => drawImage())

downloadBtn.addEventListener('click', function () {
    downloadBtn.href = canvasImgSrc
    downloadBtn.download = 'Certificate - ' + nameInput.value
})

function drawText(text,centerX,centerY,fontsize,fontface){
    ctx.save();
    ctx.font=fontsize+'px '+fontface;
    ctx.textAlign='center';
    ctx.textBaseline='middle';
    ctx.fillText(text,centerX,centerY);
    ctx.restore();
}
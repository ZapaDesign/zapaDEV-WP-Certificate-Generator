(function ($) {
    $(document).ready(function () {

        let zpwpcgInputName = $('.zpwpcg__form--name'),
            zpwpcgContainerName = $('.zpwpcg__preview--name'),

            zpwpcgInputHours = $('.zpwpcg__form--hours'),
            zpwpcgContainerHours = $('.zpwpcg__preview--hours');

        zpwpcgInputName.on('input', function () {
            zpwpcgContainerName.text($(this).val());
        })


        zpwpcgContainerHours.text(zpwpcgInputHours.val())
        zpwpcgInputHours.on('change', function () {
            zpwpcgContainerHours.text($(this).val());
        })

    })
})(jQuery)
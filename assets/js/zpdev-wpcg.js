(function ($) {
    $( document ).ready(function() {
        let zpwpcgInputName = $('.zpwpcg__form-name'),
            zpwpcgContainerName = $('.zpwpcg__preview-name');

        zpwpcgInputName.on('input', function () {
            zpwpcgContainerName.text($(this).val());
        })

    })
})(jQuery)
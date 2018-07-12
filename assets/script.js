function mistape_spinner_start() {
    jQuery('body').append('<div class="loading-spinner"></div>');
}

function mistape_spinner_stop() {
    jQuery('.loading-spinner').remove();
}

function mistape_on_success($button) {
    $button.closest('tr').hide();
}

function mistape_on_error(message) {
    alert('oops : ' + message);
}

jQuery(document).ready(function ($) {
    $('button.mistape').click(function () {
        var $button = $(this);
        var data = {
            'action': $button.data('action'),
            'mistape-id': $button.data('mistape-id')
        };
        mistape_spinner_start();
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        jQuery.post(ajaxurl, data, function (response) {
            mistape_spinner_stop();
            if (response === 'true') {
                mistape_on_success($button);
            } else {
                mistape_on_error(response)
            }
        });
    });
});
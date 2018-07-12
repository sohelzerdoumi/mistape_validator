/**
 * Start loading spinner
 */
function mistape_spinner_start() {
    jQuery('body').append('<div class="loading-spinner"></div>');
}

/**
 * Stop loading spinner
 */
function mistape_spinner_stop() {
    jQuery('.loading-spinner').remove();
}

/**
 * Remove row on success
 * @param $button
 */
function mistape_on_success($button) {
    $button.closest('tr').hide();
}

/**
 * Display error
 * @param message
 */
function mistape_on_error(message) {
    alert('oops : ' + message);
}

jQuery(document).ready(function ($) {
    $('button.mistape').click(function () {
        mistape_spinner_start();

        var $button = $(this);
        var data = {
            'action':     $button.data('action'),
            'mistape-id': $button.data('mistape-id')
        };
        jQuery.post(ajaxurl, data, function (response) {
            if (response === 'true') {
                mistape_on_success($button);
            } else {
                mistape_on_error(response)
            }
            mistape_spinner_stop();
        });
    });
});
jQuery(document).ready(function($) {
    $('#media-sweep-start-scan').on('click', function() {
        $('#media-sweep-scan-controls button').hide();
        $('#media-sweep-scan-progress').show();
        $('#media-sweep-scan-results').html('');

        $.ajax({
            url: media_sweep_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'media_sweep_scan',
                nonce: media_sweep_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    $('#media-sweep-scan-results').html(response.data.table);
                } else {
                    $('#media-sweep-scan-results').html('<p>An error occurred during the scan.</p>');
                }
            },
            error: function() {
                $('#media-sweep-scan-results').html('<p>An AJAX error occurred.</p>');
            },
            complete: function() {
                $('#media-sweep-scan-controls button').show();
                $('#media-sweep-scan-progress').hide();
            }
        });
    });
});

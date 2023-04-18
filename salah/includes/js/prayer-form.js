jQuery(document).ready(function($) {
    
    $('form#prayer-form').submit(function(event) {
        event.preventDefault();

        // Disable submit button
        $('#prayer-form button[type="submit"]').prop('disabled', true);
        
        // Clear error message
        $('#prayer-form-message').html('');

        // Get form data
        //var form_data = $(this).serialize();
    //console.log('gg');
        //Retrieve the form values
        var prayer_time = $('select[name="prayer_time"]').val();
        var time = $('input[name="time"]').val();
        var current_datetime = $('input[name="current_datetime"]').val();
        var user_id = $('input[name="user_id"]').val();
        var ajaxurl = prayer_object.ajax_url;
        // Send the form data to the server using AJAX
        $.ajax({
        type: 'POST',
        dataType: 'json',
        url: ajaxurl,
        data: { 
            action: 'prayer_form_ajax',
            prayer_time: prayer_time,
            time: time,
            current_datetime: current_datetime,
            user_id: user_id
        },
        success: function(response) {
            // Display success message
            $('#prayer-form-message').html('<div class="success">' + response.data + '</div>');
            $('#prayer-form button[type="submit"]').prop('disabled', false);
            // Clear form fields
            
                
                // Clear form fields
                $('#prayer-form input[type="prayer_time"]').val('');
                $('#prayer-form input[type="time"]').val('');
                $('#prayer-form input[type="current_datetime"]').val('');
                $('#prayer-form input[type="user_id"]').val('');
        },
        error: function(response) {
            // Display an error message
            $('form#prayer-form-message').html('<div class="error">' + response + '</div>');
            $('#prayer-form button[type="submit"]').prop('disabled', true);
        }
        });
    });
      
      
});

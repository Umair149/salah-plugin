jQuery(document).ready(function($) {
    $('#user-registration-form').submit(function(event) {
        event.preventDefault();
        
        // Disable submit button
        $('#user-registration-form button[type="submit"]').prop('disabled', true);
        
        // Clear error message
        $('#user-registration-message').html('');
        
        // Get form data
        var form_data = $(this).serialize();
        
        // Send AJAX request
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: user_registration_form.ajax_url,
            data: form_data + '&nonce=' + user_registration_form.nonce,
            success: function(response) {
                // Display success message
                $('#user-registration-message').html('<div class="success">' + response.data + '</div>');
                
                // Clear form fields
                $('#user-registration-form input[type="text"]').val('');
                $('#user-registration-form input[type="email"]').val('');
                $('#user-registration-form input[type="password"]').val('');
            },
            error: function(response) {
                // Display error message
                $('#user-registration-message').html('<div class="error">' + response.responseJSON.data + '</div>');
            },
            complete: function() {
                // Enable submit button
                $('#user-registration-form button[type="submit"]').prop('disabled', false);
            }
        });
    });

 
      
});

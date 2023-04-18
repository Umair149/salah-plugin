(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

    $('form#prayer-form').submit(function(event) {
        event.preventDefault();
    console.log('gg');
        // Retrieve the form values
        var prayer_time = $('select[name="prayer_time"]').val();
        var time = $('input[name="time"]').val();
        var current_datetime = $('input[name="current_datetime"]').val();
        var user_id = $('input[name="user_id"]').val();
    
        // Send the form data to the server using AJAX
        $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'prayer_form_object.ajax_url',
        data: { 
            action: 'prayer_form_ajax',
            prayer_time: prayer_time,
            time: time,
            current_datetime: current_datetime,
            user_id: user_id
        },
        success: function(response) {
            // Display a success message
            $('form#prayer-form-message').html('<p>Thank you for submitting the form!</p>');
        },
        error: function(response) {
            // Display an error message
            $('form#prayer-form-message').html('<p>There was an error submitting the formm.</p>');
            console.log(response);
            console.log('<p>There was an error submitting the form.</p>');
        }
        });
    });
      

})( jQuery );

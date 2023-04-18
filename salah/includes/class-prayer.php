<?php
/**
 * 
 * .
 *
 * Description.
 *
 * @since Version 3 digits
 */

 class Prayer_Form {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_shortcode( 'prayer_form', array( $this, 'prayer_form' ) );
        add_action( 'wp_ajax_prayer_form_ajax', array( $this, 'my_ajax_handler' ) );
        add_action( 'wp_ajax_nopriv_prayer_form_ajax', array( $this, 'my_ajax_handler' ) );
    }
    
    // Enqueue scripts
    public function enqueue_scripts() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'my-ajax-script', plugin_dir_url( __FILE__ ) . '/js/prayer-form.js', array( 'jquery' ), '1.0', true );
        $data = array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        );
        wp_localize_script( 'my-ajax-script', 'prayer_object', $data );
    }
    
    // Shortcode handler
    public function prayer_form() {
        $user_id = get_current_user_id();
        ob_start();
        ?>
        <form id="prayer-form" method="post">
            <label for="prayer_time">Prayer Time:</label>
            <select name="prayer_time" id="prayer_time">
                <option value="fajr">Fajr</option>
                <option value="zuhr">Zuhr</option>
                <option value="asr">Asr</option>
                <option value="maghrib">Maghrib</option>
                <option value="isha">Isha</option>
            </select>
            <label for="time-input">Time:</label>
            <input type="time" name="time" id="time-input">
            <input type="hidden" name="current_datetime" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="user_id" value="<?php echo esc_attr( $user_id ); ?>">
            <button type="submit">Save Prayer</button>
        </form>
        <div id="prayer-form-message"></div>
        <?php
        return ob_get_clean();
    }
    
    // AJAX handler 
    public function my_ajax_handler() {
       // check_ajax_referer( 'user-prayer', 'nonce' );
        
        $prayer_time = sanitize_text_field( $_POST['prayer_time'] );
        $time = sanitize_text_field( $_POST['time'] );
        $current_datetime = sanitize_text_field( $_POST['current_datetime'] );
        $user_id = sanitize_text_field( $_POST['user_id'] );
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'prayers';
        $wpdb->insert(
            $table_name,
            array(
            'user_id' => $user_id,
            'prayer_time' => $prayer_time,
            'prayer_name' => $prayer_time,
            'user_time' => $time,
            'date_time' => $current_datetime
            )
        );

        // Return a JSON response
        wp_send_json_success( 'Data saved successfully!' );
        wp_die();
    }
}

// Initialize plugin class
$Prayer_Form = new Prayer_Form();

<?php
/**
 * Summary.
 *
 * Description.
 *
 * @since Version 3 digits
 */
// Define plugin class
class User_Registration_Form {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_shortcode( 'user_registration_form', array( $this, 'shortcode' ) );
        add_action( 'wp_ajax_user_registration', array( $this, 'ajax_handler' ) );
        add_action( 'wp_ajax_nopriv_user_registration', array( $this, 'ajax_handler' ) );
    }
    
    // Enqueue scripts
    public function enqueue_scripts() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'user-registration-form', plugin_dir_url( __FILE__ ) . '/js/user-registration-form.js', array( 'jquery' ), '1.0', true );
        wp_localize_script( 'user-registration-form', 'user_registration_form', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'user-registration' ),
        ) );
    }
    
    // Shortcode handler
    public function shortcode() {
        ob_start();
        ?>
        <form id="user-registration-form" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>

            <input type="hidden" name="action" value="user_registration">
            <button type="submit">Register</button>
        </form>
        <div id="user-registration-message"></div>
        <?php
        return ob_get_clean();
    }
    
    // AJAX handler
    public function ajax_handler() {
        check_ajax_referer( 'user-registration', 'nonce' );
        
        $username = sanitize_text_field( $_POST['username'] );
        $email = sanitize_email( $_POST['email'] );
        $password = sanitize_text_field( $_POST['password'] );
        
        // Create user account
        $user_id = wp_create_user( $username, $password, $email );
        
        if ( is_wp_error( $user_id ) ) {
            wp_send_json_error( $user_id->get_error_message() );
        } else {
            wp_send_json_success( 'User account created successfully' );
        }
    }
}

// Initialize plugin class
$user_registration_form = new User_Registration_Form();

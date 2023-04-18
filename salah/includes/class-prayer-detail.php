<?php
/**
 * 
 * .
 *
 * Description.
 *
 * @since Version 3 digits
 */

 class Prayer_Detail {
    public function __construct() {
        add_shortcode( 'prayer_data', array( $this, 'prayer_data' ) );
    }
    
    
    // Shortcode handler
    public function prayer_data() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'prayers';

        $results = $wpdb->get_results("SELECT * FROM $table_name");

        $output = '<table>';
        $output .= '<thead><tr><th>Prayer Name</th><th>User Time</th><th>Entry Time Time</th></tr></thead>';
        $output .= '<tbody>';
        foreach ($results as $result) {
            $output .= '<tr><td>' . $result->prayer_name . '</td><td>' . $result->user_time . '</td><td>' . $result->date_time . '</td></tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';

        return $output;
    }
    
    // AJAX handler 
    
}

// Initialize plugin class
$Prayer_Detail = new Prayer_Detail();

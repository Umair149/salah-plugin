<?php
/**
 * Summary.
 *
 * Description.
 *
 * @since Version 3 digits
 */
// Define plugin class


class Template_Dashboard{

    public function __construct() {
        add_filter( 'template_include', array( $this, 'include_template' ) );
    }
    
    public function include_template( $template ) {
        // Check if custom template is requested
        if ( is_page( 'prayer-form' ) ) {
            // Get plugin directory path
            $plugin_dir = plugin_dir_path( __FILE__ );
            
            // Set custom template path
            $template = $plugin_dir . '/templaes/prayer-form.php';
        }
        elseif ( is_page( 'prayer-detail' ) ) {
            // Get plugin directory path
            $plugin_dir = plugin_dir_path( __FILE__ );
            
            // Set custom template path
            $template = $plugin_dir . '/templaes/prayer-detail.php';
        }
        elseif ( is_page( 'registration-form' ) ) {
            // Get plugin directory path
            $plugin_dir = plugin_dir_path( __FILE__ );
            
            // Set custom template path
            $template = $plugin_dir . '/templaes/registration-form.php';
        }
        
        return $template;
    }
}

$Template_Dashboard = new Template_Dashboard();

<?php

/**
 * Fired during plugin activation
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Salah
 * @subpackage Salah/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Salah
 * @subpackage Salah/includes
 * @author     M.Umair <umairn583@gmail.com>
 */
class Salah_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$pages = array();
	$table_name = $wpdb->prefix . 'prayers';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,
		prayer_name VARCHAR(255) NOT NULL,
		prayer_time VARCHAR(255) NOT NULL,
		date_time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		user_time time NOT NULL,
		PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
	
	// Create an array of pages to be created
    $pages = array(
        array(
            'title' => 'Prayer Detail',
            'content' => '',
            'slug' => 'prayer-detail'
        ),
        array(
            'title' => 'Prayer Form',
            'content' => '',
            'slug' => 'prayer-form'
		),
		array(
            'title' => 'Registration Form',
            'content' => '',
            'slug' => 'registration-form'
        )
    );

    foreach ($pages as $page) {
        $exists = get_page_by_path($page['slug']);

        // If the page doesn't exist, create it
        if (!$exists) {
            $post = array(
                'post_title' => $page['title'],
                'post_content' => $page['content'],
                'post_type' => 'page',
                'post_status' => 'publish',
                'post_author' => 1,
                'post_slug' => $page['slug']
            );

            wp_insert_post($post);
        }
    }
}

}

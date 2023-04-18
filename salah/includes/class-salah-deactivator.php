<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Salah
 * @subpackage Salah/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Salah
 * @subpackage Salah/includes
 * @author     M.Umair <umairn583@gmail.com>
 */
class Salah_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		
		global $wpdb;
        $table_name = $wpdb->prefix . 'prayers';
        
        $sql = "DROP TABLE IF EXISTS $table_name;";
        
        $wpdb->query( $sql );
	}

}

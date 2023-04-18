<?php

class My_Table_Plugin {

public function __construct() {
    register_activation_hook( __FILE__, array( $this, 'create_table' ) );
}

public function create_table() {
    // global $wpdb;
    // $table_name = $wpdb->prefix . 'my_table';
    // $charset_collate = $wpdb->get_charset_collate();
    
    // $sql = "CREATE TABLE $table_name (
    //     id mediumint(9) NOT NULL AUTO_INCREMENT,
    //     name varchar(50) NOT NULL,
    //     email varchar(50) NOT NULL,
    //     PRIMARY KEY  (id)
    // ) $charset_collate;";
    
    // require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    // dbDelta( $sql );
}

}

$my_table_plugin = new My_Table_Plugin();

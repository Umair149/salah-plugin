<?php



class salah_plugin_posttype {

public function __construct() {
    add_action( 'init', array( $this, 'register_salah_post_type' ) );
    add_action( 'add_meta_boxes', array( $this, 'add_custom_field_meta_box' ) );
    add_action( 'save_post', array( $this, 'save_custom_field_data' ) );
}

public function register_salah_post_type() {

    $labels = array(
        'name'               => __( 'Salah Post Type', 'text-domain' ),
        'singular_name'      => __( 'Salah Post Type', 'text-domain' ),
        'menu_name'          => __( 'Salah Post Type', 'text-domain' ),
        'name_admin_bar'     => __( 'Salah Post Type', 'text-domain' ),
        'add_new'            => __( 'Add New', 'text-domain' ),
        'add_new_item'       => __( 'Add New salah Post Type', 'text-domain' ),
        'new_item'           => __( 'New salah Post Type', 'text-domain' ),
        'edit_item'          => __( 'Edit salah Post Type', 'text-domain' ),
        'view_item'          => __( 'View salah Post Type', 'text-domain' ),
        'all_items'          => __( 'All salah Post Types', 'text-domain' ),
        'search_items'       => __( 'Search salah Post Types', 'text-domain' ),
        'parent_item_colon'  => __( 'Parent salah Post Types:', 'text-domain' ),
        'not_found'          => __( 'No salah post types found.', 'text-domain' ),
        'not_found_in_trash' => __( 'No salah post types found in Trash.', 'text-domain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'salah-post-type' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'           => 'dashicons-list-view',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'salah-post-type', $args );

}

public function add_custom_field_meta_box() {
    add_meta_box(
        'custom-field-meta-box',
        __( 'Custom Field', 'text-domain' ),
        array( $this, 'render_custom_field_meta_box' ),
        'salah-post-type',
        'normal',
        'default'
    );
}

public function render_custom_field_meta_box( $post ) {
    // Retrieve the current value of the custom field
    $custom_field_value = get_post_meta( $post->ID, '_custom_field', true );

    // Output the HTML for the custom field
    ?>
    <label for="custom-field"><?php _e( 'Custom Field', 'text-domain' ); ?></label>
    <input type="text" id="custom-field" name="custom_field" value="<?php echo esc_attr( $custom_field_value ); ?>">
    <?php
}

public function save_custom_field_data( $post_id ) {
    // Verify the nonce
    if ( !isset( $_POST['custom_field_nonce'] ) || !wp_verify_nonce( $_POST['custom_field_nonce'], basename( __FILE__ ) ) ) {
        return;
    }

    // Check if this is an autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save the custom field value
    if ( isset( $_POST['custom_field'] ) ) {
        update_post_meta( $post_id, '_custom_field', sanitize_text_field( $_POST['custom_field'] ) );
    }
}

}

$salah_plugin_posttype = new salah_plugin_posttype();

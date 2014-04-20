<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

class Core {

	/**
	 * PHP4 constructor method.  This simply provides backwards compatibility for users with setups
	 * on older versions of PHP.  Once WordPress no longer supports PHP4, this method will be removed.
	 */
	function Core() {
		$this->__construct();
	}

	/**
	 * Constructor method for the Core class.  This method adds other methods of the class to 
	 * specific hooks within WordPress.  It controls the load order.
	 */
	function __construct() {

		/* Define Core constants. */
		add_action( 'after_setup_theme', array( &$this, 'core_constants' ), 14 );

		/* Load the Core extensions. */
		add_action( 'after_setup_theme', array( &$this, 'core_extensions' ), 15 );

	}

	function core_constants() {

		/* Sets the path to the core directory. */
		define( 'CORE_DIR', trailingslashit( get_template_directory() ) . basename( dirname( __FILE__ ) ) );
	
		/* Sets the url to the core directory. */
		define( 'CORE_URL', trailingslashit( get_template_directory_uri() ) . basename( dirname( __FILE__ ) ) );

	}

	function core_extensions() {

		/* Implement Bootstrap Nav Structure */
		require_once( CORE_DIR . '/extensions/bootstrap-nav-walker.php' );

		/* Implement Bootstrap Breadcrumb Structure */
		require_once( CORE_DIR . '/extensions/bootstrap-breadcrumbs.php' );

		/* Implement Bootstrap bbPress Breadcrumb Structure */
		//require_once( CORE_DIR . '/extensions/bootstrap-bbpress-breadcrumbs.php' );

		/* Modified Pagination functions for Bootstrap */
		require_once( CORE_DIR . '/extensions/bootstrap-pagination.php' );

		/* Other Bootstrap Compatibility Function */
		require_once( CORE_DIR . '/extensions/bootstrap-other.php' );

		/* Misc Filters */
		require_once( CORE_DIR . '/extensions/misc-filters.php' );

		/* Modified wp_link_pages() function */
		require_once( CORE_DIR . '/extensions/wp-link-pages-extended.php' );

		/* Additional Theme Settings */
		require_once( CORE_DIR . '/extensions/settings.php' );

		/* Additional Function for Getting the excerpt by ID */
		require_once( CORE_DIR . '/extensions/get-excerpt-by-id.php' );

		/* Bootstrap tweaks for woocommerce */
		//require_once( CORE_DIR . '/extensions/bootstrap-woocommerce.php' );

		/* Bootstrap tweaks for gravity forms */
		require_once( CORE_DIR . '/extensions/bootstrap-gravity-forms.php' );

		/* Bootstrap editor styles */
		require_once( CORE_DIR . '/extensions/bootstrap-editor-styles.php' );

		/* Entry Updated Shortcode */
		require_once( CORE_DIR . '/extensions/entry-updated.php' );

	}

}

/**
 * Calls @see register_post_type function to create all the custom post types required on the crippen place site.
 *
 * @author Jason Conroy <jason@findingsimple.com>, Brent Shepherd <brent@findingsimple.com>
 * @package FindingSimpleCustomPostTypes
 * @subpackage CPT
 * @since 1.0
 */
function fs_register_custom_post_types() {

	register_post_type( 'fs_work',
		array(
			'description'       => __( 'Information about work completed for a particular client\'s site.', hybrid_get_parent_textdomain() ),
			'public'            => true,
			'has_archive'       => false,
			'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'           => array( 'slug' => 'work', 'with_front' => false ),
			'show_in_nav_menus' => false,
			'label'             => __( 'Works', hybrid_get_parent_textdomain() ),
			'labels'            => array(
				'name'               => __( 'Works', hybrid_get_parent_textdomain() ),
				'singular_name'      => __( 'Work', hybrid_get_parent_textdomain() ),
				'all_items'          => __( 'All Works', hybrid_get_parent_textdomain() ),
				'add_new_item'       => __( 'Add New Works', hybrid_get_parent_textdomain() ),
				'edit_item'          => __( 'Edit Work', hybrid_get_parent_textdomain() ),
				'new_item'           => __( 'New Work', hybrid_get_parent_textdomain() ),
				'view_item'          => __( 'View Work', hybrid_get_parent_textdomain() ),
				'search_items'       => __( 'Search Work', hybrid_get_parent_textdomain() ),
				'not_found'          => __( 'No works found', hybrid_get_parent_textdomain() ),
				'not_found_in_trash' => __( 'No works found in trash', hybrid_get_parent_textdomain() ),
			),
		)
	);

}
add_action( 'init', 'fs_register_custom_post_types' );


/**
 * Customises the messsages on the edit post page for each Finding simple custom post type.
 *
 * @author Brent Shepherd <brent@findingsimple.com>
 * @package crippen
 * @subpackage CPT
 * @since 1.0
 */
function fs_cpt_update_messages( $messages ) {
	global $post, $post_ID;

	$post_types = get_post_types( array( 'show_ui' => true, '_builtin' => false ), 'objects' );

	foreach( $post_types as $post_type => $post_object ) {

		$messages[$post_type] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __( '%s updated. <a href="%s">View %s</a>' ), $post_object->labels->singular_name, esc_url( get_permalink( $post_ID ) ), $post_object->labels->singular_name ),
			2 => __( 'Custom field updated.' ),
			3 => __( 'Custom field deleted.' ),
			4 => sprintf( __( '%s updated.' ), $post_object->labels->singular_name ),
			5 => isset( $_GET['revision']) ? sprintf( __( '%s restored to revision from %s' ), $post_object->labels->singular_name, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __( '%s published. <a href="%s">View %s</a>' ), $post_object->labels->singular_name, esc_url( get_permalink( $post_ID ) ), $post_object->labels->singular_name ),
			7 => sprintf( __( '%s saved.' ), $post_object->labels->singular_name ),
			8 => sprintf( __( '%s submitted. <a target="_blank" href="%s">Preview %s</a>'), $post_object->labels->singular_name, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), $post_object->labels->singular_name ),
			9 => sprintf( __( '%s scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview %s</a>'), $post_object->labels->singular_name, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ), $post_object->labels->singular_name ),
			10 => sprintf( __( '%s draft updated. <a target="_blank" href="%s">Preview %s</a>'), $post_object->labels->singular_name, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), $post_object->labels->singular_name ),
			);
	}

	return $messages;
}
add_filter( 'post_updated_messages', 'fs_cpt_update_messages' );

?>
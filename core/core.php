<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

class Core {

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

		/* Utility functions */
		require_once( CORE_DIR . '/extensions/utilities.php' );

		/* Implement Bootstrap Nav Structure */
		require_once( CORE_DIR . '/extensions/bootstrap-nav-walker.php' );

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

		/* Bootstrap tweaks for gravity forms */
		require_once( CORE_DIR . '/extensions/bootstrap-gravity-forms.php' );

		/* Bootstrap editor styles */
		require_once( CORE_DIR . '/extensions/bootstrap-editor-styles.php' );

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

/**
 * Don't highlight blog for work items
 */
function custom_fix_blog_tab_on_cpt($classes,$item,$args) {
    if(!is_singular('post') && !is_category() && !is_tag()) {
        $blog_page_id = intval(get_option('page_for_posts'));
        if($blog_page_id != 0) {
            if($item->object_id == $blog_page_id) {
				unset($classes[array_search('current_page_parent',$classes)]);
			}
        }
    }
    if(is_singular('fs_work')) {
        $work_page = get_page_by_title( 'Work' );

        if($work_page->ID  != 0) {
            if($item->object_id == $work_page->ID ) {
				$classes[] = 'current_page_parent';
			}
        }
    }

    return $classes;
}
add_filter('nav_menu_css_class','custom_fix_blog_tab_on_cpt',10,3);

function set_fs_logo( $title ) {

   /* If viewing the front page of the site, use an <h1> tag.  Otherwise, use a <div> tag. */
    $tag = ( is_front_page() ) ? 'h1' : 'div';

    /* Get the site title.  If it's not empty, wrap it with the appropriate HTML. */
    if ( $title = get_bloginfo( 'name' ) )
        $title = sprintf( '<%1$s id="site-title"><a href="%2$s" title="%3$s" rel="home">%4$s</a></%1$s>', tag_escape( $tag ), home_url(), esc_attr( $title ), '<span>finding</span>simple' );

    return $title;

}

add_filter( 'hybrid_site_title', 'set_fs_logo', 99 );


?>
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
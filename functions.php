<?php
/**
 * @package    simple
 * @subpackage Functions
 * @version    1.2.0
 * @author     Finding Simple
 * @copyright  Copyright (c) 2014, Finding Simple
 * @link       http://findingsimple.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'hybrid-core/hybrid.php' );
new Hybrid();

/* Load the theme core. */
require_once( trailingslashit( get_template_directory() ) . 'core/core.php' );
new Core();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'simple_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 */
function simple_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Register menus. */
	add_action( 'init', 'nudie_register_menus', 5 );

	/* Register sidebars. */
	add_action( 'widgets_init', 'nudie_register_sidebars', 5 );

	/* Load widgets. */
	//add_theme_support( 'hybrid-core-widgets' );

	/* Load shortcodes. */
	add_theme_support( 'hybrid-core-shortcodes' );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Theme Settings */
	add_theme_support( 'hybrid-core-theme-settings' );

	/* Enable theme layouts (need to add stylesheet support). */
	add_theme_support(
		'theme-layouts',
		array(
			'1c' => __( '1 Column', hybrid_get_parent_textdomain() ),
			'2c-l' => __( '2 Columns: Content / Sidebar', hybrid_get_parent_textdomain() ),
			'2c-r' => __( '2 Columns: Sidebar / Content', hybrid_get_parent_textdomain() )
		),
		array( 
			'default' => is_rtl() ? '2c-r' :'2c-l',
			'customizer' => true
		)
	);

	/* Support pagination instead of prev/next links. */
	add_theme_support( 'loop-pagination' );

	/* The best thumbnail/image script ever. */
	add_theme_support( 'get-the-image' );

	/* Use breadcrumbs. */
	add_theme_support( 'breadcrumb-trail' );

	/* Nicer [gallery] shortcode implementation. */
	add_theme_support( 'cleaner-gallery' );

	/* Better captions for themes to style. */
	add_theme_support( 'cleaner-caption' );

	/* Automatically add feed links to <head>. */
	add_theme_support( 'automatic-feed-links' );

	/* Add support for a custom header image. */
	//add_theme_support( 'custom-header', array( 'header-text' => false ) );

	/* Custom background. */
	//add_theme_support( 'custom-background', array( 'default-color' => 'ffffff' ) );

	/* Handle content width for embeds and images. */
	hybrid_set_content_width( 740 );

	// Add HTML5 elements
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );

	/* Remove some of the hybrid meta tags to simplify the header. */	
	add_filter( "{$prefix}_meta_author", '__return_false' );
	add_filter( "{$prefix}_meta_copyright", '__return_false' );	
	add_filter( "{$prefix}_meta_revised", '__return_false' );
	add_filter( "{$prefix}_meta_template", '__return_false' );

	/* Remove some of the default meta tags to simplify the header. Will do this with an mu plugin  */	
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_generator', 1);
  	remove_action( 'wp_head', 'wlwmanifest_link');
  	remove_action( 'wp_head', 'rsd_link');
	remove_action( 'wp_head', 'parent_post_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'hybrid_meta_template', 1 );
	
	/**
	 * Modify page support
	 */
	add_action( 'init', 'modify_page_support' );

	/* Filter hybrid thumbnail generation arguements */
	add_filter( 'get_the_image_args', 'filter_thumbnail_args', 10, 1 );

	/* Filter permalink output */
	add_filter( 'gettext', 'filter_permalink', 10, 3 );

	/**
	 * Add Custom editor styles
	 */
	add_editor_style();
	
}

/**
 * Modify page support for excerpts, comments and trackbacks
 */
function modify_page_support() {
	add_post_type_support('page','excerpt');
	remove_post_type_support('page', 'comments' );
	remove_post_type_support('page', 'trackbacks' );
}

/**
 * Tell WP Customizer to refresh when layout is changed
 */
function theme_layout_customize_refresh( $wp_customize ) {

	$wp_customize->get_setting( 'theme_layout' )->transport = 'refresh';

}

add_action( 'customize_register', 'theme_layout_customize_refresh', 11 );

/**
 * Remove the nasty inline styles added by WP when the default recent comments widget is used
 */
function simple_remove_recent_comments_style() {

	global $wp_widget_factory;

	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );

}

add_action( 'widgets_init', 'simple_remove_recent_comments_style' );

/**
* Registers nav menu locations.
*/
function nudie_register_menus() {

	register_nav_menu( 'primary', _x( 'Primary', 'Primary Menu', hybrid_get_parent_textdomain() ) );

	register_nav_menu( 'subsidiary', _x( 'Subsidiary', 'Secondary Menu', hybrid_get_parent_textdomain() ) );

}

/**
* Registers sidebars.
*/
function nudie_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id' => 'primary',
			'name' => _x( 'Primary', 'sidebar', hybrid_get_parent_textdomain() ),
			'description' => __( 'The main (primary) sidebar.', hybrid_get_parent_textdomain() )
		)
	);

	hybrid_register_sidebar(
		array(
			'id' => 'subsidiary',
			'name' => _x( 'Subsidiary', 'sidebar', 'hybrid-base' ),
			'description' => __( 'The footer (subsidiary) sidebar.', hybrid_get_parent_textdomain() )
		)
	);

}

/**
 * Add/remove scripts
 */
function simple_add_remove_scripts(){

	$parent = get_template();
	$parent = wp_get_theme( $parent );

	/* Add the main stylesheet */
	wp_enqueue_style( 'simple', get_template_directory_uri() . '/style.css' , array(), $parent['Version'] ); 

	/* Make sure jQuery is added */
	wp_enqueue_script( 'jquery' );	

	/* Modernizr */
	wp_enqueue_script( 'modernizr', THEME_URI . '/js/modernizr.min.js',array(),'2.7.1',false);

	/* FitVids JS */
	wp_enqueue_script( 'fitvids', THEME_URI . '/js/jquery.fitvids.min.js','jquery','1.0.3',true);

	/* Twitter Bootstrap JS */
	wp_enqueue_script( 'bootstrap', THEME_URI . '/js/bootstrap.min.js','jquery','3.1.0',true);

	/* simple JS */
	wp_enqueue_script( 'simple', THEME_URI . '/js/simple.js','jquery',$parent['Version'],true);
	
}

add_action( 'wp_enqueue_scripts', 'simple_add_remove_scripts' );

/**
 * Maybe bbpress
 */
function maybe_bbpress() {

	if ( function_exists('is_bbpress') ) {
		return is_bbpress();
	} else {
		return false;
	}

}

/**
 * Maybe woocommerce
 */
function maybe_woocommerce() {

	if ( function_exists('is_woocommerce') ) {
		if ( is_woocommerce() || is_checkout() || is_order_received_page() || is_cart() || is_account_page() )
			return true;
	} else {
		return false;
	}

}

/**
 * Temporary clean up blog
 */
function blog_clean_by_date( $query ) {

    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_home() ) {

		$query->set('date_query', array( 

			array( 'after' => '1 May 2014' ),

		) );

        return;

    }
}

add_action( 'pre_get_posts', 'blog_clean_by_date' );


/**
 * Disable jquery migrate script
 */
function remove_jquery_migrate( &$scripts ) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
}

add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );


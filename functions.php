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
require_once( trailingslashit( TEMPLATEPATH ) . 'core/core.php' );
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
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'subsidiary' ) );

	/* Register sidebars. */
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'subsidiary' ) );

	/* Load scripts. */
	add_theme_support( 'hybrid-core-scripts', array( 'comment-reply' ) );

	/* Load widgets. */
	add_theme_support( 'hybrid-core-widgets' );

	/* Load shortcodes. */
	add_theme_support( 'hybrid-core-shortcodes' );

	/* Enable custom template hierarchy. */
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Theme Settings */
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer', 'about' ) );

	/* Enable theme layouts (need to add stylesheet support). */
	add_theme_support( 'theme-layouts', array( '1c', '2c-l', '2c-r' ), array( 'default' => '2c-l', 'customizer' => true ) );

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

	/* Add support for excerpts to pages */
	add_post_type_support('page','excerpt');

	/* Filter hybrid thumbnail generation arguements */
	add_filter( 'get_the_image_args', 'filter_thumbnail_args', 10, 1 );

	/* Filter permalink output */
	add_filter( 'gettext', 'filter_permalink', 10, 3 );

	/* Filter the default footer text */
	add_filter("{$prefix}_default_theme_settings", 'default_footer_text' );

	/**
	 * Add Custom editor styles
	 */
	add_editor_style();
	
}


/**
 * Remove the nasty inline styles added by WP when the default recent comments widget is used
 */
function simple_remove_recent_comments_style() {

	global $wp_widget_factory;

	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );

}

add_action( 'widgets_init', 'simple_remove_recent_comments_style' );


/**
 * Add/remove scripts
 */
function simple_add_remove_scripts(){

	$parent = get_template();
	$parent = wp_get_theme( $parent );

	/* Google Font */
	//wp_register_style( 'opensans', '//fonts.googleapis.com/css?family=Open+Sans:600,600italic,400,300,400italic,700,700italic,300italic', array(), null, 'all' );

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
	wp_enqueue_script( 'simple', THEME_URI . '/js/simple.js','jquery','1',true);
	
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


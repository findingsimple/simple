<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package fs
 * @subpackage Functions
 * @version 0.2.0
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2010 - 2011, Jason Conroy
 * @link http://findingsimple.com/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( TEMPLATEPATH ) . 'hybrid-core/hybrid.php' );
$theme = new Hybrid();

/* Load the fs core. */
require_once( trailingslashit( TEMPLATEPATH ) . 'fs-core/fs-core.php' );
$theme_fs = new FSCore();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'fs_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function fs_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'header', 'subsidiary', 'after-singular' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-post-meta-box' );
	add_theme_support( 'hybrid-core-theme-settings' );
	add_theme_support( 'hybrid-core-meta-box-footer' );
	add_theme_support( 'hybrid-core-drop-downs' );
	add_theme_support( 'hybrid-core-seo' );
	add_theme_support( 'hybrid-core-template-hierarchy' );

	/* Add theme support for framework extensions. */
	add_theme_support( 'theme-layouts', array( '2c-l', '2c-r', '3c-l', '3c-r', '3c-c' ) );
	add_theme_support( 'post-stylesheets' );
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'cleaner-gallery' );
//	add_theme_support( 'dev-stylesheet' );

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	add_custom_background();

	/* Add the breadcrumb trail just after the container is open. */
	add_action( "{$prefix}_open_main", 'breadcrumb_trail' );

	/* Filter the breadcrumb trail arguments. */
	add_filter( 'breadcrumb_trail_args', 'fs_breadcrumb_trail_args' );

	/* Add the search form to the secondary menu. */
	add_action( "{$prefix}_close_menu_secondary", 'get_search_form' );

	/* Disable Sidebar for Single Column Layout*/
	add_filter( 'sidebars_widgets', 'my_disable_sidebars' );
	add_action( 'template_redirect', 'my_one_column' );
	
	/* Remove some of the built in meta tags to simplify the header. */	
	add_filter( "{$prefix}_meta_author", '__return_false' );
	add_filter( "{$prefix}_meta_copyright", '__return_false' );	
	add_filter( "{$prefix}_meta_revised", '__return_false' );
	add_filter( "{$prefix}_meta_template", '__return_false' );
	//remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
	//remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'wp_generator', 1 ); // WP version
	remove_action('wp_head', 'rsd_link'); // Really Simple Discovery service endpoint, EditURI link
	remove_action('wp_head', 'wlwmanifest_link'); // windows live writer
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link_wp_head ', 10, 0 ); // prev link
	remove_action( 'wp_head', 'start_post_rel_link_wp_head ', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Display relational links for the posts adjacent to the current post.

   /* Additional Theme JS */
    if (!is_admin()) {
    
    	wp_deregister_script('jquery');
    	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js', '', '', true );
 		wp_enqueue_script( 'jquery' );
 		
		/* Modernizr */
 		wp_register_script( 'modernizr', THEME_URI . '/js/modernizr.js','','',false);
 		wp_enqueue_script( 'modernizr' );
 		
		/* JQuery Cycle */
 		//wp_register_script( 'jquery-cycle', THEME_URI . '/js/jquery.cycle.min.js','','',true);		
		//wp_enqueue_script( 'jquery-cycle' );

		//Twitter Widgets JS in the footer
		//wp_register_script( 'twitter-widgets', 'http://platform.twitter.com/widgets.js','','',true);
		//wp_enqueue_script( 'twitter-widgets' );
		
		//Google Plus One JS in the footer
		//wp_register_script( 'google-plusone', 'https://apis.google.com/js/plusone.js','','',true);
		//wp_enqueue_script( 'google-plusone' );

		//LinkedIn JS in the footer
		//wp_register_script( 'linkedin', 'http://platform.linkedin.com/in.js','','',true);
		//wp_enqueue_script( 'linkedin' );

		/* Google Maps API v3 */
 		//wp_register_script( 'gmaps', 'http://maps.googleapis.com/maps/api/js?sensor=set_to_true_or_false','','',false);
 		//wp_enqueue_script( 'gmaps' ); 
		
		
	}	
	
	/* Add theme support for simple-core extensions. */
//	add_theme_support( 'facebook-init' );
//	add_theme_support( 'facebook-meta' );
//	add_theme_support( 'share-bar' );
//	add_theme_support( 'is-subpage-tag' );
//	add_theme_support( 'timer' );
	add_theme_support( 'fs_settings' );

	/* Add theme support for simple-core shortcodes. */
//	add_theme_support( 'shortcode-columns' );
//	add_theme_support( 'shortcode-dropcaps' );
//	add_theme_support( 'shortcode-intro' );

}


function add_js_stuff() {
	
	/* galskin*/
	wp_register_style( 'galskin', THEME_URI . '/cs/skin.css');
	wp_enqueue_style( 'galskin' );
	
	if(is_front_page()) {
		/* Twitter Search */
		wp_register_script( 'twitter-search', THEME_URI . '/js/jquery.twitter.search.js','','',true);		
		wp_enqueue_script( 'twitter-search' );

		/* home js */
		wp_register_script( 'homejs', THEME_URI . '/js/home.js','','',true);		
		wp_enqueue_script( 'homejs' );
	}
	
	/* other js */
	wp_register_script( 'otherjs', THEME_URI . '/js/other.js','','',true);		
	wp_enqueue_script( 'otherjs' );

	if (is_page_template('page-template-case-study.php')) { 
		
		/* Jcarousel*/
		wp_register_style( 'jcarcss', THEME_URI . '/js/jquery.jcarousel.css');
		wp_enqueue_style( 'jcarcss' );
	
		wp_register_script( 'jcar', THEME_URI . '/js/jquery.jcarousel.js','','',true);		
		wp_enqueue_script( 'jcar' );
		
		/* cs js */
		wp_register_script( 'csjs', THEME_URI . '/js/cs.js','jcar','',true);		
		wp_enqueue_script( 'csjs' );
		
	}
	
	if (is_page('contact') || is_page('wordpress-consultant-canberra')) {
		
		/* spamspan */
		wp_register_script( 'spamspan', THEME_URI . '/js/spamspan.js','','',true);		
		wp_enqueue_script( 'spamspan' );
		
	}
	
}
add_action('wp_print_scripts', 'add_js_stuff');

/**
 * Custom breadcrumb trail arguments.
 *
 * @since 0.1.0
 */
function fs_breadcrumb_trail_args( $args ) {

	/* Change the text before the breadcrumb trail. */
	$args['before'] = __( 'You are here:', hybrid_get_textdomain() );

	/* Return the filtered arguments. */
	return $args;
}

/**
 * Disable Sidebar on Single Column Layout
 *
 * @since 0.1.0
 */
function my_one_column() {

	if ( !is_active_sidebar( 'primary' ) && !is_active_sidebar( 'secondary' ) )
		add_filter( 'get_theme_layout', 'my_theme_layout_one_column' );
}

function my_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

function my_disable_sidebars( $sidebars_widgets ) {

	if ( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {

		if ( 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
		}
	}

	return $sidebars_widgets;
}

/**
 * Edit Excerpt Length
 *
 * @since 0.1.0
 */
function new_excerpt_length($length) {
	return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');

/**
 * Edit Excerpt More
 *
 * @since 0.1.0
 */
function new_excerpt_more($more) {
	//global $post;
	//return '<a href="'. get_permalink($post->ID) . '">Read the Rest...</a>';
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * Get Subpages
 * investigate replacing with wp_list_pages
 * @since 0.1.0
 */
function get_subpages($id) {
    global $wpdb;
    
	$query = $wpdb->prepare("
		SELECT wpposts.ID 
		FROM $wpdb->posts wpposts 
		WHERE wpposts.post_status = 'publish' 
		AND wpposts.post_type = 'page' 
		AND wpposts.post_parent = $id 
		ORDER BY wpposts.menu_order ASC
		");

	$subsarray = $wpdb->get_results($query);

	$subs = '';
	foreach ($subsarray as $sub) {
		$subs .= $sub->ID . ',';
	}
	
	return $subs;
    	
}

?>
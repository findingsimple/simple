<?php 

class SimpleCore {

	/**
	 * PHP4 constructor method.  This simply provides backwards compatibility for users with setups
	 * on older versions of PHP.  Once WordPress no longer supports PHP4, this method will be removed.
	 *
	 * @since 0.9.0
	 */
	function SimpleCore() {
		$this->__construct();
	}


	/**
	 * Constructor method for the SimpleCore class.  This method adds other methods of the class to 
	 * specific hooks within WordPress.  It controls the load order.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		/* Define SimpleCore constants. */
		add_action( 'after_setup_theme', array( &$this, 'simple_constants' ), 14 );

		/* Load the SimpleCore extensions. */
		add_action( 'after_setup_theme', array( &$this, 'simple_extensions' ), 15 );

	}

	function simple_constants() {

	/* Sets the path to the simple core directory. */
	define( 'SIMPLE_DIR', trailingslashit( get_template_directory() ) . basename( dirname( __FILE__ ) ) );

	/* Sets the url to the simple core directory. */
	define( 'SIMPLE_URL', trailingslashit( get_template_directory_uri() ) . basename( dirname( __FILE__ ) ) );

	}

	function simple_extensions() {

	/* Load facebook open graph meta fields in header. */
	require_if_theme_supports( 'facebook-meta', SIMPLE_DIR . '/extensions/facebook-meta.php' );

	/* Load facebook async js */
	require_if_theme_supports( 'facebook-init', SIMPLE_DIR . '/extensions/facebook-init.php' );

	/* Load a share bar. */
	require_if_theme_supports( 'share-bar', SIMPLE_DIR . '/extensions/share-bar.php' );

	/* Add is_subpage() tag support. */
	require_if_theme_supports( 'is-subpage-tag', SIMPLE_DIR . '/extensions/is-subpage-tag.php' );

	/* Adds load time info to footer. */
	require_if_theme_supports( 'timer', SIMPLE_DIR . '/extensions/timer.php' );

	}
	
	function simple_shortcodes() {
	
	// Replace WP autop formatting
	if (!function_exists( "simple_remove_wpautop")) {
		function simple_remove_wpautop($content) { 
			$content = do_shortcode( shortcode_unautop( $content ) ); 
			$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
			return $content;
		}
	}

	/* Shortcode Columns. */
	require_if_theme_supports( 'shortcode-columns', SIMPLE_DIR . '/shortcodes/columns.php' );

	/* Shortcode Drop Caps. */
	require_if_theme_supports( 'shortcode-dropcaps', SIMPLE_DIR . '/shortcodes/dropcaps.php' );

	/* Shortcode Intro. */
	require_if_theme_supports( 'shortcode-intro', SIMPLE_DIR . '/shortcodes/intro.php' );

	/* Shortcode Quote */
	require_if_theme_supports( 'shortcode-quote', SIMPLE_DIR . '/shortcodes/quote.php' );


	}

}

?>
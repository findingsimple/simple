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

?>
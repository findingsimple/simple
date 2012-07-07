<?php 

class FSCore {

	/**
	 * PHP4 constructor method.  This simply provides backwards compatibility for users with setups
	 * on older versions of PHP.  Once WordPress no longer supports PHP4, this method will be removed.
	 *
	 * @since 0.9.0
	 */
	function FSCore() {
		$this->__construct();
	}


	/**
	 * Constructor method for the SimpleCore class.  This method adds other methods of the class to 
	 * specific hooks within WordPress.  It controls the load order.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		/* Define FSCore constants. */
		add_action( 'after_setup_theme', array( &$this, 'fs_constants' ), 14 );

		/* Load the FSCore extensions. */
		add_action( 'after_setup_theme', array( &$this, 'fs_extensions' ), 15 );

	}

	function fs_constants() {

		/* Sets the path to the fs core directory. */
		define( 'FS_DIR', trailingslashit( get_template_directory() ) . basename( dirname( __FILE__ ) ) );

		/* Sets the url to the fs core directory. */
		define( 'FS_URL', trailingslashit( get_template_directory_uri() ) . basename( dirname( __FILE__ ) ) );

	}

	function fs_extensions() {

		/* Load fs settings if required */
		require_if_theme_supports( 'fs_settings', FS_DIR . '/extensions/fs_settings.php' );

	}
	
	function fs_shortcodes() {
	
		// Replace WP autop formatting
		if (!function_exists( "simple_remove_wpautop")) {
			function simple_remove_wpautop($content) { 
				$content = do_shortcode( shortcode_unautop( $content ) ); 
				$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
				return $content;
			}
		}

		/* Shortcode Name */
		//require_if_theme_suports( 'shortcode-id', FS_DIR . '/shortcodes/filename.php' );

	}

}

/**
 * Front page google map js
 *
 * @since 1.0.0
 */
function front_page_map() {
?>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
      var map;
      function initialize() {
        var myOptions = {
          zoom: 4,
          center: new google.maps.LatLng(-31.84023266790935, 147.6123046875),
          scrollwheel: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),
            myOptions);
        
        var brisbane = new google.maps.LatLng(-27.4709331,153.0235024);
        var bathurst = new google.maps.LatLng(-33.4176529,149.5810314);
        var canberra = new google.maps.LatLng(-35.2819998,149.1286843);
            
        var marker = new google.maps.Marker({
        	position: brisbane, 
        	map: map,
        	title:"Brisbane"
    	});  
    	
       var marker2 = new google.maps.Marker({
        	position: bathurst, 
        	map: map,
        	title:"Bathurst"
    	}); 
    	
       var marker3 = new google.maps.Marker({
        	position: canberra, 
        	map: map,
        	title:"Canberra"
    	}); 
            
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<?php
}




?>
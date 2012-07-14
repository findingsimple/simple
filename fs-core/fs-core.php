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

/**
 * Set default footer text
 * 
 * @since 1.0
 * @author Jason Conroy
 * @package eeo
 */

function default_footer_text( $settings ) {

	$settings['footer_insert'] = '<p class="copyright">Copyright &#169; 2008 - [the-year] <strong>finding</strong>simple</p><p class="credit">Powered by [wp-link]</p>';
		
	return $settings;
	
}

add_filter("fs_default_theme_settings", 'default_footer_text' );

/**
 * Displays the avatar for the comment author and wraps it in the comment author's URL if it is
 * available.  Adds a call to HYBRID_IMAGES . "/{$comment_type}.png" for the default avatars for
 * trackbacks and pingbacks.
 *
 * @since 0.2.0
 * @access public
 * @global $comment The current comment's DB object.
 * @global $hybrid The global Hybrid object.
 * @return void
 */
function hybrid_avatar_circles() {
	global $comment, $hybrid;

	/* Make sure avatars are allowed before proceeding. */
	if ( !get_option( 'show_avatars' ) )
		return false;

	/* Get/set some comment variables. */
	$comment_type = get_comment_type( $comment->comment_ID );
	$author = get_comment_author( $comment->comment_ID );
	$url = get_comment_author_url( $comment->comment_ID );
	$avatar = '';
	$default_avatar = '';

	/* Get comment types that are allowed to have an avatar. */
	$avatar_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );

	/* If comment type is in the allowed list, check if it's a pingback or trackback. */
	if ( in_array( $comment_type, $avatar_comment_types ) ) {

		/* Set a default avatar for pingbacks and trackbacks. */
		$default_avatar = ( ( 'pingback' == $comment_type || 'trackback' == $comment_type ) ? trailingslashit( HYBRID_IMAGES ) . "{$comment_type}.png" : '' );

		/* Allow the default avatar to be filtered by comment type. */
		$default_avatar = apply_filters( "{$hybrid->prefix}_{$comment_type}_avatar", $default_avatar );
	}

	/* Set up the avatar size. */
	$comment_list_args = hybrid_list_comments_args();
	$size = ( ( $comment_list_args['avatar_size'] ) ? $comment_list_args['avatar_size'] : 68 );

	/* Get the avatar provided by the get_avatar() function. */
	$avatar = get_avatar( $comment, absint( $size ), $default_avatar, $author );

	/* If URL input, wrap avatar in hyperlink. */
	if ( !empty( $url ) && !empty( $avatar ) )
		$avatar = '<a href="' . esc_url( $url ) . '" rel="external nofollow" title="' . esc_attr( $author ) . '" class="avatar-wrap" >' . $avatar . '</a>';

	/* Display the avatar and allow it to be filtered. Note: Use the get_avatar filter hook where possible. */
	echo apply_filters( "{$hybrid->prefix}_avatar", $avatar );
}

/* My translations. */
add_filter( 'gettext', 'my_translations', 10, 3 );

function my_translations( $translation, $text, $domain ) {

	$translations = &get_translations_for_domain( $domain );

	if ( '%1$s Responses' == $text )
		$translation = $translations->translate( '%1$s Comments' );

	if ( 'Leave a response' == $text )
		$translation = $translations->translate( 'Comment' );

	if ( '1 Response' == $text )
		$translation = $translations->translate( '1 Comment' );

	if ( '%1$s responses to %2$s' == $text )
		$translation = $translations->translate( '%1$s comments' );

	if ( 'Leave a Reply' == $text )
		$translation = $translations->translate( 'Leave a Comment' );

	if ( 'No responses to %1$s' == $text )
		$translation = $translations->translate( 'No comments' );

	if ( 'One response to %1$s' == $text )
		$translation = $translations->translate( 'One comment' );

	return $translation;
}



?>
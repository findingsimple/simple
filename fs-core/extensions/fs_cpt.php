<?php
 /**
 * The custom post types file creates post types for all custom content required on the Finding Simple website.
 * 
 * For more information on custom post types, see the Codex article here: http://codex.wordpress.org/Post_Types
 *
 * @package FindingSimpleCustomPostTypes
 * @subpackage CPT
 * @version 1.0
 * @author Michael Furner <michael@findingsimple.com>
 * @copyright Copyright (c) 2010 - 2011, Finding Simple
 * @link http://www.findingsimple.com/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


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
			'supports'          => array( 'title', 'editor', 'thumbnail' ),
			'rewrite'           => array( 'slug' => 'work', 'with_front' => false ),
			'show_in_nav_menus' => false,
			'label'             => __( 'Works', hybrid_get_parent_textdomain() ),
			'labels'            => array(
				'name'               => __( 'Works', hybrid_get_parent_textdomain() ),
				'singular_name'      => __( 'Work', hybrid_get_parent_textdomain() ),
				'all_items'          => __( 'All Works', hybrid_get_parent_textdomain() ),
				'add_new_item'       => __( 'Add New Works', hybrid_get_parent_textdomain() ),
				'edit_item'          => __( 'Edit Works', hybrid_get_parent_textdomain() ),
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
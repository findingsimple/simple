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
	
	register_post_type( 'fs_team_members',
		array(
			'description'       => __( 'Information about team members.', hybrid_get_parent_textdomain() ),
			'public'            => true,
			'has_archive'       => false,
			'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'           => array( 'slug' => 'team-member', 'with_front' => false ),
			'show_in_nav_menus' => false,
			'label'             => __( 'Team', hybrid_get_parent_textdomain() ),
			'labels'            => array(
				'name'               => __( 'Team Members', hybrid_get_parent_textdomain() ),
				'singular_name'      => __( 'Member', hybrid_get_parent_textdomain() ),
				'all_items'          => __( 'All Team Members', hybrid_get_parent_textdomain() ),
				'add_new_item'       => __( 'Add New Team Members', hybrid_get_parent_textdomain() ),
				'edit_item'          => __( 'Edit Team Member', hybrid_get_parent_textdomain() ),
				'new_item'           => __( 'New Team Member', hybrid_get_parent_textdomain() ),
				'view_item'          => __( 'View Team Member', hybrid_get_parent_textdomain() ),
				'search_items'       => __( 'Search Team Member', hybrid_get_parent_textdomain() ),
				'not_found'          => __( 'No team members found', hybrid_get_parent_textdomain() ),
				'not_found_in_trash' => __( 'No team members found in trash', hybrid_get_parent_textdomain() ),
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


function fs_team_members_meta_box( $post ) {

	$role = get_post_meta( $post->ID, 'fs_team_members_role', true );
	$email = get_post_meta( $post->ID, 'fs_team_members_email', true );
	$twitter = get_post_meta( $post->ID, 'fs_team_members_twitter', true );

	if( empty( $start_date ) )
		$start_date = date( 'Y-m-d' );

	if( empty( $end_date ) )
		$end_date = date( 'Y-m-d',  strtotime('+2 days') );

	wp_nonce_field( __FILE__, 'fs_team_members_meta_nonce' ); ?>

	<p>
		<label for='fs-team-members-role'>
			<?php _e( 'Role:', hybrid_get_parent_textdomain() ); ?>
			<input type='date' id='fs-team-members-role' name='fs-team-members-role' value='<?php echo $role ?>' />
		</label>
	</p>
	<p>
		<label for='fs-team-members-email'>
			<?php _e( 'Email:', hybrid_get_parent_textdomain() ); ?>
			<input type='date' id='fs-team-members-email' name='fs-team-members-email' value='<?php echo $email ?>' />
		</label>
	</p>
	<p>
		<label for='fs-team-members-twitter'>
			<?php _e( 'Twitter:', hybrid_get_parent_textdomain() ); ?>
			<input type='date' id='fs-team-members-twitter' name='fs-team-members-twitter' value='<?php echo $twitter ?>' />
		</label>
	</p>

<?php 
}

function fs_team_members_save_event_meta( $post_id, $post ) {

	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || $post->post_type != 'fs_team_members' || $post->post_status == 'auto-draft' || ! isset( $_POST['fs_team_members_meta_nonce'] ) )
		return;

	if ( ! wp_verify_nonce( $_POST['fs_team_members_meta_nonce'], __FILE__ ) )
		wp_die( __( 'Error: Event meta nonce is not valid.', hybrid_get_parent_textdomain() ) );

	if ( ! current_user_can( 'edit_post', $post_id ) )
		wp_die( __( 'Error: You do not have permission to edit this event.', hybrid_get_parent_textdomain() ) );

	update_post_meta( $post_id, 'fs_team_members_role', $_POST['fs-team-members-role'] );
	update_post_meta( $post_id, 'fs_team_members_email', $_POST['fs-team-members-email'] );
	update_post_meta( $post_id, 'fs_team_members_twitter', $_POST['fs-team-members-twitter'] );

}
add_action( 'save_post', 'fs_team_members_save_event_meta', 10, 2 );

function fs_add_team_member_meta_box() {
	add_meta_box( 'fs_team_members_meta', __( 'Team Member details:', hybrid_get_parent_textdomain() ), 'fs_team_members_meta_box', 'fs_team_members', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'fs_add_team_member_meta_box' );


?>
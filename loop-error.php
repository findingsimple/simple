<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
	<div <?php hybrid_post_attributes(); ?>>

		<div class="alert alert-warning"><?php _e( 'Apologies, but no entries were found.', hybrid_get_parent_textdomain() ); ?></div>
		
	</div><!-- .hentry .error -->
<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
	<div class="entry hentry error">

    <?php _e( 'Sorry, no entries were found.', hybrid_get_parent_textdomain() ); ?>

	</div><!-- .hentry .error -->
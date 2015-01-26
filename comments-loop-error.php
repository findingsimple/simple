<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

if ( pings_open() && !comments_open() ) { ?>

	<div class="comments-closed pings-open alert alert-warning">
		<?php printf( __( 'Comments are closed, but <a href="%s" title="Trackback URL for this post" class="alert-link">trackbacks</a> and pingbacks are open.', hybrid_get_parent_textdomain() ), esc_url( get_trackback_url() ) ); ?>
	</div><!-- .comments-closed .pings-open -->

<?php } elseif ( !comments_open() ) { ?>

	<div class="comments-closed alert alert-warning">
		<?php _e( 'Comments are closed.', hybrid_get_parent_textdomain() ); ?>
	</div><!-- .comments-closed -->

<?php } ?>
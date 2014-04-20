<?php 
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) { ?>
	<?php if ( get_option( 'page_comments' ) ) : ?>
	<div class="pagination-wrapper pagination-centered">
		<?php bootstrap_paginate_comments_links( array('type' => 'list') ); ?>
	</div>
	<?php endif; ?>
<?php } ?>
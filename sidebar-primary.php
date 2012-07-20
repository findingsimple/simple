<?php
/**
 * Primary Sidebar Template
 *
 * Displays widgets for the Primary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package fs
 * @subpackage Template
 */

if ( is_active_sidebar( 'primary' ) && get_post_type() != "fs_work") : ?>

	<?php do_atomic( 'before_sidebar_primary' ); /* fs_before_sidebar_primary */ ?>

	<div id="sidebar-primary" class="sidebar">

		<?php do_atomic( 'open_sidebar_primary' ); /* fs_open_sidebar_primary */ ?>

		<?php dynamic_sidebar( 'primary' ); ?>

		<?php do_atomic( 'close_sidebar_primary' ); /* fs_close_sidebar_primary */ ?>

	</div><!-- #sidebar-primary .sidebar -->

	<?php do_atomic( 'after_sidebar_primary' ); /* fs_after_sidebar_primary */ ?>

<?php endif; ?>
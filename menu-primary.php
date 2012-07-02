<?php
/**
 * Primary Menu Template
 *
 * Displays the Primary Menu if it has active menu items.
 *
 * @package fs
 * @subpackage Template
 */

if ( has_nav_menu( 'primary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary' ); /* fs_before_menu_primary */ ?>

	<?php do_atomic( 'open_menu_primary' ); /* fs_open_menu_primary */ ?>

		<div class="nav-collapse">
			
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'nav', 'container_class' => '', 'menu_class' => 'nav pull-right', 'menu_id' => 'menu-primary-items', 'fallback_cb' => '', 'depth' => 2 , 'walker' => new Bootstrap_Walker_Nav_Menu() ) ); ?>
						
		</div>
	
	<?php do_atomic( 'close_menu_primary' ); /* fs_close_menu_primary */ ?>

	<?php do_atomic( 'after_menu_primary' ); /* fs_after_menu_primary */ ?>
	
<?php endif; ?>
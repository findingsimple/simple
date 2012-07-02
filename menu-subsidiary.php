<?php
/**
 * Subsidiary Menu Template
 *
 * Displays the Subsidiary Menu if it has active menu items.
 *
 * @package fs
 * @subpackage Template
 */

if ( has_nav_menu( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_menu_subsidiary' ); /* fs_before_menu_subsidiary */ ?>

	<div id="menu-subsidiary" class="menu-container">

		<div class="wrap">

			<?php do_atomic( 'open_menu_subsidiary' ); /* fs_open_menu_subsidiary */ ?>
			
			<div class="container">
			
			<?php wp_nav_menu( array( 'theme_location' => 'subsidiary', 'container' => 'nav', 'container_class' => 'subnav', 'menu_class' => 'nav nav-pills', 'menu_id' => 'menu-subsidiary-items', 'depth' => 1, 'fallback_cb' => '', 'walker' => new Bootstrap_Walker_Nav_Menu() ) ); ?>
			
			</div><!-- .container -->
			
			<?php do_atomic( 'close_menu_subsidiary' ); /* fs_close_menu_subsidiary */ ?>

		</div>

	</div><!-- #menu-subsidiary .menu-container -->

	<?php do_atomic( 'after_menu_subsidiary' ); /* fs_after_menu_subsidiary */ ?>

<?php endif; ?>
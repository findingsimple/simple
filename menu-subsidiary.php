<?php if ( has_nav_menu( 'subsidiary' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'subsidiary',
			'container'       => 'nav',
			'container_id'    => 'menu-subsidiary',
			'container_class' => 'menu pull-right',
			'menu_id'         => 'menu-subsidiary-items',
			'menu_class'      => 'nav nav-pills',
			'fallback_cb'     => '',
			'depth'			  => 1,
			'walker' => new Bootstrap_Walker_Nav_Menu()
		)
	);

}
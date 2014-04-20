<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

if ( has_nav_menu( 'primary' ) ) { ?>

	<div class="collapse navbar-collapse navbar-responsive-collapse">

		<?php 

		wp_nav_menu(
			array(
				'theme_location'	=> 'primary',
				'container'			=> 'nav',
				'container_id'		=> 'menu-primary',
				'container_class'	=> 'menu',
				'menu_id'			=> 'menu-primary-items',
				'menu_class'		=> 'nav navbar-nav menu-items',
				'fallback_cb'		=> '',
				'depth'				=> 2,
				'walker' => new Bootstrap_Walker_Nav_Menu()
			)
		);

		?>

		<form method="get" class="search-form navbar-form navbar-right" role="search" action="<?php echo trailingslashit( home_url() ); ?>">
			<div class="search-toggle pull-left">
				<a href="#" class="glyphicon glyphicon-search"><span class="sr-only">Search</span></a>
			</div>
			<div class="form-group">
				<input class="search-text form-control search-query" type="search" name="s" value="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else esc_attr_e( 'Search this site...', hybrid_get_parent_textdomain() ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
				<button class="search-submit btn btn-default" type="submit"><?php esc_attr_e( 'Search', hybrid_get_parent_textdomain() ); ?></button>
			</div>
		</form><!-- .search-form -->

	</div><!-- .nav-collapse -->


<?php }
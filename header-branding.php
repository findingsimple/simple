<?php 
/**
 * Header Branding Template
 *
 * @package fs
 * @subpackage Template
 */
?>

		<header id="header" class="menu-container navbar navbar-fixed-top" >

			<?php do_atomic( 'open_header' ); /* fs_open_header */ ?>

			<div class="wrap navbar-inner">

				<div class="container">
			
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>

					<div id="branding">
						<?php 
						if ( is_front_page() )
							echo '<h1 id="site-title"><a href="/" title="Finding Simple"><span>finding</span>simple</a></h1>'; 
						else
							echo '<span id="site-title"><a href="/" title="Finding Simple"><span>finding</span>simple</a></span>';
						?>
						<?php hybrid_site_description(); ?>
					</div><!-- #branding -->
				
					<?php get_template_part( 'menu', 'primary' ); /* Loads the menu-primary.php template */ ?>
				
				</div><!-- .container -->
				
				<?php do_atomic( 'header' ); /* fs_header */ ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_header' ); /* fs_close_header */ ?>

		</header><!-- #header -->
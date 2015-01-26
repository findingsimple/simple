<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. ?>

		<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

		<div class="container">

			<div id="content" <?php if ( !is_single() && !is_page() && !is_attachment() ) echo 'class="hfeed"'; ?>>

				<?php get_template_part( 'loop' ); // Loads the loop.php template. ?>

				<?php if ( ! maybe_bbpress() ) get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

			</div><!-- #content -->

		<?php 

		if ( maybe_woocommerce() ) {
			get_sidebar( 'woocommerce' ); // Loads the sidebar-woocommerce.php template.
		} elseif ( maybe_bbpress() ) {
			get_sidebar( 'bbpress' ); // Loads the sidebar-bbpress.php template.
		} else {
			get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. 
		}

		?>

		</div><!-- .container -->

<?php get_footer(); // Loads the footer.php template. ?>
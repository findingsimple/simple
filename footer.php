<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
	</main><!-- #main -->

	<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-primary.php template. ?>

	<footer id="footer">

		<div class="container">

			<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

			<div class="footer-content">
				<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>
			</div><!-- .footer-content -->

		</div><!-- .container -->

	</footer><!-- #footer -->

	<a href="#" class="scrollToTop">&uarr;</a>

	<?php wp_footer(); // wp_footer ?>

</body>
</html>
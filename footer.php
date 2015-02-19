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

	<footer <?php hybrid_attr( 'footer' ); ?>>

		<div class="container">

			<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

			<div class="footer-content">

				<p class="credit"><?php printf( __( 'Copyright &#169; 2008 - %1$s %2$s', hybrid_get_parent_textdomain() ), date_i18n( 'Y' ), hybrid_get_site_link() ); ?></p><!-- .credit -->

			</div><!-- .footer-content -->

		</div><!-- .container -->

	</footer><!-- #footer -->

	<?php wp_footer(); // wp_footer ?>

</body>
</html>
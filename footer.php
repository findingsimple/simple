<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package fs
 * @subpackage Template
 */
?>
				<?php get_sidebar( 'primary' ); /* Loads the sidebar-primary.php template */ ?>

				<?php get_sidebar( 'secondary' ); /* Loads the sidebar-secondary.php template */ ?>

				<?php do_atomic( 'close_main' ); /* fs_close_main */ ?>

			</div><!-- .wrap -->

		</div><!-- #main -->

		<?php do_atomic( 'after_main' ); /* fs_after_main */ ?>

		<?php get_sidebar( 'subsidiary' ); /* Loads the sidebar-subsidiary.php template */ ?>

		<?php get_template_part( 'menu', 'subsidiary' ); /* Loads the menu-subsidiary.php template */ ?>

		<?php do_atomic( 'before_footer' ); /* fs_before_footer */ ?>

		<footer id="footer">

			<?php do_atomic( 'open_footer' ); /* fs_open_footer */ ?>

			<div class="wrap footer-content">

				<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>

				<?php do_atomic( 'footer' ); /* fs_footer */ ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_footer' ); /* fs_close_footer */ ?>

		</footer><!-- #footer -->

		<?php do_atomic( 'after_footer' ); /* fs_after_footer */ ?>

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); /* fs_close_body */ ?>

<?php wp_footer(); /* wp_footer */ ?>

</body>
</html>
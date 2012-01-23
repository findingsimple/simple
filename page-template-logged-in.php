<?php
/**
 * Template Name: Logged In
 *
 * The Logged In template is a page template that allows only logged-in users to view the content
 * of the page and its comments. If the user isn't logged in, a message to log in with a link to the 
 * WordPress login page will be displayed. If the site has open registration, a link to register will
 * also be displayed.
 * @link http://themehybrid.com/themes/hybrid/page-templates/logged-in
 *
 * @package fs
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // prototype_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // prototype_open_content ?>
		
		<div class="hfeed">

			<?php if ( have_posts() && is_user_logged_in() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // prototype_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // prototype_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_textdomain() ) ); ?>
							
							<ul class="xoxo category-archives">
								<?php wp_list_categories( array( 'feed' => __( 'RSS', 'hybrid' ), 'show_count' => true, 'use_desc_for_title' => false, 'title_li' => false ) ); ?>
							</ul><!-- .xoxo .category-archives -->
							
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', hybrid_get_textdomain() ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-content -->

						<?php //echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

						<?php do_atomic( 'close_entry' ); // prototype_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // prototype_after_entry ?>



					<?php do_atomic( 'after_singular' ); // prototype_after_singular ?>

					<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php elseif ( have_posts() && !is_user_logged_in() ) : // If user is not logged in ?>

					<?php do_atomic( 'before_entry' ); // prototype_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // prototype_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<p class="alert">
							<?php printf( __( 'You must be <a href="%1$s" title="Log in">logged in</a> to view the content of this page.', hybrid_get_textdomain() ), wp_login_url( get_permalink() ) ); ?>
	
							<?php if ( get_option( 'users_can_register' ) ) printf( __( 'If you\'re not currently a member, please take a moment to <a href="%1$s" title="Register">register</a>.', hybrid_get_textdomain() ), site_url( 'wp-login.php?action=register', 'login' ) ); ?>
						</p><!-- .alert -->

						<?php do_atomic( 'close_entry' ); // prototype_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // prototype_after_entry ?>



					<?php do_atomic( 'after_singular' ); // prototype_after_singular ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // prototype_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // prototype_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
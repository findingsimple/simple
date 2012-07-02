<?php
/**
 * Template Name: Yearly
 *
 * The Yearly page template is used to show a list of your post archives by year. For each year a 
 * post has been made, the year is listed along with the number of posts for that particular year.
 *
 * @package fs
 * @subpackage Template
 */

get_header(); /* Loads the header.php template */ ?>

	<?php do_atomic( 'before_content' ); /* fs_before_content */ ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); /* fs_open_content */ ?>

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); /* fs_before_entry */ ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); /* fs_open_entry */ ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_parent_textdomain() ) ); ?>

							<ul class="xoxo yearly-archives">
								<?php wp_get_archives( array( 'type' => 'yearly', 'show_post_count' => true ) ); ?>
							</ul><!-- .xoxo .yearly-archives -->
							
							<?php wp_link_pages_extended( array( 'before' => '<div class="pagination pagination-centered"><ul>', 'after' => '</ul></div>', 'before_page' => '<li>', 'before_current_page' => '<li class="active">', 'after_page' => '</li>'  ) ); ?>

						</div><!-- .entry-content -->

						<?php do_atomic( 'close_entry' ); /* fs_close_entry */ ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); /* fs_after_entry */ ?>

					<?php get_sidebar( 'after-singular' ); /* Loads the sidebar-after-singular.php template */ ?>

					<?php do_atomic( 'after_singular' ); /* fs_after_singular */ ?>

					<?php /* comments_template( '/comments.php', true ); */ /* Loads the comments.php template */ ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); /* fs_close_content */ ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); /* fs_after_content */ ?>

<?php get_footer(); /* Loads the footer.php template */ ?>
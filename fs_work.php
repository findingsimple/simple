<?php
/**
 * Work Template
 *
 * This is the default work template.  It is used when a more specific template can't be found to display
 * singular views of the 'fs_work' post type.
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
			
						<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'By [entry-author]', hybrid_get_parent_textdomain() ) . '</div>' ); ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_parent_textdomain() ) ); ?>
							<?php wp_link_pages_extended( array( 'before' => '<div class="pagination pagination-centered"><ul>', 'after' => '</ul></div>', 'before_page' => '<li>', 'before_current_page' => '<li class="active">', 'after_page' => '</li>'  ) ); ?>
						</div><!-- .entry-content -->

						<?php do_atomic( 'close_entry' ); /* fs_close_entry */ ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); /* fs_after_entry */ ?>

					<?php do_atomic( 'after_singular' ); /* fs_after_singular */ ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); /* fs_close_content */ ?>

		<?php get_template_part( 'loop-nav' ); /* Loads the loop-nav.php template */ ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); /* fs_after_content */ ?>

<?php get_footer(); /* Loads the footer.php template */ ?>
<?php
/**
 * Template Name: Authors
 *
 * The Authors page template is for listing the authors of your site.  It shows each author's 
 * biographical information and avatar while linking the author's archive page.
 *
 * @package fs
 * @subpackage Template
 */

get_header(); ?>

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
							
					<?php foreach ( get_users(array( 'order_by' => 'display_name', 'exclude' => array('1') )) as $author ) : ?>

						<?php $user = new WP_User( $author->ID ); ?>

							<div id="hcard-<?php echo str_replace( ' ', '-', get_the_author_meta( 'user_nicename', $author->ID ) ); ?>" class="author-profile vcard clear">

								<a href="<?php echo get_author_posts_url( $author->ID ); ?>" title="<?php the_author_meta( 'display_name', $author->ID ); ?>">
									<?php echo get_avatar( get_the_author_meta( 'user_email', $author->ID ), '100', '', get_the_author_meta( 'display_name', $author->ID ) ); ?>
								</a>
								<h2 class="author-name fn n">
									<a href="<?php echo get_author_posts_url( $author->ID ); ?>" title="<?php the_author_meta( 'display_name', $author->ID ); ?>"><?php the_author_meta( 'display_name', $author->ID ); ?></a>
								</h2>
								<p class="author-bio">
									<?php the_author_meta( 'description', $author->ID ); ?>
								</p><!-- .author-bio -->

							</div><!-- .author-profile .vcard -->

					<?php endforeach; ?>							
							
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
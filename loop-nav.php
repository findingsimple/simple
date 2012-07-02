<?php
/**
 * Loop Nav Template
 *
 * This template is used to show your your next/previous post links on singular pages and
 * the next/previous posts links on the home/posts page and archive pages.
 *
 * @package fs
 * @subpackage Template
 */
?>

	<?php if ( is_attachment() ) : ?>

		<div class="loop-nav">
			<ul class="pager">
				<?php previous_post_link( '%link', '<li class="previous">' . __( '&larr; Return to entry', hybrid_get_parent_textdomain() ) . '</li>' ); ?>
			</ul>
		</div><!-- .loop-nav -->

	<?php elseif ( is_singular( 'post' ) ) : ?>

		<div class="loop-nav">
			<ul class="pager">
				<?php previous_post_link( '<li class="previous">' . __( '%link', hybrid_get_parent_textdomain() ) . '</li>', '&larr; %title' ); ?>
				<?php next_post_link( '<li class="next">' . __( '%link', hybrid_get_parent_textdomain() ) . '</li>', '%title &rarr;' ); ?>
			</ul>
		</div><!-- .loop-nav -->

	<?php elseif ( !is_singular() && current_theme_supports( 'loop-pagination' ) ) : ?>
		
		<div class="pagination pagination-centered">
			<?php loop_pagination( array( 'type' => 'list', 'before' => '', 'after' => '' ) ); ?>
		</div>

	<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<li class="previous">' . __( '&larr; Previous', hybrid_get_parent_textdomain() ) . '</li>', 'nxtlabel' => '<li class="next">' . __( 'Next &rarr;', hybrid_get_parent_textdomain() ) . '</li>' ) ) ) : ?>

		<div class="loop-nav">
			<ul class="pager">
				<?php echo $nav; ?>
			</ul>
		</div><!-- .loop-nav -->

	<?php endif; ?>
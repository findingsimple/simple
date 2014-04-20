<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
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

	<?php elseif ( !is_singular() && current_theme_supports( 'loop-pagination' ) && $nav = bootstrap_loop_pagination( array( 'type' => 'list', 'before' => '', 'after' => '', 'prev_text' => '&larr; Previous', 'next_text' => 'Next &rarr;', 'echo' => false ) ) ) : ?>
		
		<div class="loop-nav pagination-centered">
			<?php echo $nav; ?>
		</div><!-- .loop-nav -->

	<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<li class="previous">' . __( '&larr; Previous', hybrid_get_parent_textdomain() ) . '</li>', 'nxtlabel' => '<li class="next">' . __( 'Next &rarr;', hybrid_get_parent_textdomain() ) . '</li>' ) ) ) : ?>

		<div class="loop-nav">
			<ul class="pager">
				<?php echo $nav; ?>
			</ul>
		</div><!-- .loop-nav -->

	<?php endif; ?>
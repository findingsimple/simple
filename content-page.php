<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

if ( is_singular( 'page' ) ) { ?>

<div <?php hybrid_post_attributes(); ?>>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php 
		if ( function_exists( 'wp_link_pages_extended' ) ) {
			wp_link_pages_extended( array( 'before' => '<div class="pagination-wrapper pagination-centered"><ul class="pagination">', 'after' => '</ul></div>', 'before_page' => '<li>', 'before_current_page' => '<li class="active">', 'after_page' => '</li>'  ) ); 
		} else {
			wp_link_pages();
		}
		?>
	</div><!-- .entry-content -->

</div><!-- .hentry -->

<?php } else { ?>

<article <?php hybrid_post_attributes(); ?>>

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '">', '</a></h2>' ); ?>
		<?php echo apply_atomic_shortcode( 'entry_byline', '<div class="entry-byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'simple' ) . '</div>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image(); ?>
		<?php the_excerpt(); ?>
		<?php 
		if ( function_exists( 'wp_link_pages_extended' ) ) {
			wp_link_pages_extended( array( 'before' => '<div class="pagination-wrapper"><ul class="pagination pagination-sm">', 'after' => '</ul></div>', 'before_page' => '<li>', 'before_current_page' => '<li class="active">', 'after_page' => '</li>'  ) ); 
		} else {
			wp_link_pages();
		}
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms before="Posted in " taxonomy="category"] [entry-terms before="| Tagged "] [entry-updated]', 'simple' ) . '</div>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- .hentry -->

<?php } ?>
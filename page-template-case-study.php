<?php
/**
 * Template Name: Case Study
 *
 *
 * @package fs
 * @subpackage Template
 */

$casestudies = hybrid_get_setting('fs_casestudies');
$featarr = split(",",$casestudies);
$featarr = array_diff($featarr, array(""));
$testlast = count($featarr);
 
get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // fs_before_content ?>

	<div id="content" class="cs">

		<?php do_atomic( 'open_content' ); // fs_open_content ?>

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // fs_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // fs_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_textdomain() ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', hybrid_get_textdomain() ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-content -->

						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

						<?php do_atomic( 'close_entry' ); // fs_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // fs_after_entry ?>

					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // fs_after_singular ?>

					<?php //comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // fs_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // fs_after_content ?>
	
	<div id="cs-gallery-wrapper">
			<?php 
			$post_id = $post->ID;
			$gallery_id = get_post_meta($post_id, 'gallery_id', true); 
			?>
			<?php echo do_shortcode("[nggallery id=$gallery_id template=list]"); ?>
			</div>
			
			<div id="cs-more-work" class="clear">
			
			<h3>Other Work</h3>
			
			<ul>
		<?php $temp_query = $wp_query; ?>

		<?php $counter = 1; ?>
        					
        
	   
	   <? } ?>

	   
<?php get_footer(); // Loads the footer.php template. ?>
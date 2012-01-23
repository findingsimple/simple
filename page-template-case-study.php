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

	<div id="content">

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



					<?php do_atomic( 'after_singular' ); // fs_after_singular ?>

					<?php //comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // fs_close_content ?>

		<div id="cs-gallery-wrapper">
			<?php 
			$post_id = $post->ID;
			$gallery_id = get_post_meta($post_id, 'gallery_id', true); 
			?>
			<?php echo do_shortcode("[nggallery id=$gallery_id template=list]"); ?>
			</div>
			
			<div id="cs-more-work">
			
			<h3>Other Work</h3>
			
			<ul>
				<?php $temp_query = $wp_query; ?>

				<?php $counter = 1; ?>
									
				<?php foreach ( $featarr as $featitem ) { ?>
									
				<?php query_posts('page_id=' . $featitem); ?>
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
					
				<li class="<?php the_title(); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="<?php if ($post_id == $post->ID) {echo 'current';} else {echo "fade";} if(sizeof($featarr) == $counter) echo " lastcs";?>" ><?php if ( function_exists( 'get_the_image' ) ) get_the_image(array( 'default_size' => 'thumbnail','link_to_post' => false, )); ?>
					</a></li>

			   <?php endwhile; endif; ?>
						
				<?php $counter++; ?>
						
				<?php } ?>
				   
				<?php $wp_query = $temp_query; ?>
					
				</ul>
			
			
			</div>
		
		
	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // fs_after_content ?>
	  

	   
<?php get_footer(); // Loads the footer.php template. ?>
<?php
/**
 * Template Name: Work
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

					<?php $temp_query = $wp_query; ?>

					<?php $counter = 1; ?>
										
					<?php foreach ( $featarr as $featitem ) { ?>
										
					<?php query_posts('page_id=' . $featitem); ?>
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
				
						<div id="work-recent" class="work-panel <?php if ($counter==4 || $counter==8 || $counter==12) {echo 'panel-end';}?>">
						
						<a href="<?php the_permalink(); ?>" class="cs-image-link">

							<?php if ( function_exists( 'get_the_image' ) ) get_the_image(array( 'link_to_post' => false, 'default_size' => 'medium')); ?>
							
							<img src="http://assets2.binaryplayground.com/wp-content/themes/simpleroyale/images/btn-more.png" alt="Read more about <?php the_title(); ?>" class="cs-hover-image" />
						</a>
						
						<h2 class="home-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<div class="home-content">
						<?php the_excerpt() ?>
						</div>
						</div><!-- .post -->
						
						<?php endwhile; endif; ?>
							
					   <?php $counter++; ?>
							
					   <?php } ?>
					   
					<?php $wp_query = $temp_query; ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // fs_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // fs_after_content ?>

	   
<?php get_footer(); // Loads the footer.php template. ?>
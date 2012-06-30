<?php
/**
 * Template Name: Home Page
 *
 *
 * @package fs
 * @subpackage Template
 */

$casestudies = get_option('fs_casestudies');
$featarr = split(",",$casestudies);
$featarr = array_diff($featarr, array(""));
$testlast = count($featarr);
 
get_header(); /* Loads the header.php template */ ?>

	<?php do_atomic( 'before_content' ); /* fs_before_content */ ?>

	<div id="content" class="cs">

		<?php do_atomic( 'open_content' ); /* fs_open_content */ ?>

		<?php $temp_query = $wp_query; ?>

        <?php query_posts('page_id=1021'); ?>
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
			<div id="home-recent" class="home-panel">
				<?php if ( function_exists( 'get_the_image' ) ) get_the_image(array( 'default_size' => 'large' )); ?>
				<!-- <img src="<?php if ( function_exists( 'p75GetThumbnail' ) ) echo p75GetThumbnail($post->ID, 300, 200); ?>" alt="<?php the_title(); ?>" /> -->
				<span class="home-category">Recent Work</span>
				<h2 class="home-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="home-content">
					<?php the_excerpt() ?>
				</div>
			</div><!-- .post -->
        <?php endwhile; endif; ?>
			
        <?php rewind_posts(); ?>

		<?php query_posts('cat=4&showposts=1'); ?>
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
			<div id="home-latest" class="home-panel">
				<?php if ( function_exists( 'get_the_image' ) ) get_the_image(array( 'default_size' => 'large' )); ?>
				<!-- <img src="<?php if ( function_exists( 'p75GetThumbnail' ) ) echo p75GetThumbnail($post->ID, 300, 200); ?>" alt="<?php the_title(); ?>" /> -->
				<span class="home-category">Latest News</span>
				<h2 class="home-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="home-content">
					<?php the_excerpt() ?>
				</div>
			</div><!-- .post -->
        <?php endwhile; endif; ?>

        <?php rewind_posts(); ?>
		
		<?php $wp_query = $temp_query; ?>
	
	
		<div id="home-test" class="home-panel">
		
			<div id="test-panel">
			
				<div class="test-content one">
					<p class="test-name">Leo Kopelow</p>
					<p class="test-org">Daylight Design</p>
					<p>"We work with Finding Simple because they offer deep (and current) technical knowledge as well as clear communication and effective project management."</p>
				</div>

				<div class="test-content two" style="display:none">
					<p class="test-name">Karl Treacher</p>
					<p class="test-org">CEO, Brand Behaviour</p>
					<p>"My experience with Finding Simple has been nothing short of terrific and I thoroughly recommend working with them."</p>
				</div>
				
				<div class="test-content three" style="display:none">
					<p class="test-name">Leo Rocker</p>
					<p class="test-org">Director, Quirky Kid</p>
					<p>"We highly recommended Finding Simple. Timely support, outstanding communication, no strings attached advice and implementation."</p>
				</div>

				<div class="test-content four" style="display:none">
					<p class="test-name">Christine Barnes</p>
					<p class="test-org">BKSIYAA</p>
					<p>"My experience of working with Finding Simple is very positive, I thoroughly recommend them, they have extensive knowledge and are very quick to help and resolve issues."</p>
				</div>

			</div>
			
			<div id="twitter-home">
				<!-- <div id="twitter-wrapper">
					<?php //aktt_latest_tweet(); ?>
				</div> -->
			</div> 

		</div><!-- .post -->

		<?php do_atomic( 'close_content' ); /* fs_close_content */ ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); /* fs_after_content */ ?>

	   
<?php get_footer(); /* Loads the footer.php template */ ?>
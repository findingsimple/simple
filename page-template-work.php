<?php
/**
 * Template Name: Work Page Template
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
						</div><!-- .entry-content -->

						<?php do_atomic( 'close_entry' ); /* fs_close_entry */ ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); /* fs_after_entry */ ?>

					<div id="work-area">
						<?php	
						$args = array( 
							'numberposts' => 12 , 
							'post_type' => 'fs_work', 
							'order' => 'DESC'
						);
						
						$works = get_posts( $args ); 
						$count=0;
						if(!empty($works)) {
							foreach($works as $post) {
								setup_postdata($post);
								if($count%4 == 0 && $count!=0) { ?></div><!-- .row --><?php }
								if($count%4 == 0) { ?><div class="row"><?php }
								?>
								
								<div class="work span3">
									<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'default_size' => 'full', 'width' => 255 ) ); ?>
									<h3><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
								</div><!-- .work .span4 -->
								
								<?php
								$count++;
							}
							?></div><!-- .row -->
							<?php
						} 
					
						wp_reset_postdata();	

						?>
					</div><!-- #work-area -->
					
					<?php get_sidebar( 'after-singular' ); /* Loads the sidebar-after-singular.php template */ ?>

					<?php do_atomic( 'after_singular' ); /* fs_after_singular */ ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); /* fs_close_content */ ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); /* fs_after_content */ ?>

<?php get_footer(); /* Loads the footer.php template */ ?>
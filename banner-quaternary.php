<?php
/**
 * Quaternary Banner Template
 *
 * Displays the Banner area after the theme navigation.
 *
 * @package fs
 * @subpackage Template
 */
?>

	<div id="banner-quaternary" class="banner">

		<div class="wrap">
		
			<div class="banner-content slider">
		
				<h2>Our Team</h2>
				
				<ul class="slides">
					
					<?php 
					global $post;
					$tmp_post = $post;
					$team = get_posts(array('post_type'=>'fs_team_members','order'=>'ASC'));
					foreach($team as $post) : setup_postdata($post); ?>
						
					<li class="slide">
					
						<div class="row-fluid">
				
							<div class="span6">
						
								<img src="<?php $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); echo $img[0]; ?>" alt="<?php the_title(); ?>" />
							
							</div><!-- .span6 -->
						
							<div class="span5">
						
								<h3><?php the_title(); ?></h3>
								<h4><?php echo get_post_meta(get_the_ID(),'fs_team_members_role',true); ?></h4>
								<?php the_content(); ?>
								<ul>
									<li class="profile-email"><a href="mailto:<?php echo antispambot( get_post_meta(get_the_ID(),'fs_team_members_email',true) ); ?>" title="Get in touch" data-icon="&#57348;" ><?php echo antispambot( get_post_meta(get_the_ID(),'fs_team_members_email',true) ); ?></a></li>
									<li class="profile-twitter"><a href="https://twitter.com/<?php echo get_post_meta(get_the_ID(),'fs_team_members_twitter',true); ?>" title="findingsimple twitter profile" data-icon="&#57349;" >@<?php echo get_post_meta(get_the_ID(),'fs_team_members_twitter',true); ?></a></li>
								</ul>
								
							</div><!-- .span5 -->
						
						</div><!-- .row -->
					
					</li>	
						
					<?php 
					endforeach;
					$post = $tmp_post;
					?>

					
				</ul><!-- .row-->
			
			</div><!-- .banner-content -->
			
		</div><!-- .wrap -->

	</div><!-- #banner-primary .banner -->
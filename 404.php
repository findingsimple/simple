<?php
/**
 * 404 Template
 *
 * The 404 template is used when a reader visits an invalid URL on your site. By default, the template will 
 * display a generic message.
 *
 * @package fs
 * @subpackage Template
 * @link http://codex.wordpress.org/Creating_an_Error_404_Page
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); /* Loads the header.php template */ ?>

	<?php do_atomic( 'before_content' ); /* fs_before_content */ ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); /* fs_open_content */ ?>

		<div class="hfeed">

			<div id="post-0" class="<?php hybrid_entry_class(); ?>">

				<h1 class="error-404-title entry-title"><?php _e( 'Not Found', hybrid_get_parent_textdomain() ); ?></h1>

				<div class="entry-content">

					<p>
					<?php printf( __( 'Apologies, but we were unable to find what you were looking for. Perhaps searching will help.', hybrid_get_parent_textdomain() )); ?>
					</p>

					<?php get_search_form(); /* Loads the searchform.php template */ ?>
					
					<p>
					There could be a few different reasons for this:</p>
					<ul>
						<li>The page was moved.</li>
						<li>The page no longer exists.</li>
						<li>The URL is slightly incorrect.</li>
					</ul>
					<p>To get you back on track, try one of the following:</p>
					<ul>
						<li><a href="<?php echo get_bloginfo('wpurl');?>">Go to our home page</a></li>
						<li><a href="<?php echo get_bloginfo('wpurl');?>/blog">View our blog</li>
						<li><a href="<?php echo get_bloginfo('wpurl');?>/contact">Report a broken link</li>
					</ul>
				</div><!-- .entry-content -->

			</div><!-- .hentry -->

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); /* fs_close_content */ ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); /* fs_after_content */ ?>

<?php get_footer(); /* Loads the footer.php template */ ?>
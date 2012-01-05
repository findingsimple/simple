<?php
/**
 * Template Name: Sitemap
 *
 * The Sitemap template is a page template that creates and HTML-fsd sitemap of your
 * site, listing nearly every page of your site. It lists your feeds, pages, archives, and posts.
 * @link http://themehybrid.com/themes/hybrid/page-templates/sitemap
 *
 * @package fs
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // prototype_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // prototype_open_content ?>

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // prototype_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // prototype_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', hybrid_get_textdomain() ) ); ?>

							<h2><?php _e( 'Feeds', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo feeds">
								<li><a href="<?php bloginfo( 'rdf_url' ); ?>" title="<?php esc_attr_e( 'RDF/RSS 1.0 feed', 'hybrid' ); ?>"><?php _e( '<acronym title="Resource Description Framework">RDF</acronym> <acronym title="Really Simple Syndication">RSS</acronym> 1.0 feed', hybrid_get_textdomain() ); ?></a></li>
								<li><a href="<?php bloginfo( 'rss_url' ); ?>" title="<?php esc_attr_e( 'RSS 0.92 feed', 'hybrid' ); ?>"><?php _e( '<acronym title="Really Simple Syndication">RSS</acronym> 0.92 feed', hybrid_get_textdomain() ); ?></a></li>
								<li><a href="<?php bloginfo( 'rss2_url' ); ?>" title="<?php esc_attr_e( 'RSS 2.0 feed', 'hybrid' ); ?>"><?php _e( '<acronym title="Really Simple Syndication">RSS</acronym> 2.0 feed', hybrid_get_textdomain() ); ?></a></li>
								<li><a href="<?php bloginfo( 'atom_url' ); ?>" title="<?php esc_attr_e( 'Atom feed', 'hybrid' ); ?>"><?php _e( 'Atom feed', hybrid_get_textdomain() ); ?></a></li>
								<li><a href="<?php bloginfo( 'comments_rss2_url' ); ?>" title="<?php esc_attr_e( 'Comments RSS 2.0 feed', 'hybrid' ); ?>"><?php _e( 'Comments <acronym title="Really Simple Syndication">RSS</acronym> 2.0 feed', hybrid_get_textdomain() ); ?></a></li>
							</ul><!-- .xoxo .feeds -->
		
							<h2><?php _e( 'Pages', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo pages">
								<?php wp_list_pages( array( 'title_li' => false ) ); ?>
							</ul><!-- .xoxo .pages -->
		
							<h2><?php _e( 'Category Archives', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo category-archives">
								<?php wp_list_categories( array( 'feed' => __( 'RSS', hybrid_get_textdomain() ), 'show_count' => true, 'use_desc_for_title' => false, 'title_li' => false ) ); ?>
							</ul><!-- .xoxo .category-archives -->
		
							<h2><?php _e( 'Author Archives', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo author-archives">
								<?php wp_list_authors( array( 'exclude_admin' => false, 'show_fullname' => true, 'feed' => __( 'RSS', hybrid_get_textdomain() ), 'optioncount' => true, 'title_li' => false ) ); ?>
							</ul><!-- .xoxo .author-archives -->
		
							<h2><?php _e( 'Yearly Archives', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo yearly-archives">
								<?php wp_get_archives( array( 'type' => 'yearly', 'show_post_count' => true ) ); ?>
							</ul><!-- .xoxo .yearly-archives -->
		
							<h2><?php _e( 'Monthly Archives', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo monthly-archives">
								<?php wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => true ) ); ?>
							</ul><!-- .xoxo .monthly-archives -->
		
							<h2><?php _e( 'Weekly Archives', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo weekly-archives">
								<?php wp_get_archives( array( 'type' => 'weekly', 'show_post_count' => true ) ); ?>
							</ul><!-- .xoxo .weekly-archives -->
		
							<h2><?php _e( 'Daily Archives', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo daily-archives">
								<?php wp_get_archives( array( 'type' => 'daily', 'show_post_count' => true ) ); ?>
							</ul><!-- .xoxo .daily-archives -->
		
							<h2><?php _e( 'Tag Archives', hybrid_get_textdomain() ); ?></h2>
		
							<p class="tag-cloud">
								<?php wp_tag_cloud( array( 'number' => 0 ) ); ?>
							</p><!-- .tag-cloud -->
		
							<h2><?php _e( 'Blog Posts', hybrid_get_textdomain() ); ?></h2>
		
							<ul class="xoxo post-archives">
								<?php wp_get_archives( array( 'type' => 'postbypost' ) ); ?>
							</ul><!-- .xoxo .post-archives -->
									
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', hybrid_get_textdomain() ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-content -->

						<?php //echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>

						<?php do_atomic( 'close_entry' ); // prototype_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // prototype_after_entry ?>

					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // prototype_after_singular ?>

					<?php //comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // prototype_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // prototype_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>
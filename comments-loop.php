<?php 
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

if ( have_comments() ) { ?>

	<h2 id="comments-number"><?php comments_number( '', __( 'One Comment', hybrid_get_parent_textdomain() ), __( '% Comments', hybrid_get_parent_textdomain() ) ); ?></h2>

	<ol class="comment-list <?php if (get_option('show_avatars') == 1){ echo"show-avatars"; } ?>">
		<?php wp_list_comments( hybrid_list_comments_args() ); ?>
	</ol><!-- .comment-list -->

	<?php get_template_part( 'comments-loop-nav' ); // Loads the comment-loop-nav.php template. ?>

<?php } // End check for comments. ?>

<?php get_template_part( 'comments-loop-error' ); // Loads the comments-loop-error.php template. ?>
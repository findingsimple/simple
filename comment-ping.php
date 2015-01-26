<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

global $comment;
?>
<li <?php hybrid_attr('comment'); ?>>

	<?php if (get_option('show_avatars') == 1){ ?>
		<img src="<?php echo get_template_directory_uri() . '/img/ping.png'; ?>" class="avatar avatar-96 photo img-circle" />
	<?php } ?>

	<div class="comment-content">

		<div class="comment-author"><cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite></div>

		<div class="comment-meta"><time <?php hybrid_attr( 'comment-published' ); ?>><?php printf( __( '%s ago', hybrid_get_parent_textdomain() ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time> <a <?php hybrid_attr( 'comment-permalink' ); ?>><?php _e( 'Permalink', hybrid_get_parent_textdomain() ); ?></a> <?php edit_comment_link(); ?></div>

		<div class="comment-text" itemprop="commentText">
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<div class="moderation alert alert-warning"><?php echo __( 'Your comment is awaiting moderation.', hybrid_get_parent_textdomain() ); ?></div>
			<?php endif; ?>
			<?php comment_text(); ?>
		</div><!-- .comment-content .comment-text -->

		<?php hybrid_comment_reply_link(); ?>

	</div><!-- .comment-content -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
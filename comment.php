<?php
/**
 * Comment Template
 *
 * The comment template displays an individual comment. This can be overwritten by templates specific
 * to the comment type (comment.php, comment-{$comment_type}.php, comment-pingback.php, 
 * comment-trackback.php) in a child theme.
 *
 * @package fs
 * @subpackage Template
 */

	global $post, $comment;
?>

	<li id="comment-<?php comment_ID(); ?>" class="<?php hybrid_comment_class(); ?>">

		<?php do_atomic( 'before_comment' ); /* fs_before_comment */ ?>

		<div class="comment-wrap clearfix">

			<?php do_atomic( 'open_comment' ); /* fs_open_comment */ ?>
			
			<div class="comment-meta-wrap">

				<?php echo hybrid_avatar_circles(); ?>

				<?php echo apply_atomic_shortcode( 'comment_meta', '<div class="comment-meta">[comment-author] [comment-published]</div>' ); ?>
			
			</div><!-- .comment-meta-wrap -->
			
			<div class="comment-content comment-text">
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<?php echo apply_atomic_shortcode( 'comment_moderation', '<p class="alert moderation">' . __( 'Your comment is awaiting moderation.', hybrid_get_parent_textdomain() ) . '</p>' ); ?>
				<?php endif; ?>

				<?php comment_text( $comment->comment_ID ); ?>
			</div><!-- .comment-content .comment-text -->

			<?php do_atomic( 'close_comment' ); /* fs_close_comment */ ?>

		</div><!-- .comment-wrap -->

		<?php do_atomic( 'after_comment' ); /* fs_after_comment */ ?>

	<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
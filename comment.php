<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

global $comment;
?>
<li <?php hybrid_comment_attributes(); ?>>

	<?php echo hybrid_avatar(); ?>

	<div class="comment-content">

		<?php echo apply_atomic_shortcode( 'comment_author', '<div class="comment-author">[comment-author]</div>' ); ?>

		<?php echo apply_atomic_shortcode( 'comment_meta', '<div class="comment-meta">[comment-published] [comment-permalink before=" "] [comment-edit-link before="| "]</div>' ); ?>

		<div class="comment-text">
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<div class="moderation alert alert-warning"><?php echo __( 'Your comment is awaiting moderation.', hybrid_get_parent_textdomain() ); ?></div>
			<?php endif; ?>
			<?php comment_text(); ?>
		</div><!-- .comment-content .comment-text -->

		<?php echo hybrid_comment_reply_link_shortcode( array() ); ?>

	</div><!-- .comment-content -->

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
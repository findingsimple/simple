<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<section id="comments">

	<?php get_template_part( 'comments-loop' ); // Loads the comments-loop.php template. ?>

	<?php 

	ob_start();

	comment_form(); // Loads the comment form.

	$form = ob_get_clean(); 

	echo str_replace('id="submit"','class="btn btn-default"', $form );
	
	?>

</section><!-- #comments -->
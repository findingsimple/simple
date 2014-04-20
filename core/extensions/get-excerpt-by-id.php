<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/
function get_excerpt_by_id( $post, $length = false ) {

	if ( is_numeric($post) ) {
		$post = get_post($post);
	} elseif( ! is_object($post) ) {
		return false;
	}

	if ( has_excerpt( $post->ID ) ) {
		return $the_excerpt = apply_filters( 'get_the_excerpt', $post->post_excerpt );
	} else {
		$the_excerpt = $post->post_content;
	}
 
	$the_excerpt = strip_shortcodes( $the_excerpt );
	$the_excerpt = apply_filters( 'the_content', $the_excerpt );
	$the_excerpt = str_replace(']]>', ']]&gt;', $the_excerpt);
	
	$excerpt_length = ( $length ) ? $length : apply_filters( 'excerpt_length', 55 );
	$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
	$the_excerpt = wp_trim_words( $the_excerpt, $excerpt_length, $excerpt_more );
 
	return apply_filters( 'wp_trim_excerpt', $the_excerpt );

}
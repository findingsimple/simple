<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Utility function for checking WordPress version
 */
if ( ! function_exists( 'is_version' ) ) {
    function is_version( $version = '3.9' ) {
        global $wp_version;

        if ( version_compare( $wp_version, $version, '>=' ) ) {
            return true;
        } 
        return false;
    }
}

/**
 * Displays a post's number of comments wrapped in a link to the comments area.
 */
function maybe_comments_link( $args = array() ) {

	$comments_link = '';

	$number = doubleval( get_comments_number() );

	$defaults = array( 
		'zero' => __( 'No Comments', hybrid_get_parent_textdomain() ), 
		'one' => __( '%1$s Comment', hybrid_get_parent_textdomain() ), 
		'more' => __( '%1$s Comments', hybrid_get_parent_textdomain() ), 
		'css_class' => 'comments-link', 
		'none' => '', 
		'before' => '| ', 
		'after' => ''
	);

	$attr = array_merge( $defaults, $args );

	if ( 0 == $number && !comments_open() && !pings_open() ) {
		if ( $attr['none'] )
			$comments_link = '<span class="' . esc_attr( $attr['css_class'] ) . '">' . sprintf( $attr['none'], number_format_i18n( $number ) ) . '</span>';
	}
	elseif ( 0 == $number )
		$comments_link = '<a class="' . esc_attr( $attr['css_class'] ) . '" href="' . get_permalink() . '#respond" title="' . sprintf( esc_attr__( 'Comment on %1$s', 'hybrid-core' ), the_title_attribute( 'echo=0' ) ) . '">' . sprintf( $attr['zero'], number_format_i18n( $number ) ) . '</a>';
	elseif ( 1 == $number )
		$comments_link = '<a class="' . esc_attr( $attr['css_class'] ) . '" href="' . get_comments_link() . '" title="' . sprintf( esc_attr__( 'Comment on %1$s', 'hybrid-core' ), the_title_attribute( 'echo=0' ) ) . '">' . sprintf( $attr['one'], number_format_i18n( $number ) ) . '</a>';
	elseif ( 1 < $number )
		$comments_link = '<a class="' . esc_attr( $attr['css_class'] ) . '" href="' . get_comments_link() . '" title="' . sprintf( esc_attr__( 'Comment on %1$s', 'hybrid-core' ), the_title_attribute( 'echo=0' ) ) . '">' . sprintf( $attr['more'], number_format_i18n( $number ) ) . '</a>';

	if ( $comments_link )
		$comments_link = $attr['before'] . $comments_link . $attr['after'];

	echo $comments_link;
}
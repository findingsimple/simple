<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

add_shortcode( 'entry-updated', 'entry_updated_shortcode' );

/**
 * Displays the updated date of an individual post.
 *
 */
function entry_updated_shortcode( $attr ) {

	$attr = shortcode_atts( 
		array( 
			'before' => '', 
			'after' => '', 
			'format' => get_option( 'date_format' ), 
			'human_time' => '' 
		), 
		$attr, 
		'entry-updated'
	);

	/* If $human_time is passed in, allow for '%s ago' where '%s' is the return value of human_time_diff(). */
	if ( !empty( $attr['human_time'] ) )
		$time = sprintf( $attr['human_time'], human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );

	/* Else, just grab the time based on the format. */
	else
		$time = get_the_modified_time( $attr['format'] );

	$updated = '<time class="updated" style="display:none;" datetime="' . get_the_modified_time( 'Y-m-d\TH:i:sP' ) . '" title="' . get_the_modified_time( esc_attr__( 'l, F jS, Y, g:i a', 'hybrid-core' ) ) . '">' . $time . '</time>';

	return $attr['before'] . $updated . $attr['after'];

}

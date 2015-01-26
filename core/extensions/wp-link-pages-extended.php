<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Modified core wp_link_pages function for a better structure 
 * and to work with bootstrap
 *
 * Adds before_page, before_current_page and after_page variables 
 * because link_before and link_after are actually with the page 
 * link/anchor tags
 * 
 */
function wp_link_pages_extended($args = '') {

	$defaults = array(
		'before' => '<p>' . __('Pages:', hybrid_get_parent_textdomain() ), 
		'after' => '</p>',
		'link_before' => '', 
		'link_after' => '',
		'next_or_number' => 'number', 
		'nextpagelink' => __('Next page', hybrid_get_parent_textdomain() ),
		'previouspagelink' => __('Previous page', hybrid_get_parent_textdomain() ), 
		'pagelink' => '%',
		'before_page' => '' , 
		'before_current_page' => '', 
		'after_page' => '',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
				$j = str_replace('%',$i,$pagelink);
				if ( ($i != $page) || ((!$more) && ($page==1)) ) {
					$output .= $before_page;
					$output .= _wp_link_page($i);
				} else {
					$output .= $before_current_page;
					$output .= '<a href="#">';
				}
				$output .= $link_before . $j . $link_after;
				$output .= '</a>';
				$output .= $after_page;
			}
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= $before_page;
					$output .= _wp_link_page($i);
					$output .= $link_before. $previouspagelink . $link_after . '</a>';
					$output .= $after_page;
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= $before_page;
					$output .= _wp_link_page($i);
					$output .= $link_before. $nextpagelink . $link_after . '</a>';
					$output .= $after_page;
				}
				$output .= $after;
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}

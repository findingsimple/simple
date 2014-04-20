<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class, 
 * which should be used in theme templates.
 *
 * @access public
 * @param  array $args Arguments to pass to Breadcrumb_Trail.
 * @return void
 */
function bootstrap_breadcrumb_trail( $args = array() ) {

	$breadcrumb = new Bootstrap_Breadcrumb_Trail( $args );

	$breadcrumb->trail();

}

/**
 * Extends the Breadcrumb_Trail class to output twitter bootstrap compatible breadcrumbs.
 * Only use this if bootstrap is in use.  
 *
 * @access public
 */
class Bootstrap_Breadcrumb_Trail extends Breadcrumb_Trail {

	/**
	 * Sets up the breadcrumb trail.
	 *
	 * @since  0.6.0
	 * @access public
	 * @param  array  $args The arguments for how to build the breadcrumb trail.
	 * @return void
	 */
	public function __construct( $args = array() ) {

		/* Remove the bbPress breadcrumbs. */
		add_filter( 'bbp_get_breadcrumb', '__return_false' );

		$defaults = array(
			'container'       => 'ul',
			'separator'       => '',
			'before'          => '',
			'after'           => '',
			'show_on_front'   => true,
			'network'         => false,
			//'show_edit_link'  => false,
			'show_title'      => true,
			'show_browse'     => false,
			'echo'            => true,

			/* Post taxonomy (examples follow). */
			'post_taxonomy' => array(
				// 'post'  => 'post_tag',
				// 'book'  => 'genre',
			),

			/* Labels for text used (see Breadcrumb_Trail::default_labels). */
			'labels' => array()
		);

		$this->args = apply_filters( 'breadcrumb_trail_args', wp_parse_args( $args, $defaults ) );

		/* Merge the user-added labels with the defaults. */
		$this->args['labels'] = wp_parse_args( $this->args['labels'], $this->default_labels() );

		$this->do_trail_items();

	}

	/**
	 * Formats and outputs the breadcrumb trail.
	 *
	 * @access public
	 * @return string
	 */
	public function trail() {

		$breadcrumb = '';

		/* Connect the breadcrumb trail if there are items in the trail. */
		if ( !empty( $this->items ) && is_array( $this->items ) ) {

			/* Open the breadcrumb trail containers. */
			$breadcrumb = "\n\t\t" . '<' . tag_escape( $this->args['container'] ) . ' class="breadcrumb-trail breadcrumbs breadcrumb" >';

			/* If $before was set, wrap it in a container. */
			$breadcrumb .= ( !empty( $this->args['before'] ) ? "\n\t\t\t" . '<li class="trail-before">' . $this->args['before'] . '</li> ' . "\n\t\t\t" : '' );

			/* Add 'browse' label if it should be shown. */
			if ( true === $this->args['show_browse'] )
				$breadcrumb .= "\n\t\t\t" . '<li class="trail-browse">' . $this->args['labels']['browse'] . '</li> ';


			//retrieve first item
			if ( 1 < count( $this->items ) )
				$first_item = array_shift( $this->items );

			//retrieve second item
			$last_item = array_pop( $this->items );

			if (is_front_page())
				$last_item = '<span class="breadcrumb-home"></span> ' . $last_item;


			//loop through each item (except for first and last) and append/prepend <li> tags
			$temp_array = array();

			foreach ( $this->items as $item ) {

				/* Format the separator. */
				$separator = ( !empty( $this->args['separator'] ) ? '<span class="sep">' . $this->args['separator'] . '</span> ' : '' );

				/* Add the separators */
				$item = $separator . $item ;				

				$temp_array[] = '<li>' . $item . '</li>';

			}

			$this->items = $temp_array;

			/* Adds the 'trail-begin' class around the first item if there's more than one item. */
			if ( !empty( $first_item ) )
				array_unshift( $this->items, '<li class="trail-begin"><span class="breadcrumb-home"></span> ' . $first_item . '</li>' );

			/* Adds the 'trail-end' class around last item. */
			if ( is_front_page() ) {

				array_push( $this->items, '<li class="trail-end active">' . $last_item . '</li>' );
				
			} else {

				/* Format the separator. */
				$separator = ( !empty( $this->args['separator'] ) ? '<span class="sep">' . $this->args['separator'] . '</span> ' : '' );

				/* Add the separator */
				$last_item = $separator . $last_item ;

				array_push( $this->items, '<li class="trail-end active">' . $last_item . '</li>' );
			}

			/* Join the individual trail items into a single string. */
			$breadcrumb .= join( "\n\t\t\t", $this->items );

			/* If $after was set, wrap it in a container. */
			$breadcrumb .= ( !empty( $this->args['after'] ) ? "\n\t\t\t" . ' <li class="trail-after">' . $this->args['after'] . '</li>' : '' );

			/* Close the breadcrumb trail containers. */
			$breadcrumb .= "\n\t\t" . '</' . tag_escape( $this->args['container'] ) . '>';
		}

		/* Allow developers to filter the breadcrumb trail HTML. */
		$breadcrumb = apply_filters( 'breadcrumb_trail', $breadcrumb, $this->args );

		if ( true === $this->args['echo'] )
			echo $breadcrumb;
		else
			return $breadcrumb;
	}

}

?>

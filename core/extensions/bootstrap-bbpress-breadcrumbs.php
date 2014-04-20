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
function bootstrap_bbpress_breadcrumb_trail( $args = array() ) {

	$breadcrumb = new Bootstrap_bbPress_Breadcrumb_Trail( $args );

	$breadcrumb->trail();
}

/**
 * Extends the Breadcrumb_Trail class to output twitter bootstrap compatible breadcrumbs.
 * Only use this if bootstrap is in use.  
 *
 * @access public
 */
class Bootstrap_bbPress_Breadcrumb_Trail extends Breadcrumb_Trail {

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
	
	/**
	 * Runs through the various bbPress conditional tags to check the current page being viewed.  Once 
	 * a condition is met, add items to the $items array.
	 *
	 * @since  0.6.0
	 * @access public
	 * @return void
	 */
	public function do_trail_items() {

		/* Add the network and site home links. */
		$this->do_network_home_link();
		$this->do_site_home_link();

		/* Get the forum post type object. */
		$post_type_object = get_post_type_object( bbp_get_forum_post_type() );

		/* If not viewing the forum root/archive page and a forum archive exists, add it. */
		if ( !empty( $post_type_object->has_archive ) && !bbp_is_forum_archive() && !is_singular( array( 'forum','topic','view','reply') ) )
			$this->items[] = '<a href="' . get_post_type_archive_link( bbp_get_forum_post_type() ) . '">' . bbp_get_forum_archive_title() . '</a>';

		/* If viewing the forum root/archive. */
		if ( bbp_is_forum_archive() ) {

			if ( true === $this->args['show_title'] )
				$this->items[] = bbp_get_forum_archive_title();

		}

		/* If viewing the topics archive. */
		elseif ( bbp_is_topic_archive() ) {

			if ( true === $this->args['show_title'] )
				$this->items[] = bbp_get_topic_archive_title();

		}

		/* If viewing a topic tag archive. */
		elseif ( bbp_is_topic_tag() ) {

			if ( true === $this->args['show_title'] )
				$this->items[] = bbp_get_topic_tag_name();

		}

		/* If viewing a topic tag edit page. */
		elseif ( bbp_is_topic_tag_edit() ) {

			$this->items[] = '<a href="' . bbp_get_topic_tag_link() . '">' . bbp_get_topic_tag_name() . '</a>';

			if ( true === $this->args['show_title'] )
				$this->items[] = __( 'Edit', 'breadcrumb-trail' );

		}

		/* If viewing a "view" page. */
		elseif ( is_singular( 'view' ) ) {

			if ( true === $this->args['show_title'] )
				$this->items[] = bbp_get_view_title();

		}

		/* If viewing a single topic page. */
		elseif ( is_singular( 'topic' ) ) {

			/* Get the queried topic. */
			$topic_id = get_queried_object_id();

			/* Get the parent items for the topic, which would be its forum (and possibly forum grandparents). */
			$this->do_post_parents( bbp_get_topic_forum_id( $topic_id ) );

			/* If viewing a split, merge, or edit topic page, show the link back to the topic.  Else, display topic title. */
			if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() )
				$this->items[] = '<a href="' . bbp_get_topic_permalink( $topic_id ) . '">' . bbp_get_topic_title( $topic_id ) . '</a>';

			elseif ( true === $this->args['show_title'] )
				$this->items[] = bbp_get_topic_title( $topic_id );

			/* If viewing a topic split page. */
			if ( bbp_is_topic_split() && true === $this->args['show_title'] )
				$this->items[] = __( 'Split', 'breadcrumb-trail' );

			/* If viewing a topic merge page. */
			elseif ( bbp_is_topic_merge() && true === $this->args['show_title'] )
				$this->items[] = __( 'Merge', 'breadcrumb-trail' );

			/* If viewing a topic edit page. */
			elseif ( bbp_is_topic_edit() && true === $this->args['show_title'] )
				$this->items[] = __( 'Edit', 'breadcrumb-trail' );
		}

		/* If viewing a single reply page. */
		elseif ( is_singular('reply') ) {

			/* Get the queried reply object ID. */
			$reply_id = get_queried_object_id();

			/* Get the parent items for the reply, which should be its topic. */
			$this->do_post_parents( bbp_get_reply_topic_id( $reply_id ) );

			/* If viewing a reply edit page, link back to the reply. Else, display the reply title. */
			if ( bbp_is_reply_edit() ) {
				$this->items[] = '<a href="' . bbp_get_reply_url( $reply_id ) . '">' . bbp_get_reply_title( $reply_id ) . '</a>';

				if ( true === $this->args['show_title'] )
					$this->items[] = __( 'Edit', 'breadcrumb-trail' );

			} elseif ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_reply_title( $reply_id );
			}

		}

		/* If viewing a single forum. */
		elseif ( bbp_is_single_forum() ) {

			/* Get the queried forum ID and its parent forum ID. */
			$forum_id = get_queried_object_id();
			$forum_parent_id = bbp_get_forum_parent_id( $forum_id );

			/* If the forum has a parent forum, get its parent(s). */
			$this->do_post_parents( $forum_parent_id );

			/* Add the forum title to the end of the trail. */
			if ( true === $this->args['show_title'] )
				$this->items[] = bbp_get_forum_title( $forum_id );
		}

		/* If viewing a user page or user edit page. */
		elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {

			if ( bbp_is_single_user_edit() ) {
				$this->items[] = '<a href="' . bbp_get_user_profile_url() . '">' . bbp_get_displayed_user_field( 'display_name' ) . '</a>';

				if ( true === $this->args['show_title'] )
					$this->items[] = __( 'Edit', 'breadcrumb-trail' );
			} elseif ( true === $this->args['show_title'] ) {
				$this->items[] = bbp_get_displayed_user_field( 'display_name' );
			}
		}

		/* Return the bbPress breadcrumb trail items. */
		$this->items = apply_filters( 'breadcrumb_trail_get_bbpress_items', $this->items, $this->args );
	}

}

?>

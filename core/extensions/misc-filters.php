<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Disable "Get the Image" auto feature image selection via image scan and attachment
 */
function filter_thumbnail_args( $args ) {

	$args['image_scan'] = false;

	$args['attachment'] = false;

	return $args;

}

/**
 * Filter permalink text in comments to just be a #
 */
function filter_permalink( $translated, $text, $domain ) {
    
	if ( is_admin() )
		return $translated;

    if ( $translated == 'Permalink')
    	$translated = '#';
    	
    return $translated;
    	
}

/**
 * Show password form instead of default password protected post excerpt text
 */
function excerpt_protected( $content ) {

    if ( post_password_required() )
        $content = get_the_password_form();

    return $content;

}

add_filter( 'the_excerpt', 'excerpt_protected' );


/**
 * Disable Sidebar if empty
 */
function my_one_column() {

    if ( ! maybe_bbpress() && ! maybe_woocommerce() && ! is_active_sidebar( 'primary' ) ) {

        add_filter( 'get_theme_layout', 'my_theme_layout_one_column' );

    } 

}

add_action( 'template_redirect', 'my_one_column' );

/**
 * Callback for setting layout to 1 column
 */
function my_theme_layout_one_column( $layout ) {

    return 'layout-1c';

}

/**
 * Remove sidebars if set to 1 column
 */
function my_disable_sidebars( $sidebars_widgets ) {

    if ( current_theme_supports( 'theme-layouts' ) && ! is_admin() ) {

        if ( 'layout-1c' == theme_layouts_get_layout() ) {
            $sidebars_widgets['primary'] = false;
            $sidebars_widgets['bbpress'] = false;
            $sidebars_widgets['woocommerce'] = false;
        }
    }

    return $sidebars_widgets;

}

add_filter( 'sidebars_widgets', 'my_disable_sidebars' );

/**
 * Adjust content width if viewing single column layout
 */
function set_single_column_content_width() {

    if ( has_post_layout( '1c') || has_user_layout('1c') ) {

        hybrid_set_content_width( 1140 );

    } 

}

add_action( 'the_post', 'set_single_column_content_width', 99 );

/**
 * Add the hentry class back into the post class to maintain hatom
 */
function add_hentry_class( $classes ) {

    $classes[] = 'hentry';

    return $classes;
    
}

add_filter( 'post_class', 'add_hentry_class' );

/**
 * Filer the main content hybrid attributes
 */
function filter_main_attr( $attr ) {

    $attr['id']       = 'main';
    $attr['class']    = 'main';

    return $attr;
}

add_filter( 'hybrid_attr_content', 'filter_main_attr', 10 );

/**
 * Filer the main content hybrid attributes
 */
function filter_author_attr( $attr ) {

    $attr['class'] = 'entry-author author vcard';

    return $attr;
}

add_filter( 'hybrid_attr_entry-author', 'filter_author_attr', 10 );

/**
 * Filer the main content hybrid attributes
 */
function filter_loop_meta_attr( $attr ) {

    $attr['class']    = 'loop-meta jumbotron';

    return $attr;
}

add_filter( 'hybrid_attr_loop-meta', 'filter_loop_meta_attr', 10 );


/**
 * Add 1 column layout class to tiny mce body
 */
function add_layout_to_tinymce_body_class( $init_array ) {

    if ( has_post_layout( '1c') || has_user_layout('1c') ) {

        $init_array['body_class'] = 'layout-1c';

    }

    return $init_array;

}

add_filter('tiny_mce_before_init', 'add_layout_to_tinymce_body_class');

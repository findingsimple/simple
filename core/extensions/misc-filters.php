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
 * Set default footer text
 */
function default_footer_text( $settings ) {

    /* Get theme-supported meta boxes for the settings page. */
    $supports = get_theme_support( 'hybrid-core-theme-settings' );

    /* If the current theme supports the footer meta box and shortcodes, add default footer settings. */
    if ( is_array( $supports[0] ) && in_array( 'footer', $supports[0] ) && current_theme_supports( 'hybrid-core-shortcodes' ) ) {

        $settings['footer_insert'] = '<p class="copyright">' . __( 'Copyright &#169; [the-year] [site-link].', 'hybrid-core' ) . '</p>' . "\n\n";
 
    }
        
    return $settings;
    
}

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
 * Set FS logo
 */
function set_fs_logo( $title ) {

    /* If viewing the front page of the site, use an <h1> tag.  Otherwise, use a <div> tag. */
    $tag = ( is_front_page() ) ? 'h1' : 'div';

    /* Get the site title.  If it's not empty, wrap it with the appropriate HTML. */
    if ( $title = get_bloginfo( 'name' ) )
        $title = sprintf( '<%1$s id="site-title"><a href="%2$s" title="%3$s" rel="home">%4$s</a></%1$s>', tag_escape( $tag ), home_url(), esc_attr( $title ), '<span>finding</span>simple' );

    return $title;
}

add_filter( 'simple_site_title', 'set_fs_logo', 99 );

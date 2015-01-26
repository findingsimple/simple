<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Initialise
 */
if ( is_version( '3.9' ) ) {

    add_action( 'init', 'bootstrap_editor_styles' );

}

/**
 * Apply appropriate hooks and filters to add the bootstrap style
 */
function bootstrap_editor_styles() {

    add_filter( 'mce_buttons_2', 'bootstrap_add_styles_dropdown' ); 

    add_filter( 'tiny_mce_before_init', 'bootstrap_add_styles_to_dropdown' );
    
}  

/**
 * Force add the "Styles" drop-down
 */ 
function bootstrap_add_styles_dropdown( $buttons ) {

    if ( ! in_array( 'styleselect', $buttons ) )
        array_unshift( $buttons, 'styleselect' );

    return $buttons;

}

/**
 * Add styles/classes to the "Styles" drop-down
 */ 
function bootstrap_add_styles_to_dropdown( $settings ) {

    $style_formats = array(
        array(
            'title' => __( 'Bootstrap', hybrid_get_parent_textdomain() ),
            'items' => array(
                array(
                    'title' => 'Lead',
                    'selector' => 'p',
                    'classes' => 'lead',
                ),
                 array(
                    'title' => 'Small',
                    'inline' => 'small'
                ),
                array(
                    'title' => __( 'Badge', hybrid_get_parent_textdomain() ),
                    'inline' => 'span',
                    'classes' => 'badge'
                ),
                array(
                    'title' => __( 'Blockquote', hybrid_get_parent_textdomain() ),
                    'items' => array(
                        array(
                            'title' => __( 'Blockquote Footer', hybrid_get_parent_textdomain() ),
                            'block' => 'footer'
                        ),
                        array(
                            'title' => __( 'Blockquote Reverse', hybrid_get_parent_textdomain() ),
                            'selector' => 'blockquote',
                            'classes' => 'blockquote-reverse'
                        ),
                    ),
                ),
                array(
                    'title' => __( 'Lists', hybrid_get_parent_textdomain() ),
                    'items' => array(
                        array(
                            'title' => __( 'List Unstyled', hybrid_get_parent_textdomain() ),
                            'selector' => 'ul',
                            'classes' => 'list-unstyled'
                        ),
                        array(
                            'title' => __( 'List Inline', hybrid_get_parent_textdomain() ),
                            'selector' => 'ul',
                            'classes' => 'list-inline'
                        ),
                    ),
                ),
                array(
                    'title' => __( 'Tables', hybrid_get_parent_textdomain() ),
                    'items' => array(
                		array(
                            'title' => __( 'Table', hybrid_get_parent_textdomain() ),
                            'selector' => 'table',
                            'classes' => 'table'
                        ),
                		array(
                            'title' => __( 'Table Striped', hybrid_get_parent_textdomain() ),
                            'selector' => '.table',
                            'classes' => 'table-striped'
                        ),
                 		array(
                            'title' => __( 'Table Bordered', hybrid_get_parent_textdomain() ),
                            'selector' => '.table',
                            'classes' => 'table-bordered'
                        ),
                  		array(
                            'title' => __( 'Table Hover', hybrid_get_parent_textdomain() ),
                            'selector' => '.table',
                            'classes' => 'table-hover'
                        ),
                 		array(
                            'title' => __( 'Table Condensed', hybrid_get_parent_textdomain() ),
                            'selector' => '.table',
                            'classes' => 'table-condensed'
                        ),
                    ),
                ),
                array(
                    'title' => __( 'Buttons', hybrid_get_parent_textdomain() ),
                    'items' => array(
                		array(
                            'title' => __( 'Button', hybrid_get_parent_textdomain() ),
                            'selector' => 'a',
                            'classes' => 'btn btn-default',
                        ),
                 		array(
                            'title' => __( 'Button Color - Primary', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-primary',
                        ),
                 		array(
                            'title' => __( 'Button Color - Success', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-success'
                        ),
                 		array(
                            'title' => __( 'Button Color - Info', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-info'
                        ),
                 		array(
                            'title' => __( 'Button Color - Warning', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-warning'
                        ),
                 		array(
                            'title' => __( 'Button Color - Danger', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-danger'
                        ),
                 		array(
                            'title' => __( 'Button Color - Link', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-link'
                        ),
                 		array(
                            'title' => __( 'Button Size - Large', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-lg'
                        ),
                 		array(
                            'title' => __( 'Button Size - Small', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-sm'
                        ),
                 		array(
                            'title' => __( 'Button Size - Extra Small', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-xs'
                        ),
                 		array(
                            'title' => __( 'Button - Block Level', hybrid_get_parent_textdomain() ),
                            'selector' => '.btn',
                            'classes' => 'btn-block'
                        ),
                    ),
                ),
                array(
                    'title' => __( 'Contextual Color', hybrid_get_parent_textdomain() ),
                    'items' => array(
                        array(
                            'title' => __( 'Contextual Color - Muted', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'text-muted'
                        ),
                        array(
                            'title' => __( 'Contextual Color - Primary', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'text-primary'
                        ),
                        array(
                            'title' => __( 'Contextual Color - Success', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'text-success'
                        ),
                        array(
                            'title' => __( 'Contextual Color - Info', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'text-info'
                        ),
                        array(
                            'title' => __( 'Contextual Color - Warning', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'text-warning'
                        ),
                        array(
                            'title' => __( 'Contextual Color - Danger', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'text-danger'
                        ),
                    ),
                ),
                array(
                    'title' => __( 'Contextual BG', hybrid_get_parent_textdomain() ),
                    'items' => array(
                        array(
                            'title' => __( 'Contextual BG - Primary', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'bg-primary'
                        ),
                        array(
                            'title' => __( 'Contextual BG - Success', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'bg-success'
                        ),
                        array(
                            'title' => __( 'Contextual BG - Info', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'bg-info'
                        ),
                        array(
                            'title' => __( 'Contextual BG - Warning', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'bg-warning'
                        ),
                        array(
                            'title' => __( 'Contextual BG - Danger', hybrid_get_parent_textdomain() ),
                            'selector' => 'p',
                            'classes' => 'bg-danger'
                        ),
                    ),
                ),
                array(
                    'title' => __( 'Labels', hybrid_get_parent_textdomain() ),
                    'items' => array(
                      	array(
                            'title' => __( 'Label', hybrid_get_parent_textdomain() ),
                            'inline' => 'span',
                            'classes' => 'label label-default'
                        ),
                        array(
                            'title' => __( 'Label Color - Primary', hybrid_get_parent_textdomain() ),
                            'selector' => '.label',
                            'classes' => 'label-primary'
                        ),
                        array(
                            'title' => __( 'Label Color - Success', hybrid_get_parent_textdomain() ),
                            'selector' => '.label',
                            'classes' => 'label-success'
                        ),
                        array(
                            'title' => __( 'Label Color - Info', hybrid_get_parent_textdomain() ),
                            'selector' => '.label',
                            'classes' => 'label-info'
                        ),
                        array(
                            'title' => __( 'Label Color - Warning', hybrid_get_parent_textdomain() ),
                            'selector' => '.label',
                            'classes' => 'label-warning'
                        ),
                        array(
                            'title' => __( 'Label Color - Danger', hybrid_get_parent_textdomain() ),
                            'selector' => '.label',
                            'classes' => 'label-danger'
                        ),
                    ),
                ),
                array(
                    'title' => __( 'Alerts', hybrid_get_parent_textdomain() ),
                    'items' => array(
                        array(
                            'title' => __( 'Alert - Success', hybrid_get_parent_textdomain() ),
                            'block' => 'div',
                            'classes' => 'alert alert-success',
                            'wrapper' => true
                        ),
                        array(
                            'title' => __( 'Alert - Info', hybrid_get_parent_textdomain() ),
                            'block' => 'div',
                            'classes' => 'alert alert-info',
                            'wrapper' => true
                        ),
                        array(
                            'title' => __( 'Alert - Warning', hybrid_get_parent_textdomain() ),
                            'block' => 'div',
                            'classes' => 'alert alert-warning',
                            'wrapper' => true
                        ),
                        array(
                            'title' => __( 'Alert - Danger', hybrid_get_parent_textdomain() ),
                            'block' => 'div',
                            'classes' => 'alert alert-danger',
                            'wrapper' => true
                        ),
                        array(
                            'title' => __( 'Alert Link', hybrid_get_parent_textdomain() ),
                            'selector' => 'a',
                            'classes' => 'alert-link'
                        ),
                    ),
                ),
                array(
                    'title' => __( 'Wells', hybrid_get_parent_textdomain() ),
                    'items' => array(
                      	array(
                            'title' => __( 'Well', hybrid_get_parent_textdomain() ),
                            'block' => 'div',
                            'classes' => 'well',
                            'wrapper' => true
                        ),
                        array(
                            'title' => __( 'Well Size - Large', hybrid_get_parent_textdomain() ),
                            'selector' => '.well',
                            'classes' => 'well-lg'
                        ),
                        array(
                            'title' => __( 'Well Size - Small', hybrid_get_parent_textdomain() ),
                            'selector' => '.well',
                            'classes' => 'well-sm'
                        )
                    )
                )
            )
        )
    );

    /**
     * Merge old & new styles
     */
    $settings['style_formats_merge'] = true;

    /**
     *  Add new styles
     */
    $settings['style_formats'] = json_encode( $style_formats );

    /**
     * Return updates settings
     */
    return $settings;

}
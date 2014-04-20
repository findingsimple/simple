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
add_action( 'init', 'bootstrap_editor_styles' );


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
            'title' => 'Lead',
            'selector' => 'p',
            'classes' => 'lead',
        ),
         array(
            'title' => 'Small',
            'inline' => 'small'
        ),
        array(
            'title' => 'Blockquote Footer',
            'block' => 'footer'
        ),
 		array(
            'title' => 'Blockquote Reverse',
            'selector' => 'blockquote',
            'classes' => 'blockquote-reverse'
        ),
		array(
            'title' => 'List Unstyled',
            'selector' => 'ul',
            'classes' => 'list-unstyled'
        ),
 		array(
            'title' => 'List Inline',
            'selector' => 'ul',
            'classes' => 'list-inline'
        ),
		array(
            'title' => 'Table',
            'selector' => 'table',
            'classes' => 'table'
        ),
		array(
            'title' => 'Table Striped',
            'selector' => 'table',
            'classes' => 'table-striped'
        ),
 		array(
            'title' => 'Table Bordered',
            'selector' => 'table',
            'classes' => 'table-bordered'
        ),
  		array(
            'title' => 'Table Hover',
            'selector' => 'table',
            'classes' => 'table-hover'
        ),
 		array(
            'title' => 'Table Condensed',
            'selector' => 'table',
            'classes' => 'table-condensed'
        ),
		array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'btn btn-default',
        ),
 		array(
            'title' => 'Button Color - Primary',
            'selector' => 'a',
            'classes' => 'btn-primary',
        ),
 		array(
            'title' => 'Button Color - Success',
            'selector' => 'a',
            'classes' => 'btn-success'
        ),
 		array(
            'title' => 'Button Color - Info',
            'selector' => 'a',
            'classes' => 'btn-info'
        ),
 		array(
            'title' => 'Button Color - Warning',
            'selector' => 'a',
            'classes' => 'btn-warning'
        ),
 		array(
            'title' => 'Button Color - Danger',
            'selector' => 'a',
            'classes' => 'btn-danger'
        ),
 		array(
            'title' => 'Button Color - Link',
            'selector' => 'a',
            'classes' => 'btn-link'
        ),
 		array(
            'title' => 'Button Size - Large',
            'selector' => 'a',
            'classes' => 'btn-lg'
        ),
 		array(
            'title' => 'Button Size - Small',
            'selector' => 'a',
            'classes' => 'btn-sm'
        ),
 		array(
            'title' => 'Button Size - Extra Small',
            'selector' => 'a',
            'classes' => 'btn-xs'
        ),
 		array(
            'title' => 'Button - Block Level',
            'selector' => 'a',
            'classes' => 'btn-block'
        ),
 		array(
            'title' => 'Contextual Color - Muted',
            'selector' => 'p',
            'classes' => 'text-muted'
        ),
        array(
            'title' => 'Contextual Color - Primary',
            'selector' => 'p',
            'classes' => 'text-primary'
        ),
        array(
            'title' => 'Contextual Color - Success',
            'selector' => 'p',
            'classes' => 'text-success'
        ),
        array(
            'title' => 'Contextual Color - Info',
            'selector' => 'p',
            'classes' => 'text-info'
        ),
        array(
            'title' => 'Contextual Color - Warning',
            'selector' => 'p',
            'classes' => 'text-warning'
        ),
        array(
            'title' => 'Contextual Color - Danger',
            'selector' => 'p',
            'classes' => 'text-danger'
        ),
        array(
            'title' => 'Contextual BG - Primary',
            'selector' => 'p',
            'classes' => 'bg-primary'
        ),
        array(
            'title' => 'Contextual BG - Success',
            'selector' => 'p',
            'classes' => 'bg-success'
        ),
        array(
            'title' => 'Contextual BG - Info',
            'selector' => 'p',
            'classes' => 'bg-info'
        ),
        array(
            'title' => 'Contextual BG - Warning',
            'selector' => 'p',
            'classes' => 'bg-warning'
        ),
        array(
            'title' => 'Contextual BG - Danger',
            'selector' => 'p',
            'classes' => 'bg-danger'
        ),
      	array(
            'title' => 'Label',
            'inline' => 'span',
            'classes' => 'label label-default'
        ),
        array(
            'title' => 'Label Color - Primary',
            'selector' => 'span',
            'classes' => 'label-primary'
        ),
        array(
            'title' => 'Label Color - Success',
            'selector' => 'span',
            'classes' => 'label-success'
        ),
        array(
            'title' => 'Label Color - Info',
            'selector' => 'span',
            'classes' => 'label-info'
        ),
        array(
            'title' => 'Label Color - Warning',
            'selector' => 'span',
            'classes' => 'label-warning'
        ),
        array(
            'title' => 'Label Color - Danger',
            'selector' => 'span',
            'classes' => 'label-danger'
        ),
     	array(
            'title' => 'Badge',
            'inline' => 'span',
            'classes' => 'badge'
        ),
       array(
            'title' => 'Alert - Success',
            'block' => 'div',
            'classes' => 'alert alert-success',
            'wrapper' => true
        ),
        array(
            'title' => 'Alert - Info',
            'block' => 'div',
            'classes' => 'alert alert-info',
            'wrapper' => true
        ),
        array(
            'title' => 'Alert - Warning',
            'block' => 'div',
            'classes' => 'alert alert-warning',
            'wrapper' => true
        ),
        array(
            'title' => 'Alert - Danger',
            'block' => 'div',
            'classes' => 'alert alert-danger',
            'wrapper' => true
        ),
        array(
            'title' => 'Alert Link',
            'selector' => 'a',
            'classes' => 'alert-link'
        ),
      	array(
            'title' => 'Well',
            'block' => 'div',
            'classes' => 'well',
            'wrapper' => true
        ),
        array(
            'title' => 'Well Size - Large',
            'selector' => 'div',
            'classes' => 'well-lg'
        ),
        array(
            'title' => 'Well Size - Small',
            'selector' => 'div',
            'classes' => 'well-sm'
        ),
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}
<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Check of Gravity forms is Active
 */
if ( class_exists('GFForms') ) {

	add_action("gform_field_css_class", "add_form_group_class", 10, 3);
	add_filter("gform_field_content", "add_form_control_class", 10, 5);
	add_filter("gform_submit_button", "form_submit_button", 10, 2);

}



/**
 * Add form-group class to field wrappers
 */
function add_form_group_class( $classes, $field, $form ){

    if ( !is_admin() )
        $classes .= " form-group";

    return $classes;

}

/**
 * Add the bootstrap form-control class to inputs
 */
function add_form_control_class( $field_content, $field, $value, $something, $form_id ){
	
    if ( !is_admin() ) {

       	$dom = new DOMDocument();

        @$dom->loadHTML($field_content);

        $x = new DOMXPath($dom);

        foreach($x->query("//input[@type='text']") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' form-control';
            $node->setAttribute( "class" , $classes );
        }

        foreach($x->query("//input[@type='email']") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' form-control';
            $node->setAttribute( "class" , $classes );
        }

        foreach($x->query("//input[@type='tel']") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' form-control';
            $node->setAttribute( "class" , $classes );
        }

       foreach($x->query("//input[@type='number']") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' form-control';
            $node->setAttribute( "class" , $classes );
        }

       foreach($x->query("//input[@type='url']") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' form-control';
            $node->setAttribute( "class" , $classes );
        }

        foreach($x->query("//textarea") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' form-control';
            $node->setAttribute( "class" , $classes );
        }

        foreach($x->query("//select") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' form-control';
            $node->setAttribute( "class" , $classes );
        }

        $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

        return $newHtml;

    }

    return $field_content;

}

/**
 * Filter gravity forms button classes
 */
function form_submit_button($button, $form){

    $class = '';

    return "<button class='btn btn-primary " . $class . "' id='gform_submit_button_{$form["id"]}'>{$form["button"]["text"]}</button>";
    
}

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

    add_action("init", "disable_gravity_forms_css" );
    add_action("gform_field_css_class", "add_form_group_class", 10, 3);
    add_filter("gform_field_content", "add_form_control_class", 10, 5);
    add_filter("gform_submit_button", "form_submit_button", 10, 2);
    add_filter("gform_next_button", "form_previous_next_button", 10, 2);
    add_filter("gform_previous_button", "form_previous_next_button", 10, 2);
    add_filter("gform_validation_message", "add_form_validation_class", 10, 2);
    add_filter("gform_confirmation", "add_form_confirmation_class", 10, 4);

}

/**
 * Set option to disable gravity forms styles
 */
function disable_gravity_forms_css() {
    
    if  ( ! get_option ( 'rg_gforms_disable_css' ) ) {
        update_option( 'rg_gforms_disable_css', TRUE );
    }

}

/**
 * Add form-group class to field wrappers
 */
function add_form_group_class( $classes, $field, $form ){

    if ( !is_admin() ) {
        $classes .= " form-group";
        $classes = str_replace("gfield_error", "has-error", $classes);
    }

    return $classes;

}

/**
 * Add the bootstrap form-control class to inputs
 */
function add_form_control_class( $field_content, $field, $value, $something, $form_id ){
    
    if ( !is_admin() ) {

        $dom = new DOMDocument();

        @$dom->loadHTML(mb_convert_encoding($field_content, 'HTML-ENTITIES', 'UTF-8'));

        $x = new DOMXPath($dom);

        foreach($x->query("//label") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' control-label';
            $node->setAttribute( "class" , $classes );
        }

        foreach($x->query("//*[contains(@class, 'gfield_description')]") as $node) {   
            $classes = $node->getAttribute( "class" );
            $classes .= ' help-block';
            $node->setAttribute( "class" , $classes );
        }

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

        foreach($x->query("//input[@type='password']") as $node) {   
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

        foreach($x->query("//*[@class='gfield_radio']") as $node) { 
            if ($node->hasChildNodes()) {
                foreach ($node->childNodes as $nodeChild) {
                    $classes = $nodeChild->getAttribute( "class" );
                    $classes .= ' radio';
                    $nodeChild->setAttribute( "class" , $classes );
                    $input = $nodeChild->firstChild;
                    $nodeChild->removeChild($input);
                    foreach($nodeChild->childNodes as $label) { 
                        $label->insertBefore( $input, $label->firstChild );
                    }
                }
            }
        }

        foreach($x->query("//*[@class='gfield_checkbox']") as $node) {   
            if ($node->hasChildNodes()) {
                foreach ($node->childNodes as $nodeChild) {
                    $classes = $nodeChild->getAttribute( "class" );
                    $classes .= ' checkbox';
                    $nodeChild->setAttribute( "class" , $classes );
                    $input = $nodeChild->firstChild;
                    $nodeChild->removeChild($input);
                    foreach($nodeChild->childNodes as $label) { 
                        $label->insertBefore( $input, $label->firstChild );
                    }
                }
            }
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

/**
 * Filter gravity forms button classes
 */
function form_previous_next_button($button, $form){

    if ( !is_admin() ) {

        $dom = new DOMDocument();

        @$dom->loadHTML(mb_convert_encoding($button, 'HTML-ENTITIES', 'UTF-8'));

        $x = new DOMXPath($dom);

        $classname="gform_confirmation_message";

        foreach($x->query("//*[contains(@class, 'button')]") as $node) { 
            $classes = $node->getAttribute( "class" );
            $classes .= ' btn btn-info';
            $node->setAttribute( "class" , $classes );
        }

        $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

        return $newHtml;

    }

    return $button;
    
}


/**
 * Add the bootstrap alert class to validation error message
 */
function add_form_validation_class( $validation_message, $form ){

   if ( !is_admin() ) {

        $dom = new DOMDocument();

        @$dom->loadHTML(mb_convert_encoding($validation_message, 'HTML-ENTITIES', 'UTF-8'));

        $x = new DOMXPath($dom);

        $classname="validation_error";

        foreach($x->query("//div[contains(@class, '$classname')]") as $node) { 
            $classes = $node->getAttribute( "class" );
            $classes .= ' alert alert-danger';
            $node->setAttribute( "class" , $classes );
        }

        $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

        return $newHtml;

    }

    return $validation_message;

}

/**
 * Add the bootstrap alert class to the confirmation message
 */
function add_form_confirmation_class( $confirmation, $form, $lead, $ajax ){

    if ( !is_admin() ) {

        $dom = new DOMDocument();

        @$dom->loadHTML(mb_convert_encoding($confirmation, 'HTML-ENTITIES', 'UTF-8'));

        $x = new DOMXPath($dom);

        $classname="gform_confirmation_message";

        foreach($x->query("//div[contains(@class, '$classname')]") as $node) { 
            $classes = $node->getAttribute( "class" );
            $classes .= ' alert alert-success';
            $node->setAttribute( "class" , $classes );
        }

        $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

        return $newHtml;

    }

    return $confirmation;

}
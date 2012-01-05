<?php
/**
 * Shortcode Columns - Adds shortcodes for inserting columns into content areas.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package ShortcodeColumns
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2011, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
/* ============= Two Columns ============= */

function simple_shortcode_twocol_one($atts, $content = null) {
   return '<div class="twocol-one">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'twocol_one', 'simple_shortcode_twocol_one' );

function simple_shortcode_twocol_one_last($atts, $content = null) {
   return '<div class="twocol-one last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'twocol_one_last', 'simple_shortcode_twocol_one_last' );


/* ============= Three Columns ============= */

function simple_shortcode_threecol_one($atts, $content = null) {
   return '<div class="threecol-one">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'threecol_one', 'simple_shortcode_threecol_one' );

function simple_shortcode_threecol_one_last($atts, $content = null) {
   return '<div class="threecol-one last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'threecol_one_last', 'simple_shortcode_threecol_one_last' );

function simple_shortcode_threecol_two($atts, $content = null) {
   return '<div class="threecol-two">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'threecol_two', 'simple_shortcode_threecol_two' );

function simple_shortcode_threecol_two_last($atts, $content = null) {
   return '<div class="threecol-two last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'threecol_two_last', 'simple_shortcode_threecol_two_last' );

/* ============= Four Columns ============= */

function simple_shortcode_fourcol_one($atts, $content = null) {
   return '<div class="fourcol-one">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_one', 'simple_shortcode_fourcol_one' );

function simple_shortcode_fourcol_one_last($atts, $content = null) {
   return '<div class="fourcol-one last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_one_last', 'simple_shortcode_fourcol_one_last' );

function simple_shortcode_fourcol_two($atts, $content = null) {
   return '<div class="fourcol-two">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_two', 'simple_shortcode_fourcol_two' );

function simple_shortcode_fourcol_two_last($atts, $content = null) {
   return '<div class="fourcol-two last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_two_last', 'simple_shortcode_fourcol_two_last' );

function simple_shortcode_fourcol_three($atts, $content = null) {
   return '<div class="fourcol-three">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_three', 'simple_shortcode_fourcol_three' );

function simple_shortcode_fourcol_three_last($atts, $content = null) {
   return '<div class="fourcol-three last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fourcol_three_last', 'simple_shortcode_fourcol_three_last' );

/* ============= Five Columns ============= */

function simple_shortcode_fivecol_one($atts, $content = null) {
   return '<div class="fivecol-one">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_one', 'simple_shortcode_fivecol_one' );

function simple_shortcode_fivecol_one_last($atts, $content = null) {
   return '<div class="fivecol-one last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_one_last', 'simple_shortcode_fivecol_one_last' );

function simple_shortcode_fivecol_two($atts, $content = null) {
   return '<div class="fivecol-two">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_two', 'simple_shortcode_fivecol_two' );

function simple_shortcode_fivecol_two_last($atts, $content = null) {
   return '<div class="fivecol-two last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_two_last', 'simple_shortcode_fivecol_two_last' );

function simple_shortcode_fivecol_three($atts, $content = null) {
   return '<div class="fivecol-three">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_three', 'simple_shortcode_fivecol_three' );

function simple_shortcode_fivecol_three_last($atts, $content = null) {
   return '<div class="fivecol-three last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_three_last', 'simple_shortcode_fivecol_three_last' );

function simple_shortcode_fivecol_four($atts, $content = null) {
   return '<div class="fivecol-four">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_four', 'simple_shortcode_fivecol_four' );

function simple_shortcode_fivecol_four_last($atts, $content = null) {
   return '<div class="fivecol-four last">' . simple_remove_wpautop($content) . '</div>';
}
add_shortcode( 'fivecol_four_last', 'simple_shortcode_fivecol_four_last' );

 
 ?>
<?php
/**
 * Shortcode Intro - Adds shortcode for inserting custom styling for intro paragraphs into content areas.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package ShortcodeIntro
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2011, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
function intro_shortcode( $atts, $content = null ) {
   return '<p class="intro">' . simple_remove_wpautop($content) . '</p>';
}
add_shortcode('intro', 'intro_shortcode');
 
 ?>
<?php
/**
 * Shortcode Dropcaps - Adds shortcodes for inserting drop capitals into content areas.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package ShortcodeDropcaps
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2011, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
 function dropcap_shortcode( $atts, $content = null ) {
   return '<span class="dropcap">' . simple_remove_wpautop($content) . '</span>';
}
add_shortcode('dropcap', 'dropcap_shortcode');
 
 ?>
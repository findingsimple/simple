<?php 
/**
 * Timer - Adds WP number of queries and timer info to footer of page
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package Time
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2011, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Get action/filter hook prefix. */
$prefix = hybrid_get_prefix();

function timer_init() {
?>
<!-- <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?>  seconds. -->
<?php
}

add_action('wp_footer','timer_init', 9999 );

?>
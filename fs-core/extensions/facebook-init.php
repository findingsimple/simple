<?php 
/**
 * Facebook Init - Adds Facebook Async JS to Footer.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package FacebookInit
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2011, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Get action/filter hook prefix. */
$prefix = hybrid_get_prefix();

function facebook_init() {
$appID = ''; ?>
<script>
window.fbAsyncInit = function() {
	FB.init({appId: '<?php echo $appID; ?>', status: true, cookie: true, xfbml: true});};
	(function() {
		var e = document.createElement('script'); e.async = true;
		e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
		document.getElementById('fb-root').appendChild(e);
}());
</script>
<?php 
}

add_action('wp_footer','facebook_init');

function facebook_init_div() { ?>
<div id="fb-root"></div>
<?php }

add_action( "{$prefix}_open_body", 'facebook_init_div' );

function facebook_schema($attr) {
	$attr .= " xmlns:fb=\"http://www.facebook.com/2008/fbml\" "; 
	return $attr;
}
add_filter('language_attributes', 'facebook_schema');


?>
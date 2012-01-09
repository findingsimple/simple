<?php 
/**
 * FindingSimple Settings Page
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package FindingSimpleSettingsPage
 * @version 0.0.1
 * @author Jason Conroy <jason@findingsimple.com>
 * @copyright Copyright (c) 2008 - 2011, Jason Conroy
 * @link http://findingsimple.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

add_action( 'admin_menu', 'fs_theme_admin_setup' );

function fs_theme_admin_setup() {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'fs_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'fs_theme_validate_settings' );
}

/* Adds custom meta boxes to the theme settings page. */
function fs_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'osul-theme-meta-box',			// Name/ID
		__( 'FindingSimple Settings', hybrid_get_textdomain() ),	// Label
		'fs_theme_meta_box',			// Callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'normal',					// Which meta box holder?
		'high'					// High/low within the meta box holder
	);

	/* Add additional add_meta_box() calls here. */
}

/* Function for displaying the meta box. */
function fs_theme_meta_box() { ?>

	<table class="form-table">
		<!-- Add custom form elements below here. -->

		<!-- Text input box -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'fs_casestudies' ); ?>"><?php _e( 'Case Studies:', hybrid_get_textdomain() ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'fs_casestudies' ); ?>" name="<?php echo hybrid_settings_field_name( 'fs_casestudies' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'fs_casestudies' ) ); ?>" /></p>
			</td>
		</tr> 

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
}

/* Validates theme settings. */
function fs_theme_validate_settings( $input ) {

	/* Validate and/or sanitize the text input. */
	$input['fs_casestudies'] = wp_filter_nohtml_kses( $input['fs_casestudies'] );

	/* Return the array of theme settings. */
	return $input;
}

?>
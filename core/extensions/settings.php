<?php 

/**
 * Additional Theme Settings
 */
function additional_theme_settings() {
	
	$prefix = hybrid_get_prefix();
	$domain = hybrid_get_parent_textdomain();
	
	add_settings_section(
		"{$prefix}-theme-setting",
		'Frontpage',
		'theme_banner_settings',
		'appearance_page_theme-settings'
	);

}

add_action('admin_menu','additional_theme_settings');

/**
 * Homepage banner settings
 */
function theme_banner_settings() {

	?>	

	<table class="form-table">

	<tr>
		<th>
			<label for="<?php echo hybrid_settings_field_id( 'banner-headline' ); ?>"><?php _e('Banner Headline:',hybrid_get_parent_textdomain()); ?></label>
		</th>
		<td>
			<p><textarea id="<?php echo hybrid_settings_field_id( 'banner-headline' ); ?>" name="<?php echo hybrid_settings_field_name( 'banner-headline' ); ?>" cols="60" rows="5" style="width: 98%;"><?php echo stripslashes( hybrid_get_setting( 'banner-headline' ) ); ?></textarea></p>
			<p><label for="<?php echo hybrid_settings_field_id( 'banner-headline' ); ?>"><?php _e('Headline for the Home/Front Page Banner Area',hybrid_get_parent_textdomain()); ?></label></p>
		</td>
	</tr>
	
	<tr>
		<th>
			<label for="<?php echo hybrid_settings_field_id( 'banner-subtext' ); ?>"><?php _e('Banner Subtext:',hybrid_get_parent_textdomain()); ?></label>
		</th>
		<td>
			<p><textarea id="<?php echo hybrid_settings_field_id( 'banner-subtext' ); ?>" name="<?php echo hybrid_settings_field_name( 'banner-subtext' ); ?>" cols="60" rows="5" style="width: 98%;"><?php echo stripslashes( hybrid_get_setting( 'banner-subtext' ) ); ?></textarea></p>
			<p><label for="<?php echo hybrid_settings_field_id( 'banner-subtext' ); ?>"><?php _e('Subtext for the Home/Front Page Banner Area',hybrid_get_parent_textdomain()); ?></label></p>
		</td>
	</tr>
	
	</table><!-- .form-table -->
	<?php
}

?>
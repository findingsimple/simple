<?php 

/**
 * Additional Theme Settings
 */
function additional_theme_settings() {
	
	$prefix = hybrid_get_prefix();
	$domain = hybrid_get_textdomain();
	
	add_meta_box(
		"{$prefix}-theme-meta-box", 
		sprintf( __( '%1$s Settings', $domain ), 'Theme' ), 
		'theme_meta_box', 
		'appearance_page_theme-settings', 
		'normal', 
		'default' 
	);

}

add_action('admin_menu','additional_theme_settings');

function theme_meta_box() {

	?>	

	<table class="form-table">

	<tr>
		<th>
			<label for="<?php echo hybrid_settings_field_id( 'banner-headline' ); ?>"><?php _e('Front Page Banner Headline:',hybrid_get_textdomain()); ?></label>
		</th>
		<td>
			<p><textarea id="<?php echo hybrid_settings_field_id( 'banner-headline' ); ?>" name="<?php echo hybrid_settings_field_name( 'banner-headline' ); ?>" cols="60" rows="5" style="width: 98%;"><?php echo stripslashes( hybrid_get_setting( 'banner-headline' ) ); ?></textarea></p>
			<p><label for="<?php echo hybrid_settings_field_id( 'banner-headline' ); ?>"><?php _e('Headline for the Home/Front Page Banner Area',hybrid_get_textdomain()); ?></label></p>
		</td>
	</tr>
	
	<tr>
		<th>
			<label for="<?php echo hybrid_settings_field_id( 'banner-subtext' ); ?>"><?php _e('Front Page Banner Subtext:',hybrid_get_textdomain()); ?></label>
		</th>
		<td>
			<p><textarea id="<?php echo hybrid_settings_field_id( 'banner-subtext' ); ?>" name="<?php echo hybrid_settings_field_name( 'banner-subtext' ); ?>" cols="60" rows="5" style="width: 98%;"><?php echo stripslashes( hybrid_get_setting( 'banner-subtext' ) ); ?></textarea></p>
			<p><label for="<?php echo hybrid_settings_field_id( 'banner-subtext' ); ?>"><?php _e('Subtext for the Home/Front Page Banner Area',hybrid_get_textdomain()); ?></label></p>
		</td>
	</tr>
	
	</table><!-- .form-table -->
	<?php
}

?>
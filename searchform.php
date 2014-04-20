<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

				<form method="get" class="search-form" role="search" action="<?php echo trailingslashit( home_url() ); ?>">
					<div class="form-group">
						<input class="search-text form-control search-query" type="search" name="s" value="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else esc_attr_e( 'Search this site...', hybrid_get_parent_textdomain() ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
						<button class="search-submit btn btn-default" type="submit"><?php esc_attr_e( 'Search', hybrid_get_parent_textdomain() ); ?></button>
					</div>
				</form><!-- .search-form -->
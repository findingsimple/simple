<?php 

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

if ( ( is_front_page() && is_paged() ) || ( !is_front_page() )  ) { ?>
<div class="breadcrumb-bar">
	<nav class="container">

	<?php

	if ( maybe_bbpress() ) {
	
		bootstrap_bbpress_breadcrumb_trail();

	} else {

		bootstrap_breadcrumb_trail();

	} 

	?>

	</nav>
</div>
<?php }

?>
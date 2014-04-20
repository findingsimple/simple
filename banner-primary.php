<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

$headline = ( ! hybrid_get_setting( 'banner-headline' ) ) ? get_bloginfo('name') : hybrid_get_setting( 'banner-headline' );

$subtext = ( ! hybrid_get_setting( 'banner-subtext' ) ) ? get_bloginfo('description')  : hybrid_get_setting( 'banner-subtext' ) ;

?>
<div class="banner jumbotron" role="banner">

	<div class="container">

  		<h1><?php echo $headline; ?></h1>

  		<p><?php echo $subtext; ?></p> 

	</div><!-- .container -->

</div><!-- .banner -->
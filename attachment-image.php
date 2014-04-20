<?php 
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Rediect to attachment file - rarely do I see people use the attachment pages properly
 */
if ( have_posts() ) { 
    the_post(); 
    $image_url = wp_get_attachment_url();
}

header( 'Location: ' . $image_url );

?>
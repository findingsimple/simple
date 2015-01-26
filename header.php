<?php
/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js lt-ie9 lt-ie8 ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js lt-ie9 ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/img/favicon.ico'; ?>" />
<script type="text/javascript" src="//use.typekit.net/wrz4rtj.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php wp_head(); // wp_head ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<header class="menu-container navbar navbar-default" <?php hybrid_attr( 'header' ); ?>>

		<div class="container">

			<div class="navbar-header">

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div id="branding" class="navbar-brand">
					<?php hybrid_site_title(); ?> 
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->

			</div><!-- .navbar-header -->
		
			<?php get_template_part( 'menu', 'primary' ); /* Loads the menu-primary.php template */ ?>

		</div><!-- .container -->

	</header><!-- #header -->

	<?php if ( is_front_page() ) get_template_part( 'banner', 'primary' ); /* Loads the banner-primary.php template */ ?>

	<main <?php hybrid_attr( 'content' ); ?>>

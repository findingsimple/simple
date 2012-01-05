<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it 
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the 
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins. 
 *
 * @package fs
 * @subpackage Template
 */
?>
<!doctype html>
<!--[if IEMobile 7 ]><html class="no-js iem7" ><![endif]-->
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="HandheldFriendly" content="True" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1" />
<title><?php hybrid_document_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon-114.png" /><!-- For iPhone 4 -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon-72.png" /><!-- For iPad 1-->
<link rel="apple-touch-icon-precomposed" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon.png" /><!-- For iPhone 3G, iPod Touch and Android -->
<link rel="shortcut icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon.png" /><!-- For Nokia -->
<link rel="shortcut icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/favicon.ico" /><!-- For everything else -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><!--Microsoft. Delete if not required -->
<?php wp_head(); // wp_head ?>
</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // fs_open_body ?>

	<div id="container">

		<?php do_atomic( 'before_header' ); // fs_before_header ?>
		
		<header id="header">

			<?php do_atomic( 'open_header' ); // fs_open_header ?>

			<div class="wrap">
			
				<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>
				
				<div id="branding">
					<?php hybrid_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->
				
				<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>

				<?php do_atomic( 'header' ); // fs_header ?>
				
				<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
				
			</div><!-- .wrap -->

			<?php do_atomic( 'close_header' ); // fs_close_header ?>

		</header><!-- #header -->

		<?php do_atomic( 'after_header' ); // fs_after_header ?>


		<?php do_atomic( 'before_main' ); // fs_before_main ?>

		<div id="main">

			<div class="wrap">

			<?php do_atomic( 'open_main' ); // fs_open_main ?>
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
<!--[if lt IE 7 ]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js lt-ie9 lt-ie8 ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js lt-ie9 ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if IE 8 ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<title><?php hybrid_document_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon-114.png" /><!-- For iPhone 4 -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon-72.png" /><!-- For iPad 1-->
<link rel="apple-touch-icon-precomposed" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon.png" /><!-- For iPhone 3G, iPod Touch and Android -->
<link rel="shortcut icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/apple-touch-icon.png" /><!-- For Nokia -->
<link rel="shortcut icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/favicon.ico" /><!-- For everything else -->
<?php wp_head(); ?>
</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); /* fs_open_body */ ?>
	
	<?php do_atomic( 'before_header' ); /* fs_before_header */ ?>
	
	<?php get_template_part( 'header', 'branding' ); /* Loads the header-branding.php template */ ?>

	<?php do_atomic( 'after_header' ); /* fs_after_header */ ?>

	<div id="container" class="container">

		<?php /* get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template */ ?>

		<?php do_atomic( 'before_main' ); /* fs_before_main */ ?>

		<div id="main">

			<div class="wrap">

			<?php do_atomic( 'open_main' ); /* fs_open_main */ ?>
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
<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
<link rel="shortcut icon" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
<script type="text/javascript" src="http://use.typekit.com/wrz4rtj.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php wp_head(); /* wp_head */ ?>
</head>

<body class="<?php hybrid_body_class(); if(is_page("work")) echo " work"; ?>">

	<?php do_atomic( 'open_body' ); /* fs_open_body */ ?>

	<div id="container">

		<?php do_atomic( 'before_header' ); /* fs_before_header */ ?>
		
		<header id="header">

			<?php do_atomic( 'open_header' ); /* fs_open_header */ ?>

			<div class="wrap">
			
				<?php get_template_part( 'menu', 'secondary' ); /* Loads the menu-secondary.php template */ ?>
				
				<div id="branding">
					<?php hybrid_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->
				
				<?php do_atomic( 'header' ); /* fs_header */ ?>
				
				<?php get_template_part( 'menu', 'primary' ); /* Loads the menu-primary.php template */ ?>
				
			</div><!-- .wrap -->

			<?php do_atomic( 'close_header' ); /* fs_close_header */ ?>

			
			<?php if(is_front_page()) { ?>
				<div id="main-banner">
					<div id="main-banner-wrapper">
						We design, build and tweak WordPress websites and provide training and support too. <a href="/contact/" title="Contact Us">Contact us</a>, we love to help.
					</div>
				</div> 
			<?php } ?>
		</header><!-- #header -->

		<?php do_atomic( 'after_header' ); /* fs_after_header */ ?>


		<?php do_atomic( 'before_main' ); /* fs_before_main */ ?>

		<div id="main">

			<div class="wrap">

			<?php do_atomic( 'open_main' ); /* fs_open_main */ ?>
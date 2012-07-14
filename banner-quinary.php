<?php
/**
 * Quinary Banner Template
 *
 * Displays the Banner area after the theme navigation.
 *
 * @package fs
 * @subpackage Template
 */
?>

	<div id="banner-quinary" class="banner">

		<div class="wrap">
		
			<div class="banner-content">
		
				<h2>Get in touch</h2>
				
				<p>Australian based, we work with clients from around the world. Get in touch, we love to help.</p>
				
				<div class="row">
					
					<div id="map_canvas" class="span6"></div><!-- .span6 -->
					
					<div class="span6">
					
						<div class="contact-method phone">
							<h3>Phone</h3>
							<a href="tel:+61-2-6243-5115" title="Phone">+61 2 6243 5115</a>
						</div><!-- .contact-method -->
						
						<div class="contact-method email">
							<h3>Email</h3>
							<a href="mailto:<?php echo antispambot( 'hi@findingsimple.com' ); ?>" title="Get in touch"><?php echo antispambot( 'hi@findingsimple.com' ); ?></a>
						</div><!-- .contact-method -->
						
						<div class="contact-method twitter">
							<h3>Twitter</h3>
							<a href="https://twitter.com/findingsimple" title="findingsimple twitter profile">@findingsimple</a>
						</div><!-- .contact-method -->
						
						<div class="contact-method postal">
							<h3>Postal</h3>
							<span>PO Box 7314 Kaleen ACT 2617</span>
						</div><!-- .contact-method -->
						
					</div><!-- .span6 -->
				
				</div><!-- .row -->
			
			</div><!-- .banner-content -->
			
		</div><!-- .wrap -->

	</div><!-- #banner-primary .banner -->
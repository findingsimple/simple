<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); // Loads the header.php template. ?>

		<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

		<?php get_template_part( 'breadcrumbs' ); // Loads the loop-meta.php template. ?>

		<div class="container">

			<div class="front-three">

				<div class="row">

					<div class="col-sm-4">

						<div class="panel panel-default">

							<div class="panel-heading">

								<h2 class="panel-title">Design</h2>

							</div>

							<div class="panel-body">

								<ul>
									<li>Custom site designs <span class="amp">&amp;</span> redesigns</li>
								    <li>WordPress conversions</li>
								    <li>Friendly consultation <span class="amp">&amp;</span> advice</li>
    							</ul>

							</div>

						</div>

					</div>

					<div class="col-sm-4">

						<div class="panel panel-default">

							<div class="panel-heading">

								<h2 class="panel-title">Build</h2>

							</div>

							<div class="panel-body">

								<ul>
									<li>Theme development <span class="amp">&amp;</span> customisation</li>
									<li>Plugin development <span class="amp">&amp;</span> customisation</li>
									<li>Installation <span class="amp">&amp;</span> configuration</li>
    							</ul>

							</div>

						</div>

					</div>
				
					<div class="col-sm-4">

						<div class="panel panel-default">

							<div class="panel-heading">

								<h2 class="panel-title">Support</h2>

							</div>

							<div class="panel-body">
								<ul>
									<li>Troubleshooting <span class="amp">&amp;</span> support</li>
									<li>Maintenance <span class="amp">&amp;</span> upgrades</li>
									<li>Project Management <span class="amp">&amp;</span> Training</li>
								</ul>
							</div>

						</div>

					</div>

				</div><!--.row -->
				
			</div><!-- .front-three -->

			<div class="front-logos">

				<div class="row">
					<div class="col-xs-6 col-sm-2 logo logo-1"><a href="/work/" title="Happy WordPress Clients"><img src="<?php echo get_template_directory_uri() . "/img/logo-dschool.png"; ?>" alt="" /></a></div>
					<div class="col-xs-6 col-sm-2 logo logo-2"><a href="/work/" title="Happy WordPress Clients"><img src="<?php echo get_template_directory_uri() . "/img/logo-daylight.png"; ?>" alt="" /></a></div>
					<div class="col-xs-6 col-sm-2 logo logo-3"><a href="/work/" title="Happy WordPress Clients"><img src="<?php echo get_template_directory_uri() . "/img/logo-tedx.png"; ?>" alt="" /></a></div>
					<div class="col-xs-6 col-sm-2 logo logo-4"><a href="/work/" title="Happy WordPress Clients"><img src="<?php echo get_template_directory_uri() . "/img/logo-msr.png"; ?>" alt="" /></a></div>
					<div class="col-xs-6 col-sm-2 logo logo-5"><a href="/work/" title="Happy WordPress Clients"><img src="<?php echo get_template_directory_uri() . "/img/logo-anu.png"; ?>" alt="" /></a></div>
					<div class="col-xs-6 col-sm-2 logo logo-6"><a href="/work/" title="Happy WordPress Clients"><img src="<?php echo get_template_directory_uri() . "/img/logo-agov.png"; ?>" alt="" /></a></div>
				</div>

			</div><!-- .front-logos -->

		</div><!-- .container -->

<?php get_footer(); // Loads the footer.php template. ?>
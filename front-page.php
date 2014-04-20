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

		</div><!-- .container -->

<?php get_footer(); // Loads the footer.php template. ?>
<?php
/**
 *Template Name: Full Width
 *
 * @package Education_LMS
 */
get_header();
?>

	<div id="primary" class="content-area full-width">
		<div class="container">
			<div class="row">
				<main id="main" class="site-main col-md-12">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->

			</div>
		</div>

	</div><!-- #primary -->

<?php

get_footer();

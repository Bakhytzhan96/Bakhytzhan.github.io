<?php
/**
 * archive course page
 * @package Education_LMS
 */
get_header();

global $post;

$template = get_post_meta( $post->ID, '_wp_page_template', true );

?>

	<div id="primary" class="content-area">
		<div class="container">
			<div class="row">
				<main id="main" class="site-main col-md-<?php echo ($template !== 'fullwidth-template.php') ? 9 : 12 . ' no-sidebar' ; ?>">
					<?php
					while ( have_posts() ) :
						the_post();

                        the_content();

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->

                <?php if( $template !== 'fullwidth-template.php' ) get_sidebar(); ?>

			</div>
		</div>

	</div><!-- #primary -->

<?php

get_footer();

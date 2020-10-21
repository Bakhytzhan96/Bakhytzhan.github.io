<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Education_LMS
 */

get_header();

$post_layout = esc_attr( get_theme_mod('post_layout', 'right-sidebar') );
$col = ( $post_layout == 'no-sidebar' ) ? 12 : 9;
?>

	<div id="primary" class="content-area">
		<div class="container">
            <div class="row">

	            <?php
	            if ( $post_layout != 'no-sidebar' && $post_layout == 'left-sidebar' ) {
		            get_sidebar();
	            }
	            ?>

                <main id="main" class="site-main col-md-<?php echo intval($col) ?>">

		            <div class="blog-content">
			            <?php
			            while ( have_posts() ) :
				            the_post();

				            get_template_part( 'template-parts/content', 'single' );

				            // If comments are open or we have at least one comment, load up the comment template.
				            if ( comments_open() || get_comments_number() ) :
					            comments_template();
				            endif;

			            endwhile; // End of the loop.
			            ?>
                    </div>

                </main><!-- #main -->

	            <?php
	            if ( $post_layout != 'no-sidebar' && $post_layout == 'right-sidebar' ) {
		            get_sidebar();
	            }
	            ?>

            </div>
        </div>
	</div><!-- #primary -->

<?php

get_footer();

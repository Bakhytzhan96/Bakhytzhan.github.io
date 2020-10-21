<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Education_LMS
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="post-featured-image">
        <a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail('full') ; ?>
        </a>
    </div>

    <div class="entry-content">
        <header class="entry-header">

            <div class="entry-date">
	            <?php echo get_the_date('d') ?>
                <i><?php echo get_the_date('F') ?></i>
            </div>

            <div class="entry-contain">
	            <?php

	            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	            if ( 'post' === get_post_type() ) :
		            ?>
                    <div class="entry-meta">
			            <?php
			            education_lms_posted_by();
			            education_lms_posted_in();
			            education_lms_comment_number();
			            ?>
                    </div><!-- .entry-meta -->
	            <?php endif; ?>
            </div>

        </header><!-- .entry-header -->

        <div class="entry-summary">
	        <?php
	        the_excerpt();
	        ?>
        </div>

        <div class="readmore">
            <a href="<?php the_permalink() ?>"><?php esc_html_e('Read more', 'education-lms') ?></a>
        </div>

    </div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->

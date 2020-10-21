<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Education_LMS
 */

if ( ! function_exists( 'education_lms_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function education_lms_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			' %s',
			'<i class="fa fa-calendar-o"></i> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'education_lms_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function education_lms_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			'%s',
			'<span class="author vcard"><i class="fa fa-user-o"></i> <a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'education_lms_posted_in' ) ) :
    function education_lms_posted_in(){
	    $categories_list = get_the_category_list( esc_html__( ', ', 'education-lms' ) );
	    if ( $categories_list ) {
		    /* translators: 1: list of categories. */
		    printf( '<span class="cat-links"><i class="fa fa-folder-o"></i> %1$s</span>', $categories_list ); // WPCS: XSS OK.
	    }
    }
endif;

if ( ! function_exists( 'education_lms_comment_number' ) ) :
    function education_lms_comment_number(){
	    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		    echo '<span class="comments-link">';
		    echo '<i class="fa fa-comments-o"></i> ';
		    printf( esc_html(_n( '%d Comment', '%d Comments', get_comments_number(), 'education-lms' ) ), number_format_i18n( get_comments_number() ) );
		    echo '</span>';
	    }
    }
endif;

if ( ! function_exists( 'education_lms_posted_tag' ) ) :
    function education_lms_posted_tag() {
	    /* translators: used between list items, there is a space after the comma */
	    $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'education-lms' ) );
	    if ( $tags_list ) {
		    /* translators: 1: list of tags. */
		    printf( '<span class="tags-links"><i class="fa fa-tags"></i> %1$s</span>', $tags_list ); // WPCS: XSS OK.
	    }
    }

endif;



if ( ! function_exists( 'education_lms_comments' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @return void
	 */
	function education_lms_comments( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
                <li class="pingback">
                <p><?php esc_html_e( 'Pingback:', 'education-lms' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'education-lms' ), ' ' ); ?></p>
				<?php
				break;
			default :
				?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment">
                    <div class="comment-author fn vcard">
						<?php echo get_avatar( $comment, 60 ); ?>
						<?php //printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
                    </div><!-- .comment-author .vcard -->

                    <div class="comment-wrapper">
						<?php if ( $comment->comment_approved == '0' ) : ?>
                            <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'education-lms' ); ?></em>
						<?php endif; ?>

                        <div class="comment-meta comment-metadata">
                            <strong><?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?></strong>
                            <span class="says"><?php esc_html_e( 'says:', 'education-lms' ) ?></span><br>
                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
									<?php
									/* translators: 1: date, 2: time */
									printf( esc_html__( '%1$s at %2$s', 'education-lms' ), get_comment_date(), get_comment_time() ); ?>
                                </time></a>
                        </div><!-- .comment-meta .commentmetadata -->
                        <div class="comment-content"><?php comment_text(); ?></div>
                        <div class="comment-actions">
							<?php comment_reply_link( array_merge( array( 'after' => '<i class="fa fa-reply"></i>' ), array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div><!-- .reply -->
                    </div> <!-- .comment-wrapper -->

                </article><!-- #comment-## -->

				<?php
				break;
		endswitch;
	}
endif;



function education_lms_breadcrumb(){
	if ( function_exists('bcn_display') )
	{
		echo '<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/"><div class="container"> ';
		bcn_display();
		echo '</div></div>';
	}
}

/**
 * Display course ratings
 */
if ( ! function_exists( 'education_lms_course_ratings' ) ) {
	function education_lms_course_ratings() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! is_plugin_active( 'learnpress-course-review/learnpress-course-review.php' ) ) {
			return;
		}

		$course_id   = get_the_ID();
		$course_rate = learn_press_get_course_rate( $course_id );
		$ratings  = education_lms_course_rate_total();
		?>
        <div class="course-review">
            <?php if ( is_singular('lp_course') ) { printf(  '<label>%1$s '. esc_html__('Review', 'education-lms') .'</label>', $ratings ); } ?>
            <div class="value">
				<?php education_lms_print_rating( $course_rate );  ?>
            </div>
        </div>
		<?php
	}
}

if ( ! function_exists( 'education_lms_print_rating' ) ) {
	function education_lms_print_rating( $rate ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! is_plugin_active( 'learnpress-course-review/learnpress-course-review.php' ) ) {
			return;
		}

		?>
        <div class="review-stars-rated">
            <ul class="review-stars">
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
            </ul>
            <ul class="review-stars filled" style="<?php echo esc_attr( 'width: calc(' . ( $rate * 20 ) . '% - 2px)' ) ?>">
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
            </ul>
        </div>
		<?php

	}
}


if ( ! function_exists( 'education_lms_course_rate_total' ) ) {
	function education_lms_course_rate_total() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			return '';
		}

		$course_id   = get_the_ID();
		$course_rate = learn_press_get_course_rate_total( $course_id );

		return $course_rate;
	}
}

if ( ! function_exists( 'education_lms_course_price' ) ) {
	function education_lms_course_price() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			return;
		}

		$course = LP_Global::course();
        $price = $course->get_price_html();
        
		?>
            <div class="course-price">
            
                <?php if ( $course->has_sale_price() ) { ?>

                    <span class="origin-price"> <?php echo $course->get_origin_price_html(); ?></span>

                <?php } ?>

                <span class="price"><?php echo (!$price ) ? 'Free' : $price; ?></span>
           
            </div>
        <?php
        
	}
}

if ( ! function_exists( 'education_lms_course_students' ) ) {
	function education_lms_course_students() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			return;
		}

		$course = learn_press_get_course();

		if ( $course ) {
			echo esc_attr( $course->count_students() );
		}
	}
}

if ( ! function_exists( 'education_lms_get_setting' ) ) {
	function education_lms_get_setting( $setting_name ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			return '';
		}

		$setting =  LP()->settings->get( $setting_name ) ;

		return $setting;

	}
}

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'WooCommerce' ) ) { return true; } else { return false; }
	}
}

if ( ! function_exists( 'education_lms_is_wc_shop' ) ) {
	function education_lms_is_wc_shop(){
		if ( class_exists( 'WooCommerce' ) || function_exists( 'is_shop' ) ) {
		    if ( is_shop() )
			return true;
		}
		return false;
	}
}
if ( ! function_exists( 'education_lms_is_wc_archive' ) ) {
	function education_lms_is_wc_archive(){
		if ( function_exists( 'is_product_category' ) || function_exists('is_product_tag') ) {
			if ( is_product_category() || is_product_tag() ) {
				return true;
			}
		}
		return false;
	}
}


function education_lms_social_media() {
	$facebook = get_theme_mod('facebook_url', '');
	$twitter = get_theme_mod('twitter_url', '');
	$google_plus = get_theme_mod('gooogle_plus', '');
	$pinterest = get_theme_mod('pinterest_url', '');
	$tumblr = get_theme_mod('tumblr_url', '');
	$reddit = get_theme_mod('reddit_url', '');
	$youtube = get_theme_mod('youtube_url', '');
	$linkedin = get_theme_mod('linkedin_url', '');
	$instagram = get_theme_mod('instagram_url', '');
	$email = get_theme_mod('email_address', '');
	if ( $facebook != '') { ?>
        <a target="_blank" href="<?php echo esc_url($facebook) ?>"><i class="fa fa-facebook"></i></a>
	<?php } ?>
	<?php if ( $twitter != '') { ?>
        <a target="_blank" href="<?php echo esc_url($twitter) ?>" ><i class="fa fa-twitter"></i></a>
	<?php } ?>
	<?php if ( $google_plus != '') { ?>
        <a target="_blank" href="<?php echo esc_url($google_plus) ?>" ><i class="fa fa-google-plus"></i></a>
	<?php } ?>
	<?php if ( $pinterest != '') { ?>
        <a target="_blank" href="<?php echo esc_url($pinterest) ?>" ><i class="fa fa-pinterest-p"></i></a>
	<?php } ?>
	<?php if ( $tumblr != '') { ?>
        <a target="_blank" href="<?php echo esc_url($tumblr) ?>" ><i class="fa fa-tumblr"></i></a>
	<?php } ?>
	<?php if ( $reddit != '') { ?>
        <a target="_blank" href="<?php echo esc_url($reddit) ?>" ><i class="fa fa-reddit"></i></a>
	<?php } ?>
	<?php if ( $youtube != '') { ?>
        <a target="_blank" href="<?php echo esc_url($youtube) ?>" ><i class="fa fa-youtube-play"></i></a>
	<?php } ?>
	<?php if ( $linkedin != '') { ?>
        <a target="_blank" href="<?php echo esc_url($linkedin) ?>" ><i class="fa fa-linkedin"></i></a>
	<?php } ?>
	<?php if ( $instagram != '') { ?>
        <a target="_blank" href="<?php echo esc_url($instagram) ?>"><i class="fa fa-instagram"></i></a>
	<?php } ?>
	<?php if ( $email != '') { ?>
        <a target="_blank" href="<?php echo esc_url( 'mailto:' . antispambot( $email ) ) ?>" ><i class="fa fa-envelope"></i></a>
	<?php }
}


function education_lms_header() {
   
	    education_lms_header_1();
    
}

function education_lms_archive_course_layout() {
    return esc_attr( get_theme_mod( 'default_course_layout', 'grid' ) );
}

function education_lms_course_view() {
    $view_default = education_lms_archive_course_layout();
    return isset( $_REQUEST['view_type'] ) ? $_REQUEST['view_type'] : $view_default;
}
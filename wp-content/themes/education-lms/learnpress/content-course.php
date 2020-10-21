<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$postid   = get_the_ID();
$author   = get_post_meta( $postid, '_lp_course_author' );
$ratings  = education_lms_course_rate_total();
$course_author = !empty($author) ? $author[0] : 1;

$default_column_desktop = 4;
$default_column_tablet = 6;

?>

<li id="post-<?php the_ID(); ?>" class="col-lg-<?php echo $default_column_desktop ?> col-sm-<?php echo $default_column_tablet; ?>" >
    <div class="course-item">
        <div class="course-thumbnail">
            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'education-lms-course-carousel' ) ?></a>
			<?php  education_lms_course_price(); ?>
        </div>
        <div class="course-content">
            <div class="course-author">
				<?php echo get_avatar( $course_author, 64 ); ?>
                <div class="author-contain">
                    <div class="value"><?php echo esc_html( get_the_author_meta( 'display_name', $course_author ) ) ?></div>
                </div>
            </div>
            <h2 class="course-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
            <?php ?>
            <div class="course-meta clearfix">
                <div class="pull-left">
                    <div class="value"><i class="fa fa-group"></i> <?php education_lms_course_students(); ?></div>
                    <div class="value"><i class="fa fa-comment"></i><?php echo esc_attr( $ratings ); ?></div>
                </div>
                <div class="course-price pull-right">
					<?php education_lms_course_ratings() ?>
                </div>
	            <?php ?>
            </div>

        </div>
    </div>
</li>
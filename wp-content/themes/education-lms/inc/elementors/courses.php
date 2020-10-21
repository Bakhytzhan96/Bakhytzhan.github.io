<?php

namespace EducationLMS\Widgets;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


class Education_LMS_Courses extends Widget_Base {
	public function get_name() {
		return 'edu-courses';
	}

	public function get_title() {
		return __( 'Popular Course', 'education-lms' );
	}

	public function get_icon() {
		return 'fa fa-book';
	}

	public function get_categories() {
		return [ 'edu-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Courses', 'education-lms' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => __( 'Heading', 'education-lms' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Popular Courses', 'education-lms' )
			]
		);

       

		$this->add_control(
			'order',
			[
				'label'       => __( 'Order', 'education-lms' ),
				'label_block' => true,
				'description' => __( 'Ascending or descending order', 'education-lms' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'desc',
				'options'     => [
					'desc' => __( 'DESC', 'education-lms' ),
					'asc'  => __( 'ASC', 'education-lms' ),
				],
			]
		);
		$this->add_control(
			'orderby',
			[
				'label'       => __( 'Orderby', 'education-lms' ),
				'label_block' => true,
				'description' => __( 'Sort retrieved posts/pages by parameter', 'education-lms' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => [
					''      => __( 'None', 'education-lms' ),
					'ID'    => __( 'ID', 'education-lms' ),
					'title' => __( 'Title', 'education-lms' ),
					'name'  => __( 'Name', 'education-lms' ),
					'rand'  => __( 'Random', 'education-lms' ),
					'date'  => __( 'Date', 'education-lms' ),
				],
			]
		);
		$this->add_control(
			'number',
			[
				'label'       => __( 'Number of posts', 'education-lms' ),
				'description' => __( 'How many course to show?', 'education-lms' ),
				'label_block' => true,
				'type'        => Controls_Manager::NUMBER,
				'default'     => ''
			]
		);

		$this->add_control(
			'column',
			[
				'label'       => __( 'Column', 'education-lms' ),
				'label_block' => true,
				'description' => __( 'How many column will be display on a row?', 'education-lms' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '4',
				'options'     => [
					'2' => __( '2 Columns', 'education-lms' ),
					'3' => __( '3 Columns', 'education-lms' ),
					'4' => __( '4 Columns', 'education-lms' ),
					'6' => __( '6 Columns', 'education-lms' ),
				],
			]
		);


		$this->end_controls_section();
	}


	protected function render( $instance = [] ) {
		$settings = $this->get_settings();

		$heading = $settings['heading'];
		$column  = $settings['column'];

		if ( $settings['heading'] == '' ) {
			$heading = __( 'Popular Courses', 'education-lms' );
		}

		switch ( $column ) {
            case "2" : $layout = 6; break;
			case "6" : $layout = 2; break;
			case "4" : $layout = 3; break;
            default: $layout = 4; break;
        }

        $featured_course = isset( $settings['featured_course'] ) ? $settings['featured_course'] : 'no';
        $cat = isset( $settings['category'] ) ? $settings['category'] : 0;
       

		$carousel_class = 'coures-carousel-'.uniqid();

		$args    = array(
			'posts_per_page' => $settings['number'],
			'post_type'      => 'lp_course',
			'post_status'    => 'publish',
			'order'          => $settings['order'],
			'orderby'        => $settings['orderby']
		);

		if ( $featured_course == 'yes' ) {
			$args['meta_query'] = array(
				array(
					'key' => '_lp_featured',
					'value'    => 'yes',
					'compare'    => '='
				),
			);
        }
		if ( $cat > 0 ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'course_category',
					'field'    => 'term_id',
					'terms'    =>  $cat
				),
			);
		}

		$courses = new \WP_Query( $args );

		if ( $courses->have_posts() ) {
			?>

            <div class="carousel-wrapper">

                <h2 class="title"><?php echo esc_html( $heading ); ?></h2>

                <div class="coures-carousel row <?php echo esc_attr($carousel_class) ?>"
                     data-slick='{"slidesToShow": <?php echo absint( $column ) ?>, "slidesToScroll": 1}'>
					<?php while ( $courses->have_posts() ) {
						$courses->the_post();
						$postid   = get_the_ID();
						$author   = get_post_meta( $postid, '_lp_course_author' );
						$ratings  = education_lms_course_rate_total();

						if ( has_post_thumbnail() ) {
							?>

                            <div class="col-md-<?php echo absint( $layout ) ?>">
                                <div class="course-item">
                                    <div class="course-thumbnail">
                                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'education-lms-course-carousel' ) ?></a>
										<?php  education_lms_course_price(); ?>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-author">
											<?php echo get_avatar( $author[0], 64 ); ?>
                                            <div class="author-contain">
                                                <div class="value"
                                                     itemprop="name"><?php echo esc_html( get_the_author_meta( 'display_name', $author[0] ) ) ?></div>
                                            </div>
                                        </div>
                                        <h2 class="course-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                                        <div class="course-meta clearfix">
                                            <div class="pull-left">

                                                <div class="value"><i class="fa fa-group"></i> <?php education_lms_course_students(); ?>
                                                </div>

                                                <div class="value"><i class="fa fa-star"></i><?php echo esc_attr( $ratings ); ?>
                                                </div>

                                            </div>
                                            <div class="course-price pull-right">
												<?php education_lms_course_ratings() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

						<?php }
					} ?>
                </div>
            </div>
            <script type="text/javascript">
                (function($) {
                    "use strict";
                    $('.<?php echo esc_attr($carousel_class) ?>').slick({
						<?php if( is_rtl() ) { echo "rtl: true,"; } ?>
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    arrows: false,
                                    centerMode: true,
                                    centerPadding: '40px',
                                    slidesToShow: 3
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: false,
                                    centerMode: true,
                                    centerPadding: '40px',
                                    slidesToShow: 2
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    arrows: false,
                                    centerMode: true,
                                    centerPadding: '40px',
                                    slidesToShow: 1
                                }
                            }
                        ]
                    });
                })(jQuery);
            </script>
			<?php
		}
		wp_reset_postdata();
	}

	protected function _content_template() {
	}
}
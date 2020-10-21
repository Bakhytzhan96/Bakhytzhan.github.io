<?php
namespace EducationLMS\Widgets;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Education_LMS_Recent_News extends Widget_Base {
	public function get_name() {
		return 'edu-recent-news';
	}

	public function get_title() {
		return __( 'Recent News', 'education-lms' );
	}

	public function get_icon() {
		return 'eicon-wordpress';
	}

	public function get_categories() {
		return [ 'edu-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Recent News', 'education-lms' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => __( 'Heading', 'education-lms' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Latest News', 'education-lms' )
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
			'excerpt_lenght',
			[
				'label'       => __( 'Excerpt length', 'education-lms' ),
				'description' => __( 'The excerpt length', 'education-lms' ),
				'label_block' => true,
				'type'        => Controls_Manager::NUMBER,
				'default'     => '20'
			]
		);

		$this->add_control(
			'column',
			[
				'label'       => __( 'Layout', 'education-lms' ),
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
			$heading = __( 'Latest News', 'education-lms' );
		}

		switch ( $column ) {
			case "2" : $layout = 6; break;
			case "6" : $layout = 2; break;
			case "4" : $layout = 3; break;
			default: $layout = 4; break;
		}

		$carousel_class = 'recent-news-carousel-'.uniqid();

		$args    = array(
			'posts_per_page' => $settings['number'],
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'order'          => $settings['order'],
			'orderby'        => $settings['orderby']
		);
		$recent_posts = new \WP_Query( $args );

		if ( $recent_posts->have_posts() ) {
			?>

			<div class="carousel-wrapper">

				<h2 class="title"><?php echo esc_html( $heading ); ?></h2>

				<div class="recent-post-carousel row <?php echo esc_attr($carousel_class) ?>"
				     data-slick='{"slidesToShow": <?php echo absint( $column ) ?>, "slidesToScroll": 1}'>
					<?php while ( $recent_posts->have_posts() ) {
						$recent_posts->the_post();

						if ( has_post_thumbnail() ) {
							?>

							<div class="col-md-<?php echo absint( $layout ) ?>">
								<div class="post-item">
									<div class="post-thumbnail">
										<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'education-lms-recent-post-carousel' ) ?></a>
									</div>

									<h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

									<div class="recent-news-meta">
										<?php education_lms_posted_on(); ?>
										<?php education_lms_comment_number(); ?>
									</div>

									<p><?php echo wp_trim_words( get_the_content(), $settings['excerpt_lenght'], '&hellip;' ); ?></p>
									<a class="btn btn-readmore" href="<?php the_permalink() ?>"><?php esc_html_e('Read more', 'education-lms') ?></a>

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
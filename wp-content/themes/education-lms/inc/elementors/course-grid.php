<?php

namespace EducationLMS\Widgets;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


class Education_LMS_Courses_Grid extends Widget_Base {
	public function get_name() {
		return 'edu-courses-grid';
	}

	public function get_title() {
		return __( 'Course Grid', 'education-lms' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'edu-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Course Grid', 'education-lms' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => __( 'Heading', 'education-lms' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Top Courses', 'education-lms' )
			]
		);

        $this->add_control(
            'category',
            [
                'label'       => __( 'Category', 'education-lms' ),
                'label_block' => true,
                'description' => __( 'Select the course category', 'education-lms' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple' => true,
                'default'     => '',
                'options'     => education_lms_course_category()
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
			'more_link',
			[
				'label' => __( 'More Link', 'education-lms' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'education-lms' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true				
				],
			]
		);


		$this->end_controls_section();
	}


	protected function render( $instance = [] ) {
		$settings = $this->get_settings();

        $heading = $settings['heading'];
        $category =  $settings['category'];
		
		if ( $heading == '' ) {
			$heading = __( 'Top Courses', 'education-lms' );
        }
       
        $posts_per_page = 5;
        $featured_course = 'no';

       
		$args    = array(
			'posts_per_page' => $posts_per_page,
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
        
		if ( !empty($category) &&  0 < $category[0] ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'course_category',
					'field'    => 'term_id',
					'terms'    => $category
				),
			);
        }
     
        
        $layout = 'layout_1';
        
       

		$courses = new \WP_Query( $args );
        $k = 0 ;
		if ( $courses->have_posts() ) {

           


            /* Default layout 1 */
            if ( 'layout_1' == $layout) {
			?>

            <div class="<?php echo $layout ?> carousel-wrapper">

                <div class="row">
                    <div class="col-md-6 col-xs-12 text-left">
                        <h2 class="title"><?php echo esc_html( $heading ); ?></h2>
                    </div>
                    <div class="col-md-6 col-xs-12 btn-view-all text-right">
                        <a class="btn btn-all-courses" href="<?php echo $settings['more_link']['url'] ?>"><?php _e('View All Courses', 'education-lms') ?></a>
                    </div>
                </div>

                <div class="carouse-grid row">
					<?php while ( $courses->have_posts() ) {
						$courses->the_post();
						$courseID   = get_the_ID();
                        $author   = get_post_meta( $courseID, '_lp_course_author' );
                        $_image = wp_get_attachment_image_src( get_post_thumbnail_id( $courseID ), 'education-lms-course-grid' );
            
                    
                        if ( $k == 0 ) {
                            echo '<div class="col-sm-6">';
                        }
                        
                        ?>
                       
                        <div class="course-grid-box <?php echo ( $k > 0 ) ? 'col-sm-6' : '' ?>">
                            <div class="course-holder">
                                <div class="course-holder-inner">
                                    <a href="<?php the_permalink() ?>" class="course_link"></a>
                                    <span class="course-bg" style="background-image: url(<?php echo esc_url( $_image[0] ) ?>)"></span>
                                    <div class="info-on-hover">
                                        <h4 class="course-title"><?php the_title() ?></h4>
                                        <?php  education_lms_course_price(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php    
                        
                        if ( $k == 0 ) {
                            echo '</div>';
                            echo '<div class="col-sm-6"><div class="row">';
                        }
                        
                        if( $k == 4) {
                            echo '</div></div>';
                        }

                        $k++;
                    } 
                    ?>
                </div>
            </div>
            <?php
            } // end layout 1

		} // end while
		wp_reset_postdata();
	}

}
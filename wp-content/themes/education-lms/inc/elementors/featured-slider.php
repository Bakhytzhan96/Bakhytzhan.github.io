<?php
namespace EducationLMS\Widgets;
use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Education_LMS_Featured_Slider extends Widget_Base {
	public function get_name() {
		return 'edu-featured-slider';
	}
	public function get_title() {
		return __( 'Featured Slider', 'education-lms' );
	}
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-slideshow';
	}
	public function get_categories() {
		return [ 'edu-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Slider', 'education-lms' ),
			]
		);

		$repeater = new Repeater();
		$repeater->start_controls_tabs( 'slides_repeater' );

		$repeater->start_controls_tab( 'background', [ 'label' => __( 'Background', 'education-lms' ) ] );

		$repeater->add_control(
			'background_color',
			[
				'label' => __( 'Color', 'education-lms' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .feature-slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_image',
			[
				'label' => _x( 'Image', 'Background Control', 'education-lms' ),
				'type' => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .feature-slide-bg' => 'background-image: url({{URL}})',
				],
			]
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'content', [ 'label' => __( 'Content', 'education-lms' ) ] );

		$repeater->add_control(
			'heading',
			[
				'label' => __( 'Title', 'education-lms' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Slide Heading', 'education-lms' ),
				'label_block' => true,
			]
		);
	

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'education-lms' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'education-lms' ),
				'show_label' => true,
			]
		);
	

		$repeater->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'education-lms' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'education-lms' ),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'education-lms' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'education-lms' ),
			]
		);

	
		$repeater->end_controls_tab();
		
		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'education-lms' ),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'default' => [
					[
						'heading' => __( 'Slide 1 Heading', 'education-lms' ),
						'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'education-lms' ),
						'button_text' => __( 'Click Here', 'education-lms' ),
						'background_color' => '#833ca3',
					],
					[
						'heading' => __( 'Slide 2 Heading', 'education-lms' ),
						'description' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'education-lms' ),
						'button_text' => __( 'Click Here', 'education-lms' ),
						'background_color' => '#4054b2',
					],
				],
				'fields' => array_values( $repeater->get_controls() ),
				'title_field' => '{{{ heading }}}',
			]
		);

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __( 'Height', 'education-lms' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 400,
				],
				'size_units' => [ 'px', 'vh', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slick-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

        $this->end_controls_section();
        
       
	}


	protected function render( $instance = [] ) {
		$settings = $this->get_settings();

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		$this->add_render_attribute( 'button', 'class', [ 'btn', 'slide-button' ] );



		$slides = [];
		$slide_count = 0;
		foreach ( $settings['slides'] as $slide ) {
			$slide_html = $slide_attributes = $btn_attributes = '';
			$btn_element = $slide_element = 'div';
			$slide_url = $slide['link']['url'];

			$slide_html .= '<div class="feature-slide-content animated fadeInUp">';

			if ( $slide['heading'] ) {
				$slide_html .= '<h2 class="feature-slide-heading">' . $slide['heading'] . '</h2>';
			}

			if ( $slide['description'] ) {
				$slide_html .= '<p class="feature-slide-description">' . $slide['description'] . '</p>';
			}

			if ( $slide['button_text'] && ! empty( $slide_url ) ) {
				$this->add_render_attribute( 'slide_link' . $slide_count , 'href', $slide_url );

				if ( $slide['link']['is_external'] ) {
					$this->add_render_attribute( 'slide_link' . $slide_count, 'target', '_blank' );
				}

				$btn_element = 'a';
				$btn_attributes = $this->get_render_attribute_string( 'slide_link' . $slide_count );
				$slide_html .= '<' . $btn_element . ' ' . $btn_attributes . ' ' . $this->get_render_attribute_string( 'button' ) . '>' . $slide['button_text'] . '</' . $btn_element . '>';
			}

			$slide_html .= '</div>';

			$slide_html = '<div class="feature-slide-bg"></div><' . $slide_element . ' ' . $slide_attributes . ' class="feature-slide-inner">' . $slide_html . '</' . $slide_element . '>';
			$slides[] = '<div class="elementor-repeater-item-' . $slide['_id'] . ' slick-slide">' . $slide_html . '</div>';

			$slide_count++;
		}
		$slider_class = 'slider-'.uniqid();
		$carousel_classes = [ 'feature-slider' ];
		$carousel_classes[] = $slider_class;
		$this->add_render_attribute( 'slides', [
			'class' => $carousel_classes,
			'data-animation' => 'up',
		] );

		?>

        <div class="feature-slides-wrapper feature-slick-slider" >
            <div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
				<?php echo implode( '', $slides ); ?>
            </div>
        </div>
        <script type="text/javascript">
            (function($) {
                "use strict";
                $('.<?php echo esc_attr($slider_class) ?>').slick({    
                    <?php ?>      
                    <?php if( is_rtl() ) { echo "rtl: true"; } ?>
                });
            })(jQuery);
        </script>
		<?php
	}

	protected function _content_template() {}

}
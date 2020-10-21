<?php
namespace EducationLMS;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Education_LMS_Elementors {
	/**
	 * Plugin constructor.
	 */
	public function __construct() {
		$this->add_actions();
	}
	private function add_actions() {
		add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

	}
	public function add_elementor_category()
	{

		$elementor = \Elementor\Plugin::$instance;

		// Add element category in panel
		$elementor->elements_manager->add_category(
			'edu-elements',
			[
				'title' => __( 'Theme Elements', 'education-lms' ),
				'icon' => 'font',
			],
			1
		);

	}


	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}
	private function includes()
	{
		// Theme Elements
		require_once __DIR__ . '/elementors/featured-slider.php';
        require_once __DIR__ . '/elementors/courses.php';
        require_once __DIR__ . '/elementors/course-grid.php';
        require_once __DIR__ . '/elementors/recent-news.php';
       
	}
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \EducationLMS\Widgets\Education_LMS_Featured_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \EducationLMS\Widgets\Education_LMS_Courses() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \EducationLMS\Widgets\Education_LMS_Recent_News() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \EducationLMS\Widgets\Education_LMS_Courses_Grid() );
       
	}
}
new Education_LMS_Elementors();
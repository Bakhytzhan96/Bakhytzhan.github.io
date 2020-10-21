<?php
class Education_LMS_Customize_Pro_Control extends WP_Customize_Control {
	public $type = 'education_lms_pro';
	function render_content(){
		if ( ! empty( $this->label ) ) : ?>
            <span class="customize-control-title education-pro-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif;
		if ( ! empty( $this->description ) ) : ?>
            <div class="description customize-control-description education-pro-description"><?php echo $this->description ; ?></div>
		<?php endif; ?>
		<?php
	}
}
if(!class_exists('Education_LMS_Group_Settings_Heading_Control')):
	class Education_LMS_Group_Settings_Heading_Control extends WP_Customize_Control {
		public $settings = 'blogname';
		public $description = '';
		public $title = '';
		public $group = '';
		public $type = '';
		/**
		 * Render the description and title for the sections
		 */
		public function render_content() {
			switch ( $this->type ) {
				default:
				case 'group_heading_top':
					echo '<h4 class="customizer-group-heading group-heading-top">' . $this->title . '</h4>';
					if ( $this->description != '' ) {
						echo '<p class="customizer-group-subheading">' . $this->description . '</p>';
					}
					break;
				case 'group_heading':
					echo '<h4 class="customizer-group-heading">' . $this->title . '</h4>';
					if ( $this->description != '' ) {
						echo '<p class="customizer-group-subheading">' . $this->description . '</p>';
					}
					break;
				case 'group_heading_message':
					echo '<h4 class="customizer-group-heading-message">' . $this->title . '</h4>';
					if ( $this->description != '' ) {
						echo '<p class="customizer-group-heading-message">' . $this->description . '</p>';
					}
					break;
				case 'hr' :
					echo '<hr />';
					break;
			}
		}
	}
endif;

/**
 * Slider Range Control
 */
 class Education_LMS_Slider_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'slider_control';

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><span class="unit">px</span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
			</div>
		<?php
		}
	}



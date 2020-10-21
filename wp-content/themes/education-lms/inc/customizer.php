<?php
/**
 * Education LMS Theme Customizer
 *
 * @package Education_LMS
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_lms_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'education_lms_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'education_lms_customize_partial_blogdescription',
		) );

		$wp_customize->selective_refresh->add_partial( 'follow_title', array(
			'selector'        => '.footer-social',
			'render_callback' => 'education_lms_customize_partial_social_connect',
		) );

		$wp_customize->selective_refresh->add_partial( 'blog_page_title', array(
			'selector'        => '.blog .header-title',
			'render_callback' => 'education_lms_refresh_titlebar',
		) );

	
	}

	// Load custom controls
	require get_template_directory() . '/inc/customizer-controls.php';


	$wp_customize->add_setting( 'logo_max_width', array(
		'default'           => 90,
		'transport'   => 'postMessage',
		'sanitize_callback' => 'education_lms_sanitize_number_absint'
	) );
	$wp_customize->add_control( new Education_LMS_Slider_Control( $wp_customize, 'logo_max_width',
		array(
			'label' => __( 'Logo Max Width', 'education-lms' ),
			'section' => 'title_tagline',
			'input_attrs' => array(
				'min' => 10,
				'max' => 1000,
				'step' => 1,
			),
		)
	) );





	$wp_customize->add_panel( 'layouts' ,
		array(
			'title'       => esc_html__( 'Layouts', 'education-lms' ),
			'description' => ''
		)
	);

	$wp_customize->add_section( 'container' ,
		array(
			'panel'       => 'layouts',
			'title'       => esc_html__( 'Containers', 'education-lms' ),
			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'container_max_width', array(
		'default'           => 1230,
		'transport'   => 'postMessage',
		'sanitize_callback' => 'education_lms_sanitize_number_absint'
	) );
	$wp_customize->add_control( new Education_LMS_Slider_Control( $wp_customize, 'container_max_width',
		array(
			'label' => __( 'Container Width', 'education-lms' ),
			'section' => 'container',
			'input_attrs' => array(
				'min' => 1000,
				'max' => 2000,
				'step' => 5,
			),
		)
	) );

	$wp_customize->add_section( 'header_layouts' ,
		array(
			'panel'       => 'layouts',
			'title'       => esc_html__( 'Header', 'education-lms' ),
			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'topbar_layout', array(
		'sanitize_callback' => 'education_lms_sanitize_select',
		'transport'			=> 'postMessage',
		'default'           => 'contained'
	) );
	$wp_customize->add_control( 'topbar_layout',
		array(
			'type'        => 'select',
			'label'       => esc_html__('Header Top Width', 'education-lms'),
			'section'     => 'header_layouts',
			'choices' => array(
				'full' => esc_html__('Full', 'education-lms'),
				'contained' => esc_html__('Contained', 'education-lms'),
			)
		)
	);
	$wp_customize->add_setting( 'header_main_layout', array(
		'sanitize_callback' => 'education_lms_sanitize_select',
		'transport'			=> 'postMessage',
		'default'           => 'contained'
	) );
	$wp_customize->add_control( 'header_main_layout',
		array(
			'type'        => 'select',
			'label'       => esc_html__('Header Main Width', 'education-lms'),
			'section'     => 'header_layouts',
			'choices' => array(
				'full' => esc_html__('Full', 'education-lms'),
				'contained' => esc_html__('Contained', 'education-lms'),
			)
		)
	);



	$wp_customize->add_section( 'footer_layouts' ,
		array(
			'panel'       => 'layouts',
			'title'       => esc_html__( 'Footer', 'education-lms' ),
			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'footer_width', array(
		'sanitize_callback' => 'education_lms_sanitize_select',
		'transport'			=> 'postMessage',
		'default'           => 'contained'
	) );
	$wp_customize->add_control( 'footer_width',
		array(
			'type'        => 'select',
			'label'       => esc_html__('Footer Width', 'education-lms'),
			'section'     => 'footer_layouts',
			'choices' => array(
				'full' => esc_html__('Full', 'education-lms'),
				'contained' => esc_html__('Contained', 'education-lms'),
			)
		)
	);




		// Up sell
		$wp_customize->add_section( 'education_lms_pro' ,
			array(
				'title'       => esc_html__( 'Upgrade to Pro', 'education-lms' ),
				'description' => '',
				'priority'     => 10
			)
		);
		$wp_customize->add_setting( 'wpblog_pro_features', array(
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(
			new Education_LMS_Customize_Pro_Control(
				$wp_customize,
				'wpblog_pro_features',
				array(
					'label'      => esc_html__( 'Education Pro Features', 'education-lms' ),
					'description'   => '<span>Retina Logo</span><span>Sticky Header</span><span>Header Transparent</span><span>2 Header Layout</span><span>Slider Advanced Styling</span><span>Course Search Widget</span><span>Course Grid/List Layout</span><span>600+ Google Fonts</span><span>Multiple Color Options</span><span>Back To Top</span><span>Footer Widget Layout</span><span>Footer Copyright Editor</span><span>... and much more </span>',
					'section'    => 'education_lms_pro',
				)
			)
		);
		$wp_customize->add_setting( 'wpblog_pro_links', array(
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(
			new Education_LMS_Customize_Pro_Control(
				$wp_customize,
				'wpblog_pro_links',
				array(
					'description'   => '<a target="_blank" class="education-pro-buy-button" href="https://www.filathemes.com/downloads/education-lms-pro/">Buy Now</a>', 'education-lms',
					'section'    => 'education_lms_pro',
				)
			)
		);
	






	/* Menu Sidebar Display */
	$wp_customize->add_section( 'menu_sidebar' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Menu Sidebar', 'education-lms' ),
			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'menu_display', array(
		'sanitize_callback' => 'education_lms_sanitize_select',
		'default'           => 'left'
	) );
	$wp_customize->add_control( 'menu_display',
		array(
			'type'        => 'select',
			'label'       => esc_html__('Display Type', 'education-lms'),
			'section'     => 'menu_sidebar',
			'choices' => array(
				'left' => esc_html__('Slide from left', 'education-lms'),
				'right' => esc_html__('Slide from right', 'education-lms'),
				'dropdown' => esc_html__('Toggle Dropdown', 'education-lms'),
			)
		)
	);

	/* Header Topbar */
	$wp_customize->add_section( 'topbar' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Header Topbar', 'education-lms' ),
			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'show_topbar', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'         => 'postMessage'
	) );
	$wp_customize->add_control( 'show_topbar',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the header topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'show_login', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'         => 'postMessage'
	) );
	$wp_customize->add_control( 'show_login',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the login on topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);

	$wp_customize->add_setting( 'show_register', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'              => 'postMessage'
	) );
	$wp_customize->add_control( 'show_register',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the register on topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);

	$wp_customize->add_setting( 'show_logout', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'              => 'postMessage'
	) );
	$wp_customize->add_control( 'show_logout',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the logout on topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);


	$wp_customize->add_setting( 'login_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => ''
	) );
	$wp_customize->add_control( 'login_url',
		array(
			'type'        => 'text',
			'label'       => esc_html__('Login page URL', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'register_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => ''
	) );
	$wp_customize->add_control( 'register_url',
		array(
			'type'        => 'text',
			'label'       => esc_html__('Register page URL', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);
	// Group Heading
	$wp_customize->add_control( new Education_LMS_Group_Settings_Heading_Control( $wp_customize, 'wc_setting_group_heading',
			array(
				'type' 			=> 'group_heading_top',
				'title'			=> esc_html__( 'WooCommerce Cart', 'education-lms' ),
				'section' 		=> 'topbar'
			)
		)
	);
	$wp_customize->add_setting( 'show_wc_cart', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'              => 'postMessage'
	) );
	$wp_customize->add_control( 'show_wc_cart',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide the WooCommerce Cart on topbar?', 'education-lms'),
			'section'     => 'topbar',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'cart_font_size', array(
		'default'           => 14,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'education_lms_sanitize_number_absint'
	) );
	$wp_customize->add_control( new Education_LMS_Slider_Control( $wp_customize, 'cart_font_size',
		array(
			'label' => __( 'Icon size', 'education-lms' ),
			'section' => 'topbar',
			'input_attrs' => array(
				'min' => 10,
				'max' => 50,
				'step' => 1,
			),
		)
	));
	$wp_customize->add_setting( 'cart_color' , array(
		'sanitize_callback'	=> 'sanitize_hex_color',
		'default'     => '#fff',
		'transport'         => 'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cart_color', array(
		'label'        => esc_html__( 'Icon Color', 'education-lms' ),
		'section'    => 'topbar',
		'settings'   => 'cart_color',
	) ) );

	/* Social */
	$wp_customize->add_section( 'social_media' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Social Media', 'education-lms' ),
			'priority'     => 15
		)
	);

	$wp_customize->add_setting( 'hide_footer_social', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'   => 'postMessage'
	) );
	$wp_customize->add_control( 'hide_footer_social',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide Footer Connect', 'education-lms'),
			'section'     => 'social_media',
			'description' => 'Hide the social icons at footer.'
		)
	);

	$wp_customize->add_setting( 'follow_title', array(
		'transport'   => 'postMessage',
		'default' => esc_html__( 'Follow Us', 'education-lms' ),
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control(
		'follow_title',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Follow Text', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'facebook_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'facebook_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Facebook', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'twitter_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'twitter_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Twitter', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'gooogle_plus', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'gooogle_plus',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Google+', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'pinterest_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'pinterest_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Pinterest', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'tumblr_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'tumblr_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Tumblr', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'reddit_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'reddit_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Reddit', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'youtube_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'youtube_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Youtube', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'linkedin_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'linkedin_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Linkedin', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'instagram_url', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '',
	) );
	$wp_customize->add_control(
		'instagram_url',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Instagram', 'education-lms' ),
			'section'    => 'social_media',
		)
	);
	$wp_customize->add_setting( 'email_address', array(
		'sanitize_callback' => 'sanitize_email',
		'default' => '',
	) );
	$wp_customize->add_control(
		'email_address',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Email', 'education-lms' ),
			'section'    => 'social_media',
		)
	);





	/* Single post */
	$wp_customize->add_section( 'single_post' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Single Post', 'education-lms' ),
			'priority'     => 15
		)
	);

	$wp_customize->add_setting( 'post_layout', array(
		'sanitize_callback' => 'education_lms_sanitize_select',
		'default'           => 'right-sidebar'
	) );
	$wp_customize->add_control( 'post_layout',
		array(
			'type'        => 'select',
			'label'       => esc_html__('Post Layout', 'education-lms'),
			'section'     => 'single_post',
			'choices' => array(
				'right-sidebar' => esc_html__('Right sidebar', 'education-lms'),
				'left-sidebar' => esc_html__('Left sidebar', 'education-lms'),
				'no-sidebar' => esc_html__('No sidebar', 'education-lms'),
			)
		)
	);




	$wp_customize->add_setting( 'show_category', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'              => 'postMessage'
	) );
	$wp_customize->add_control( 'show_category',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide category after main title?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'show_date', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'              => 'postMessage'
	) );
	$wp_customize->add_control( 'show_date',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide date after main title?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);
	$wp_customize->add_setting( 'show_author', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'              => 'postMessage'
	) );
	$wp_customize->add_control( 'show_author',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide author after main title?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);


	$wp_customize->add_setting( 'show_tag', array(
		'sanitize_callback' => 'education_lms_checkbox_sanitize',
		'default'           => '',
		'transport'              => 'postMessage'
	) );
	$wp_customize->add_control( 'show_tag',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__('Hide tagged below entry post?', 'education-lms'),
			'section'     => 'single_post',
			'description' => ''
		)
	);

	/* Titlebar */
	$wp_customize->add_setting( 'titlbar_bg_color' , array(
		'sanitize_callback'	=> 'sanitize_hex_color',
		'default'     => '#457992',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'titlbar_bg_color', array(
		'label'        => esc_html__( 'Background Color', 'education-lms' ),
		'section'    => 'header_image',
		'settings'   => 'titlbar_bg_color',
	) ) );

	/* Primary color */
	$wp_customize->add_setting( 'primary_color' , array(
		'sanitize_callback'	=> 'sanitize_hex_color',
		'default'     => '#ffb606',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label'        => esc_html__( 'Primary Color', 'education-lms' ),
		'section'    => 'colors',
		'settings'   => 'primary_color',
	) ) );

	$wp_customize->add_panel( 'theme_options' ,
		array(
			'title'       => esc_html__( 'Theme Options', 'education-lms' ),
			'description' => ''
		)
	);
	$wp_customize->add_section( 'titlebar' ,
		array(
			'panel'       => 'theme_options',
			'title'       => esc_html__( 'Titlebar', 'education-lms' ),
			'priority'     => 15
		)
	);
	$wp_customize->add_setting( 'blog_page_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => esc_html__( 'Blog', 'education-lms' ),
		'transport'              => 'postMessage'
	) );
	$wp_customize->add_control(
		'blog_page_title',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Blog Page Title', 'education-lms' ),
			'description' => esc_html__( 'The title display on blog page.', 'education-lms' ),
			'section'    => 'titlebar',
		)
	);
	$wp_customize->add_setting( 'padding_top', array(
		'sanitize_callback' => 'education_lms_sanitize_number_absint',
		'default' => 5,
		'transport'  => 'postMessage'
	) );
	$wp_customize->add_control(
		'padding_top',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Padding Top', 'education-lms' ),
			'description' => esc_attr__('The page cover padding top in percent (%).', 'education-lms'),
			'section'    => 'titlebar',
		)
	);
	$wp_customize->add_setting( 'padding_botton', array(
		'sanitize_callback' => 'education_lms_sanitize_number_absint',
		'default'           => 5,
		'transport'         => 'postMessage'
	) );
	$wp_customize->add_control(
		'padding_botton',
		array(
			'type' => 'text',
			'label'      => esc_html__( 'Padding Bottom', 'education-lms' ),
			'description' => esc_attr__('The page cover padding bottom in percent (%).', 'education-lms'),
			'section'    => 'titlebar',
		)
	);





	function education_lms_checkbox_sanitize( $input ){
		//returns true if checkbox is checked
		return ( ( $input == 1 ) ? 1 : '' );
	}
	function education_lms_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );
		// If the input is an absolute integer, return it; otherwise, return the default
		return ( $number ? $number : $setting->default );
	}
	function education_lms_sanitize_select( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;
		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}


}
add_action( 'customize_register', 'education_lms_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function education_lms_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function education_lms_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function education_lms_customize_partial_social_connect(){
	echo esc_html( get_theme_mod('follow_title',  esc_html__('Follow Us', 'education-lms') ) );
	education_lms_social_media();
}

function education_lms_refresh_nav_button(){
	return  get_theme_mod('button_text');
}
function education_lms_refresh_titlebar(){
	return esc_html( get_theme_mod('blog_page_title') );
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function education_lms_customize_preview_js() {
	wp_enqueue_script( 'education-lms-customizer', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview', 'jquery' ), '20151215', true );
}
add_action( 'customize_preview_init', 'education_lms_customize_preview_js' );


function education_lms_customizer_load_css(){
	wp_enqueue_style( 'education-lms-customizer', get_template_directory_uri() . '/assets/css/customizer.css' );
}
add_action('customize_controls_print_styles', 'education_lms_customizer_load_css');



function education_lms_customizer_load_scripts(){
	wp_enqueue_script( 'education-customizer', get_template_directory_uri() . '/assets/js/customizer-controls.js', array( 'jquery' ), false, true );
}
add_action('customize_controls_enqueue_scripts', 'education_lms_customizer_load_scripts');

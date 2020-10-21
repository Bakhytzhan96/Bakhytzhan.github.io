<?php
/**
 * Add theme dashboard page
 */
add_action('admin_menu', 'education_lms_theme_info');
function education_lms_theme_info() {
	$theme_data = wp_get_theme();
	add_theme_page( sprintf( esc_html__( '%s Dashboard', 'education-lms' ), $theme_data->Name ), sprintf( '%s', $theme_data->Name), 'edit_theme_options', 'education_lms', 'education_lms_theme_info_page');
}
if ( ! function_exists( 'education_lms_admin_scripts' ) ) :
	/**
	 * Enqueue scripts for admin page only: Theme info page
	 */
	function education_lms_admin_scripts( $hook ) {
		if ( $hook === 'widgets.php' || $hook === 'appearance_page_education_lms'  ) {
			wp_enqueue_style('education_lms-admin-css', get_template_directory_uri() . '/assets/css/admin.css');
		}
	}
endif;
add_action('admin_enqueue_scripts', 'education_lms_admin_scripts');
function education_lms_theme_info_page() {
	$theme_data = wp_get_theme();
	// Check for current viewing tab
	$tab = null;
	if ( isset( $_GET['tab'] ) ) {
		$tab = $_GET['tab'];
	} else {
		$tab = null;
	}
	?>

	<div class="wrap about-wrap theme_info_wrapper">
		<h1><?php printf(esc_html__('Welcome to %1$1s - Version %2$2s', 'education-lms'), $theme_data->Name, $theme_data->Version ); ?></h1>
		<div class="about-text"><?php echo $theme_data->Description ?></div>

		<h2 class="nav-tab-wrapper">
			<a href="?page=education_lms" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>"><?php echo $theme_data->Name; ?></a>
            <?php ?>
            <a href="<?php echo esc_url( add_query_arg( array( 'page'=>'education_lms', 'tab' => 'free_pro' ), admin_url( 'themes.php' ) ) ); ?>" class="nav-tab<?php echo $tab == 'free_pro' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Free vs PRO', 'education-lms' ); ?></span></a>
            <?php  ?>
		</h2>

		<?php if ( is_null($tab) ) { ?>
			<div class="theme_info info-tab-content">
				<div class="theme_info_column clearfix">
					<div class="theme_info_left">

						<div class="theme_link">
							<h3><?php esc_html_e( 'Theme Customizer', 'education-lms' ); ?></h3>
							<p class="about"><?php printf(esc_html__('%s supports the Theme Customizer for all theme settings. Click "Customize" to start customize your site.', 'education-lms'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php esc_html_e('Start Customize', 'education-lms'); ?></a>
							</p>
						</div>
						<div class="theme_link">
							<h3><?php esc_html_e( 'Theme Documentation', 'education-lms' ); ?></h3>
							<p class="about"><?php printf(esc_html__('Need any help to setup and configure %s? Please have a look at our documentations instructions.', 'education-lms'), $theme_data->Name); ?></p>
							<p>
								<a href="http://docs.filathemes.com/education-lms/" target="_blank" class="button button-secondary"><?php esc_html_e('Online Documentation', 'education-lms'); ?></a>
							</p>
						</div>
					</div>

					<div class="theme_info_right">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php esc_html_e( 'Theme Screenshot', 'education-lms' ); ?>" />
					</div>
				</div>
			</div>
		<?php } ?>

		<?php
       
        if ( $tab == 'free_pro' ) { ?>
            <div id="free_pro" class="freepro-tab-content info-tab-content">
                <table class="free-pro-table">
                    <thead><tr><th></th><th>Free</th><th> PRO</th></tr></thead>
                    <tbody>
                    <tr>
                        <td>
                            <h4>Responsive Design</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Translation Ready</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Upload Your Own Logo</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Unlimited Slide</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>

                    <tr>
                        <td>
                            <h4>LearnPress - WordPress LMS</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Elementor Compatible</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>WooCommerce Compatible</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Custom Widgets</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Header Topbar</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Header Cover Image</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Social Icons</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Footer Widget</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Demo Content Ready</h4>
                        </td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Retina Logo</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Sticky Header</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Header Transparent</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>2 Header Layout</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Slider Advanced Styling</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Course Search Widget</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Course Grid/List Layout</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Multi Color Options</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Back To Top</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>600+ Google fonts</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>

                    <tr>
                        <td>
                            <h4>Footer Copyright & Layout</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td>
                            <h4>24/7/365 Support</h4>
                        </td>
                        <td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>
                        <td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>
                    </tr>


                    <tr class="ti-about-page-text-center"><td></td><td colspan="2"><a href="https://www.filathemes.com/downloads/education-lms-pro/" target="_blank" class="button button-primary button-hero">Get Pro now!</a></td></tr>
                    </tbody>
                </table>
            </div>
		<?php }  ?>



	</div> <!-- END .theme_info -->

	<?php
}
function education_lms_admin_notice(){
   
	if ( version_compare(PHP_VERSION, '5.4.0') < 0 ) {
		?>
		<div class="warning notice notice-warning notice-alt is-dismissible">
			<p><strong><?php esc_html_e('The Education LMS theme require PHP version 5.4 or greater.', 'education-lms'); ?></strong></p>
		</div>
		<?php
    }

}
function education_lms_one_activation_admin_notice(){
	global $pagenow;
	if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'education_lms_admin_notice' );
	}
}
/* activation notice */
add_action( 'load-themes.php',  'education_lms_one_activation_admin_notice'  );







function education_lms_review_notice(){
	global $pagenow;
	if ( is_admin() && 'themes.php' == $pagenow  ) {
		?>
		<span id="footer-thankyou">
                <?php
                $reviewurl = 'https://wordpress.org/support/theme/education-lms/reviews/#new-post';
                printf( __( 'You have been using <b>Education LMS</b> theme, do you like it? If so, please leave us <a href="%s" target="_blank">a review</a> with your feedback. Thank you!', 'education-lms' ), esc_url( $reviewurl ) );
                ?>
        </span>
		<?php
	}
}
add_filter('admin_footer_text', 'education_lms_review_notice');
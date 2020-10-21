<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Education_LMS
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function education_lms_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if (  is_singular('post') ) {
		$post_layout = esc_attr( get_theme_mod( 'post_layout', 'right-sidebar' ) );
		$classes[]   = $post_layout;
	}



	return $classes;
}
add_filter( 'body_class', 'education_lms_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function education_lms_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'education_lms_pingback_header' );

add_filter( 'get_the_archive_title', function ($title) {

	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() || is_tax() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}
	return $title;

});

function education_lms_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <label for="s">
    	<input type="text" value="' . get_search_query() . '" placeholder="' . esc_attr__( 'Search &hellip;', 'education-lms' ) . '" name="s" id="s" />
    </label>
    <button type="submit" class="search-submit">
        <i class="fa fa-search"></i>
    </button>
    </form>';
	return $form;
}
add_filter( 'get_search_form', 'education_lms_search_form' );

if ( !function_exists('education_lms_titlebar') ) {
	function education_lms_titlebar() {
		global $post;

		$blog_title      = get_theme_mod( 'blog_page_title', 'Blog' );
		$course_page     = absint( education_lms_get_setting( 'courses_page_id' ) );
		$hide_title_bar  = false;
		$hide_breadcrumb = false;
		$page_id         = $post->ID;

	
        
      
		if ( ! is_front_page() && ! $hide_title_bar ) {
			?>
            <div class="titlebar">
                <div class="container">

					<?php
					if ( is_home() || is_singular( 'post' ) ) {
						echo '<h2 class="header-title">' . esc_html( $blog_title ) . '</h2>';
					}
					elseif ( is_singular('product') ) {
						the_title( '<h2 class="header-title">', '</h2>' );
                    }
					elseif ( $course_page == $post->ID ) {
						the_title( '<h1 class="header-title">', '</h1>' );
					}
					elseif ( education_lms_is_wc_shop() ) {
							$shop = get_option( 'woocommerce_shop_page_id' );
							echo '<h2 class="header-title">' . esc_html( get_the_title($shop) ) . '</h2>';
                    }
					elseif ( is_archive() ) {
						the_archive_title( '<h1 class="header-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					}
					else the_title( '<h1 class="header-title">', '</h1>' )

					?>
                    <div class="triangled_colored_separator"></div>
                </div>
            </div>
			<?php
		}
		if ( ! is_front_page() && ! $hide_breadcrumb ) {
			education_lms_breadcrumb();
		}
	}
}
add_action('education_lms_header_titlebar', 'education_lms_titlebar');

/* Custom style */
function education_lms_custom_style(){

	$custom_css = '';

	$primary_color   = esc_attr( get_theme_mod( 'primary_color', '#ffb606' ) );

	$titlebar_bg   = esc_attr( get_theme_mod( 'titlbar_bg_color', '#457992' ) );
	$titlebar_pd_top = absint( get_theme_mod( 'padding_top', 5 ) );
	$titlebar_pd_bottom = absint( get_theme_mod( 'padding_botton', 5 ) );

	$logo_max_width = absint( get_theme_mod( 'logo_max_width', 90 ) );
	$container_max_width = absint( get_theme_mod( 'container_max_width', 1230 ) );

	$menu_sidebar = esc_attr( get_theme_mod( 'menu_display', 'left' ) );

	$cart_color   = esc_attr( get_theme_mod( 'cart_color', '#fff' ) );
	$cart_font_size = absint( get_theme_mod( 'cart_font_size', 14 ) );

	$custom_css .= "
	        button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"],
		    .titlebar .triangled_colored_separator,
		    .widget-area .widget-title::after,
		    .carousel-wrapper h2.title::after,
		    .course-item .course-thumbnail .price,
		    .site-footer .footer-social,
		    .single-lp_course .lp-single-course ul.learn-press-nav-tabs .course-nav.active,
		    .single-lp_course .lp-single-course ul.learn-press-nav-tabs .course-nav:hover,
		    .widget_tag_cloud a:hover,
		    .header-top .header-contact-wrapper .btn-secondary,
            .header-type3 .header-top .header-contact-wrapper .box-icon,
            a.btn-all-courses:hover,
            .course-grid-layout2 .intro-item:before,
            .learnpress .learn-press-pagination .page-numbers > li span,
            .courses-search-widget::after
		     { background: $primary_color; }

            a:hover, a:focus, a:active,
            .main-navigation a:hover,
            .nav-menu ul li.current-menu-item a,
            .nav-menu ul li a:hover,
            .entry-title a:hover,
            .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .main-navigation .current-menu-ancestor > a,
            .entry-meta span i,
            .site-footer a:hover,
            .blog .entry-header .entry-date, .archive .entry-header .entry-date,
            .site-footer .copyright-area span,
            .breadcrumbs a:hover span,
            .carousel-wrapper .slick-arrow:hover:before,
            .recent-post-carousel .post-item .btn-readmore:hover,
            .recent-post-carousel .post-item .recent-news-meta span i,
            .recent-post-carousel .post-item .entry-title a:hover,
            .single-lp_course .course-info li i,
            .search-form .search-submit,
            .header-top .header-contact-wrapper li .box-icon i,
            .course-grid-layout2 .intro-item .all-course a:hover,
            .course-filter div.mixitup-control-active, .course-filter div:hover
            {
                color: $primary_color;
            }

		    .recent-post-carousel .post-item .btn-readmore:hover,
		    .carousel-wrapper .slick-arrow:hover,
		    .single-lp_course .lp-single-course .course-curriculum ul.curriculum-sections .section-header,
		    .widget_tag_cloud a:hover,
            .readmore a:hover,
            a.btn-all-courses,
            .learnpress .learn-press-pagination .page-numbers > li span,
            .course-filter div.mixitup-control-active, .course-filter div:hover {
                border-color: $primary_color;
            }
			.container { max-width: {$container_max_width}px; }
		    .site-branding .site-logo, .site-logo { max-width: {$logo_max_width}px; }
		    
		    .topbar .cart-contents { color: $cart_color; }
		    .topbar .cart-contents i, .topbar .cart-contents { font-size: {$cart_font_size}px; }
	";

	$page_display_cover = false;
	$header_image = get_header_image();
	$page_id = get_the_ID();



    if ( $page_display_cover ) {
        
        $custom_header_image = get_post_meta( $page_id, 'custom_header_image', true );
        if( $custom_header_image ) {
            $custom_image = wp_get_attachment_image_src( $custom_header_image, 'full' );
            $header_image = esc_url( $custom_image[0] );
        } else {
            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
            $header_image = esc_url( $featured_image[0] );
        }
        
       
    }

	$custom_css .= "
		 .titlebar { background-color: $titlebar_bg; padding-top: $titlebar_pd_top%; padding-bottom: $titlebar_pd_bottom%; background-image: url($header_image); background-repeat: no-repeat; background-size: cover; background-position: center center;  }
	";

	if ( $menu_sidebar == 'right' ) {
	    $custom_css .= '.nav-form .nav-content { right: 0; margin-right: -500px; margin-left: auto;} .nav-form.open .nav-content{ margin-right: 0; margin-left: auto; }';
    }
	if ( $menu_sidebar == 'dropdown' ) {
	    $custom_css .= '
	    .nav-form { position: absolute; top: auto; height: auto;}
	    .nav-form .nav-content { width: 100%; height: auto; margin-left: auto; }
	    .nav-form.open .nav-content { margin-left: auto; }
	    .nav-form .nav-spec { padding: 0; border-top: 1px solid #eaeaea; }
	    ';
	}



	return $custom_css;
}


if ( !is_admin() ) {
	function education_lms_custom_excerpt_length( $length ) {
		return 50;
	}
	add_filter( 'excerpt_length', 'education_lms_custom_excerpt_length', 999 );
	function education_lms_excerpt_more( $more ) {
		return '&hellip;';
	}
	add_filter( 'excerpt_more', 'education_lms_excerpt_more' );

}

if ( is_admin() ) {
	function education_lms_remove_learnpress_ads() {
		?>
        <style>
            #learn-press-advertisement { display: none; }
        </style>
        <?php
	}
	add_action( 'admin_footer', 'education_lms_remove_learnpress_ads', 100 );

}


add_action( 'tgmpa_register', 'education_lms_register_required_plugins' );
function education_lms_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'      => esc_html__('Elementor', 'education-lms'),
			'slug'      => 'elementor',
			'required'  => false,
		),

		array(
			'name'      => esc_html__('LearnPress - WordPress LMS Plugin', 'education-lms'),
			'slug'      => 'learnpress',
			'required'  => false,
		),

		array(
			'name'      => esc_html__('LearnPress - Course Review', 'education-lms'),
			'slug'      => 'learnpress-course-review',
			'required'  => false,
		),

		array(
			'name'      => esc_html__('One Click Demo Import', 'education-lms'),
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),


	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'education-lms',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


	);

	tgmpa( $plugins, $config );
}

function education_lms_ocdi_import_files() {
	return array(
		array(
			'import_file_name'             => 'Education LMS Demo Import',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/dummy-data/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/dummy-data/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/dummy-data/customizer.dat'
		)
	);
}
add_filter( 'pt-ocdi/import_files', 'education_lms_ocdi_import_files' );

function education_lms_footer_info() {

   
	    echo sprintf( esc_html__( 'Copyright &copy; %1$s %2$s - %3$s theme by %4$s', 'education-lms' ), date_i18n( __( 'Y', 'education-lms' ) ), '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">' . esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>', '<a target="_blank" href="https://www.filathemes.com/downloads/education-lms">Education LMS</a>', '<span>FilaThemes</span>' );
    
}
add_action( 'education_lms_footer_copyright', 'education_lms_footer_info' );


function education_lms_course_category(){
	$categories = array( 'ALL');
	$course_cat = get_terms( array( 'taxonomy' => 'course_category', 'hide_empty' => false ) );
	if ( ! empty( $course_cat ) && ! is_wp_error( $course_cat ) ) {
		foreach ( $course_cat as $cat ) {
            
            $categories[ $cat->term_id ] = $cat->name;
           
		}
	}

	return $categories;
}

if ( !function_exists('education_lms_site_branding') ) {
    function education_lms_site_branding() {
        ?>
        <div class="site-branding">

            <div class="site-logo">
			    <?php the_custom_logo(); ?>
            </div>

            <div>
			    <?php
			    if ( is_front_page() || is_home() ) :
				    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                              rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				    <?php
			    else :
				    ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                             rel="home"><?php bloginfo( 'name' ); ?></a></p>
				    <?php
			    endif;
			    $education_lms_description = get_bloginfo( 'description', 'display' );
			    if ( $education_lms_description || is_customize_preview() ) :
				    ?>
                    <p class="site-description"><?php echo $education_lms_description; /* WPCS: xss ok. */ ?></p>
			    <?php endif; ?>
            </div>

        </div><!-- .site-branding -->
        <?php
    }
}

if ( !function_exists('education_lms_site_nav') ) {
    function education_lms_site_nav() {
        ?>
        <a href="#" class="mobile-menu" id="mobile-open"><span></span></a>
        <nav id="site-navigation" class="main-navigation">
		    <?php
		    wp_nav_menu( array(
			    'theme_location' => 'menu-1',
			    'menu_id'        => 'primary-menu'
		    ) );
		    ?>
        </nav><!-- #site-navigation -->
        <?php
    }
}

if ( !function_exists('education_lms_header_topbar') ) {
    function education_lms_header_topbar(){
	    $show_topbar        = esc_attr( get_theme_mod( 'show_topbar', '1' ) );
	    $topbar_layout      = esc_attr( get_theme_mod( 'topbar_layout', 'contained' ) );
	    $show_login         = esc_attr( get_theme_mod( 'show_login', '1' ) );
	    $show_register      = esc_attr( get_theme_mod( 'show_register', '1' ) );
	    $show_logout        = esc_attr( get_theme_mod( 'show_logout', '1' ) );
	    $show_wc_cart       = esc_attr( get_theme_mod( 'show_wc_cart', '1' ) );
	    if ( $show_topbar != 1 ) {
		    ?>
            <div class="topbar">
                <div class="<?php echo ( $topbar_layout == 'full' ) ? 'container-fluid' : 'container' ?>">
                    <div class="row">
                        <div class="col-sm-6 topbar-left">
						    <?php if ( is_active_sidebar( 'topbar-left' ) ) : dynamic_sidebar( 'topbar-left' ); endif; ?>
                        </div>
                        <div class="col-sm-6 topbar-right hidden-xs">
						    <?php if ( is_active_sidebar( 'topbar-right' ) ) : dynamic_sidebar( 'topbar-right' ); endif; ?>
                            <div class="header_login_url">
							    <?php if ( ! is_user_logged_in() ) { ?>
								    <?php if ( $show_login != 1 ) { ?>
                                        <a class="login_url" href="<?php echo esc_url( get_theme_mod( 'login_url' ) ) ?>"><i
                                                    class="fa fa-user"></i><?php echo esc_html__( 'Login', 'education-lms' ) ?>
                                        </a>
                                        <span class="vertical_divider"></span>
								    <?php } ?>
								    <?php if ( $show_register != 1 ) { ?>
                                        <a class="register_url" href="<?php echo esc_url( get_theme_mod( 'register_url' ) ) ?>"><?php echo esc_html__( 'Register', 'education-lms' ) ?></a>
								    <?php } ?>
							    <?php } else {
								    if ( $show_logout != 1 ) {
									    echo '<a class="logout_url" href="' . esc_url( wp_logout_url( home_url() ) ) . '">' . esc_html__( 'Logout', 'education-lms' ) . ' <i class="fa fa-sign-out"></i> </a>';
								    }
							    } ?>

							    <?php
							    if ( is_woocommerce_activated() && $show_wc_cart != 1 ) { ?>
                                    <a class="cart-contents" href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>" title="<?php esc_html_e('View your shopping cart', 'education-lms') ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
							    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	    <?php }
    }
}

if ( !function_exists('education_lms_header_1') ) {
	function education_lms_header_1() {
		$header_main_layout = esc_attr( get_theme_mod( 'header_main_layout', 'contained' ) );

		education_lms_header_topbar();
		?>

        <div class="header-default">
            <div class="<?php echo ( $header_main_layout == 'full' ) ? 'container-fluid' : 'container' ?>">
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <?php education_lms_site_branding() ?>
                    </div>

                    <div class="col-lg-8 pull-right">
                        <?php education_lms_site_nav() ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}



/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'education_lms_wc_header_add_to_cart_fragment' );
function education_lms_wc_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
    <a class="cart-contents" href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>" title="<?php esc_html_e('View your shopping cart', 'education-lms') ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
}




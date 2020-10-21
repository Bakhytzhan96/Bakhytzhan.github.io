<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_LMS
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-lms' ); ?></a>

	<header id="masthead" class="site-header">
        <?php education_lms_header() ; ?>
	</header><!-- #masthead -->

    <div class="nav-form ">
        <div class="nav-content">
            <div class="nav-spec">
                <nav class="nav-menu">
                    <?php $menu_sidebar = esc_attr( get_theme_mod( 'menu_display', 'left' ) ); ?>
                    <?php if ($menu_sidebar != 'dropdown') { ?>
                    <div class="mobile-menu nav-is-visible"><span></span></div>
                    <?php } ?>
                    <?php 
                    if ( has_nav_menu( 'menu-1' ) ) { 
                        wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'after' => '<span class="arrow"></span>' ) );
                    } 
                    ?>
                </nav>
            </div>
        </div>
    </div>

    <?php do_action('education_lms_header_titlebar') ; ?>

	<div id="content" class="site-content">
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_LMS
 */

$show_footer_connect    = esc_attr( get_theme_mod( 'hide_footer_social', '1' ) );
$footer_layout    = esc_attr( get_theme_mod( 'footer_width', 'contained' ) );
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php if ( $show_footer_connect != 1 ) { ?>
        <div class="footer-connect">
            <div class="container">
                <div class="footer-social">
                    <label><?php echo esc_html( get_theme_mod('follow_title',  esc_html__('Follow Us', 'education-lms') ) )  ?></label>
                    <?php education_lms_social_media(); ?>
                </div>
            </div>
        </div>
		<?php } ?>

		<div id="footer" class="<?php echo ( $footer_layout == 'full' ) ? 'container-fluid' : 'container' ?>">

			<?php
            ?>

            <?php ?>
            <div class="footer-widgets">
                <div class="row">
                    <div class="col-md-3">
			            <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                    <div class="col-md-3">
			            <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                    <div class="col-md-3">
			            <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                    <div class="col-md-3">
			            <?php dynamic_sidebar('footer-4'); ?>
                    </div>
                </div>
            </div>
            <?php  ?>

            <div class="copyright-area">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="site-info">
	                        <?php do_action( 'education_lms_footer_copyright' ); ?>
                        </div><!-- .site-info -->
                    </div>
                    <div class="col-sm-6">
                        <?php
                        if ( has_nav_menu( 'menu-2' ) ) {
                            wp_nav_menu( array(
                                'theme_location' => 'menu-2',
                                'menu_id'        => 'footer-menu',
                                'menu_class'     => 'pull-right list-unstyled list-inline mb-0'
                            ) );
                        }
                        ?>

                    </div>
                </div>
            </div>

        </div>
	</footer><!-- #colophon -->

    <?php ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

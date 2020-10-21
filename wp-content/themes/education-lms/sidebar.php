<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_LMS
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$sidebar = 'sidebar-1';
?>

<aside id="secondary" class="widget-area col-sm-3">
	<div class="sidebar-inner">
		<?php dynamic_sidebar( $sidebar ); ?>
    </div>
</aside><!-- #secondary -->

<?php
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
$show_date = esc_attr( get_theme_mod('show_date', '1') );
$show_author = esc_attr( get_theme_mod('show_author', '1') );
$show_category = esc_attr( get_theme_mod('show_category', '1') );
$show_tag = esc_attr( get_theme_mod('show_tag', '1') );

$hide_featured_image = false;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<div class="entry-meta">
		<?php
		if ( $show_date != 1 )
		    education_lms_posted_on();
		if ( $show_author != 1 )
		    education_lms_posted_by();
		if ( $show_category != 1 )
		    education_lms_posted_in();
		?>
	</div><!-- .entry-meta -->

    <?php if ( $hide_featured_image == false ) { ?>
	<div class="post-featured-image">
		<a href="<?php the_permalink() ?>">
			<?php the_post_thumbnail('full') ; ?>
		</a>
	</div>
    <?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<div class="row">

			<div class="col-md-12">
				<?php  if ( $show_tag != 1 ) {  education_lms_posted_tag(); } ?>
			</div>

		</div>
	</div>


</article><!-- #post-<?php the_ID(); ?> -->
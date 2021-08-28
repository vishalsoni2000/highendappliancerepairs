<?php
$ban = get_the_ID();
$banner_section = get_field('banner_section');
$image_side_option = $banner_section['inner_banner_image_side_option'];
$banner_content = $banner_section['inner_banner_content'];
$bannerImg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

if(has_post_thumbnail($post->ID)) {
	if( have_rows('banner_section') ):
		while( have_rows('banner_section') ): the_row();
		echo
			(
				($image_side_option == 'right')
				?   '<section class="inner-banner-section section-heading d-flex position-relative">'
				:   '<section class="inner-banner-section section-heading left d-flex position-relative">'
			).
					'<div class="inner-banner-block cell-6 d-992-none"></div>'.
					(
						$banner_content
						? '<div class="inner-banner-content position-absolute "><div class="inner-banner-content-block">'.$banner_content.'</div></div>'
						: ''
					).
					(
						(has_post_thumbnail($post->ID))
						? '<div class="inner-banner-img cell-6 cell-992-12">'.wp_image( get_post_thumbnail_id( $post->ID ), 'full' ).'</div>'
						: '<div class="inner-banner-img"><img src="'.get_template_directory_uri().'/images/placeholder-image.jpg" /></div>'
					).
			(
				($image_side_option == 'right')
				?   '</section>'
				:   '</section>'
			);
		endwhile;
	endif;
}

?>

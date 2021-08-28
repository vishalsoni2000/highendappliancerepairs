<?php
$ban = get_the_ID();
$service_detail = get_field('service_detail');
$image_side_option = $service_detail['image_position'];
$service_detail_image = $service_detail['service_detail_image'];
$service_detail_content = $service_detail['service_detail_content'];

if( have_rows('service_detail') ):
	while( have_rows('service_detail') ): the_row();
	echo
  		(
  			($image_side_option == 'right')
  			?   '<section class="inner-banner-section d-flex position-relative overflow-hidden">'
  			:   '<section class="inner-banner-section left d-flex position-relative overflow-hidden">'
  		).
  		'<div class="inner-banner-block cell-6 cell-767-12"></div>'.
  		(
  			$service_detail_content
  			? '<div class="inner-banner-content position-absolute aos-init" data-aos="fade-left"><div class="inner-banner-content-block">'.$service_detail_content.'</div></div>'
  			: ''
  		).
  		(
  			$service_detail_image
  			? '<div class="inner-banner-img cell-6 cell-767-12">'.wp_image( $service_detail_image, 'full' ).'</div>'
  			: '<div class="inner-banner-img"><img src="'.get_template_directory_uri().'/images/placeholder-image.jpg" /></div>'
  		).
  		(
  			($image_side_option == 'right')
  			?   '</section>'
  			:   '</section>'
  		);
	endwhile;
endif;
?>

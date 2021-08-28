<?php
/**  banner area part */
if(have_rows('banner', 'options') ){
	function homeBanner() {
		/** banner common options */
		$banner_common_options = get_field('banner_common_options', 'options');
		$select_arrow_style = $banner_common_options[ 'select_arrow_style' ];
		$select_pagination_style = $banner_common_options[ 'select_pagination_style' ];
		$banner_arrow_on_button = $banner_common_options[ 'banner_arrow_on_button' ];
		$banner_image_animation = $banner_common_options[ 'banner_image_zoom-in-out_animation' ];

		/** banner mobile options */
		$banner_mobile_options = get_field( 'banner_mobile_options', 'options' );
		$single_slide_on_mobile = $banner_mobile_options[ 'single_slide_on_mobile' ];
		$remove_animation_from_mobile = $banner_mobile_options[ 'remove_animation_from_mobile' ];
		$select_banner_slide_for_mobile = $banner_mobile_options[ 'select_banner_slide_for_mobile' ];
		$differentiate_image_and_content_in_mobile = $banner_mobile_options[ 'differentiate_image_and_content_in_mobile' ];

		/** banner slider counter */
		$totalSlides = count(get_field('banner', 'options'));
		$sliderCounter = 1 ;
		ob_start();
		echo '<section class="banner position-relative image-bg before-image-right ' . ( my_wp_is_mobile() == 1 && $single_slide_on_mobile == 1 ? ' yes-mobile ' : ' run-slider ' ) . ( my_wp_is_mobile() == 1 && $differentiate_image_and_content_in_mobile == 1 ? ' static-content ' : ' ' ) . $select_arrow_style . ' ' . $select_pagination_style . ' ">' .
			'<div class="home-slider position-relative">';
			while(have_rows('banner', 'options') ) :
				the_row();

				/** banner image */
				$bannerImage = get_sub_field('banner_image', 'options');
				$select_banner_image = $bannerImage[ 'select_banner_image' ];
				$banner_image_size = $bannerImage[ 'banner_image_size' ];
				$banner_image_position = $bannerImage[ 'banner_image_position' ];
				if( !empty( $banner_image_position ) ) { $banner_image_position = implode( ' ', $banner_image_position ); }
				$select_banner_Mobileimage = $bannerImage[ 'banner_mobile_image' ];

				if(my_wp_is_mobile() == 1 && $select_banner_Mobileimage) {
					$select_banner_image = $select_banner_Mobileimage;
				}

				/** banner content */
				$bannerContent = get_sub_field('banner_content', 'options');
				$mainBannerTitle = $bannerContent['main_banner_title'];
				$bannerSubtitle = $bannerContent['banner_subtitle'];
				$bannerLink = $bannerContent['banner_button'];
				if( !empty($bannerLink) ){
					$bannerLinkURL = $bannerLink['url'];
					$bannerLinkTitle = $bannerLink['title'];
					$bannerLinkTarget = $bannerLink['target'] ? 'target="_blank"' : ' ';
				}

				/** banner style */
				$bannerStyle = get_sub_field('banner_style', 'options');
				$bannerContentMode = $bannerStyle[ 'banner_content_mode' ];
				$verticalMode = $bannerStyle[ 'vertical_mode' ];
				//if( !empty( $verticalMode ) ) { $verticalMode = implode( ' ', $verticalMode ); }
				$bannerAnimation = $bannerStyle['banner_animation'];
				$bannerTextAlignment =  $bannerStyle['banner_text_alignment'];
				if( !empty( $bannerTextAlignment ) ){ $bannerTextAlignment = implode( ' ', $bannerTextAlignment ); }
				$bannerBlockAlignment = $bannerStyle['banner_block_alignment'];
				if( !empty( $bannerBlockAlignment ) ) { $bannerBlockAlignment = implode( ' ', $bannerBlockAlignment ); }
				$bannerBlockWidth = $bannerStyle['banner_block_width'];
				if ( !empty( $bannerBlockWidth ) ) { $bannerBlockWidth = implode( ' ', $bannerBlockWidth ); }

				if( my_wp_is_mobile() == 1 && $single_slide_on_mobile == 1 ){
					/** for mobile only code */
					if( $sliderCounter == $select_banner_slide_for_mobile ){
						echo '<div class="home__single--slide h-100 position-relative cell-12  ">' .
							(
								$select_banner_image
								? '<div class="home__single--slide-image ' . ( $banner_image_animation == 1 ? ( $remove_animation_from_mobile != 1 ? ' banner-image-animation ' : '' ) : '' ) . ' cell-12 ' . ( $differentiate_image_and_content_in_mobile == 1 ? ' ' : ' h-100 position-absolute pin-t pin-l ' ) . ' ">' .
									'<div class="single-slider d-flex innbaner h-100 ">' .
										(
											$select_banner_Mobileimage
											? '<img src="' . wp_get_attachment_url( $select_banner_Mobileimage, 'large' ) . '" class="  object-fit  cell-12 h-100 ' . $banner_image_size . ' ' . ( $banner_image_position ? $banner_image_position : '' ) . ' " />'
											: '<img src="' . wp_get_attachment_url( $select_banner_image, 'full' ) . '" class="  object-fit  cell-12 h-100 ' . $banner_image_size . ' ' . ( $banner_image_position ? $banner_image_position : '' ) . ' " />'
										) .
									'</div>' .
								'</div>'
								: ''
							) .
							(
								!empty( $mainBannerTitle || $bannerSubtitle || $bannerLink )
								? '<div class="home__single--slide-content position-relative ' . ( $differentiate_image_and_content_in_mobile == 1 ? ' mobile-static-content ' : ' h-100 ' ) . ' p-20 ' . $bannerAnimation . ( $remove_animation_from_mobile == 1 ? ' no-mobile-animation ' : ' mobile-show '  ) . ' ">' .
									'<div class="' . ( $bannerContentMode ? $bannerContentMode : '' ) . ' h-100 d-flex ' . $verticalMode . '">' .
										'<div class="d-flex cell-12 ' . ( $bannerBlockAlignment ? $bannerBlockAlignment : '' ) . '">' .
											'<div class="banner-content-wrapper position-relative ' . ( $bannerBlockWidth ? $bannerBlockWidth : '' ) . ' ' . $bannerTextAlignment . '">' .
												// main banner title
												( $mainBannerTitle ? '<h2 class="h1 mb-10 banner-main-title text-white position-relative">' . $mainBannerTitle . '</h2>' : '' ) .
												// Banner Sub Title
												( $bannerSubtitle ? '<h4 class="banner-sub-title text-white font-normal">' . $bannerSubtitle . '</h4>' : '' ) .
												// Banner Button
												(
													!empty( $bannerLink )
													? '<a href="' . $bannerLinkURL . '"
													class="read-more hvr-pulse position-relative "
													' . $bannerLinkTarget . ' >' .
														'<span>' .
															$bannerLinkTitle .
														'</span>' .
													'</a>'
													: ''
												).
											'</div>' .
										'</div>' .
									'</div>' .
								'</div>'
								: ''
							) .
						'</div>';
					}
				} else {
					/** for mobile as well as desktop code */
					global $calIcon;
					echo '<div class="home__single--slide h-100 position-relative cell-12 ">' .
						(
							$select_banner_image
							? '<div class="home__single--slide-image cell-12 ' . ( $banner_image_animation == 1 ? ( my_wp_is_mobile() == 1 ? ( $remove_animation_from_mobile != 1 ? ' banner-image-animation ' : '' ) : ' banner-image-animation '  )  : ' ' ) . ( my_wp_is_mobile() == 1 && $differentiate_image_and_content_in_mobile == 1 ? ' ' : ' h-100 position-absolute pin-t pin-l ' ) . '">' .
								'<div class="single-slider d-flex innbaner h-100 ">' .
									'<img ' . ( my_wp_is_mobile() == 'ie11' || $totalSlides == 1 ? 'src="' . wp_get_attachment_url( $select_banner_image, 'full' ) . '"' : 'data-lazy="' . wp_get_attachment_url( $select_banner_image, 'full' ) . '"' ) . '  class="  ' . $banner_image_size . ' ' . ( $banner_image_position ? $banner_image_position : '' ) . ( my_wp_is_mobile() == 'ie11' ? ' skip-lazy ' : ' object-fit  cell-12 h-100 ' ) . ' " />' .
								'</div>' .
							'</div>'
							: ''
						) .
						(
							!empty( $mainBannerTitle || $bannerSubtitle || $bannerLink )
							? '<div class="home__single--slide-content position-relative  p-20 ' . $bannerAnimation . ( $remove_animation_from_mobile == 1 ? ' no-mobile-animation ' : ( my_wp_is_mobile() == 1 ? ' mobile-show ' : ' ' )  ) . ( my_wp_is_mobile() == 1 && $differentiate_image_and_content_in_mobile == 1 ? ' mobile-static-content ' : ' h-100 ' ) . ' ">' .
								'<div class="' . ( $bannerContentMode ? $bannerContentMode : '' ) . ' h-100 d-flex ' . $verticalMode . '">' .
									'<div class="d-flex cell-12 ' . ( $bannerBlockAlignment ? $bannerBlockAlignment : '' ) . '">' .
										'<div class="banner-content-wrapper position-relative ' . ( $bannerBlockWidth ? $bannerBlockWidth : '' ) . ' ' . $bannerTextAlignment . '">' .
											// main banner title
											( $mainBannerTitle ? '<h2 class="h1 mb-10 banner-main-title text-white position-relative">' . $mainBannerTitle . '</h2>' : '' ) .
											// Banner Sub Title
											( $bannerSubtitle ? '<h4 class="banner-sub-title text-white font-normal">' . $bannerSubtitle . '</h4>' : '' ) .
											// Banner Button
											(
												!empty( $bannerLink )
												? '<a href="' . $bannerLinkURL . '"
												class="read-more hvr-pulse call-btn position-relative ' . ( $banner_arrow_on_button ? ' has-arrow ' : ' ' ) . '"
												' . $bannerLinkTarget . ' >' .
													(
														$banner_arrow_on_button && my_wp_is_mobile() != 1
														? wp_get_attachment_image( $banner_arrow_on_button, 'full', '', array( 'class'=>'btn-arrow' ) )
														: ' '
													) .
													'<span>' .
														$calIcon . '  ' . $bannerLinkTitle .
													'</span>' .
												'</a>'
												: ''
											) .
										'</div>' .
									'</div>' .
								'</div>' .
							'</div>'
							: ''
						) .
					'</div>';
				}
			$sliderCounter++;
			endwhile;
			wp_reset_query();
			wp_reset_postdata();
				echo '</div>' .
		'</section>';
		return ob_get_clean();
	}
	echo homeBanner();
}
?>

<?php
/**
* Template Name: Intallationa Page
*/
get_header();

    /** Banner Section */
    if ( have_posts() ) {
		while ( have_posts() ) { the_post();
		$bannerImg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		// content
			echo
			(
				(has_post_thumbnail())
				? '<section class="inner-banner-page"><img src="'.$bannerImg[0].'"/></section>'
				: ''
			);
		} // end while
	wp_reset_postdata();
	} // end if
    /** -- end -- */

    /** Installation service */
    if ( have_posts() ) {
	    echo '<section class="section-heading installation-section section-padding text-center">'.
	    	'<div class="wrapper">'.
	    		'<div class="installation-wrap p-50 px-767-20 py-767-30 bg-white position-relative">';
	    			while ( have_posts() ) { the_post();
	    				the_content();
				    } // end while
					wp_reset_postdata();
					if( have_rows('installation_section') ):
					while( have_rows('installation_section') ): the_row();
					$installation_service_title = get_sub_field('installation_service_section_title');
					$include_title = get_sub_field('installation_service_include_title');
					$installation_cta = get_sub_field('installation_service_cta');
						echo '<div class="installation-service">'.
							'<h2>'.$installation_service_title.'</h2>'.
							'<div class="installation-service-block d-flex align-items-center justify-content-between justify-767-content-center pb-30">';
							if( have_rows('installation_service') ):
								while( have_rows('installation_service') ): the_row();
									$service_icon = get_sub_field('installation_service_icon');
									$service_title = get_sub_field('installation_service_title');
									echo
									'<div class="installation-service-item p-10">'.
										(
											$service_icon
											? wp_image($service_icon)
											: ''
										).
										(
											$service_title
											? '<p class="mt-10 font-bold">'.$service_title.'</p>'
											: ''
										).
									'</div>';
								endwhile;
								wp_reset_postdata();
							endif;
							echo '</div>'.
						'</div>'.
						'<div class="installation-service-include p-30 p-767-15 bg-brand-primary-light">'.
							'<h2>'.$include_title.'</h2>'.
							'<ul class="installation-include-block text-left px-30 px-640-5 mx-auto mb-0">';
							if( have_rows('installation_service_include') ):
								while( have_rows('installation_service_include') ): the_row();
									$service_list = get_sub_field('installation_service_include_list');
									echo
									(
										$service_list
										? '<li>'.$service_list.'</li>'
										: ''
									);
								endwhile;
								wp_reset_postdata();
							endif;
							echo '</ul>'.
		    			'</div>'.
		    			'<div class="installation-contact">'.
		    				(
		    					$installation_cta
		    					? '<p class="font-bold my-15">'.$installation_cta.'</p>'
		    					: ''
		    				).
		    			'</div>';
		    		endwhile;
					wp_reset_postdata();
					endif;
	    		echo '</div>'.
	    	'</div>'.
	    '</section>';
	}

    /** Our Brand */
    get_template_part( 'template-parts/parts-our', 'brands' );

    /** Our Testimonials */
    get_template_part( 'template-parts/parts', 'testimonials' );

get_footer();

?>

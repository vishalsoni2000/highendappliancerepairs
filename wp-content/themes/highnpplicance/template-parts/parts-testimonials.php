<?php

wp_enqueue_style('our-testimonials');

$testimonials = get_field('our_testimonials','options');
if( have_rows('our_testimonials','options') ) {
	while ( have_rows('our_testimonials','options') ) : the_row();
		echo '<section class="section testimonials-section position-relative overflow-hidden d-block " '. (get_sub_field('testimonial_bg_image','options') ? 'style="background-image:url('. get_sub_field('testimonial_bg_image','options') .')"' : '') .'>' .
		'<div class="wrapper position-relative">' .
        (
          get_sub_field('testimonial_heading','options')
          ? '<h2 class="text-center text-white mb-767-10">'. get_sub_field('testimonial_heading','options') .'</h2>'
          : ''
        ) ;

  		$posts = get_sub_field('select_testimonials','options');
  		if( $posts ) {
  			echo '<div class="testimonials-slider aos-init" data-aos="fade-left" data-aos-duration="1000">' .
  				'<div class="slider-wrapper ">';
  				foreach( $posts as $post):
  				setup_postdata($post);
  					echo '<div class="single-testimonial p-10">' .
							'<div class="description" data-match-height="2">'.
									'<div class="start-icon pb-5"><img src="'. get_template_directory_uri() .'/images/star-icon.png" class="pb-20"></div>'.
									'<div class="d-inline-block pb-20">'.
			  						'<span>“</span>'.
										(
			  							has_excerpt()
			  							? apply_filters( 'the_content', get_the_excerpt() )
			  							: apply_filters( 'the_content', wp_trim_words( get_the_content(), 70 ) )
			  						) .
										'<span>”</span>'.
									'</div>'.
		  						(
		  							get_the_title()
		  							? '<span>- ' . get_the_title() . '</span>'
		  							: ''
		  						) .
								'</div>'.
  					'</div>';
  				endforeach;
  			echo '</div>' .
  			 '</div>';
  		}

      $link = get_sub_field('review_link','options');
      if( $link ) {
          echo '<div class="testimonial-button text-center pt-20">
					<span class="review-icon d-block pt-10"><a href="'. esc_url( $link ) .'" target="_blank"><img src="'. get_template_directory_uri() .'/images/review-testimonial.png" /></a></span>
					</div>';
        }
    echo '</div>' .
		'</section>';
	endwhile; wp_reset_query();
}
?>

<?php

if( have_rows('our_specialty') ):
    while( have_rows('our_specialty') ): the_row();

		if(get_sub_field('our_specialty_heading')) {
			echo '<section class="our-more-services specialty-section">'.
					'<div class="wrapper entry">'.
							'<h2 class="text-center pb-20">'. get_sub_field('our_specialty_heading') .'</h2>';

							if( have_rows('our_specialty_listing') ) {
									echo '<ul class="more-services mb-0">';
										while( have_rows('our_specialty_listing') ):the_row();
												echo '<li class="font-bold"><p>'. get_sub_field('specialty') .'</p></li>';
										endwhile;
									echo '</ul>';

                  echo general_appointment_buttton();
							}
					echo '</div>'.
			'</section>';
		}
endwhile;
endif;

?>

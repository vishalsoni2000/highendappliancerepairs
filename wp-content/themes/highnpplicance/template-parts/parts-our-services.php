<?php

if( have_rows('our_services') ):
    while( have_rows('our_services') ): the_row();

    $column_count = get_sub_field('column_count');

		if(get_sub_field('our_services_heading')) {
			echo '<section class="our-more-services '. ($column_count == 'four' ? 'bg-brand-primary four-column ' : 'three-column') .'">'.
					'<div class="wrapper entry">'.
							'<h2 class="text-center pb-20 pb-767-0 '. ($column_count == 'four' ? 'text-white' : '') .'">'. get_sub_field('our_services_heading') .'</h2>';

							if( have_rows('our_services_listing') ) {
									echo '<ul class="more-services mb-0">';
										while( have_rows('our_services_listing') ):the_row();
												echo '<li class="font-bold"><p>'. get_sub_field('service') .'</p></li>';
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

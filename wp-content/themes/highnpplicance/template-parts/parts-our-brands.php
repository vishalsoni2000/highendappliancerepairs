<?php

wp_enqueue_style('our-brands');

if( have_rows('our_brands','options') ) {
  while(have_rows('our_brands','options')):the_row();
    echo '<section class="our-brands-section">'.
        '<div class="wrapper">'.
            (
                get_sub_field('our_brand_heading','options')
                ? '<h2 class="text-center pb-20 pb-767-0">'. get_sub_field('our_brand_heading','options') .'</h2>'
                : ''
            );
            if( have_rows('our_brand_logos','options') ) {
              echo '<ul class="our-logos list-none">';
                while(have_rows('our_brand_logos','options')):the_row();
                    echo '<li class="p-10 cell-4 text-center">'.
                      ( get_sub_field('logo_link','options') ? '<a class="h-100" href="'. get_sub_field('logo_link','options') .'" target="_blank">' : '' ) .
                        '<div class="logo d-flex align-items-center h-100 innbaner image-src">'.
                          wp_image(get_sub_field('logo','options')) .
                        '</div>'.
                      ( get_sub_field('logo_link','options') ? '</a>' : '' ) .
                    '</li>';
                endwhile;
              echo '</ul>';
            }
        echo '</div>'.
    '</section>';
  endwhile;
}

?>

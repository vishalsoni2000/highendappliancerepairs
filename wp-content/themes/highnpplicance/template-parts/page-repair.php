<?php
/**
* Template Name: Repair Page
*/
get_header();

    /** Inner Banner */
    get_template_part( 'template-parts/inner', 'banner' );

    /** Our Brand */
    get_template_part( 'template-parts/parts-our', 'brands' );

    /** Repair Service Section */
    if( have_rows('repair_section') ):
    echo '<section class="section-heading section-padding repair-section overflow-hidden">'.
        '<div class="wrapper">'.
            '<div class="repair-section-wrap d-flex align-items-stretch pt-20">';
                while( have_rows('repair_section') ): the_row();
                    $repair_img = get_sub_field('repair_section_image');
                    $repair_title = get_sub_field('repair_section_title');
                    $repair_desc = get_sub_field('repair_section_desc');
                    echo '<div class="repair-service-block p-15 cell-6 cell-767-12 mb-30 p-640-0 aos-init" data-aos="fade-up" data-aos-duration="1000">'.
                        '<div class="repair-service-item bg-white">'.
                            (
                                $repair_img
                                ? wp_image($repair_img)
                                : ''
                            ).
                            (
                                ($repair_title || $repair_desc)
                                ? '<div class="repair-service-content pt-20 pb-30 px-30 px-767-15" data-match-height="repair-service-content">'.
                                    (
                                        $repair_title
                                        ? '<h2>'.$repair_title.'</h2>'
                                        : ''
                                    ).
                                    (
                                        $repair_desc
                                        ? '<p>'.$repair_desc.'</p>'
                                        : ''
                                    ).
                                  '</div>'
                                : ''
                            ).
                        '</div>'.
                    '</div>';
                endwhile;
                wp_reset_postdata();
            echo '</div>'.
        '</div>'.
    '</section>';
    endif;

    /** Repair Alternating Section */
    if( have_rows('repair_alternating_section') ):
    echo '<section class="section-heading repair-alternating-section">';
        while( have_rows('repair_alternating_section') ): the_row();
            $repair_alternating_img = get_sub_field('repair_alternating_section_image');
            $repair_alternating_content = get_sub_field('repair_alternating_section_content');
            $repair_cta = get_sub_field('repair_alternating_section_cta');
            $alternating_img = $repair_alternating_img['url'];
            echo '<div class="repair-alternating-wrap d-flex align-items-stretch">'.
                (
                    !empty( $repair_alternating_img )
                    ? '<div class="repair-alternating-image cell-6 cell-992-12" style="background-image: url(' . $alternating_img . ');background-size: cover;"></div>'
                    : ''
                );
                if($repair_alternating_content) {
                  echo '<div class="repair-alternating-content cell-6 cell-992-12">'.
                  $repair_alternating_content;

                  global $calIcon;
                  if ($repair_cta) {
                      $repair_cta_url = $repair_cta['url'];
                      $repair_cta_title = $repair_cta['title'];
                      $repair_cta_target = $repair_cta['target'] ? $repair_cta['target'] : '_self';
                      echo '<div class="appt-btn"><a class="read-more hvr-pulse " href="' . esc_url($repair_cta_url) . '" target="' . esc_attr($repair_cta_target) . '"><span>' . $calIcon . '  '  . esc_html($repair_cta_title) . '</span></a></div>';
                  }
                  echo '</div>';
                }
            echo '</div>';
        endwhile;
        wp_reset_postdata();
    echo '</section>';
    endif;

    /** Our Testimonials */
    get_template_part( 'template-parts/parts', 'testimonials' );

get_footer();
?>

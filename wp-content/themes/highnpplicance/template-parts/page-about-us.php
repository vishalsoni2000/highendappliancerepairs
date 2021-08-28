<?php
/**
* Template Name: About Page
*/
get_header();

/** Inner Banner */
get_template_part( 'template-parts/inner', 'banner' );

/** Our Specialty */
get_template_part( 'template-parts/parts', 'our-specialty' );

/** Service Detail */
get_template_part( 'template-parts/parts', 'service-detail' );

/** Our Services */
get_template_part( 'template-parts/parts', 'our-services' );

/** Our Brand */
get_template_part( 'template-parts/parts-our', 'brands' );

/** Our Testimonials */
get_template_part( 'template-parts/parts', 'testimonials' );

get_footer();
?>

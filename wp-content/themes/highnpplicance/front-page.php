<?php
/*
Template Name: Front Page
*/
/** header */
get_header();


/** banner */
get_template_part( 'template-parts/parts-front', 'banner' );

/** Works */
get_template_part( 'template-parts/parts', 'works' );

/** Service Detail */
get_template_part( 'template-parts/parts', 'service-detail' );

/** Our Brands */
get_template_part( 'template-parts/parts', 'our-brands' );

/** Our Services */
get_template_part( 'template-parts/parts', 'our-services' );

/** Our Services */
get_template_part( 'template-parts/parts', 'testimonials' );

/** footer */
get_footer();

?>

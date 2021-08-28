<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>

</div><!-- #content -->
</div><!-- #page -->

<?php
echo '<footer id="" class="site-footer cell-12 height-auto position-relative d-block">'.
      '<div class="footer-contact">'.
        '<div class="wrapper d-flex align-items-center justify-content-between position-relative">' .
         brand_logo() .
          '<div class="quick-links d-flex justify-content-end cell-12 height-auto">'.
              '<ul class="contact-links d-flex align-items-center justify-content-between m-0 p-0 list-none ">'.
                  '<li class="address">'. do_shortcode('[location-address]').'</li>'.
                  '<li class="hours">'. do_shortcode('[location-hours]').'</li>'.
                  '<li class="phone">'. do_shortcode('[location-phone]').'</li>'.
              '</ul>'.
          '</div>' .
          general_appointment_buttton() .
        '</div>'.
      '</div>'.
      '<div class="footer-social text-center">'.
        '<div class="wrapper">'.
            '<h2>Connect & Follow</h2>'.
            social_media_options() .
        '</div>'.
      '</div>'.
      '<div class="footer-last copyright-block pt-20 pb-20 text-center">' .
        '<div class="wrapper">' .
        '<div class="left-part">' .
            (
                get_field('copyright', 'options')
                ? '<div class="copyright">' . get_field('copyright', 'options') . '</div>'
                : ''
            ) .
        '</div>' .
    '</div>' .
'</div>' ; ?>

</footer><!-- #colophon -->

<?php

wp_footer();
?>
</body>
</html>

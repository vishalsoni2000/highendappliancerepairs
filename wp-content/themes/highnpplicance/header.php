<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>  >
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>
       <?php
       /** mobile navigation */
       echo '<div class="mobile_menu d-none">' .
            '<a class="close-btn" href="#"></a>' .
            '<div class="mob-appntmtn">' .
              general_appointment_buttton() .
            '</div>' .
            '<div class="inner">' .
                main_navigation() .
            '</div>' .
       '</div>';
       ?>

        <div id="wrapper" class="<?php
                    // if( is_front_page() ){
                    //     echo ' sticky-header';
                    // }
            ?>">


            <?php
                /** Brand Logo Function Start */
                function brand_logo(){
                    ob_start();
                    if( has_custom_logo() ) {
                        $desktopBrandLogoID = get_theme_mod( 'custom_logo' ); //Desktop Main brand Logo ID
                        $desktopBrandLogoImage = wp_get_attachment_image( $desktopBrandLogoID , 'large', '', ["class" => "large-logo transition"] ); //Desktop Main brand Logo Image
                        echo '<div class="header-logo position-relative height-auto transition twidth">' .
                            '<a href="' . get_option('home') . '" class="cell-12 transition position-relative">' .
                                ( $desktopBrandLogoID ? $desktopBrandLogoImage : '' ) .
                            '</a>' .
                        '</div>';
                    }
                    return ob_get_clean();
                }
                /** Brand Logo Function End */

                global $phoneIcon;

                echo '<header id="myHeader" class=" d-block cell-12 transition">' .
                  '<div class="header-top pb-20 pb-767-15">'.
                    '<div class="wrapper d-flex align-items-center justify-content-between position-relative">' .
                     brand_logo() .
                      '<div class="quick-links d-flex justify-content-end cell-12 height-auto">'.
                          '<ul class="contact-links d-flex align-items-center justify-content-between m-0 p-0 list-none ">'.
                              '<li class="address">'. do_shortcode('[location-address]').'</li>'.
                              '<li class="hours">'. do_shortcode('[location-hours]').'</li>'.
                              '<li class="phone">'. do_shortcode('[location-phone]').'</li>'.
                              '<li class="call d-none d-767-block"><a href="tel:'. get_field('phone_mobile', 'options') .'">'. $phoneIcon .'</a></li>'.
                          '</ul>'.
                         '<a class="navbar-toggle" href="javascript:void(0)"><span class="navbar-toggle__icon-bar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </span> </a>'.
                      '</div>' .
                    '</div>'.
                  '</div>'.
                '</header>' .
                    (
                        my_wp_is_mobile() == 1
                        ? ''
                        : '<div class="main-navigation cell-12 height-auto d-block position-relative transition">' .
                          '<div class="wrapper">'.
                              (
                                  has_nav_menu( 'main-navigation' )
                                  ? '<nav id="site-navigation" class="" aria-label="' . esc_attr( 'Top Menu', 'twentynineteen' ) . '">' .
                                    main_navigation() .
                                 '</nav>'
                                  : ''
                              ) .
                            '</div>' .
                        '</div>'
                    ) .
            // '</header>' .

            '<div id="content-area" class="">';

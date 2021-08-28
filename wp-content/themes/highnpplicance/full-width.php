<?php
/**
 * The template for displaying all single posts
 template name: Full Width
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
global $contentBanner;
if ( has_post_thumbnail() ){
    if( 'Top' == get_field( 'banner_position_new' ) ) {
        echo '<div class="innbaner">' . featureImageOverlay() . get_the_post_thumbnail() . '</div>';
    } elseif( 'yes' == get_field('feature_image_placement_globally','options') && 'Content' != get_field('banner_position_new') ) {
        echo '<div class="innbaner">' . featureImageOverlay() . get_the_post_thumbnail() . '</div>';
    } else {
        $contentBanner = 'true';
    }
}
echo '<div class="content">';
        if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<div id="breadcrumbs " class="breadcrumbs"><div class="wrapper"><div class="inner-bc"','</div></div></div>' );
        }
        echo '<div class="wrapper">' .
                '<div class="mid ' . ( function_exists('yoast_breadcrumb') ? 'no-left-radius' : '' ) . '">' .
                (
                    $contentBanner == 'true'
                    ? '<div class="content-banner ' . $contentBanner . ' ">' . get_the_post_thumbnail() . '</div>'
                    : ''
                ) .
                '<div class="post" id="post-' . get_the_ID() .'">';
                        if (have_posts()) : while (have_posts()) : the_post();
						$customTitle = get_field( 'custom_title_services_pages' );
						$titlePlacement = get_field( 'replace_with_main_title' );
							echo (
								$customTitle
								? ( $titlePlacement == 1 ? '<h1>' . $customTitle . '</h1>' : '<h1>' . get_the_title() . '</h1>' )
								: '<h1>' . get_the_title() . '</h1>'
							) .
						 	'<div class="entry">' .
								(
									$customTitle
									? ( $titlePlacement != 1 ? '<h2>' . $customTitle . '</h2>' : '' )
									: ''
								);
                                $term = get_field('service_testimonial');
                                if( $term != '' ) {
                                //  echo 'count'. count($term);
                                    $posts_array = get_posts(
                                        array(
                                            'posts_per_page' => -1,
                                            'post_type' => 'testimonial',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'test_cats',
                                                    'field' => 'term_id',
                                                    'terms' => $term->term_id,
                                                )
                                            )
                                        )
                                    );
                                }
                                if($term != '' && count($posts_array) > 0) {
                                echo '<div class="testimonial-post"><div class="slider-post">';
                                    foreach ($posts_array as $mypost) {
                                        echo '<div class="single-testimonials">' .
                                            '<h5>' . $mypost->post_title . '</h5>' .
                                            $mypost->post_content . '<br><br>' .
                                            '</div>';
                                    }
                                echo '</div></div>';
                                }
                                the_content();
                                wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
                            echo '</div>';
                           endwhile;
                        echo '</div>';
                        edit_post_link('Edit this entry.', '<p>', '</p>');
                    echo '</div>';

                echo '</div>' .
            '</div>';
        endif;
get_footer();

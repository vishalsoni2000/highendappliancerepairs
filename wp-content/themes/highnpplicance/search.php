<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();

get_template_part( 'template-parts/inner', 'banner' );

    echo '<div class="content">';
	    echo '<div class="wrapper">' .
        '<div class="mid blog-listing">' .
        '<h1> Search Result: ' . get_search_query() . '</h1>';
        get_header('blog');
		if ( have_posts() ) :

			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				//get_template_part( 'template-parts/content/content', 'excerpt' );
                echo '<div class="'. join( 'post listing-single-post ', get_post_class() ) .'" id="post-'. get_the_ID() .'">' .
                    (
                        has_post_thumbnail()
                        ? '<div class="blog-image position-relative">' .
                            wp_get_attachment_image( get_post_thumbnail_id(), 'large' ) .
                            '<span class="date-with-svg position-absolute pin-t-20 pin-l-20">' .
                                '<svg> <use xlink:href="#date-svg" /> </svg>' .
                                '<span class="cal-month">' . get_the_time('M') . '</span>' .
                                '<span class="cal-date transform-center">' . get_the_time('j') . '<sup>' . get_the_time('S') . '</sup> ' . '</span>' .
                                '<span class="cal-year">' . get_the_time('Y') . '</span>' .
                            '</span>' .
                        '</div>'
                        : ''
                    ) .
                    '<h3><a href="' . get_the_permalink() . '" rel="bookmark" title="Permanent Link to '. get_the_title() .'">' . get_the_title() . '</a></h3>' .
                    (
                        has_post_thumbnail()
                        ? ''
                        : '<span class="date-with-svg">' .
                            '<svg> <use xlink:href="#date-svg" /> </svg>' .
                            '<span class="cal-month">' . get_the_time('M') . '</span>' .
                            '<span class="cal-date transform-center">' . get_the_time('j') . '<sup>' . get_the_time('S') . '</sup> ' . '</span>' .
                            '<span class="cal-year">' . get_the_time('Y') . '</span>' .
                        '</span>'
                    ) .
	            	'<div class="entry"><p>' .  get_the_excerpt() . '</p></div>' .
                '</div>' ;
				// End the loop.
			endwhile;

			// Previous/next page navigation.
			twentynineteen_the_posts_navigation();




			// If no content, include the "No posts found" template.
		else :
			//get_template_part( 'template-parts/content/content', 'none' );
            echo 'No Post Found for "' . get_search_query() . '" please try another keyword';

		endif;

		echo '</div>';
		echo '</div>' .
		'</div>';


get_footer();

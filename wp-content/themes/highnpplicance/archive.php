<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();

echo '<div class="content">'.
  get_template_part( 'template-parts/inner', 'banner' );
	if (have_posts()) :
	$post = $posts[0]; // Hack. Set $post so that the_date() works.
    $cat = get_query_var('cat');

$current_tag = single_tag_title("", false);
	echo '<div class="wrapper">' .
	    '<div class="mid blog-listing">';
            $page_for_posts = get_option( 'page_for_posts' ); ?>
            <h1>Category: <?php single_term_title() ;?></h1>
	      	<?php get_header('blog');
            if (have_posts()) :

			while (have_posts()) : the_post();
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
             endwhile;
        twentynineteen_the_posts_navigation();
	else :
        echo '<h2 class="center">Not Found</h2>';
        echo '<p class="center">Sorry, but you are looking for something that isnt here.</p>';
        get_search_form();
	endif;
	    echo '</div>';

	    else :

			if ( is_category() ) { // If this is a category archive
	            printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
	        } else if ( is_date() ) { // If this is a date archive
	            echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
	        } else if ( is_author() ) { // If this is a category archive
	            $userdata = get_userdatabylogin(get_query_var('author_name'));
	            printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
	        } else {
	          echo("<h2 class='center'>No posts found.</h2>");
	        }
	            //get_search_form();
	endif;
	echo '</div>';
echo '</div>';

get_footer();

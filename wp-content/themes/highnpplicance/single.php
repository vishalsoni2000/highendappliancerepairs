<?php
/**
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<!-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script> -->
<!-- <script type="text/javascript">
  addthis.layers({
    'recommended' : {},
    // This will disable the Thank You Layer
    'thankyou' : false
  });
</script> -->
<?php
get_header();

get_template_part( 'template-parts/inner', 'banner' );

echo '<div class="content">';
	   echo '<div class="wrapper">' .
	        '<div class="mid blog-details">';
	       		if (have_posts()) :
	            while (have_posts()) : the_post(); ?>
	             	<div <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>'">
	             		<?php echo '<h1>' . get_the_title() . '</h1>';
                        echo
                        (
                            has_post_thumbnail()
                            ? '<div class="post-img position-relative">' .
                                wp_get_attachment_image( get_post_thumbnail_id(), 'large' ) .
                                '<span class="date-with-svg position-absolute pin-t-20 pin-l-20">' .
                                    '<svg> <use xlink:href="#date-svg" /> </svg>' .
                                    '<span class="cal-month">' . get_the_time('M') . '</span>' .
                                    '<span class="cal-date transform-center">' . get_the_time('j') . '<sup>' . get_the_time('S') . '</sup> ' . '</span>' .
                                    '<span class="cal-year">' . get_the_time('Y') . '</span>' .
                                '</span>' .
                            '</div>'
                            : '<span class="date-with-svg">' .
                                '<svg> <use xlink:href="#date-svg" /> </svg>' .
                                '<span class="cal-month">' . get_the_time('M') . '</span>' .
                                '<span class="cal-date transform-center">' . get_the_time('j') . '<sup>' . get_the_time('S') . '</sup> ' . '</span>' .
                                '<span class="cal-year">' . get_the_time('Y') . '</span>' .
                            '</span>'
                        ) .
                        '<div class="entry">';
	            	        the_content('<p class="serif">Read the rest of this entry </p>');
                     		wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
                    		the_tags( '<p>Tags: ', ', ', '</p>');
			            echo '</div>';
	            	echo '</div>';
	            endwhile; else :
	            	echo '<p>Sorry, no posts matched your criteria.</p>';
	            endif;
	        echo '</div>';
	    echo '</div>';
echo '</div>';


get_footer();

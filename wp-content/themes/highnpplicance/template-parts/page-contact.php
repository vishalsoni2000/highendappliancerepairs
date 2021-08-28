<?php
/**
* @package WordPress
* @subpackage Default_Theme
template name: Contact Page
*/
get_header();

if (has_post_thumbnail( $post->ID ) ):
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	echo '<section class="contact-banner position-relative d-flex align-items-end" style="background-image: url('. $image[0] .');">'.
		'<div class="wrapper position-relative">'.
			'<div class="contact-title">'.
				'<h1 class="text-white text-uppercase">' . get_the_title() . '</h1>' .
			'</div>'.
		'</div>'.
	'</section>';
endif;

global $phoneIcon;
echo '<section class="contact-content">'.
	'<div class="wrapper">'.
		'<div class="contanct-form">'.
			(
					get_field('contact_title')
					? '<h2 class="text-white mb-10">'. get_field('contact_title') .'</h2>'
					: ''
			).
			(
					get_field('contact_links')
					? '<div class="cantact-links"><span>Call &nbsp;</span>' . $phoneIcon . '&nbsp;' . get_field('contact_links') .'</div>'
					: ''
			);
			while (have_posts()) : the_post();
				the_content('<p class="serif">Read the rest of this page &raquo;</p>');
			endwhile;
		echo '</div>';
		edit_post_link('Edit this entry.', '<p>', '</p>');
	echo '</div>'.
'</section>';

get_footer();

?>

<?php
$work_group = get_field('work_group');
$work_title = $work_group['work_title'];
$work_tagline = $work_group['work_tagline'];

if( have_rows('work_group') ):
	while( have_rows('work_group') ): the_row();
	 echo '<section class="work-section text-568-center">'.
        '<div class="wrapper">'.
          (
            $work_title
            ? '<h1 class="h2 text-center pb-20 pb-767-0">'. $work_title .'</h1>'
            : ''
          );

          if( have_rows('work_listing') ):
            echo '<ul class="work-listing list-none d-flex pb-30 justify-1024-content-center pb-767-0">';
                while ( have_rows('work_listing') ) : the_row();
                    $title = get_sub_field('title');
                    $icon = get_sub_field('icon');
                    $content = get_sub_field('content');

                    echo '<li class="single-item cell-4 cell-1024-6 cell-767-12 d-flex justify-content-between align-767-content-center justify-568-content-center">'.
                        (
                          $icon
                          ? '<div class="icon-block d-flex justify-content-center align-items-center">' . wp_icon($icon) . '</div>'
                          : ''
                        );
                        if($content) {
                          echo '<div class="content-block">'.
                            (
                              $title
                              ? '<h3 class="mb-10">'. $title .'</h3>'
                              : ''
                            ).
                            (
                              $content
                              ? $content
                              : ''
                            ).
                          '</div>';
                        }
                    '</li>';
                endwhile;
              echo '</ul>';
          endif;

          echo (
            $work_tagline
            ? '<div class="tagline text-center">'. $work_tagline .'</div>'
            : ''
          ) .
        '</div>'.
    '</section>';
  endwhile;
endif;
?>

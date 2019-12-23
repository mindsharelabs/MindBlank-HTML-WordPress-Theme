<?php get_header();
include 'layout/top-header.php';
include 'layout/brand.php';

if(have_posts()) :
  echo '<div class="container pt-0 pt-md-4">';
  while(have_posts()) :

    echo '<div class="row">';
      echo '<div class="col-12">';
        the_content();
        mapi_post_edit();
      echo '</div>';
    echo '</div>';

  endwhile;
  echo '</div>';
endif;

include 'layout/top-footer.php';
get_footer();

<?php
get_header();
if(have_posts()) :
  echo '<div class="container">';
    echo '<div class="row">';
      echo '<div class="col-12">';
      while(have_posts()) :
        the_post();
          the_content();
      endwhile;
      echo '</div>';
    echo '</div>';
  echo '</div>';
endif;
get_footer();

<?php
get_header();

if(have_posts()) :
  echo '<div role="main" aria-label="Content" class="container">';
    echo '<div class="row">';
      echo '<article id="page-' . get_the_id() . '" class="' . esc_attr( implode( ' ', get_post_class( 'col-12', $post->ID ) ) )  . '" itemscope="" itemtype="http://schema.org/Article">';

      while(have_posts()) :
        the_post();
          the_content();
      endwhile;

      echo '</div>';
    echo '</div>';
  echo '</div>';
endif;
get_footer();

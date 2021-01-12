<?php
if (has_post_thumbnail()) :
  if(wp_is_mobile()) :
    $image_url = aq_resize(get_the_post_thumbnail_url(), 560, 1300, true, true);
  else :
    $image_url = aq_resize(get_the_post_thumbnail_url(), 1600, 750, true, true);
  endif;
  $background = 'style="background-image: url(' . $image_url . ')"';
else :
  $background = null;
endif;




echo '<header class="blog-header bg-light pt-5 pb-5 mb-4" ' . $background . '>';
  echo '<div class="container pt-5 pb-5">';
    echo '<div class="row">';
      echo '<div class="col-12">';

      if ( is_front_page() && is_home() ) :
        // Default homepage

      elseif ( is_front_page()) :
        // Static homepage

      elseif ( is_home()) :
        // Blog page

      else :
        // Everything else
        echo '<div class="header-title w-100">';
          echo '<h1 class="highlight display-4 text-uppercase ' . ($background ? 'text-white' : '') .'">' . get_the_title() . '</h1>';
        echo '</div>';
      endif;


      echo '</div>';
    echo '</div>';
  echo '</div>';
echo '</header>';

<?php
if (has_post_thumbnail()) :
  $image_url = aq_resize(get_the_post_thumbnail_url(), 1300, 400, true, true);
  $background = 'style="background-image: url(' . $image_url . ')"';
else :
  $background = null;
endif;

echo '<header class="blog-header bg-primary mt-3 pt-5 pb-5 mb-4" ' . $background . '>';
  echo '<div class="container pt-5 pb-5">';
    echo '<div class="row">';
      echo '<div class="col-12 text-center">';
        echo '<h1 class="display-4 text-white">' . get_the_title() . '</h1>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
echo '</header>';

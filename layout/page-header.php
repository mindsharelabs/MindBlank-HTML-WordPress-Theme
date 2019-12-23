<?php
echo '<header class="blog-header bg-primary pt-5 pb-5 mb-4">';
  echo '<div class="container pt-5 pb-5">';
    echo '<div class="row">';
      echo '<div class="col-12 text-center">';
        echo '<h1 class="display-4 text-white">' . get_the_title() . '</h1>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
echo '</header>';

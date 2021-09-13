<?php
$s_query = get_search_query();
echo '<section class="archive-header">';

  echo '<div class="container py-5">';
    echo '<div class="row">';
      echo '<div class="col-12 my-auto">';
        echo '<h1 class="page-title text-white">' . printf( ' Search Results for: %s', get_search_query()) . '</h1>';
      echo '</div>';
    echo '</div>';
  echo '</div>';

echo '</section>';

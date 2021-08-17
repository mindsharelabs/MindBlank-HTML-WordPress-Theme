<?php
if (has_post_thumbnail()) :
  if(wp_is_mobile()) :
    $f_image = get_the_post_thumbnail_url( get_option( 'page_for_posts' ), 'page-header');
  else :
    $f_image = get_the_post_thumbnail_url( get_option( 'page_for_posts' ), 'page-header-short');
  endif;
else :
  $f_image = null;
endif;

if ( is_front_page() && is_home() ) :
  // Default homepage
  $title = get_bloginfo('name');
elseif ( is_front_page()) :
  // Static homepage
  $title = get_bloginfo('name');
elseif ( is_home()) :
  // Blog page
  $title = get_the_title( get_option( 'page_for_posts' ) );
else :
  // Everything else
  $title = get_the_title(get_the_id());
  echo '<section class="brand">';
    echo '<div class="container py-5">';
      echo '<div class="row">';
        echo '<div class="col-12 my-auto">';
          echo '<h1 class="page-title">' . $title . '</h1>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  echo '</section>';
endif;

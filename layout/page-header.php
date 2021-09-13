<?php
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

  if (has_post_thumbnail()) :
    if(wp_is_mobile()) :
      $f_image = get_the_post_thumbnail_url( get_the_id(), 'page-header');
    else :
      $f_image = get_the_post_thumbnail_url( get_the_id(), 'page-header-short');
    endif;
  else :
    $f_image = null;
  endif;


  $title = get_the_title(get_the_id());
  $subtitle = get_field('subtitle');

  echo '<section class="brand ' . ($f_image ? 'has-background' : '') . '" ' . ($f_image ? 'style="background-image:url(' . $f_image . ')"' : '') . '>';
    echo '<div class="container">';
      echo '<div class="row">';
        echo '<div class="col-12 col-xl-9">';
          echo '<h1 class="page-title">' . $title . '</h1>';
          echo ($subtitle ? '<h2 class="sub-title">' . $subtitle  . '</h1>' : '');
        echo '</div>';
      echo '</div>';
    echo '</div>';
  echo '</section>';

endif;

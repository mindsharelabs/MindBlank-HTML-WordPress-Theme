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
?>
<style>
section.brand {
  background: linear-gradient(90deg, rgba(214, 212, 172, <?php echo ($f_image ? '0.7' : 1); ?>), rgba(138, 141, 127,<?php echo ($f_image ? '0.9' : 1); ?>)), url("<?php echo $f_image; ?>");
}
</style>
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
  $title = get_the_title(get_the_id());
endif;

echo '<section class="brand">';
  echo '<div class="container py-5">';
    echo '<div class="row">';
      echo '<div class="col-12 my-auto">';
        echo '<h1 class="page-title text-white">' . $title . '</h1>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
echo '</section>';

<?php
get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
<main role="main" aria-label="Content" <?php post_class(); ?>>
  <?php
  

  echo '<section class="blog">';
    echo '<div class="container">';
      echo '<div class="row pt-5">';
        if(have_posts()) :
          while(have_posts()) : the_post();
            get_template_part( 'loop-post' );
          endwhile;
        else :
          '<h3 class="text-center">There\'s nothin\' here.</h3>';
        endif;
      echo '</div>';
      get_template_part('pagination');
    echo '</div>';
  echo '</section>';
  ?>
</main>
<?php include 'layout/top-footer.php';
get_footer();

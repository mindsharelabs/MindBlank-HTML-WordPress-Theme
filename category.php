<?php get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>

<main role="main" aria-label="Content" <?php post_class(); ?>>
  <section class="container blog">
    <div class="row">
      <div class="col">
        <h2 class="section-title"><?php _e('Posted in ', 'mindblank'); single_cat_title(); ?></h2>
        <div class="row">
          <?php
          $object = get_queried_object();
          while (have_posts()) : the_post();
            get_template_part('loop-' . $object->taxonomy);
          endwhile;
          ?>
      </div>
    </div>
  </div>
  <?php get_template_part('pagination'); ?>
</section>

<!-- /section -->
</main>


<?php include 'layout/top-footer.php';
get_footer();

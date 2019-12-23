<?php
get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
<main role="main" aria-label="Content" <?php post_class('container'); ?>>
  <section class="row blog">
    <div class="col-12">
      <h2 class="section-title"><?php the_archive_title(); ?></h2>
    </div>
    <div class="row">
    <?php
      $post_type = get_post_type();
      $post_type_obj = get_post_type_object($post_type);
      while (have_posts()) : the_post();
        get_template_part('loop-' . $post_type_obj->name);
      endwhile;
      ?>
    </div>
    <div class="row">
      <?php get_template_part('pagination'); ?>
    </div>
  </section>
</main>
<?php include 'layout/top-footer.php';
get_footer();

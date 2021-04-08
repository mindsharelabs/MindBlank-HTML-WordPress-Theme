<?php get_header();
?>

<main role="main" aria-label="Content">
  <?php include 'layout/archive-header.php'; ?>
  <section <?php post_class('container'); ?>>
    <div class="row">
      <?php
      $object = get_queried_object();
      while (have_posts()) : the_post();
        get_template_part('loop-post');
      endwhile;
      ?>
      </div>
      <?php get_template_part('pagination'); ?>
    </div>
  </section>
</main>
<?php
get_footer();

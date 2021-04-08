<?php
get_header();
?>
<main role="main" aria-label="Content">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php the_content(); ?>
      <?php comments_template(); ?>
    </article>
  <?php endwhile; endif; ?>
</main>
<?php
get_footer();

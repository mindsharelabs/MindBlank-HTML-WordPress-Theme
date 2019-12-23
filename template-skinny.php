<?php
//Template Name: Skinny Single Column
get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
<main role="main" aria-label="Content">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <?php include 'layout/page-header.php'; ?>
  <section class="container">
    <div class="row">
      <section class="col-12 col-md-8 offset-0 offset-md-2">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php the_content(); ?>
          <?php comments_template('', true); // Remove if you don't want comments ?>
          <br class="clear">
          <?php mapi_post_edit(); // Always handy to have Edit Post Links available ?>
        </article>

      </section>
    </div>
  </section>
  <?php endwhile; endif; ?>
</main>
<?php
include 'layout/top-footer.php';
get_footer();

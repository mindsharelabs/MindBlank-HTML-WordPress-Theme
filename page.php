<?php
get_header();
include 'layout/top-header.php';
?>
<main role="main" aria-label="Content" class="container">
    <div class="row">
      <section class="col-12 col-md-9">
        <h1><?php the_title(); ?></h1>
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php the_content(); ?>
            <?php comments_template('', true); // Remove if you don't want comments ?>
            <br class="clear">
            <?php edit_post_link('Edit this Page', '', '', null, 'btn btn-warning'); // Always handy to have Edit Post Links available ?>
          </article>

        <?php endwhile; endif; ?>
      </section>
      <?php get_sidebar(); ?>
    </div>
  </div>
</main>
<?php
include 'layout/top-footer.php';
get_footer();

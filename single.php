<?php
get_header();
include 'layout/top-header.php';
if(have_posts()) : while(have_posts()) : the_post(); ?>
  <main role="main" aria-label="Content" <?php post_class(); ?>>
    <?php include 'layout/page-header.php'; ?>

    <section class="container">
      <article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
        <div class="col-12 col-md-8 offset-0 offset-md-2">
          <?php the_content(); ?>
          <p><?php the_tags(__('Tags: ', 'mindblank'), ', '); ?></p>
          <p><?php _e('Categorised in: ', 'mindblank');the_category(', '); // Separated by commas ?></p>
          <hr>
          <?php mapi_post_edit(); // Always handy to have Edit Post Links available ?>
        </div>
      </article>
    </section>
  </main>
<?php endwhile; endif;

include 'layout/top-footer.php';
get_footer();

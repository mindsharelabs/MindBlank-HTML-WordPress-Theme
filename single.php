<?php
get_header();
include 'layout/top-header.php';
if(have_posts()) : while(have_posts()) : the_post(); ?>
  <main role="main" aria-label="Content" <?php post_class(); ?>>
    <?php include 'layout/page-header.php'; ?>

    <section class="container">
      <article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
        <div class="col-12 col-md-10 offset-md-1">
          <?php
          if (has_post_thumbnail()) :
            echo'<div class="row">';
              echo'<div class="col-12">';
              $attr = array('echo' => false,);
              $image_url = aq_resize(get_the_post_thumbnail_url(), 300, 400, true, true);
                echo '<a href="' . get_the_permalink() . '" title="' . the_title_attribute($attr) . '" class="single-thumb">';
                  echo '<img src="' . $image_url . '"  title="' . the_title_attribute($attr) . '" alt="' . the_title_attribute($attr) . '">';
                echo '</a>';
              echo'</div>';
            echo'</div>';
          endif;
          ?>
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

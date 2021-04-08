<?php
get_header();
if(have_posts()) : while(have_posts()) : the_post(); ?>
  <main role="main" aria-label="Content">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_content(); ?>
    </article>
  </main>
<?php endwhile; endif;

get_footer();

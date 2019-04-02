<?php
get_header();
include 'layout/top-header.php';
if(have_posts()) : while(have_posts()) : the_post(); ?>
  <main role="main" aria-label="Content" <?php post_class('container'); ?>>
    <div class="row mt-3">
      <div class="col-12 col-md-10 offset-md-1">
        <h1 class="my-auto text-center"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
        <div class="date text-center w-100">
            <time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
                <span class="month"><?php the_time('F'); ?></span>
                <span class="day"><?php the_time('j'); ?></span>
            </time>
        </div>
      </div>
    </div>
    <hr class="space">
    <section class="row">
      <article id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-10 offset-md-1'); ?>>
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
        <?php edit_post_link('Edit this Post', '', '', null, 'btn btn-warning'); // Always handy to have Edit Post Links available ?>
      </article>
    </section>
  </main>
<?php endwhile; endif;

include 'layout/top-footer.php';
get_footer();

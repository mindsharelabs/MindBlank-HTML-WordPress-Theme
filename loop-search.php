<article id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-4 mb-3'); ?>>
  <div class="card d-flex flex-column h-100">
    <div class="card-body">
      <h3 class="section-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h3>
      <?php the_excerpt(); ?>
    </div>
    <div class="p-2 text-center card-footer">
      <a href="<?php the_permalink(); ?>">Read More <i class="fal fa-arrow-right"></i></a>
    </div>
  </div>
</article>

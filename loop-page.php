<?php
if (has_post_thumbnail()) :
  $image = get_the_post_thumbnail_url();
  $image_url = aq_resize($image, 300, 150, true);
endif;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-4 mb-3'); ?>>
  <div class="card d-flex flex-column h-100">
    <?php if(isset($image_url)) : ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <img class="card-img-top" src="<?php echo $image_url; ?>" alt="<?php the_title_attribute(); ?>">
      </a>
    <?php endif; ?>
    <div class="card-body">
      <h3 class="section-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h3>
      <span class="posted-date">
        <time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
		   </span>
      <span class="author-name"><?php echo get_the_author(); ?></span>
      <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="btn btn-block btn-primary">Read More</a>
  </div>
</article>

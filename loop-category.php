<?php
if (has_post_thumbnail()) :
  $image = get_the_post_thumbnail_url();
  $image_url = aq_resize($image, 300, 150, true);
endif;
$cats = wp_get_post_categories(get_the_id(), array('fields' => 'id=>name', 'number' => 10));
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-4 mb-3'); ?>>
  <div class="card d-flex flex-column h-100">
    <?php if(isset($image_url)) : ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <img class="card-img-top" src="<?php echo $image_url; ?>" alt="<?php the_title_attribute(); ?>">
      </a>
    <?php endif; ?>
    <div class="card-body">
      <span class="posted-date">
        <time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
		   </span>
      <h3 class="section-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h3>
      <span class="author-name">Written by: <?php echo get_the_author(); ?></span>
      <?php
      if(count($cats) > 0) :
        echo '<div class="categories mb-2 w-100">';
        foreach ($cats as $key => $cat) :
          echo '<small class="text-muted pr-2">';
            echo '<a href="' . get_term_link($key, 'category') . '" title="' . $cat . '">' . $cat . '</a>';
          echo '</small>';
        endforeach;
        echo '</div>';
      endif;

      the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="btn btn-block btn-primary mt-auto">Read More</a>
  </div>
</article>

<?php
if ( is_front_page() && is_home() ) :
  // Default homepage
  $f_image = get_the_post_thumbnail_url( get_the_id(), 'page-header');
elseif ( is_front_page()) :
  // Static homepage
  $f_image = get_the_post_thumbnail_url( get_the_id(), 'page-header');
elseif ( is_home()) :
  // Blog page
  $f_image = get_the_post_thumbnail_url( get_option( 'page_for_posts' ), 'page-header-short');
else :
  // Everything else
  $f_image = get_the_post_thumbnail_url( get_the_id(), 'page-header');
endif;

 ?>

<style>
section.brand {
  background-image: linear-gradient(90deg, rgba(214, 212, 172, <?php echo ($f_image ? '0.7' : 1); ?>), rgba(138, 141, 127,<?php echo ($f_image ? '0.7' : 1); ?>)), url('<?php echo $f_image; ?>');
}
</style>
<section class="brand">
  <div class="container py-5">
    <div class="row py-5">
      <div class="col-12 col-md-6 offset-0 offset-md-6 text-md-left my-auto blog-description">
        <h1 class="m-0 pt-5 blog-description text-white"><?php echo html_entity_decode(get_bloginfo('description'));; ?></h1>
      </div>
    </div>
  </div>
</section>

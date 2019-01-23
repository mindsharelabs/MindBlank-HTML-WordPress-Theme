<?php get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>

<div class="container">
  <h1>Class List</h1>
  <main role="main" aria-label="Content" <?php post_class('row'); ?>>
    <section class="col-9 facetwp-template">
      <?php while ( have_posts() ) : the_post(); ?>
           <div class="col-12" itemscope itemtype="http://schema.org/Course">
             <?php
               if(has_post_thumbnail()) {
                 $thumb = get_the_post_thumbnail_url( get_the_id(), 'full');
                 $image = aq_resize($thumb, 150, 150);
               } else {
                 $default = get_template_directory_uri() . '/img/mmw-default.jpg';
                 $image = aq_resize($default, 150, 150);
               }
               ?>
               <div>
                 <span itemprop="provider" style="display:none;">Molten Metal Works</span>
                 <div itemprop="image" class="archive-featured-img">
                   <?php echo '<img" src="' . $image . '"/>'; ?>
                 </div>
                 <div class="archive-title">
                   <h2 itemprop="name"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                   <div itemprop="description" class="entry-content">
                     <?php $summary = get_field('executive_summary'); ?>
                       <?php if ($summary) : ?>
                         <p><?php echo $summary; ?></p>
                       <?php endif; ?>
                   </div>
                 </div>
               </div>
             </div>
       <?php endwhile; ?>
    </section>
    <?php get_sidebar('class'); ?>
  </main>
  <?php echo facetwp_display( 'pager', 'true' ); ?>
</div>

<?php get_footer(); ?>

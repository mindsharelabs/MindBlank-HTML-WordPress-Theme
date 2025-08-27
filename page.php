<?php get_header();?>

<main id="primary" class="site-main container">
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <?php $classes = get_post_class( 'entry row' ); ?>

    <article id="post-<?php the_ID(); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
      <header class="entry-header">
        <h1 class="entry-title wp-block-post-title"><?php the_title(); ?></h1>
      </header>

      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; ?>
<?php endif; ?>
</main>

<?php get_footer();
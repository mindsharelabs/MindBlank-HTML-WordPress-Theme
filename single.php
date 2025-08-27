<?php get_header(); ?>

<main id="primary" class="site-main container py-5">
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <?php $classes = get_post_class( 'entry row' ); ?>

    <article id="post-<?php the_ID(); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
      <header class="entry-header mb-4">
        <h1 class="entry-title wp-block-post-title mb-3"><?php the_title(); ?></h1>
        <div class="entry-meta text-muted small">
          <span class="me-3">
            <i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?>
          </span>
          <span class="me-3">
            <i class="fas fa-user"></i> <?php the_author_posts_link(); ?>
          </span>
          <span class="me-3">
            <i class="fas fa-folder-open"></i> <?php the_category(', '); ?>
          </span>
          <?php if ( get_the_tags() ) : ?>
            <span>
              <i class="fas fa-tags"></i> <?php the_tags( '', ', ' ); ?>
            </span>
          <?php endif; ?>
        </div>
      </header>

      <div class="entry-content mb-4 col-12">
        <?php the_content(); ?>
      </div>

      <footer class="entry-footer border-top pt-3 mt-4">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="post-navigation mb-2">
            <?php previous_post_link('<span class="me-3">&laquo; %link</span>'); ?>
            <?php next_post_link('<span>%link &raquo;</span>'); ?>
          </div>
          <div class="post-edit-link">
            <?php edit_post_link( __( 'Edit', 'mindblank' ), '<span class="btn btn-sm btn-outline-secondary">', '</span>' ); ?>
          </div>
        </div>
      </footer>
    </article>
  <?php endwhile; ?>
<?php endif; ?>
</main>

<?php get_footer();
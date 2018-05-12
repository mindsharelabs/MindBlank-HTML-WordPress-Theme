<?php get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
<main role="main" aria-label="Content" class="container">
    <div class="row">
        <div class="col-xs-12 col-md-9">

            <!-- section -->
            <section>

                <h1><?php the_title(); ?></h1>

                <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                    <!-- article -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php the_content(); ?>

                        <?php comments_template('', true); // Remove if you don't want comments ?>

                        <br class="clear">

                        <?php edit_post_link(); ?>

                    </article>
                    <!-- /article -->

                <?php endwhile; ?>

                <?php else: ?>

                    <!-- article -->
                    <article>

                        <h2><?php _e('Sorry, nothing to display.', 'mindblank'); ?></h2>

                    </article>
                    <!-- /article -->

                <?php endif; ?>

            </section>
        </div>
        <?php get_sidebar(); ?>
    </div>
            <!-- /section -->
</main>

<?php include 'layout/top-footer.php';
get_footer();

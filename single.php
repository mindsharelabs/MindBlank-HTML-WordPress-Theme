<?php get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
    <main role="main" aria-label="Content" <?php post_class('container'); ?>>
        <div class="row">
            <div class="col-md-10 offset-md-1 col-12">
                <div class="row">
                    <div class="col-2">
                        <!-- post details -->
                        <div class="date">
                            <time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
                                <span class="month"><?php the_time('F'); ?></span>
                                <span class="day"><?php the_time('j'); ?></span>
                            </time>
                        </div>

                    </div>
                    <div class="col-10">
                        <h1>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h1>
                        <span class="author"><?php _e('Published by ', 'mindblank'); ?><?php the_author_posts_link(); ?></span>
                    </div>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="row">
                        <div class="col-12">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="single-thumb">
                                <?php
                                $image = get_the_post_thumbnail_url();
                                $image_url = aq_resize($image, 1000, 300, true, true);
                                ?>
                                <img src="<?php echo $image_url; ?>"  title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-7 offset-md-1 col-12">

                <!-- section -->
                <section>
                    <!-- article -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php the_content(); ?>

                        <p><?php the_tags(__('Tags: ', 'mindblank'), ', '); ?></p>

                        <p><?php _e('Categorised in: ', 'mindblank');the_category(', '); // Separated by commas ?></p>

                        <?php edit_post_link('Edit this Article', '', '', null, 'btn btn-warning'); // Always handy to have Edit Post Links available ?>



                    </article>
                    <!-- /article -->
                </section>
            </div>
            <?php get_sidebar(); ?>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
                <?php comments_template(); ?>
            </div>
        </div>
        <!-- /section -->
    </main>

<?php include 'layout/top-footer.php';
get_footer();

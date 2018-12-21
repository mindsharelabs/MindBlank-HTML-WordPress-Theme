<?php get_header();
include 'layout/top-header.php';
include 'layout/brand.php';
?>
    <main role="main" aria-label="Content" class="container">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <section class="container blog">
                    <div class="row">
                        <div class="col">
                           
                            <div class="row">
                                <?php
                                $types = array('product', 'page', 'posts');

                                foreach ($types as $type) :

                                    $posts = new WP_Query(
                                        array(
                                            's' => $s_query,            // search query
                                            'post_type' => $type,
                                            'posts_per_page' => -1,     // posts per page
                                        )
                                    );

                                    if ($posts->have_posts()) :
                                      $found = true;
                                        $post_type = get_post_type_object($type);

                                        $post_type_label = $post_type->labels->singular_name;


                                        echo '<div class="row"><div class="col"><h3 class="search-label">';
                                              echo sprintf('%s ' . $post_type_label . ' Results for ', $posts->found_posts) . $s_query;
                                        echo '</h3></div></div>';


                                        echo '<div class="row">';
                                          while($posts->have_posts()) : $posts->the_post();
                                            get_template_part('loop');
                                          endwhile;
                                        echo '</div>';

                                    endif; //End if Have Posts

                                endforeach; //End foreach post type

                                if(!$found){
                                  echo '<div class="row"><div class="col"><h3 class="search-label">';
                                      echo sprintf('%s Results for ', $posts->found_posts) . $s_query;
                                  echo '</h3></div></div>';
                                }
                                
                                
                                
                                
                                
                                
                                ?>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php get_sidebar(); ?>
        </div>
        <!-- /section -->
    </main>


<?php include 'layout/top-footer.php';
get_footer();

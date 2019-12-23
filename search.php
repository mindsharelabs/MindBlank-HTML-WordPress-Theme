<?php
get_header();
include 'layout/top-header.php';
$s_query = get_search_query();
?>
  <main role="main" aria-label="Content" class="container">
    <section class="container blog">
      <div class="row">
              <?php
              $types = array('page', 'post', 'example-post-type'); //add searchable posts types here
              $found = false;
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
                  echo '<div class="col-12"><h3 class="search-label"><hr>';
                    echo sprintf('%s ' . $post_type_label . ' result(s) for ', $posts->found_posts) . '"' . $s_query . '"';
                  echo '</h3></div>';
                  while($posts->have_posts()) : $posts->the_post();
                    get_template_part('loop-' . $type); //make sure there is a file named loop-[post type].php that gets used for all archive templates.
                  endwhile;
                endif; //End if Have Posts

              endforeach; //End foreach post type

              if(!$found){
                echo '<div class="col"><h3 class="search-label">';
                  echo sprintf('%s Results for ', $posts->found_posts) . '"' . $s_query . '"';
                echo '</h3></div>';
              }
              ?>
      </div>
    </section>
  </main>


<?php
include 'layout/top-footer.php';
get_footer();

<?php
get_header();
if(have_posts()) :
    $classes = get_post_class( 'container', get_the_ID());
    echo '<article class="' . implode(' ', $classes) . '">';
        echo '<div class="row">';
            echo '<div class="col-12">';
                echo '<h1 class="page-title">' . get_the_title() . '</h1>';
            echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        
            while(have_posts()) : the_post();
                the_content();
            endwhile;
        
        echo '</div>';
    echo '</article>';
else :
    echo '<div class="container">';
        echo '<div class="row">';
            echo '<div class="col">';
                echo '<h2>There is nothing here.</h2>';
            echo '</div>';
        echo '</div>';
    echo '</div>';    
endif;


get_footer();
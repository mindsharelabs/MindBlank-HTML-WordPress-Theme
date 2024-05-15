<?php
get_header();

echo '<div class="container">';
    echo '<div class="row gy-4">';
    if(have_posts()) :
        while(have_posts()) : the_post();
            get_template_part( 'template-parts/loop', get_post_type(get_the_id()));
        endwhile;
        get_template_part( 'template-parts/pagination');
    endif;
    echo '</div>';
echo '</div>';



get_footer();
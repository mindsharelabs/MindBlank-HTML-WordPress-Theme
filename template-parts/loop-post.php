<?php
echo '<div class="col-12 col-md-6 col-lg-4">';
    echo '<div class="card d-flex flex-column justify-content-between h-100">';
        echo '<img src="'.get_the_post_thumbnail_url().'" class="card-img-top" alt="'.get_the_title().'">';
        echo '<div class="card-body">';
            echo '<h5 class="card-title">'.get_the_title().'</h5>';
            echo '<p class="card-text">'.get_the_excerpt().'</p>';
            echo '<a href="'.get_the_permalink().'" class="btn btn-primary">Read More</a>';
        echo '</div>';
    echo '</div>';
echo '</div>';
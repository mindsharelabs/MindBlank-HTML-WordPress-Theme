<?php

/**
 * Post Repeater
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'post-repeater-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'post-repeater';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$post_repeater = get_field('post_repeater');

$cards = new WP_Query(array(
  'post_type' => $post_repeater['post_type'],
  'posts_per_page' => $post_repeater['posts_per_page']
));

if($cards->have_posts()) :
  echo '<div class="container my-5 ' . $className . '" id="' . $id .'">';
    echo '<div class="row">';

    while ($cards->have_posts()) :
      $cards->the_post();


        if($post_repeater['post_type'] == 'staff') :
          echo '<div class="col-6 col-md-2">';
            echo '<div class="staff-card">';
              echo '<a href="' . get_permalink(get_the_id()) . '" title="' . the_title_attribute( array('echo' => false)) . '">';
                the_post_thumbnail( 'thumbnail', array('class' => 'rounded-circle'));
              echo '</a>';
              echo '<div class="card-body px-0 pt-2 text-center">';
                echo '<a href="' . get_permalink(get_the_id()) . '" title="' . the_title_attribute( array('echo' => false)) . '">';
                  echo '<h3 class="staff-name">' . get_the_title(get_the_id()) . '</h3>';
                  echo '<h4 class="staff-title">' . get_field('title', get_the_id()) . '</h4>';
                echo '</a>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        else :
          echo '<div class="col-12 col-md-4">';
            echo '<div class="card">';
              if(has_post_thumbnail()) :
                echo '<a href="' . get_permalink( ) . '" title="' . get_the_title( ) .'">';
                  the_post_thumbnail( 'medium', array('class'=> 'card-img-top'));
                echo '</a>';
              endif;
              echo '<div class="card-body">';
                echo '<h3>' . get_the_title() . '</h3>';
                echo '<p>' . get_the_excerpt( ) . '</p>';
              echo '</div>';
              echo '<div class="card-footer">';
                echo '<a href="' . get_permalink( ) . '" title="' . get_the_title( ) .'">Read More  <i class="fal fa-angle-right"></i></a>';
              echo '</div>';
            echo '</div>';
          echo '</div>';

        endif;
      endwhile;

    echo '</div>';
  echo '</div>';
endif;

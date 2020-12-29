<?php

/**
 * Region Map
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'region-map-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'region-map';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if($is_preview) :
  echo '<div class="preview-block"><p>Region map will appear here.</p></div>';
else :
  echo '<div id="map" class="map ' . $className . '"></div>';
endif;

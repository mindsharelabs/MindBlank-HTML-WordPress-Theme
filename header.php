<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
            echo ' : ';
        } ?><?php bloginfo('name'); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/site.webmanifest">
    <meta name="msapplication-TileColor" content="#f8faf5">
    <meta name="theme-color" content="#f8faf5">


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="main-panel">
<?php

if ( is_front_page() && is_home() ) {
// Default homepage

} elseif ( is_front_page()){
// Static homepage

} elseif ( is_home()){
// Blog page

} else {
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col-12">';
    echo '<h1 class="page-title display-1">' . get_the_title() . '</h1>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
// Everything else

}

<?php
/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/


add_action('init', 'create_post_type_class'); // Add our mind Blank Custom Post Type
function create_post_type_class()
{
    register_post_type('class', // Register Custom Post Type
        array(
            'labels' => array(
                'name' => __('Classes', 'mindblank'), // Rename these to suit
                'singular_name' => __('Class', 'mindblank'),
                'add_new' => __('Add New', 'mindblank'),
                'add_new_item' => __('Add New Class', 'mindblank'),
                'edit' => __('Edit Class', 'mindblank'),
                'edit_item' => __('Edit Class', 'mindblank'),
                'new_item' => __('New Class', 'mindblank'),
                'view' => __('View Class', 'mindblank'),
                'view_item' => __('View Class', 'mindblank'),
                'search_items' => __('Search Classes', 'mindblank'),
                'not_found' => __('No Classes found', 'mindblank'),
                'not_found_in_trash' => __('No Classes found in Trash', 'mindblank')
            ),
            'public' => true,
            'exclude_from_search' => false,
            'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => 'class',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'author'
            ), // Go to Dashboard Custom mind Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
        ));

}


add_action('init', 'create_class_taxonomies', 0);

function create_class_taxonomies() {

  $class_level_labels = array(
        'name'              => _x( 'Class Levels', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Class Level', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Class Levels', 'textdomain' ),
        'all_items'         => __( 'All Class Levels', 'textdomain' ),
        'edit_item'         => __( 'Edit Class Level', 'textdomain' ),
        'update_item'       => __( 'Update Class Level', 'textdomain' ),
        'add_new_item'      => __( 'Add New Class Level', 'textdomain' ),
        'new_item_name'     => __( 'New Class Level Name', 'textdomain' ),
        'menu_name'         => __( 'Class Level', 'textdomain' ),
    );
    $class_level_args = array(
        'hierarchical'      => true,
        'public'            => true,
        'exclude_from_search' => false,
        'labels'            => $class_level_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'level' ),
    );

    $class_interest_labels = array(
          'name'              => _x( 'Class Interests', 'taxonomy general name', 'textdomain' ),
          'singular_name'     => _x( 'Class Interest', 'taxonomy singular name', 'textdomain' ),
          'search_items'      => __( 'Search Class Interests', 'textdomain' ),
          'all_items'         => __( 'All Class Interests', 'textdomain' ),
          'edit_item'         => __( 'Edit Class Interest', 'textdomain' ),
          'update_item'       => __( 'Update Class Interest', 'textdomain' ),
          'add_new_item'      => __( 'Add New Class Interest', 'textdomain' ),
          'new_item_name'     => __( 'New Class Interest Name', 'textdomain' ),
          'menu_name'         => __( 'Class Interest', 'textdomain' ),
      );
      $class_interest_args = array(
          'hierarchical'      => true,
          'public'            => true,
          'exclude_from_search' => false,
          'labels'            => $class_interest_labels,
          'show_ui'           => true,
          'show_admin_column' => true,
          'query_var'         => true,
          'rewrite'           => array( 'slug' => 'interest' ),
      );

  register_taxonomy('class_level', 'class', $class_level_args );
  register_taxonomy('class_interest', 'class', $class_interest_args );

}

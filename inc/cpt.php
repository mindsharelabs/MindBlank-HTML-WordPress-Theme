<?php
/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// add_action('init', 'create_post_type_mind'); // Add our mind Blank Custom Post Type
function create_post_type_mind()
{
    register_taxonomy_for_object_type('category', 'example-post-type'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'example-post-type');
    register_post_type('example-post-type', // Register Custom Post Type
        array(
            'labels' => array(
                'name' => __('Example Post Type', 'mindblank'), // Rename these to suit
                'singular_name' => __('Example', 'mindblank'),
                'add_new' => __('Add New', 'mindblank'),
                'add_new_item' => __('Add New Post', 'mindblank'),
                'edit' => __('Edit Post', 'mindblank'),
                'edit_item' => __('Edit Post', 'mindblank'),
                'new_item' => __('New Post', 'mindblank'),
                'view' => __('View Post', 'mindblank'),
                'view_item' => __('View Post', 'mindblank'),
                'search_items' => __('Search Posts', 'mindblank'),
                'not_found' => __('No Posts found', 'mindblank'),
                'not_found_in_trash' => __('No Posts found in Trash', 'mindblank')
            ),
            'public' => true,
            'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => 'example-post-type',
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'author'
            ), // Go to Dashboard Custom mind Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'taxonomies' => array(
                'post_tag',
                'category'
            ) // Add Category and Post Tags support
        ));
}

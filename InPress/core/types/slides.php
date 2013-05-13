<?php
add_action( 'init', 'register_taxonomy_slide_categories' );
add_action( 'init', 'register_cpt_slide' );

function register_taxonomy_slide_categories() {

    $labels = array( 
        'name' => _x( 'Slide Categories', 'slide_categories' ),
        'singular_name' => _x( 'Slide Category', 'slide_categories' ),
        'search_items' => _x( 'Search Slide Categories', 'slide_categories' ),
        'popular_items' => _x( 'Popular Slide Categories', 'slide_categories' ),
        'all_items' => _x( 'All Slide Categories', 'slide_categories' ),
        'parent_item' => _x( 'Parent Slide Category', 'slide_categories' ),
        'parent_item_colon' => _x( 'Parent Slide Category:', 'slide_categories' ),
        'edit_item' => _x( 'Edit Slide Category', 'slide_categories' ),
        'update_item' => _x( 'Update Slide Category', 'slide_categories' ),
        'add_new_item' => _x( 'Add New Slide Category', 'slide_categories' ),
        'new_item_name' => _x( 'New Slide Category', 'slide_categories' ),
        'separate_items_with_commas' => _x( 'Separate slide categories with commas', 'slide_categories' ),
        'add_or_remove_items' => _x( 'Add or remove Slide Categories', 'slide_categories' ),
        'choose_from_most_used' => _x( 'Choose from most used Slide Categories', 'slide_categories' ),
        'menu_name' => _x( 'Slides Categories', 'slide_categories' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'slide_categories', array('slide'), $args );
}

function register_cpt_slide() {

    $labels = array( 
        'name' => _x( 'Slides', 'slide' ),
        'singular_name' => _x( 'Slide', 'slide' ),
        'add_new' => _x( 'Add New Slide', 'slide' ),
        'add_new_item' => _x( 'Add New Slide', 'slide' ),
        'edit_item' => _x( 'Edit Slide', 'slide' ),
        'new_item' => _x( 'New Slide', 'slide' ),
        'view_item' => _x( 'View Slide', 'slide' ),
        'all_items' => _x( 'All Slides', 'slide' ),
        'search_items' => _x( 'Search Slides', 'slide' ),
        'not_found' => _x( 'No slides found', 'slide' ),
        'not_found_in_trash' => _x( 'No slides found in Trash', 'slide' ),
        'parent_item_colon' => _x( 'Parent Slide:', 'slide' ),
        'menu_name' => _x( 'Sliders', 'slide' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Manage website sliders',
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'taxonomies' => array( 'slide_categories' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 25,
        'show_in_nav_menus' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => false,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'page',
    );

    register_post_type( 'slide', $args );
}

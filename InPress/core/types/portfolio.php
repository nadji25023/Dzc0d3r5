<?php
add_action( 'init', 'register_taxonomy_portfolio_categories' );
add_action( 'init', 'register_cpt_portfolio' );

function register_taxonomy_portfolio_categories() {

    $labels = array( 
        'name' => _x( 'Portfolio Categories', 'portfolio_categories' ),
        'singular_name' => _x( 'Portfolio Category', 'portfolio_categories' ),
        'search_items' => _x( 'Search Portfolio Categories', 'portfolio_categories' ),
        'popular_items' => _x( 'Popular Portfolio Categories', 'portfolio_categories' ),
        'all_items' => _x( 'All Portfolio Categories', 'portfolio_categories' ),
        'parent_item' => _x( 'Parent Portfolio Category', 'portfolio_categories' ),
        'parent_item_colon' => _x( 'Parent Portfolio Category:', 'portfolio_categories' ),
        'edit_item' => _x( 'Edit Portfolio Category', 'portfolio_categories' ),
        'update_item' => _x( 'Update Portfolio Category', 'portfolio_categories' ),
        'add_new_item' => _x( 'Add New Portfolio Category', 'portfolio_categories' ),
        'new_item_name' => _x( 'New Portfolio Category', 'portfolio_categories' ),
        'separate_items_with_commas' => _x( 'Separate portfolio categories with commas', 'portfolio_categories' ),
        'add_or_remove_items' => _x( 'Add or remove Portfolio Categories', 'portfolio_categories' ),
        'choose_from_most_used' => _x( 'Choose from most used Portfolio Categories', 'portfolio_categories' ),
        'menu_name' => _x( 'Portfolios Categories', 'portfolio_categories' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => false,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'portfolio_categories', array('portfolio'), $args );
}

function register_cpt_portfolio() {

    $labels = array( 
        'name' => _x( 'Portfolios', 'portfolio' ),
        'singular_name' => _x( 'Portfolio', 'portfolio' ),
        'add_new' => _x( 'Add New Portfolio', 'portfolio' ),
        'add_new_item' => _x( 'Add New Portfolio', 'portfolio' ),
        'edit_item' => _x( 'Edit Portfolio', 'portfolio' ),
        'new_item' => _x( 'New Portfolio', 'portfolio' ),
        'view_item' => _x( 'View Portfolio', 'portfolio' ),
        'all_items' => _x( 'Portfolio Posts', 'portfolio' ),
        'search_items' => _x( 'Search Portfolios', 'portfolio' ),
        'not_found' => _x( 'No portfolios found', 'portfolio' ),
        'not_found_in_trash' => _x( 'No portfolios found in Trash', 'portfolio' ),
        'parent_item_colon' => _x( 'Parent Portfolio:', 'portfolio' ),
        'menu_name' => _x( 'Portfolio', 'portfolio' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Manage website portfolios',
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'portfolio_categories' ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 25,
        
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );
}

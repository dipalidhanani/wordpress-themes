<?php 

add_action( 'init', 'register_cpt_slide',10 );

function register_cpt_slide() {

    $labels = array( 
        'name' => _x( 'Slide', 'slide' ),
        'singular_name' => _x( 'slide', 'slide' ),
        'add_new' => _x( 'Add New', 'slide' ),
        'add_new_item' => _x( 'Add New slide', 'slide' ),
        'edit_item' => _x( 'Edit slide', 'slide' ),
        'new_item' => _x( 'New slide', 'slide' ),
        'view_item' => _x( 'View slide', 'slide' ),
        'search_items' => _x( 'Search slides', 'slide' ),
        'not_found' => _x( 'No slides found', 'slide' ),
        'not_found_in_trash' => _x( 'No slides found in Trash', 'slide' ),
        'parent_item_colon' => _x( 'Parent slide:', 'slide' ),
        'menu_name' => _x( 'slides', 'slide' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Slides',
        'supports' => array( 'title', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'slides', $args );
}
<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitFaqPostType()
{
	register_post_type( 'ait-faq',
		array(
			'labels' => array(
				'name'			=> __('Question', 'ait'),
				'singular_name' => __('question', 'ait'),
				'add_new'		=> __('Add new question', 'ait'),
				'add_new_item'	=> __('Add new question', 'ait'),
				'edit_item'		=> __('Edit question', 'ait'),
				'new_item'		=> __('New question', 'ait'),
				'not_found'		=> __('No questions found', 'ait'),
				'not_found_in_trash' => __('No questions found in Trash', 'ait'),
				'menu_name'		=> __('Questions', 'ait'),
			),
			'description' => __('Manipulating with questions', 'ait'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'editor',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/faq/faq.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['faq'],
		)
	);
	aitFaqTaxonomies();
}


function aitFaqTaxonomies()
{

	register_taxonomy('ait-faq-category', array('ait-faq'), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Faqs', 'taxonomy general name', 'ait'),
			'singular_name' => _x( 'Faq', 'taxonomy singular name', 'ait'),
			'search_items'	=> __( 'Search Faq', 'ait'),
			'all_items'		=> __( 'All Faqs', 'ait'),
			'parent_item'	=> __( 'Parent Faq', 'ait'),
			'parent_item_colon' => __( 'Parent Faq:', 'ait'),
			'edit_item'		=> __( 'Edit Faq', 'ait'),
			'update_item'	=> __( 'Update Faq', 'ait'),
			'add_new_item'	=> __( 'Add New Faq', 'ait'),
			'new_item_name' => __( 'New Faq Name', 'ait'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'ait-faq-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Faqs', 'ait-faq-category' )){
		wp_insert_term( 'Uncategorized Faqs', 'ait-faq-category' );
	}
}
add_action( 'init', 'aitFaqPostType' );



function aitFaqFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-faq-box', 'side' );
	add_meta_box('postimagediv', __('Tab image', 'ait'), 'post_thumbnail_meta_box', 'ait-faq', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitFaqFeaturedImageMetabox');

function aitFaqChangeColumns($cols)
{
	$cols = array(
		'cb'            => '<input type="checkbox" />',
		'title'         => __( 'Name', 'ait'),
		'content'		=> __( 'Content', 'ait'),
		'category'      => __( 'Team', 'ait'),
		'menu_order'    => __( 'Order', 'ait'),
	);

	return $cols;
}
add_filter( "manage_ait-faq_posts_columns", "aitFaqChangeColumns");


function aitFaqSortableColumns()
{
	return array(
		'menu_order' => 'order',
		'category' => 'category',
	);
}
add_filter("manage_edit-ait-faq_sortable_columns", "aitFaqSortableColumns");

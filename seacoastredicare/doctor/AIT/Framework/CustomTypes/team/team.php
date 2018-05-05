<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */

function aitTeamPostType()
{
	register_post_type( 'ait-team',
		array(
			'labels' => array(
				'name'			=> __('Member', 'ait'),
				'singular_name' => __('member', 'ait'),
				'add_new'		=> __('Add new member', 'ait'),
				'add_new_item'	=> __('Add new member', 'ait'),
				'edit_item'		=> __('Edit member', 'ait'),
				'new_item'		=> __('New member', 'ait'),
				'not_found'		=> __('No members found', 'ait'),
				'not_found_in_trash' => __('No members found in Trash', 'ait'),
				'menu_name'		=> __('Members', 'ait'),
			),
			'description' => __('Manipulating with members', 'ait'),
			'public' => false,
			'show_in_nav_menus' => false,
			'supports' => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/team/team.png',
			'menu_position' => $GLOBALS['aitThemeCustomTypes']['team'],
		)
	);
	aitTeamTaxonomies();
}


function aitTeamTaxonomies()
{

	register_taxonomy('ait-team-category', array('ait-team'), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Teams', 'taxonomy general name', 'ait'),
			'singular_name' => _x( 'Team', 'taxonomy singular name', 'ait'),
			'search_items'	=> __( 'Search Team', 'ait'),
			'all_items'		=> __( 'All Teams', 'ait'),
			'parent_item'	=> __( 'Parent Team', 'ait'),
			'parent_item_colon' => __( 'Parent Team:', 'ait'),
			'edit_item'		=> __( 'Edit Team', 'ait'),
			'update_item'	=> __( 'Update Team', 'ait'),
			'add_new_item'	=> __( 'Add New Team', 'ait'),
			'new_item_name' => __( 'New Team Name', 'ait'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'ait-team-category' ),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Teams', 'ait-team-category' )){
		wp_insert_term( 'Uncategorized Teams', 'ait-team-category' );
	}
}
add_action( 'init', 'aitTeamPostType' );



function aitTeamFeaturedImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-team-box', 'side' );
	add_meta_box('postimagediv', __('Tab image', 'ait'), 'post_thumbnail_meta_box', 'ait-team', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitTeamFeaturedImageMetabox');



$teamOptions = new WPAlchemy_MetaBox(array
(
	'id' => '_ait-team',
	'title' => __('Options for team', 'ait'),
	'types' => array('ait-team'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
));



function aitTeamChangeColumns($cols)
{
	$cols = array(
		'cb'            => '<input type="checkbox" />',
		'thumbnail'     => __( 'Photo', 'ait'),
		'title'         => __( 'Name', 'ait'),
		'specialization'  => __( 'Specialization', 'ait'),
		'category'      => __( 'Team', 'ait'),
		'menu_order'    => __( 'Order', 'ait'),
	);

	return $cols;
}
add_filter( "manage_ait-team_posts_columns", "aitTeamChangeColumns");

function aitTeamCustomColumns($column, $post_id)
{
	global $teamOptions;
	$options = $teamOptions->the_meta();

	switch ($column)
	{
		case "specialization":
			if(isset($options['specialization'])){
				echo "<p>".$options['specialization']."</p>";
			}
			unset($options);
			break;
	}
}
add_action( "manage_posts_custom_column", "aitTeamCustomColumns", 10, 2);

function aitTeamSortableColumns()
{
	return array(
		'menu_order' => 'order',
		'category' => 'category',
	);
}
add_filter("manage_edit-ait-team_sortable_columns", "aitTeamSortableColumns");

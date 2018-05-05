<?php

/**
 * AIT Theme Admin
 *
 * Copyright (c) 2011, AIT s.r.o (http://ait-themes.com)
 *
 */


 function aitGridPortfolioBPostType()
 {
	register_post_type('ait-grid-portfoliob',
		array(
			'labels' => array(
			'name'			=> __('Grid Portfolios', 'ait'),
			'singular_name' => __('Portfolio', 'ait'),
			'add_new'		=> __('Add New', 'ait'),
			'add_new_item'	=> __('Add New Grid Portfolio Item', 'ait'),
			'edit_item'		=> __('Edit Grid Portfolio Item', 'ait'),
			'new_item'		=> __('New Item', 'ait'),
			'view_item'		=> __('View Item', 'ait'),
			'search_items'	=> __('Search Items', 'ait'),
			'not_found'		=> __('No Grid Portfolio Items found', 'ait'),
			'not_found_in_trash' => __('No items found in Trash', 'ait')
		),
		'public' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'grid-portfolio'),
		'supports' => array('title', 'thumbnail', 'page-attributes', 'editor'),
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => AIT_FRAMEWORK_URL . '/CustomTypes/grid-portfoliob/grid-portfoliob.png',
		'menu_position' => $GLOBALS['aitThemeCustomTypes']['grid-portfoliob'],
		)
	);
        flush_rewrite_rules(false);
	aitGridPortfolioBTaxonomies();
}



function aitGridPortfolioBTaxonomies()
{

	register_taxonomy( 'ait-grid-portfoliob-category', array( 'ait-grid-portfoliob' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name'			=> _x( 'Grid Portfolio Categories', 'taxonomy general name', 'ait'),
			'singular_name' => _x( 'Category', 'taxonomy singular name', 'ait'),
			'search_items'	=> __( 'Search Category', 'ait'),
			'all_items'		=> __( 'All Gategories', 'ait'),
			'parent_item'	=> __( 'Parent Category', 'ait'),
			'parent_item_colon' => __( 'Parent Category:', 'ait'),
			'edit_item'		=> __( 'Edit Category', 'ait'),
			'update_item'	=> __( 'Update Gategory', 'ait'),
			'add_new_item'	=> __( 'Add New Category', 'ait'),
			'new_item_name' => __( 'New Category Name', 'ait'),
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'ait-grid-portfolio-category'),
	));
	// add uncategorized term
	if(!term_exists( 'Uncategorized Grid Portfolios', 'ait-grid-portfoliob-category' )){
		wp_insert_term( 'Uncategorized Grid Portfolios', 'ait-grid-portfoliob-category' );
	}
}

add_action( 'init', 'aitGridPortfolioBPostType' );



function aitGridPortfolioBImageMetabox()
{
	remove_meta_box( 'postimagediv', 'ait-grid-portfoliob', 'side' );
	add_meta_box('postimagediv', __('Grid Portfolio Item Thumbnail', 'ait'),  'post_thumbnail_meta_box', 'ait-grid-portfoliob', 'normal', 'high');
}
add_action('do_meta_boxes', 'aitGridPortfolioBImageMetabox');



$gridPortfolioBOptions = new WPAlchemy_MetaBox(array(
	'id' => '_ait-grid-portfoliob',
	'title' => 'Grid Portfolio Item Options',
	'types' => array('ait-grid-portfoliob'),
	'context' => 'normal',
	'priority' => 'core',
	'config' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.neon',
	'js' => dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.js',
));


function aitGridPortfolioBChangeColumns($cols)
{
  $cols = array(
	'cb'         => '<input type="checkbox" />',
	'title'      => __( 'Grid Portfolio Item Name', 'ait'),
	'thumbnail'  => __( 'Thumbnail', 'ait'),
	'menu_order' => __( 'Order', 'ait'),
	'category'   => __( 'Grid Portfolio Category', 'ait'),
  );

  return $cols;
}
add_filter( "manage_ait-grid-portfoliob_posts_columns", "aitGridPortfolioBChangeColumns");



function aitGridPortfolioBCustomColumns($column, $post_id)
{
	switch ($column){
		case "itemType":
			$meta_type = get_post_meta($post_id, '_ait-grid-portfoliob', TRUE);
			if($meta_type['itemType'] == "image"){
				echo "Large image";
			}elseif($meta_type['itemType'] == "website"){
				echo "Website";
			}elseif($meta_type['itemType'] == "video"){
				echo "Video";
			}
		break;

		case "itemUrl":
			$meta_type = get_post_meta($post_id, '_ait-grid-portfoliob', TRUE);

			$link = '';

			if($meta_type['itemType'] == "image"){
				if(isset($meta_type['imageLink']))
					$link = $meta_type['imageLink'];

			}elseif($meta_type['itemType'] == "website"){
				if(isset($meta_type['websiteLink']))
					$link = $meta_type['websiteLink'];
			}elseif($meta_type['itemType'] == "video"){
				if(isset($meta_type['videoLink']))
					$link = $meta_type['videoLink'];
			}
			if(!empty($link))
				echo '<a href="' . esc_url($link) . '">' . htmlspecialchars($link) . '</a>';
			else
				echo '';
		break;
	}
}
add_action( "manage_posts_custom_column", "aitGridPortfolioBCustomColumns", 10, 2 );

function aitGridPortfolioBSortableColumns()
{
  return array(
    'title' => 'title',
    'category' => 'category',
    'menu_order' => 'order',
  );
}
add_filter( "manage_edit-ait-grid-portfolio_sortable_columns", "aitGridPortfolioBSortableColumns" );
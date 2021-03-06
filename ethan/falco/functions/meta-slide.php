<?php
/**
 * Slide custom meta fields.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

/* ---------------------------------------------------------------------------
 * Create new post type
 * --------------------------------------------------------------------------- */
function mfn_slide_post_type() 
{
	$slider_item_slug = 'slider-item';
	
	$labels = array(
		'name' 					=> __('Vertical Slider','mfn-opts'),
		'singular_name' 		=> __('Slide','mfn-opts'),
		'add_new' 				=> __('Add New','mfn-opts'),
		'add_new_item' 			=> __('Add New Slide','mfn-opts'),
		'edit_item' 			=> __('Edit Slide','mfn-opts'),
		'new_item' 				=> __('New Slide','mfn-opts'),
		'view_item' 			=> __('View Slide','mfn-opts'),
		'search_items' 			=> __('Search Slides','mfn-opts'),
		'not_found' 			=> __('No slides found','mfn-opts'),
		'not_found_in_trash' 	=> __('No slides found in Trash','mfn-opts'), 
		'parent_item_colon' 	=> ''
	  );	
	  
	  $args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'query_var' 			=> true,
		'capability_type' 		=> 'post',
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'rewrite' 				=> array( 'slug' => $slider_item_slug, 'with_front'=>true ),
		'supports' 				=> array( 'title', 'thumbnail', 'page-attributes' ),
	  ); 
	  
	  register_post_type( 'slide', $args );
}
add_action( 'init', 'mfn_slide_post_type' );


/* ---------------------------------------------------------------------------
 * Edit columns
 * --------------------------------------------------------------------------- */
function mfn_slide_edit_columns($columns)
{
	$newcolumns = array(
		"cb" 					=> "<input type=\"checkbox\" />",
		"slider_thumbnail" 		=> __('Thumbnail','mfn-opts'),
		"title" 				=> 'Title',
		"slider_order" 			=> __('Order','mfn-opts'),
	);
	$columns = array_merge($newcolumns, $columns);	
	
	return $columns;
}
add_filter("manage_edit-slide_columns", "mfn_slide_edit_columns");  


/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */
function mfn_slide_custom_columns($column)
{
	global $post;
	switch ($column)
	{
		case "slider_thumbnail":
			if ( has_post_thumbnail() ) { the_post_thumbnail('50x50'); }
			break;	
		case "slider_order":
			echo $post->menu_order;
			break;	
	}
}
add_action("manage_posts_custom_column",  "mfn_slide_custom_columns"); 

 
/*-----------------------------------------------------------------------------------*/
/*	Define Metabox Fields
/*-----------------------------------------------------------------------------------*/

$mfn_slide_prefix = 'mfn-slide-';
 
$mfn_slide_meta_box = array(
	'id' => 'mfn-meta-slide',
	'title' => __('Slide Options','mfn-opts'),
	'page' => 'slide',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		array(
			'id' 	=> 'mfn-post-title',
			'type' 	=> 'textarea',
			'title' => __('Title', 'mfn-opts'),
			'sub_desc' => __('Slide Title.', 'mfn-opts'),
		),
			
		array(
			'id' 	=> 'mfn-post-text',
			'type' 	=> 'textarea',
			'title' => __('Text', 'mfn-opts'),
			'sub_desc' => __('Slide content text.', 'mfn-opts'),
		),
		
		array(
			'id' 	=> 'mfn-post-link_title',
			'type' 	=> 'text',
			'title' => __('Button text', 'mfn-opts'),
			'class'	=> 'small-text',
			'std' 	=> 'See more',
		),
		
		array(
			'id' 	=> 'mfn-post-link',
			'type' 	=> 'text',
			'title' => __('Button link', 'mfn-opts'),
			'desc' 	=> __('Button will appear only if this field will be filled.', 'mfn-opts'),
		),
			
		array(
			'id' 	=> 'mfn-post-dark',
			'type' 	=> 'switch',
			'title' => __('Dark Background', 'mfn-opts'),
			'options' => array( 0 => 'No', 1 => 'Yes' ),
			'desc' 	=> __('Turn it ON if you uploaded dark background and you want light text color.', 'mfn-opts'),
		),	

	),
);


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/ 
function mfn_slide_meta_add() {
	global $mfn_slide_meta_box;
	add_meta_box($mfn_slide_meta_box['id'], $mfn_slide_meta_box['title'], 'mfn_slide_show_box', $mfn_slide_meta_box['page'], $mfn_slide_meta_box['context'], $mfn_slide_meta_box['priority']);
}
add_action('admin_menu', 'mfn_slide_meta_add');


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/
function mfn_slide_show_box() {
	global $MFN_Options, $mfn_slide_meta_box, $post;
	$MFN_Options->_enqueue();
 	
	// Use nonce for verification
	echo '<div id="mfn-wrapper">';
		echo '<input type="hidden" name="mfn_slide_meta_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
			echo '<tbody>';
	 
				foreach ($mfn_slide_meta_box['fields'] as $field) {
					$meta = get_post_meta($post->ID, $field['id'], true);
					if( ! key_exists('std', $field) ) $field['std'] = false;
					$meta = ( $meta || $meta==='0' ) ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES ));
					mfn_meta_field_input( $field, $meta );
				}
	 
			echo '</tbody>';
		echo '</table>';
	echo '</div>';
}


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
function mfn_slide_save_data($post_id) {
	global $mfn_slide_meta_box;
 
	// verify nonce
	if( key_exists( 'mfn_slide_meta_nonce',$_POST ) ) {
		if ( ! wp_verify_nonce( $_POST['mfn_slide_meta_nonce'], basename(__FILE__) ) ) {
			return $post_id;
		}
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ( (key_exists('post_type', $_POST)) && ('page' == $_POST['post_type']) ) {
		if ( ! current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif ( ! current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($mfn_slide_meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if( key_exists($field['id'], $_POST) ) {
			$new = $_POST[$field['id']];
		} else {
//			$new = ""; // problem with "quick edit"
			continue;
		}
 
		if ( isset($new) && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
add_action('save_post', 'mfn_slide_save_data');

?>
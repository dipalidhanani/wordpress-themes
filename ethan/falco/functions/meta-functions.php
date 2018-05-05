<?php
/**
 * General custom meta fields.
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */


/*-----------------------------------------------------------------------------------*/
/*	LIST of Categories for posts or specified taxonomy
/*-----------------------------------------------------------------------------------*/
function mfn_get_categories( $category ) {
	$categories = get_categories( array( 'taxonomy' => $category ));
	
	$array = array( '' => __( 'All', 'mfn-opts' ) );	
	foreach( $categories as $cat ){
		$array[$cat->slug] = $cat->name;
	}
		
	return $array;
}


/*-----------------------------------------------------------------------------------*/
/*	LIST of Sliders (Revolution Sliders)
/*-----------------------------------------------------------------------------------*/
function mfn_get_sliders( $all = false ) {
	global $wpdb;

	$sliders = array( 0 => __('-- Select --', 'mfn-opts') );
	
	// Muffin Slider for some themes
	if( $all ) $sliders['mfn-slider'] = __('- Muffin Slider -', 'mfn-opts');

	// Revolution Slider database table name
	$table_name = $wpdb->base_prefix . "revslider_sliders";
	
	$array = false;
	
	// check if Revolution Slider is activated
	$plugins = get_option('active_plugins');
	if( is_array( $plugins ) && in_array( 'revslider/revslider.php', $plugins ) ){
		$array = $wpdb->get_results("SELECT * FROM $table_name ORDER BY title");
	}
	
	if( is_array( $array ) ){
		foreach( $array as $v ){
			$sliders[$v->alias] = $v->title;
		}
	}
	
	return $sliders;
}


/*-----------------------------------------------------------------------------------*/
/*	PRINT Single Muffin Options FIELD
/*-----------------------------------------------------------------------------------*/
function mfn_meta_field_input( $field, $meta ){
	global $MFN_Options;

	if( isset( $field['type'] ) ){		
		echo '<tr valign="top">';
		
			// Field Title & SubDescription
			echo '<th scope="row">';
				if( key_exists('title', $field) ) echo $field['title'];
				if( key_exists('sub_desc', $field) ) echo '<span class="description">'. $field['sub_desc'] .'</span>';
			echo '</th>';
			
			// Muffin Options Field & Description 
			echo '<td>';
				$field_class = 'MFN_Options_'.$field['type'];
				require_once( $MFN_Options->dir.'fields/'.$field['type'].'/field_'.$field['type'].'.php' );
				
				if( class_exists( $field_class ) ){
					$field_object = new $field_class( $field, $meta );
					$field_object->render(1);
				}
				
			echo '</td>';
			
		echo '</tr>';
	}
	
}


/*-----------------------------------------------------------------------------------*/
/*	PRINT Single Muffin Builder ITEM
/*-----------------------------------------------------------------------------------*/
function mfn_builder_item( $item_std, $item = false, $section_id = false ) {
	
	// input's 'name' only for existing items, not for items to clone
	$name_type 		= $item ? 'name="mfn-item-type[]"' : '';
	$name_size 		= $item ? 'name="mfn-item-size[]"' : '';
	$name_parent	= $item ? 'name="mfn-item-parent[]"' : '';
	
	$item_std['size'] = $item['size'] ? $item['size'] : $item_std['size'];
	$label = ( $item && key_exists('fields', $item) && key_exists('title', $item['fields']) ) ? $item['fields']['title'] : '';

	$classes = array(
		'1/4' => 'mfn-item-1-4',
		'1/3' => 'mfn-item-1-3',
		'1/2' => 'mfn-item-1-2',
		'2/3' => 'mfn-item-2-3',
		'3/4' => 'mfn-item-3-4',
		'1/1' => 'mfn-item-1-1'
	);
	
	echo '<div class="mfn-element mfn-item mfn-item-'. $item_std['type'] .' '. $classes[$item_std['size']] .'">';
							
		echo '<div class="mfn-element-content">';
			echo '<input type="hidden" class="mfn-item-type" '. $name_type .' value="'. $item_std['type'] .'">';
			echo '<input type="hidden" class="mfn-item-size" '. $name_size .' value="'. $item_std['size'] .'">';
			echo '<input type="hidden" class="mfn-item-parent" '. $name_parent .' value="'. $section_id .'" />';
			
			echo '<div class="mfn-element-header">';
				echo '<div class="mfn-item-size">';
					echo '<a class="mfn-element-btn mfn-item-size-dec" href="javascript:void(0);">-</a>';
					echo '<a class="mfn-element-btn mfn-item-size-inc" href="javascript:void(0);">+</a>';
					echo '<span class="mfn-item-desc">'. $item_std['size'] .'</span>';
				echo '</div>';
				echo '<div class="mfn-element-tools">';
					echo '<a class="mfn-element-btn mfn-fr mfn-element-edit" title="Edit" href="javascript:void(0);">E</a>';
					echo '<a class="mfn-element-btn mfn-fr mfn-element-clone mfn-item-clone" title="Clone" href="javascript:void(0);">C</a>';
					echo '<a class="mfn-element-btn mfn-fr mfn-element-delete" title="Delete" href="javascript:void(0);">D</a>';
				echo '</div>';
			echo '</div>';
			
			echo '<div class="mfn-item-content">';
				echo '<div class="mfn-item-icon"></div>';
				echo '<span class="mfn-item-title">'. $item_std['title'] .'</span>';
				echo '<span class="mfn-item-label">'. $label .'</span>';
			echo '</div>';
	
		echo '</div>';
		
		echo '<div class="mfn-element-meta">';
			echo '<table class="form-table">';
				echo '<tbody>';		
		 
					// Fields for Item
					foreach( $item_std['fields'] as $field ){
							
						// values for existing items
						if( $item && key_exists( $field['id'] , $item['fields'] ) ){
							$meta = $item['fields'][$field['id']];
						} else {
							$meta = false;
						}
						
						if( ! key_exists('std', $field) ) $field['std'] = false;
						$meta = ( $meta || $meta==='0' ) ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES ));
						
						// field ID
						$field['id'] = 'mfn-items['. $item_std['type'] .']['. $field['id'] .']';	
						
						// field ID except accordion, faq & tabs
						if( $field['type'] != 'tabs' ){
							$field['id'] .= '[]';					
						}
						
						// PRINT Single Muffin Options FIELD
						mfn_meta_field_input( $field, $meta );
						
					}
		 
				echo '</tbody>';
			echo '</table>';
		echo '</div>';
	
	echo '</div>';
						
}


/*-----------------------------------------------------------------------------------*/
/*	PRINT Single Muffin Builder SECTION
/*-----------------------------------------------------------------------------------*/
function mfn_builder_section( $item_std, $section_std, $section = false, $section_id = false ) {

	// input's 'name' only for existing sections, not for section to clone
	$name_row_id = $section ? 'name="mfn-row-id[]"' : '';
		
	echo '<div class="mfn-element mfn-row">';

		echo '<div class="mfn-element-content">';
		
			// Section ID
			echo '<input type="hidden" class="mfn-row-id" '. $name_row_id .' value="'. $section_id .'" />';

			echo '<div class="mfn-element-header">';
			echo '<div class="mfn-item-add">';
				echo '<a class="mfn-item-add-btn" href="javascript:void(0);">Add Item</a>';
					echo '<ul class="mfn-item-add-list">';
					
						// List of available Items
						foreach( $item_std as $item ){
							echo '<li><a class="'. $item['type'] .'" href="javascript:void(0);">'. $item['title'] .'</a></li>';
						}
					
					echo '</ul>';
				echo '</div>';
				echo '<div class="mfn-element-tools">';			
					echo '<a class="mfn-element-btn mfn-element-edit" title="Edit" href="javascript:void(0);">E</a>';
					echo '<a class="mfn-element-btn mfn-element-clone mfn-row-clone" title="Clone" href="javascript:void(0);">C</a>';
					echo '<a class="mfn-element-btn mfn-element-delete" title="Delete" href="javascript:void(0);">D</a>';
				echo '</div>';
			echo '</div>';
			
			// .mfn-element-droppable
			echo '<div class="mfn-droppable mfn-sortable clearfix">';

				// Existing Items for Section
				if( $section && key_exists('items', $section) && is_array($section['items']) ){
					foreach( $section['items'] as $item )
					{
						mfn_builder_item( $item_std[$item['type']], $item, $section_id );
					}
				}
		
			echo '</div>';

		echo '</div>';
		
		echo '<div class="mfn-element-meta">';
			echo '<table class="form-table" style="display: table;">';
				echo '<tbody>';
					
					// Fields for Section
					foreach( $section_std as $field ){

						// values for existing sections
						if( $section ){
							$meta = $section['attr'][$field['id']];
						} else {
							$meta = false;
						}
					
						if( ! key_exists('std', $field) ) $field['std'] = false;
						$meta = ( $meta || $meta==='0' ) ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES ));
					
						// field ID
						$field['id'] = 'mfn-rows['. $field['id'] .']';
					
						// field ID except accordion, faq & tabs
						if( $field['type'] != 'tabs' ){
							$field['id'] .= '[]';
						}
					
						// PRINT Single Muffin Options FIELD
						mfn_meta_field_input( $field, $meta );
						
					}
					
				echo '</tbody>';
			echo '</table>';
		echo '</div>';
		
	echo '</div>';

}


/*-----------------------------------------------------------------------------------*/
/*	PRINT Muffin Builder
/*-----------------------------------------------------------------------------------*/
function mfn_builder_show() {
	global $post;
	
	// Default Fields for Section -----------------------------------------------------------------------------
	$mfn_std_section = array(
	
		array(
			'id' => 'bg_image',
			'type' => 'upload',
			'title' => __('Background Image', 'mfn-opts'),
			'desc' => __('This option can be used <strong>only</strong> with Layout: Boxed.', 'mfn-opts'),
		),
			
		array(
			'id' => 'bg_position',
			'type' => 'select',
			'title' => __('Background Image position', 'mfn-opts'),
			'desc' => __('This option can be used only with your custom image selected above.', 'mfn-opts'),
			'options' => array(
				'no-repeat;center top;;' => 'Center Top No-Repeat',
				'repeat;center top;;' => 'Center Top Repeat',
				'no-repeat;center;;' => 'Center No-Repeat',
				'no-repeat;center;;cover' => 'Center No-Repeat Cover',
				'repeat;center;;' => 'Center Repeat',
				'no-repeat;center top;fixed;' => 'Center No-Repeat Fixed',
				'no-repeat;center;fixed;cover' => 'Center No-Repeat Fixed Cover',
			),
			'std' => 'center top no-repeat',
		),
			
		array(
			'id' => 'bg_color',
			'type' => 'text',
			'title' => __('Background Color', 'mfn-opts'),
			'desc' => __('Use color name (eg. "gray") or hex (eg. "#808080").<br /><br />Leave this field blank if you want to use transparent background.', 'mfn-opts'),
			'class' => 'small-text',
			'std' => '',
		),
		
		array(
			'id' => 'layout',
			'type' => 'select',
			'title' => __('Layout', 'mfn-opts'),
			'sub_desc' => __('Select layout for this page', 'mfn-opts'),
			'desc' => __('<strong>Notice:</strong> Sidebar for section will show <strong>only</strong> if you set Full Width Page Layout in Page Options below Content Builder.', 'mfn-opts'),
			'options' => array(
				'no-sidebar' => 'Full width. No sidebar',
				'left-sidebar' => 'Left Sidebar',
				'right-sidebar' => 'Right Sidebar'
			),
			'std' => 'no-sidebar',
		),
		
		array(
			'id' => 'sidebar',
			'type' => 'select',
			'title' => __('Sidebar', 'mfn-opts'),
			'sub_desc' => __('Select sidebar for this page.', 'mfn-opts'),
			'options' => mfn_opts_get( 'sidebars' ),
		),
		
		array(
			'id' => 'padding',
			'type' => 'text',
			'title' => __('Padding', 'mfn-opts'),
			'sub_desc' => __('Section Vertical Padding', 'mfn-opts'),
			'desc' => __('px', 'mfn-opts'),
			'class' => 'small-text',
			'std' => '0',
		),
		
		array(
			'id' => 'class',
			'type' => 'text',
			'title' => __('Custom CSS classes', 'mfn-opts'),
			'desc' => __('Multiple classes should be separated with SPACE.<br />For sections with dark background you can use class: <strong>dark</strong>', 'mfn-opts'),
		),
				
	);
	
	// Default Items with Fields -----------------------------------------------------------------------------
	$mfn_std_items = array(
	
		// Accordion  --------------------------------------------
		'accordion' => array(
			'type' => 'accordion',
			'title' => __('Accordion', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
		
				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
				),
					
				array(
					'id' => 'tabs',
					'type' => 'tabs',
					'title' => __('Accordion', 'mfn-opts'),
					'sub_desc' => __('Manage accordion tabs.', 'mfn-opts'),
					'desc' => __('You can use Drag & Drop to set the order.', 'mfn-opts'),
				),
					
				array(
					'id' => 'open1st',
					'type' => 'select',
					'options' => array( 0 => 'No', 1 => 'Yes' ),
					'title' => __('Open First', 'mfn-opts'),
					'desc' => __('Open first tab at start.', 'mfn-opts'),
				),
				
			),															
		),
			
		// Article box  --------------------------------------------
		'article_box' => array(
			'type' => 'article_box',
			'title' => __('Article Box', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(

				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
				),
					
				array(
					'id' => 'image',
					'type' => 'upload',
					'title' => __('Image', 'mfn-opts'),
					'sub_desc' => __('Featured Image', 'mfn-opts'),
// 					'desc' => __('Recommended image size 380px x 125px.', 'mfn-opts'),
				),
					
				array(
					'id' => 'subtitle',
					'type' => 'text',
					'title' => __('Subtitle', 'mfn-opts'),
				),
					
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Content', 'mfn-opts'),
					'desc' => __('HTML tags allowed.', 'mfn-opts')
				),
					
				array(
					'id' => 'link',
					'type' => 'text',
					'title' => __('Link', 'mfn-opts'),
				),
					
				array(
					'id' => 'link_title',
					'type' => 'text',
					'title' => __('Link Title', 'mfn-opts'),
					'std' => __('Read more', 'mfn-opts'),
				),
				
				array(
					'id' => 'target',
					'type' => 'select',
					'options' => array( 0 => 'No', 1 => 'Yes' ),
					'title' => __('Open in new window', 'mfn-opts'),
					'desc' => __('Adds a target="_blank" attribute to the link.', 'mfn-opts'),
				),
			
			),															
		),
		
		// Blockquote --------------------------------------------
		'blockquote' => array(
			'type' => 'blockquote',
			'title' => __('Blockquote', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
		
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Content', 'mfn-opts'),
					'sub_desc' => __('Blockquote content.', 'mfn-opts'),
					'desc' => __('HTML tags allowed.', 'mfn-opts')
				),
					
				array(
					'id' => 'photo',
					'type' => 'upload',
					'title' => __('Photo', 'mfn-opts'),
					'sub_desc' => __('Author Photo.', 'mfn-opts'),
				),
				
				array(
					'id' => 'author',
					'type' => 'text',
					'title' => __('Author', 'mfn-opts'),
				),
				
				array(
					'id' => 'company',
					'type' => 'text',
					'title' => __('Company', 'mfn-opts'),
				),
				
				array(
					'id' => 'link',
					'type' => 'text',
					'title' => __('Link', 'mfn-opts'),
					'sub_desc' => __('Link to company page.', 'mfn-opts'),
				),
				
				array(
					'id' => 'target',
					'type' => 'select',
					'options' => array( 0 => 'No', 1 => 'Yes' ),
					'title' => __('Open in new window', 'mfn-opts'),
					'sub_desc' => __('Open link in a new window.', 'mfn-opts'),
					'desc' => __('Adds a target="_blank" attribute to the link.', 'mfn-opts'),
				),
				
			),															
		),
		
		// Clients  --------------------------------------------
		'clients' => array(
			'type' => 'clients',
			'title' => __('Clients', 'mfn-opts'),
			'size' => '1/1',
			'fields' => array(
	
				array(
					'id' 	=> 'in_row',
					'type' 	=> 'text',
					'title' => __('Items in Row', 'mfn-opts'),
					'sub_desc' 	=> __('Number of items in row', 'mfn-opts'),
					'desc' 	=> __('Recommended number: 3-6', 'mfn-opts'),
					'std' 	=> 6,
					'class' => 'small-text',
				),
	
			),
		),
		
		// Code  --------------------------------------------
		'code' => array(
			'type' => 'code',
			'title' => __('Code', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
		
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Content', 'mfn-opts'),
					'class' => 'full-width',
					'validate' => 'html',
				),
				
			),															
		),
		
		// Column  --------------------------------------------
		'column' => array(
			'type' => 'column',
			'title' => __('Column', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
		
				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
					'desc' => __('This field is used as an Item Label in admin panel only and shows after page update.', 'mfn-opts'),
				),
					
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Column content', 'mfn-opts'),
					'desc' => __('Shortcodes and HTML tags allowed.', 'mfn-opts'),
					'class' => 'full-width',
					'validate' => 'html',
				),

			),															
		),
		
		// Contact box --------------------------------------------
		'contact_box' => array(
			'type' => 'contact_box',
			'title' => __('Contact Box', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
		
				array(
					'id' 	=> 'title',
					'type' 	=> 'text',
					'title' => __('Title', 'mfn-opts'),
				),
				
				array(
					'id' 	=> 'lat',
					'type' 	=> 'text',
					'title' => __('Google Maps Lat', 'mfn-opts'),
					'class' => 'small-text',
					'desc' 	=> __('The map will appear only if this field is filled correctly.', 'mfn-opts'),
				),
				
				array(
					'id' 	=> 'lng',
					'type' 	=> 'text',
					'title' => __('Google Maps Lng', 'mfn-opts'),
					'class' => 'small-text',
					'desc' 	=> __('The map will appear only if this field is filled correctly.', 'mfn-opts'),
				),
				
				array(
					'id' 	=> 'zoom',
					'type' 	=> 'text',
					'title' => __('Zoom', 'mfn-opts'),
					'class' => 'small-text',
					'std' 	=> 13,
				),

				array(
					'id' 	=> 'address',
					'type' 	=> 'textarea',
					'title' => __('Address', 'mfn-opts'),
					'desc' 	=> __('HTML tags allowed.', 'mfn-opts'),
				),
					
				array(
					'id' 	=> 'telephone',
					'type' 	=> 'text',
					'title' => __('Telephone', 'mfn-opts'),
				),			
				
				array(
					'id' 	=> 'email',
					'type' 	=> 'text',
					'title' => __('Email', 'mfn-opts'),
				),
				
				array(
					'id' 	=> 'www',
					'type' 	=> 'text',
					'title' => __('WWW', 'mfn-opts'),
				),
				
				array(
					'id' 	=> 'link_title',
					'type' 	=> 'text',
					'title' => __('Left Button title', 'mfn-opts'),
					'class' => 'small-text',
					'std' 	=> 'About us',
				),
				
				array(
					'id' 	=> 'link',
					'type' 	=> 'text',
					'title' => __('Left Button link', 'mfn-opts'),
				),
				
				array(
					'id' 	=> 'link2_title',
					'type' 	=> 'text',
					'title' => __('Right Button title', 'mfn-opts'),
					'class' => 'small-text',
					'std' 	=> 'Contact page',
				),
				
				array(
					'id' 	=> 'link2',
					'type' 	=> 'text',
					'title' => __('Right Button link', 'mfn-opts'),
				),
				
			),															
		),
		
		// Content  --------------------------------------------
		'content' => array(
			'type' => 'content',
			'title' => __('Content', 'mfn-opts'), 
			'size' => '1/4',
			'fields' => array(
		
				array(
					'id' => 'info',
					'type' => 'info',
					'desc' => __('Adding this Item will show Content from WordPress Editor above Page Options. You can use it only once per page. Please also remember to turn on "Hide The Content" option.', 'nhp-opts'),
				),

			),														
		),
	
		// Divider  --------------------------------------------
		'divider' => array(
			'type' => 'divider',
			'title' => __('Divider', 'mfn-opts'), 
			'size' => '1/1',
			'fields' => array(
		
				array(
					'id' => 'height',
					'type' => 'text',
					'title' => __('Divider height', 'mfn-opts'),
					'desc' => __('px', 'mfn-opts'),
					'class' => 'small-text',
				),
				
				array(
					'id' => 'line',
					'type' => 'select',
					'options' => array( 0 => 'No', 1 => 'Yes' ),
					'title' => __('Show line', 'mfn-opts'),
					'sub_desc' => __('Display horizontal line as a divider.', 'mfn-opts'),
				),
				
			),														
		),	
		
		// Fancy Heading --------------------------------------------
		'fancy_heading' => array(
			'type' => 'fancy_heading',
			'title' => __('Fancy Heading', 'mfn-opts'), 
			'size' => '1/1', 
			'fields' => array(
		
				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
				),
		
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Content', 'mfn-opts'),
					'validate' => 'html',
				),
				
				array(
					'id' => 'icon',
					'type' => 'text',
					'title' => __('Icon', 'mfn-opts'),
					'desc' => __('Font Awesome Icon, eg. <strong>icon-reorder</strong>', 'mfn-opts'),
					'class' => 'small-text',
				),
				
				array(
					'id' => 'image',
					'type' => 'upload',
					'title' => __('Background Image', 'mfn-opts'),
				),

				array(
					'id' => 'color',
					'type' => 'text',
					'title' => __('Background Color', 'mfn-opts'),
					'desc' => __('Use color name (eg. "gray") or hex (eg. "#808080").', 'mfn-opts'),
					'class' => 'small-text',
				),
				
				array(
					'id' => 'class',
					'type' => 'text',
					'title' => __('Custom CSS classes', 'mfn-opts'),
					'desc' => __('Multiple classes should be separated with SPACE.<br />For sections with dark background you can use class: <strong>dark</strong>', 'mfn-opts'),
				),
				
			),															
		),
		
		// FAQ  --------------------------------------------
		'faq' => array(
			'type' => 'faq',
			'title' => __('FAQ', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
				
				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
				),
					
				array(
					'id' => 'tabs',
					'type' => 'tabs',
					'title' => __('FAQ', 'mfn-opts'),
					'sub_desc' => __('Manage FAQ tabs.', 'mfn-opts'),
					'desc' => __('You can use Drag & Drop to set the order.', 'mfn-opts'),
				),
					
				array(
					'id' => 'open1st',
					'type' => 'select',
					'options' => array( 0 => 'No', 1 => 'Yes' ),
					'title' => __('Open First', 'mfn-opts'),
					'desc' => __('Open first tab at start.', 'mfn-opts'),
				),
				
			),															
		),
		
		// Feature box  --------------------------------------------
		'feature_box' => array(
			'type' => 'feature_box',
			'title' => __('Feature Box', 'mfn-opts'),
			'size' => '1/2',
			'fields' => array(
		
				array(
					'id' => 'image',
					'type' => 'upload',
					'title' => __('Image', 'mfn-opts'),
					'sub_desc' => __('Featured Image', 'mfn-opts'),
					'desc' => __('Recommended image size 576px x 385px or larger.', 'mfn-opts'),
				),
					
				array(
					'id' => 'icon',
					'type' => 'text',
					'title' => __('Icon', 'mfn-opts'),
					'desc' => __('Font Awesome Icon, eg. <strong>icon-heart</strong>', 'mfn-opts'),
					'class' => 'small-text',
					'std' => 'icon-heart',
				),
				
				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
				),
					
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Content', 'mfn-opts'),
					'desc' => __('HTML tags allowed.', 'mfn-opts')
				),
					
				array(
					'id' => 'link',
					'type' => 'text',
					'title' => __('Link', 'mfn-opts'),
				),
		
				array(
					'id' => 'target',
					'type' => 'select',
					'options' => array( 0 => 'No', 1 => 'Yes' ),
					'title' => __('Open in new window', 'mfn-opts'),
					'desc' => __('Adds a target="_blank" attribute to the link.', 'mfn-opts'),
				),
					
			),
		),
		
		// Icon Box  --------------------------------------------------
		'icon_box' => array(
			'type' => 'icon_box',
			'title' => __('Icon Box', 'mfn-opts'), 
			'size' => '1/4',
			'fields' => array(
		
				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
				),
					
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Content', 'mfn-opts'),
				),
		
				array(
					'id' => 'icon',
					'type' => 'text',
					'title' => __('Icon', 'mfn-opts'),
					'desc' => __('Font Awesome Icon, eg. <strong>icon-xing</strong>', 'mfn-opts'),
					'std' => 'icon-xing',
					'class' => 'small-text',
				),
				
				array(
					'id' => 'image',
					'type' => 'upload',
					'title' => __('Image', 'mfn-opts'),
					'desc' => __('If you upload an image, icon will not show.', 'mfn-opts'),
				),
				
				array(
					'id' => 'link_title',
					'type' => 'text',
					'title' => __('Link Title', 'mfn-opts'),
					'std' => 'Read more',
					'class' => 'small-text',
				),
				
				array(
					'id' => 'link',
					'type' => 'text',
					'title' => __('Link', 'mfn-opts'),
				),
				
				array(
					'id' => 'target',
					'type' => 'select',
					'options' => array( 0 => 'No', 1 => 'Yes' ),
					'title' => __('Open in new window', 'mfn-opts'),
					'desc' => __('Adds a target="_blank" attribute to the link.', 'mfn-opts'),
				),

			),														
		),
			
		// Image  --------------------------------------------------
		'image' => array(
			'type' => 'image',
			'title' => __('Image', 'mfn-opts'), 
			'size' => '1/4',
			'fields' => array(
		
				array(
					'id' => 'src',
					'type' => 'upload',
					'title' => __('Image', 'mfn-opts'),
				),
				
				array(
					'id' => 'alt',
					'type' => 'text',
					'title' => __('Alternate Text', 'mfn-opts'),
				),
				
				array(
					'id' => 'caption',
					'type' => 'text',
					'title' => __('Caption', 'mfn-opts'),
				),
				
				array(
					'id' => 'link_image',
					'type' => 'upload',
					'title' => __('Zoomed image', 'mfn-opts'),
					'desc' => __('This image will be opened in lightbox.', 'mfn-opts'),
				),
				
				array(
					'id' => 'link',
					'type' => 'text',
					'title' => __('Link', 'mfn-opts'),
					'desc' => __('This link will work only if you leave the above "Zoomed image" field empty.', 'mfn-opts'),
				),
				
			),														
		),
		
		// Map ---------------------------------------------
		'map' => array(
			'type' => 'map',
			'title' => __('Map', 'mfn-opts'), 
			'size' => '1/4',
			'fields' => array(

				array(
					'id' => 'lat',
					'type' => 'text',
					'title' => __('Google Maps Lat', 'mfn-opts'),
					'class' => 'small-text',
					'desc' => __('The map will appear only if this field is filled correctly.', 'mfn-opts'), 
				),
				
				array(
					'id' => 'lng',
					'type' => 'text',
					'title' => __('Google Maps Lng', 'mfn-opts'),
					'class' => 'small-text',
					'desc' => __('The map will appear only if this field is filled correctly.', 'mfn-opts'), 
				),
				
				array(
					'id' => 'height',
					'type' => 'text',
					'title' => __('Height', 'mfn-opts'),
					'desc' => 'px',
					'class' => 'small-text',
					'std' => 200,
				),
				
				array(
					'id' => 'zoom',
					'type' => 'text',
					'title' => __('Zoom', 'mfn-opts'),
					'class' => 'small-text',
					'std' => 13,
				),
				
			),														
		),
			
		// Offer --------------------------------------------
		'offer' => array(
			'type' => 'offer',
			'title' => __('Offer', 'mfn-opts'), 
			'size' => '1/1',
			'fields' => array(
				
				array(
					'id' => 'info',
					'type' => 'info',
					'desc' => __('There is no settings for this item.', 'nhp-opts'),
				),
				
			),														
		),
		
		// Our team --------------------------------------------
		'our_team' => array(
			'type' => 'our_team',
			'title' => __('Our Team', 'mfn-opts'), 
			'size' => '1/4',
			'fields' => array(
				
				array(
					'id' => 'image',
					'type' => 'upload',
					'title' => __('Photo', 'mfn-opts'),
				),
				
				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
					'sub_desc' => __('Will also be used as the image alternative text.', 'mfn-opts'),
				),
				
				array(
					'id' => 'subtitle',
					'type' => 'text',
					'title' => __('Subtitle', 'mfn-opts'),
				),
				
				array(
					'id' => 'phone',
					'type' => 'text',
					'title' => __('Phone', 'mfn-opts'),
				),
				
				array(
					'id' => 'email',
					'type' => 'text',
					'title' => __('E-mail', 'mfn-opts'),
				),
				
				array(
					'id' => 'facebook',
					'type' => 'text',
					'title' => __('Facebook', 'mfn-opts'),
				),
				
				array(
					'id' => 'twitter',
					'type' => 'text',
					'title' => __('Twitter', 'mfn-opts'),
				),
				
				array(
					'id' => 'linkedin',
					'type' => 'text',
					'title' => __('LinkedIn', 'mfn-opts'),
				),
				
			),														
		),
				
		// Portfolio --------------------------------------------
		'portfolio' => array(
			'type' => 'portfolio',
			'title' => __('Portfolio', 'mfn-opts'),
			'size' => '1/1',
			'fields' => array(
				
				array(
					'id' => 'link',
					'type' => 'text',
					'title' => __('Link', 'mfn-opts'),
					'desc' => __('Portfolio or Category Page Link', 'mfn-opts'),
				),
					
				array(
					'id' => 'count',
					'type' => 'text',
					'title' => __('Count', 'mfn-opts'),
					'desc' => __('We <strong>do not</strong> recommend use more than 10 items, because site will be working slowly.', 'mfn-opts'),
					'std' => '5',
					'class' => 'small-text',
				),

				array(
					'id' => 'category',
					'type' => 'select',
					'title' => __('Category', 'mfn-opts'),
					'options' => mfn_get_categories( 'portfolio-types' ),
					'sub_desc' => __('Select the portfolio post category.', 'mfn-opts'),
				),

				array(
					'id' => 'orderby',
					'type' => 'select',
					'title' => __('Order by', 'mfn-opts'),
					'sub_desc' => __('Portfolio items order by column.', 'mfn-opts'),
					'options' => array('date'=>'Date', 'menu_order' => 'Menu order', 'title'=>'Title'),
					'std' => 'menu_order'
				),
		
				array(
					'id' => 'order',
					'type' => 'select',
					'title' => __('Order', 'mfn-opts'),
					'sub_desc' => __('Portfolio items order.', 'mfn-opts'),
					'options' => array('ASC' => 'Ascending', 'DESC' => 'Descending'),
					'std' => 'ASC'
				),
		
			),
		),
		
		// Pricing item --------------------------------------------
		'pricing_item' => array(
			'type' => 'pricing_item',
			'title' => __('Pricing Item', 'mfn-opts'), 
			'size' => '1/4',
			'fields' => array(
		
				array(
					'id' 	=> 'title',
					'type' 	=> 'text',
					'title' => __('Title', 'mfn-opts'),
					'sub_desc' => __('Pricing item title', 'mfn-opts'),
				),
				
				array(
					'id' 	=> 'subtitle',
					'type' 	=> 'text',
					'title' => __('Subtitle', 'mfn-opts'),
				),
				
				array(
					'id' => 'price',
					'type' => 'text',
					'title' => __('Price', 'mfn-opts'),
					'class' => 'small-text',
				),
				
				array(
					'id' => 'currency',
					'type' => 'text',
					'title' => __('Currency', 'mfn-opts'),
					'class' => 'small-text',
				),
					
				array(
					'id' => 'period',
					'type' => 'text',
					'title' => __('Period', 'mfn-opts'),
					'class' => 'small-text',
				),
				
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Content', 'mfn-opts'),
					'desc' => __('HTML tags allowed.', 'mfn-opts'),
					'std' => '<ul><li><strong>List</strong> item</li></ul>',
				),
				
				array(
					'id' => 'link_title',
					'type' => 'text',
					'title' => __('Link title', 'mfn-opts'),
					'desc' => __('Link will appear only if this field will be filled.', 'mfn-opts'),
				),
				
				array(
					'id' => 'link',
					'type' => 'text',
					'title' => __('Link', 'mfn-opts'),
					'desc' => __('Link will appear only if this field will be filled.', 'mfn-opts'),
				),
				
				array(
					'id' => 'featured',
					'type' => 'select',
					'title' => __('Featured', 'mfn-opts'),
					'options' => array( 0 => 'No', 1 => 'Yes' ),
					'sub_desc' => __('This pricing item will be featured.', 'mfn-opts'),
					'desc' => __('Featured item is bigger and has different color.', 'mfn-opts'),
				),
				
			),														
		),
		
		// Progress Bars  --------------------------------------------
		'progress_bars' => array(
			'type' => 'progress_bars',
			'title' => __('Progress Bars', 'mfn-opts'),
			'size' => '1/4',
			'fields' => array(
	
				array(
					'id' => 'title',
					'type' => 'text',
					'title' => __('Title', 'mfn-opts'),
				),
					
				array(
					'id' => 'content',
					'type' => 'textarea',
					'title' => __('Content', 'mfn-opts'),
					'desc' => __('Please use <strong>[bar title="Title" value="50"]</strong> shortcodes here.', 'mfn-opts'),
					'std' => '[bar title="Bar1" value="50"]'."\n".'[bar title="Bar2" value="60"]',
				),
	
			),
		),
		
		// Tabs  --------------------------------------------
		'tabs' => array(
			'type' => 'tabs',
			'title' => __('Tabs', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
		
				array(
					'id' => 'tabs',
					'type' => 'tabs',
					'title' => __('Tabs', 'mfn-opts'),
					'sub_desc' => __('Manage tabs.', 'mfn-opts'),
					'desc' => __('You can use Drag & Drop to set the order.', 'mfn-opts'),
				),
				
			),															
		),
			
		// Testimonials --------------------------------------------
		'testimonials' => array(
			'type' => 'testimonials',
			'title' => __('Testimonials', 'mfn-opts'),
			'size' => '1/1',
			'fields' => array(
				
				array(
					'id' => 'category',
					'type' => 'select',
					'title' => __('Category', 'mfn-opts'),
					'options' => mfn_get_categories( 'testimonial-types' ),
					'sub_desc' => __('Select the testimonial post category.', 'mfn-opts'),
				),
				
				array(
					'id' => 'orderby',
					'type' => 'select',
					'title' => __('Order by', 'mfn-opts'),
					'sub_desc' => __('Testimonials order by column.', 'mfn-opts'),
					'options' => array('date'=>'Date', 'menu_order' => 'Menu order', 'title'=>'Title'),
					'std' => 'date'
				),
				
				array(
					'id' => 'order',
					'type' => 'select',
					'title' => __('Order', 'mfn-opts'),
					'sub_desc' => __('Testimonials order.', 'mfn-opts'),
					'options' => array('ASC' => 'Ascending', 'DESC' => 'Descending'),
					'std' => 'DESC'
				),
	
			),
		),
		
		// Timeline --------------------------------------------
		'timeline' => array(
			'type' => 'timeline',
			'title' => __('Timeline', 'mfn-opts'),
			'size' => '1/1',
			'fields' => array(
		
				array(
					'id' => 'tabs',
					'type' => 'tabs',
					'title' => __('Timeline', 'mfn-opts'),
					'sub_desc' => __('Please add <strong>date</strong> wrapped into <strong>span</strong> tag in Title field.<br/><br/>&lt;span&gt;2013&lt;/span&gt;Event Title', 'mfn-opts'),
					'desc' => __('You can use Drag & Drop to set the order.', 'mfn-opts'),
				),
		
			),
		),
		
		// Vimeo  --------------------------------------------
		'vimeo' => array(
			'type' => 'vimeo',
			'title' => __('Vimeo', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
		
				array(
					'id' => 'video',
					'type' => 'text',
					'title' => __('Vimeo video ID', 'mfn-opts'),
					'desc' => __('It`s placed in every Vimeo video link after the last /,for example: http://vimeo.com/<b>1084537</b>', 'mfn-opts')
				),
				
				array(
					'id' => 'width',
					'type' => 'text',
					'title' => __('Width', 'mfn-opts'),
					'desc' => __('px', 'mfn-opts'),
					'class' => 'small-text',
					'std' => 700,
				),
				
				array(
					'id' => 'height',
					'type' => 'text',
					'title' => __('Height', 'mfn-opts'),
					'desc' => __('px', 'mfn-opts'),
					'class' => 'small-text',
					'std' => 400,
				),
				
			),															
		),
		
		// YouTube  --------------------------------------------
		'youtube' => array(
			'type' => 'youtube',
			'title' => __('YouTube', 'mfn-opts'), 
			'size' => '1/4', 
			'fields' => array(
		
				array(
					'id' => 'video',
					'type' => 'text',
					'title' => __('YouTube video ID', 'mfn-opts'),
					'desc' => __('It`s placed in every YouTube video link after <b>v=</b> parameter, for example: http://www.youtube.com/watch?v=<b>YE7VzlLtp-4</b>', 'mfn-opts')
				),
				
				array(
					'id' => 'width',
					'type' => 'text',
					'title' => __('Width', 'mfn-opts'),
					'desc' => __('px', 'mfn-opts'),
					'class' => 'small-text',
					'std' => 700,
				),
				
				array(
					'id' => 'height',
					'type' => 'text',
					'title' => __('Height', 'mfn-opts'),
					'desc' => __('px', 'mfn-opts'),
					'class' => 'small-text',
					'std' => 420
				),
				
			),															
		),
		
	);
	
	// GET Sections & Items
	$mfn_items = get_post_meta($post->ID, 'mfn-page-items', true);
	$mfn_tmp_fn = 'base'.'64_decode';
	$mfn_items = unserialize(call_user_func($mfn_tmp_fn, $mfn_items));

	// OLD Content Builder 1.0 Compatibility
	if( is_array( $mfn_items ) && ! key_exists( 'attr', $mfn_items[0] ) ){
		$mfn_items_builder2 = array(
			'attr'	=> $mfn_std_section,
			'items'	=> $mfn_items
		);
		$mfn_items = array( $mfn_items_builder2 );
	}

// 	print_r($mfn_items);
	$mfn_sections_count = is_array( $mfn_items ) ? count( $mfn_items ) : 0;	
	
	?>
	<div id="mfn-builder">
		<input type="hidden" id="mfn-row-id" value="<?php echo $mfn_sections_count; ?>" />
		<a id="mfn-go-to-top" href="javascript:void(0);">Go to top</a>
	
		<div id="mfn-content">
		
		
			<!-- .mfn-row-add ================================================ -->			
			<div class="mfn-row-add">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<td>
								<a class="btn-blue mfn-row-add-btn" href="javascript:void(0);"><em></em>Add Section</a>
								<div class="logo">Muffin Group | Muffin Builder</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			
			<!-- #mfn-desk ================================================== -->
			<div id="mfn-desk" class="clearfix">
			
				<?php
					for( $i = 0; $i < $mfn_sections_count; $i++ ) {
						mfn_builder_section( $mfn_std_items, $mfn_std_section, $mfn_items[$i], $i+1 );
					}
				?>
			
			</div>
			
			
			<!-- #mfn-rows ================================================= -->
			<div id="mfn-rows" class="clearfix">
				<?php mfn_builder_section( $mfn_std_items, $mfn_std_section ); ?>
			</div>
						
			
			<!-- #mfn-items =============================================== -->
			<div id="mfn-items" class="clearfix">
				<?php
					foreach( $mfn_std_items as $item ){
						mfn_builder_item( $item );
					}
				?>				
			</div>
	
		</div>
		
		<!-- #mfn-popup -->
		<div id="mfn-popup">
			<a href="javascript:void(0);" class="mfn-btn-close mfn-popup-close">Close</a>	
			<a href="javascript:void(0);" class="mfn-popup-save">Save changes</a>	
		</div>
		
	</div>
	<?php 

}


/*-----------------------------------------------------------------------------------*/
/*	SAVE Muffin Builder
/*-----------------------------------------------------------------------------------*/
function mfn_builder_save($post_id) {

	$mfn_items = array();
// 	print_r($_POST);

	
	// sections loop -------------------------------------------------------------
	if( key_exists('mfn-row-id', $_POST) && is_array($_POST['mfn-row-id']))
	{
		// foreach $_POST['mfn-row-id']
		foreach( $_POST['mfn-row-id'] as $sectionID_k => $sectionID )
		{
			$section = array();
				
			// $section['attr'] - section attributes
			if( key_exists('mfn-rows', $_POST) && is_array($_POST['mfn-rows'])){
				foreach ( $_POST['mfn-rows'] as $section_attr_k => $section_attr ){
					$section['attr'][$section_attr_k] = $section_attr[$sectionID_k];
				}
			}
				
			// $section['items'] - section items will be added in the next foreach
			$section['items'] = '';
				
			$mfn_items[] = $section;
		}
	
		$newParentSectionIDs = array_flip( $_POST['mfn-row-id'] );
	}	
	
	// items loop ----------------------------------------------------------------
	if( key_exists('mfn-item-type', $_POST) && is_array($_POST['mfn-item-type']))
	{
		$count = array();
		$tabs_count = array();
	
		foreach( $_POST['mfn-item-type'] as $type_k => $type )
		{
			$item = array();
			$item['type'] = $type;
			$item['size'] = $_POST['mfn-item-size'][$type_k];
				
			// init count for specified item type
			if( ! key_exists($type, $count) ){
				$count[$type] = 0;
			}
			
			// init count for specified tab type
			if( ! key_exists($type, $tabs_count) ){
				$tabs_count[$type] = 0;
			}
			
			if( key_exists($type, $_POST['mfn-items']) ){	
				foreach( (array) $_POST['mfn-items'][$type] as $attr_k => $attr ){

					if( $attr_k == 'tabs'){
						// accordion, faq & tabs ----------------------------
						$item['fields']['count'] = $attr['count'][$count[$type]];
						if( $item['fields']['count'] ){
							for ($i = 0; $i < $item['fields']['count']; $i++) {
								$tab = array();
								$tab['title'] = stripslashes($attr['title'][$tabs_count[$type]]);
								$tab['content'] = stripslashes($attr['content'][$tabs_count[$type]]);
								$item['fields']['tabs'][] = $tab;
								$tabs_count[$type]++;
							}
						}
					
					} else {
						$item['fields'][$attr_k] = stripslashes($attr[$count[$type]]);
					}
					
				}
			}
				
			// increase count for specified item type
			$count[$type] ++;
				
			// new parent section ID
			$parentSectionID = $_POST['mfn-item-parent'][$type_k];
			$newParentSectionID = $newParentSectionIDs[$parentSectionID];
				
			// $section['items']
			$mfn_items[$newParentSectionID]['items'][] = $item;
		}
	}
// 	print_r($mfn_items);
	
	
	// save -----------------------------------------------
	if( $mfn_items )
	{
		$mfn_tmp_fn = 'base'.'64_encode';
		$new = call_user_func($mfn_tmp_fn, serialize($mfn_items));		
	}
	
	
	// "quick edit" fix -----------------------------------
	if( key_exists('mfn-items', $_POST) )
	{
		$field['id'] = 'mfn-page-items';
		$old = get_post_meta($post_id, $field['id'], true);
		
		if( isset($new) && $new != $old ) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif( '' == $new && $old ) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}


/*-----------------------------------------------------------------------------------*/
/*	PRINT Muffin Builder - FRONTEND
/*-----------------------------------------------------------------------------------*/
function mfn_builder_print( $post_id ) {

	// Sizes for Items
	$classes = array(
		'1/4' => 'one-fourth',
		'1/3' => 'one-third',
		'1/2' => 'one-second',
		'2/3' => 'two-third',
		'3/4' => 'three-fourth',
		'1/1' => 'one'
	);

	// Sidebars list
	$sidebars = mfn_opts_get( 'sidebars' );
	
	// GET Sections & Items
	$mfn_items = get_post_meta( $post_id, 'mfn-page-items', true );
	$mfn_tmp_fn = 'base'.'64_decode';
	$mfn_items = unserialize(call_user_func($mfn_tmp_fn, $mfn_items));
	
// 	print_r($mfn_items);
	
	// Content Builder
	if( is_array( $mfn_items ) ){
		// Sections
		foreach( $mfn_items as $section ){
		
// 			print_r($section['attr']);

			// section attributes ----------------------------

			// Sidebar for section -------------
			if( ( ! mfn_sidebar_classes() ) && // don't show sidebar for section if sidebar for page is set
				( ( $section['attr']['layout'] == 'right-sidebar' ) || ( $section['attr']['layout'] == 'left-sidebar' ) ) )
			{
				$section_sidebar = $section['attr']['layout'];
			} else {
				$section_sidebar = false;
			}

			// classes ------------------------
			$section_class 		= array();
			$section_class[]	= $section_sidebar;
			$section_class[]	= $section['attr']['class'];
			$section_class		= implode(' ', $section_class);
		
			// styles -------------------------
			$section_style 		= '';

			// image || color background sections only
			if( $section['attr']['bg_color'] || $section['attr']['bg_image'] ){
				$section_padding_bottom = intval( $section['attr']['padding'] ) >= 20 ? intval( $section['attr']['padding'] )-20 : intval( $section['attr']['padding'] );
				$section_style[] 	= 'padding:'. intval( $section['attr']['padding'] ) .'px 0 '. $section_padding_bottom .'px';
			} else {
				$section_style[] 	= 'padding:'. intval( $section['attr']['padding'] ) .'px 0';
			}

			$section_style[] 	= 'background-color:'. $section['attr']['bg_color'];
			
			// background image attributes
			if( $section['attr']['bg_image'] ){
				$section_style[] 	= 'background-image:url('. $section['attr']['bg_image'] .')';
				$section_bg_attr 	= explode(';', $section['attr']['bg_position']);
				$section_style[] 	= 'background-repeat:'. $section_bg_attr[0];
				$section_style[] 	= 'background-position:'. $section_bg_attr[1];
				$section_style[] 	= 'background-attachment:'. $section_bg_attr[2];
				$section_style[] 	= '-webkit-background-size:'. $section_bg_attr[3];
				$section_style[] 	= 'background-size:'. $section_bg_attr[3];
			}
			
			$section_style 		= implode('; ', $section_style );
			
			// print ------------------------------------------
			
			echo '<div class="section '. $section_class .'" style="'. $section_style .'">'; // 100%
				echo '<div class="section_wrapper clearfix">'; // WIDTH + margin: 0 auto
					
					// Items ------------------------
					echo '<div class="items_group clearfix">'; // 100% || WIDTH (sidebar)
						if( is_array( $section['items'] ) ){			
							foreach( $section['items'] as $item ){
							
								if( function_exists( 'mfn_print_'. $item['type'] ) ){
									
									$class  = $classes[$item['size']];	// size of item
									$class .= ' '. $item['type'];		// type of item
										
									echo '<div class="column '. $class .'">';
										call_user_func( 'mfn_print_'. $item['type'], $item );
									echo '</div>';
								}
		
							}
						}
					echo '</div>';
					
					// Sidebar for section -----------
					if( $section_sidebar ){
						echo '<div class="four columns section_sidebar">';
							echo '<div class="widget-area clearfix">';
								dynamic_sidebar( $sidebars[$section['attr']['sidebar']] );
							echo '</div>';
						echo '</div>';
					}
					
				echo '</div>';
			echo '</div>';
		}
	}
	
	// WordPress Editor Content -------------------------------------
	if( ! get_post_meta( $post_id, 'mfn-post-hide-content', true ) && get_the_content() ){
		echo '<div class="section the_content">';
			echo '<div class="section_wrapper">';
				echo '<div class="the_content_wrapper">';
					the_content();
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
}


/*-----------------------------------------------------------------------------------*/
/*	PRINT Item - FRONTEND
/*-----------------------------------------------------------------------------------*/

// ---------- [accordion] -----------
function mfn_print_accordion( $item ) {
	echo sc_accordion( $item['fields'] );
}

// ---------- [article_box] -----------
function mfn_print_article_box( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_article_box( $item['fields'], $item['fields']['content'] );
}

// ---------- [blockquote] -----------
function mfn_print_blockquote( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_blockquote( $item['fields'], $item['fields']['content'] );
}

// ---------- [call_to_action] -----------
function mfn_print_call_to_action( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_call_to_action( $item['fields'], $item['fields']['content'] );
}

// ---------- [clients] -----------
function mfn_print_clients( $item ) {
	echo sc_clients( $item['fields'] );
}

// ---------- [code] -----------
function mfn_print_code( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_code( $item['fields'], $item['fields']['content'] );
}

// ---------- [column] -----------
function mfn_print_column( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo do_shortcode( $item['fields']['content'] );
}

// ---------- [contact_box] -----------
function mfn_print_contact_box( $item ) {
	echo sc_contact_box( $item['fields'] );
}

// ---------- [content] -----------
function mfn_print_content( $item ) {
	echo '<div class="the_content">';
		the_content();
	echo '</div>';
}

// ---------- [divider] -----------
function mfn_print_divider( $item ) {
	echo sc_divider( $item['fields'] );
}

// ---------- [faq] -----------
function mfn_print_faq( $item ) {
	echo sc_faq( $item['fields'] );
}

// ---------- [fancy_heading] -----------
function mfn_print_fancy_heading( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_fancy_heading( $item['fields'], $item['fields']['content'] );
}

// ---------- [feature_box] -----------
function mfn_print_feature_box( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_feature_box( $item['fields'], $item['fields']['content'] );
}

// ---------- [icon_box] -----------
function mfn_print_icon_box( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_icon_box( $item['fields'], $item['fields']['content'] );
}

// ---------- [image] -----------
function mfn_print_image( $item ) {
	echo sc_image( $item['fields'] );
}

// ---------- [info_box] -----------
function mfn_print_info_box( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_info_box( $item['fields'], $item['fields']['content'] );
}

// ---------- [latest_posts] -----------
function mfn_print_latest_posts( $item ) {
	echo sc_latest_posts( $item['fields'] );
}

// ---------- [map] -----------
function mfn_print_map( $item ) {
	echo sc_map( $item['fields'] );
}

// ---------- [offer] -----------
function mfn_print_offer( $item ) {
	echo sc_offer();
}

// ---------- [our_team] -----------
function mfn_print_our_team( $item ) {
	echo sc_our_team( $item['fields'] );
}

// ---------- [portfolio] -----------
function mfn_print_portfolio( $item ) {
	echo sc_portfolio( $item['fields'] );
}

// ---------- [pricing_item] -----------
function mfn_print_pricing_item( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_pricing_item( $item['fields'], $item['fields']['content'] );
}

// ---------- [progress_bars] -----------
function mfn_print_progress_bars( $item ) {
	if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
	echo sc_progress_bars( $item['fields'], $item['fields']['content'] );
}

// ---------- [tabs] -----------
function mfn_print_tabs( $item ) {
	echo sc_tabs( $item['fields'] );
}

// ---------- [testimonials] -----------
function mfn_print_testimonials( $item ) {
	echo sc_testimonials( $item['fields'] );
}

// ---------- [timeline] -----------
function mfn_print_timeline( $item ) {
	echo sc_timeline( $item['fields'] );
}

// ---------- [vimeo] -----------
function mfn_print_vimeo( $item ) {
	echo sc_vimeo( $item['fields'] );
}

// ---------- [youtube] -----------
function mfn_print_youtube( $item ) {
	echo sc_youtube( $item['fields'] );
}

?>
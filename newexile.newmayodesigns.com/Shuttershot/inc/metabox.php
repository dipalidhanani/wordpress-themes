<?php

$prefix = 'wtf_';

$fields = array(
	array( // Image ID field
		'label'	=> 'Slide item', // <label>
		'desc'	=> 'Add an image to the slider.', // description
		'id'	=> $prefix.'slider', // field id and name
		'type'	=> 'image' // type of field
	),
	
	array( // Text Input
		'label'	=> 'External url', // <label>
		'desc'	=> 'Add an external url to link the image.', // description
		'id'	=> $prefix.'extlink', // field id and name
		'type'	=> 'text' // type of field
	)


);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$sample_box = new custom_add_meta_box( 'sample_box', 'Slideshow', $fields, 'slides', true );

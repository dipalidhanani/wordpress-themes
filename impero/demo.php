<?php
add_filter( 'rwmb_meta_boxes', 'salmon_register_meta_boxes' );
function salmon_register_meta_boxes( $meta_boxes ){
	$prefix = 'salmon';
	$meta_boxes[] = array(
		'id' => 'salmon_application_email_settings',
		'title' => __( 'Application Email Settings', 'rwmb' ),
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => __( 'To', 'rwmb' ),
				'id'    => "{$prefix}to",
				'desc'  => __( 'To email address', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'From', 'rwmb' ),
				'id'    => "{$prefix}from",
				'desc'  => __( 'From email address', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'Reply To', 'rwmb' ),
				'id'    => "{$prefix}reply_to",
				'desc'  => __( 'Reply To email address', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'Subject', 'rwmb' ),
				'id'    => "{$prefix}subject",
				// Field description (optional)
				'desc'  => __( 'Mail subject', 'rwmb' ),
				'type'  => 'text',
				// Default value (optional)
				'std'   => '',
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			),
			array(
				'name' => __( 'Message', 'rwmb' ),
				'desc' => __( 'Mail Message Body', 'rwmb' ),
				'id'   => "{$prefix}message",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
		)
	);
	return $meta_boxes;
}
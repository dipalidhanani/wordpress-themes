<?php
add_action( 'admin_enqueue_scripts', 'ninja_forms_conditionals_admin_js', 10, 2 );
function ninja_forms_conditionals_admin_js( $form_id ){
	if( isset( $_REQUEST['page'] ) AND $_REQUEST['page'] == 'ninja-forms' ){
		wp_enqueue_script( 'ninja-forms-conditionals-admin',
			NINJA_FORMS_CON_URL .'/js/min/ninja-forms-conditionals-admin.min.js',
			array( 'jquery', 'ninja-forms-admin' ) );
	}
}

add_action( 'admin_enqueue_scripts', 'ninja_forms_conditionals_admin_css' );
function ninja_forms_conditionals_admin_css(){
	if( isset( $_REQUEST['page'] ) AND $_REQUEST['page'] == 'ninja-forms' ){
		wp_enqueue_style('ninja-forms-conditionals-admin', NINJA_FORMS_CON_URL .'/css/ninja-forms-conditionals-admin.css', array( 'ninja-forms-admin' ) );
	}
}
<?php
add_action('init', 'ninja_forms_register_filter_email_add_fields', 15 );
function ninja_forms_register_filter_email_add_fields(){
	global $ninja_forms_processing;

	if( is_object( $ninja_forms_processing ) ){
		if( $ninja_forms_processing->get_form_setting( 'user_email_fields' ) == 1 ){
			add_filter( 'ninja_forms_user_email', 'ninja_forms_filter_email_add_fields' );
		}
	}

	if( is_object( $ninja_forms_processing ) ){
		if( $ninja_forms_processing->get_form_setting( 'admin_email_fields' ) == 1 ){
			add_filter( 'ninja_forms_admin_email', 'ninja_forms_filter_email_add_fields' );
		}
	}
}

function ninja_forms_filter_email_add_fields( $message ){
	global $ninja_forms_processing, $ninja_forms_fields;

	$form_id = $ninja_forms_processing->get_form_ID();
	$all_fields = ninja_forms_get_fields_by_form_id( $form_id );
	//$all_fields = $ninja_forms_processing->get_all_fields();
	$tmp_array = array();
	if( is_array( $all_fields ) ){
		foreach( $all_fields as $field ){
			if( $ninja_forms_processing->get_field_value( $field['id'] ) ){
				$tmp_array[$field['id']] = $ninja_forms_processing->get_field_value( $field['id'] );
			}
		}
	}
	$all_fields = apply_filters( 'ninja_forms_email_all_fields_array', $tmp_array, $form_id );
	$email_type = $ninja_forms_processing->get_form_setting( 'email_type' );
	if(is_array($all_fields) AND !empty($all_fields)){
		if($email_type == 'html'){
			$message .= "<br><br>";
			$message .= __( 'User Submitted Values:', 'ninja-forms' );
			$message .= "<table>";
		}else{
			$message = str_replace("<p>", "\r\n", $message);
			$message = str_replace("</p>", "", $message);
			$message = str_replace("<br>", "\r\n", $message);
			$message = str_replace("<br />", "\r\n", $message);
			$message = strip_tags($message);
			$message .= "\r\n \r\n";
			$message .= __('User Submitted Values:', 'ninja-forms');
			$message .= "\r\n";
		}
		foreach( $all_fields as $field_id => $user_value ){

			$field_row = ninja_forms_get_field_by_id( $field_id );
			$field_label = $field_row['data']['label'];
			$field_label = apply_filters( 'ninja_forms_email_field_label', $field_label, $field_id );
			$user_value = apply_filters( 'ninja_forms_email_user_value', $user_value, $field_id );
			$field_type = $field_row['type'];

			if( $ninja_forms_fields[$field_type]['process_field'] ){
				if( is_array( $user_value ) AND !empty( $user_value ) ){
					$x = 0;
					foreach($user_value as $val){
						if(!is_array($val)){
							if($x > 0){
								$field_label = '----';
							}
							if($email_type == 'html'){
								$message .= "<tr><td width='50%'>".$field_label.":</td><td width='50%'>".$val."</td></tr>";
							}else{
								$message .= $field_label." - ".$val."\r\n";
							}
						}else{
							foreach($val as $v){
								if(!is_array($v)){
									if($x > 0){
										$field_label = '----';
									}
									if($email_type == 'html'){
										$message .= "<tr><td width='50%'>".$field_label.":</td><td width='50%'>".$v."</td></tr>";
									}else{
										$message .= $field_label." - ".$v."\r\n";
									}
								}else{
									foreach($v as $a){
										if($x > 0){
											$field_label = '----';
										}
										if($email_type == 'html'){
											$message .= "<tr><td width='50%'>".$field_label.":</td><td width='50%'>".$a."</td></tr>";
										}else{
											$message .= $field_label." - ".$a."\r\n";
										}
									}
								}
							}
						}
						$x++;
					}
				}else{
					if($email_type == 'html'){
						$message .= "<tr><td width='50%'>".$field_label.":</td><td width='50%'>".$user_value."</td></tr>";
					}else{
						$message .= $field_label." - ".$user_value."\r\n";
					}
				}

			}
		}
		
		
		/*	Send extra fields to email Start	*/
		$product_name = $_REQUEST['product_name'];
		$product_type = $_REQUEST['product_type'];
		$contract_period = $_REQUEST['contract_period'];
		$meter_type = $_REQUEST['meter_type'];
		$person_value = $_REQUEST['person_value'];
		$srch_electricity = $_REQUEST['srch_electricity'];
		$srch_electricity2 = $_REQUEST['srch_electricity2'];
		$srch_gas = $_REQUEST['srch_gas'];
		$include_discount = $_REQUEST['include_discount'];
		
		if( 'Elektriciteit & Gas' == $product_type ){
			$prod_name = explode('{@}', $product_name);
			$contract_period = explode('{@}', $contract_period);
			if($email_type == 'html'){
				$prod_name = 'Elektriciteit: '.$prod_name[0].'<br/> Gas: '.$prod_name[1];
				$contract_period = 'Elektriciteit: '.$contract_period[0].'<br/> Gas: '.$contract_period[1];
			}else{
				$prod_name = 'Elektriciteit: '.$prod_name[0].'\r\n Gas: '.$prod_name[1];
				$contract_period = 'Elektriciteit: '.$contract_period[0].'\r\n Gas: '.$contract_period[1];
			}
		}else{
			$prod_name = $product_name;
			$contract_period = $contract_period;
		}
		
		if($email_type == 'html'){
			$message .= "<tr><td width='50%'>Produktnaam:</td><td width='50%'>".$prod_name."</td></tr>";
			$message .= "<tr><td width='50%'>Type product:</td><td width='50%'>".$product_type."</td></tr>";
			$message .= "<tr><td width='50%'>Contract periode:</td><td width='50%'>".$contract_period."</td></tr>";
			$message .= "<tr><td width='50%'>Meter Type:</td><td width='50%'>".$meter_type."</td></tr>";
			$message .= "<tr><td width='50%'>Person Value:</td><td width='50%'>".$person_value."</td></tr>";
			$message .= "<tr><td width='50%'>Search Electricity:</td><td width='50%'>".$srch_electricity."</td></tr>";
			$message .= "<tr><td width='50%'>Search Electricity2:</td><td width='50%'>".$srch_electricity2."</td></tr>";
			$message .= "<tr><td width='50%'>Search Gas:</td><td width='50%'>".$srch_gas."</td></tr>";
			$message .= "<tr><td width='50%'>Include Discount:</td><td width='50%'>".$include_discount."</td></tr>";
		}else{
			$message .= "Produktnaam - ".$prod_name."\r\n";
			$message .= "Type product - ".$product_type."\r\n";
			$message .= "Contract periode - ".$contract_period."\r\n";
			$message .= "Meter Type - ".$meter_type."\r\n";
			$message .= "Person Value - ".$person_value."\r\n";
			$message .= "Search Electricity - ".$srch_electricity."\r\n";
			$message .= "Search Electricity2 - ".$srch_electricity2."\r\n";
			$message .= "Search Gas - ".$srch_gas."\r\n";
			$message .= "Include Discount - ".$include_discount."\r\n";
		}
		/*	Send extra fields to email end	*/
		
		if($email_type == 'html'){
			$message .= "</table>";
		}
	}
	$message = apply_filters( 'ninja_forms_email_field_list', $message, $form_id );

	return $message;
}
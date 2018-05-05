<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';

// Don't load alt stylesheet from WooFramework
if ( ! function_exists( 'woo_output_alt_stylesheet' ) ) {
	function woo_output_alt_stylesheet () {}
}

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', 'tnla49pj66y028vef95h2oqhkir0tf3jr' );

// WooFramework
require_once ( $functions_path . 'admin-init.php' );	// Framework Init

if ( get_option( 'woo_woo_tumblog_switch' ) == 'true' ) {
	//Enable Tumblog Functionality and theme is upgraded
	update_option( 'woo_needs_tumblog_upgrade', 'false' );
	update_option( 'tumblog_woo_tumblog_upgraded', 'true' );
	update_option( 'tumblog_woo_tumblog_upgraded_posts_done', 'true' );
	require_once ( $functions_path . 'admin-tumblog-quickpress.php' );  // Tumblog Dashboard Functionality
}

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 				// Options panel settings and custom settings
				'includes/theme-functions.php', 			// Custom theme functions
				'includes/theme-actions.php', 				// Theme actions & user defined hooks
				'includes/theme-comments.php', 				// Custom comments/pingback loop
				'includes/theme-js.php', 					// Load JavaScript via wp_enqueue_script
				'includes/theme-plugin-integrations.php',	// Plugin integrations
				'includes/sidebar-init.php', 				// Initialize widgetized areas
				'includes/theme-widgets.php',				// Theme widgets
				'includes/theme-advanced.php',				// Advanced Theme Functions
				'includes/theme-shortcodes.php',	 		// Custom theme shortcodes
				'includes/woo-layout/woo-layout.php',		// Layout Manager
				'includes/woo-meta/woo-meta.php',			// Meta Manager
				'includes/woo-hooks/woo-hooks.php'			// Hook Manager
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );

foreach ( $includes as $i ) {
	locate_template( $i, true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login.css' );
}
add_action('login_head', 'login_css');


add_action( 'init' , 'myyy_remove' , 15 );
function myyy_remove() {
remove_action('um_account_display_tabs_hook', 'um_account_display_tabs_hook');
 
}

add_action('um_account_display_tabs_hook', 'custom_um_account_display_tabs_hook');

function custom_um_account_display_tabs_hook( $args ) {
		global $ultimatemember;
		extract( $args );

		$ultimatemember->account->tabs = apply_filters('um_account_page_default_tabs_hook', $tabs=array() );

		ksort( $ultimatemember->account->tabs  );

		?>

			<ul class="account-tabmenu">

				<?php

				foreach( $ultimatemember->account->tabs as $k => $arr ) {
					foreach( $arr as $id => $info ) { extract( $info );

						$current_tab = $ultimatemember->account->current_tab;

						if ( isset($info['custom']) || um_get_option('account_tab_'.$id ) == 1 || $id == 'general' ) { ?>

				<li>
					<a data-tab="<?php echo $id; ?>" href="<?php echo $ultimatemember->account->tab_link($id); ?>" class="um-account-link <?php if ( $id == $current_tab ) echo 'current'; ?>">

						<?php if ( $ultimatemember->mobile->isMobile() ) { ?>
						<span class="um-account-icontip uimob800-show" title="<?php echo $title; ?>"><i class="<?php echo $icon; ?>"></i></span>
						<?php } else { ?>
						<span class="um-account-icontip uimob800-show um-tip-w" title="<?php echo $title; ?>"><i class="<?php echo $icon; ?>"></i></span>
						<?php } ?>

						<span class="um-account-icon uimob800-hide"><i class="<?php echo $icon; ?>"></i></span>
						<span class="um-account-title uimob800-hide"><?php echo $title; ?></span>
						<span class="um-account-arrow uimob800-hide"><?php echo ( is_rtl() ) ? '<i class="um-faicon-angle-left"></i>' : '<i class="um-faicon-angle-right"></i>'; ?></span>
					</a>
				</li>

				<?php

						}
					}
				}

				?>

			</ul>

		<?php

	}


remove_action('um_admin_user_action_hook', 'um_admin_user_action_hook');

add_action('um_admin_user_action_hook', 'custom_um_admin_user_action_hook');
	function custom_um_admin_user_action_hook( $action ){
		global $ultimatemember;
		
	//echo "jhgjg:".$action;
	switch ( $action ) {
			
			default:
				do_action("um_admin_custom_hook_{$action}", $ultimatemember->user->id );
				break;

			case 'um_put_as_pending':
				$ultimatemember->user->pending();
				break;
				
			case 'um_approve_membership':
				$ultimatemember->user->approve();
				 $corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
				update_user_meta ($ultimatemember->user->id, 'account_expiry_date', $corporate_user_expiry);	
				break;
			case 'um_reenable':
				$ultimatemember->user->approve();
				break;
				
			case 'um_reject_membership':
				$ultimatemember->user->reject();
				break;
				
			case 'um_resend_activation':
				$ultimatemember->user->email_pending();
				break;
				
			case 'um_deactivate':
				$ultimatemember->user->deactivate();
				break;
				
			case 'um_delete':
				if ( is_admin() )
					wp_die('This action is not allowed in backend.','ultimatemember');
				$ultimatemember->user->delete();
				break;

		}
	
	 
		
	}
	

/*** Update user after registraion ***/

function remove_anonymous_action( $name, $class, $method ){
        $actions = $GLOBALS['wp_filter'][ $name];
      /*  echo "<pre>";
        print_r($actions);
        echo "</pre>";*/
        if ( empty ( $actions ) ){
            return;
        }
        foreach ( $actions as $prity => $action ){
            foreach ( $action as $identifier => $function ){
                if ( is_array( $function) && is_a( $function['function'][0], $class ) && $method === $function['function'][1]){
                  print_r($function['function'][0]);
                  print_r($method);
                    remove_action($tag, array ( $function['function'][0], $method ), $prity);
                }
            }
        }
}

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">
    <?php if(get_the_author_meta( 'group_individual_account', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Group/Individual Account:</label></th>

			<td>
            <select name="group_individual_account" id="group_individual_account">
            <option value="Group Account" <?php if(get_the_author_meta( 'group_individual_account', $user->ID ) == 'Group Account'){ echo "selected"; }?>>Group Account</option>
            <option value="Individual Account" <?php if(get_the_author_meta( 'group_individual_account', $user->ID ) == 'Individual Account'){ echo "selected"; }?>>Individual Account</option>
            </select>				
				
			</td>
		</tr>
        <?php } ?>
<?php if(get_the_author_meta( 'user_subscription_type', $user->ID ) != ''){ ?>
		<tr>
			<th><label for="phone-number">Subscription Type:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_subscription_type', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'user_company_name', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Company Name:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_company_name', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'phone-number', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Phone Number:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'phone-number', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'address1', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Address1:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'address1', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'address2', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Address2:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'address2', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'user_city', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">City:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_city', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'user_province', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Province:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_province', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'user_postal_code', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Postal Code:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'user_postal_code', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
        
        <tr>
			<th><label for="phone-number">Billing Address1:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_address1', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        
        <tr>
			<th><label for="phone-number">Billing Address2:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_address2', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        
        <tr>
			<th><label for="phone-number">Billing City:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_city', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        
        <tr>
			<th><label for="phone-number">Billing Province:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_province', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        
        <tr>
			<th><label for="phone-number">Billing Postal Code:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_postalcode', $user->ID ) ); ?><br />
				
			</td>
		</tr>
         <?php if(get_the_author_meta( 'billing_payment_method', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Payment Method:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_payment_method', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'registration_fees', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Registration Fees:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'registration_fees', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
        <?php if(get_the_author_meta( 'credit_card_number', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Credit Card Number:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'credit_card_number', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'billing_cvv', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">CVV:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'billing_cvv', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'expiry_month', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Expiry Month:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'expiry_month', $user->ID ) ); ?><br />
				
			</td>
		</tr>
        <?php } ?>
         <?php if(get_the_author_meta( 'expiry_year', $user->ID ) != ''){ ?>
        <tr>
			<th><label for="phone-number">Expiry Year:</label></th>

			<td>
				<?php echo esc_attr( get_the_author_meta( 'expiry_year', $user->ID ) ); ?><br />
				
			</td>
		</tr>
		<?php } ?>
        
	</table>
<?php } 
add_action( 'personal_options_update', 'update_extra_profile_fields' );

// Hook is used to save custom fields that have been added to the WordPress profile page (if not current user) 
add_action( 'edit_user_profile_update', 'update_extra_profile_fields' );

function update_extra_profile_fields( $user_id ) {
    if ( current_user_can( 'edit_user', $user_id ) )
        update_user_meta( $user_id, 'group_individual_account', $_POST['group_individual_account'] );
}



remove_action('um_post_registration_listener', 'um_post_registration_listener', 10, 2);
add_action('um_post_registration_listener', 'custom_um_post_registration_listener', 10, 2);
	function custom_um_post_registration_listener($user_id, $args){
		global $ultimatemember;
		//um_user('status') = 'approved';
		if ( um_user('status') == 'pending' ) {
			$ultimatemember->mail->send( um_admin_email(), 'notification_new_user', array('admin' => true ) );
		} else {
			$ultimatemember->mail->send( um_admin_email(), 'notification_review', array('admin' => true ) );
		}

	}

/***
	***	@post-registration procedure
	***/
	remove_action('um_post_registration', 'um_post_registration', 10, 2);
	add_action('um_post_registration', 'custom_um_post_registration', 10, 2);
	function custom_um_post_registration($user_id, $args){
		global $ultimatemember;
		extract($args);
	  
		$status = um_user('status'); 	
			
		$corporate_or_individual_usr = get_the_author_meta( 'group_individual_account', $user_id );
		
	/*	if($corporate_or_individual_usr != ''){
			$status = 'approved';	
		 $corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
				update_user_meta ($ultimatemember->user->id, 'account_expiry_date', $corporate_user_expiry);
			}	
		else{
				$status = '';
			update_user_meta ($ultimatemember->user->id, 'account_status', 'approved');
			$corporate_user_expiry = date('Y-m-d', strtotime('+1 year'));
				update_user_meta ($ultimatemember->user->id, 'account_expiry_date', $corporate_user_expiry);
	
		$ultimatemember->mail->send( um_user('user_email'), 'pending_email' );
		
			}
	*/
			
		
		do_action("um_post_registration_global_hook", $user_id, $args);

		do_action("um_post_registration_{$status}_hook", $user_id, $args);

		if ( !is_admin() ) {

			do_action("track_{$status}_user_registration");

			// Priority redirect
			if ( isset( $args['redirect_to'] ) ) {
				exit( wp_redirect(  urldecode( $args['redirect_to'] ) ) );
			}

			if ( $status == 'approved' ) {

			//	$ultimatemember->user->auto_login($user_id);
				if ( um_user('auto_approve_act') == 'redirect_url' && um_user('auto_approve_url') !== '' ) exit( wp_redirect( home_url() ) );
				if ( um_user('auto_approve_act') == 'redirect_profile' ) exit( wp_redirect( home_url() ) );

			}

			if ( ($status != 'approved') && ( $status != '') ) {

				if ( um_user( $status . '_action' ) == 'redirect_url' && um_user( $status . '_url' ) != '' ) {
					exit( wp_redirect( um_user( $status . '_url' ) ) );
				}

				if ( um_user( $status . '_action' ) == 'show_message' && um_user( $status . '_message' ) != '' ) {
					$url = $ultimatemember->permalinks->get_current_url();
					$url =  add_query_arg( 'message', esc_attr( $status ), $url );
					$url =  add_query_arg( 'uid', esc_attr( um_user('ID') ), $url );

					exit( wp_redirect( $url ) );
				}

			}else{
					update_user_meta ($ultimatemember->user->id, 'account_status', 'approved');
				exit( wp_redirect( home_url() ) );}

		}

	}
	
 		add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
		function add_login_logout_link($items, $args) {
			         ob_start(); 
					 wp_loginout('index.php');
					 $loginoutlink = ob_get_contents();         
					 ob_end_clean();         
					 $items .= '<li id="menu-item-18">'. $loginoutlink .'</li>';     
					 return $items;
		}
    
    /**** Ultimate member mail start ****/
    
    
    remove_action('um_post_registration_approved_hook', 'um_post_registration_approved_hook', 10, 2);
    add_action('um_post_registration_approved_hook', 'custom_um_post_registration_approved_hook', 10, 2);



    function custom_um_post_registration_approved_hook($user_id, $args){
      
    	global $ultimatemember;

    	um_fetch_user( $user_id );
	
    	custom_approve();
    }

    function custom_approve(){
           
    	global $ultimatemember;
    	$user_id = um_user('ID');
    	delete_option( "um_cache_userdata_{$user_id}" );

    	if ( um_user('account_status') == 'awaiting_admin_review' ) {
    		$ultimatemember->user->password_reset_hash();
    		custom_send( um_user('user_email'), 'approved_email' );

    	} else {
    		$ultimatemember->user->password_reset_hash();
    		custom_send( um_user('user_email'), 'welcome_email');
    	}

    	$ultimatemember->user->set_status('approved');
    	$ultimatemember->user->delete_meta('account_secret_hash');
    	$ultimatemember->user->delete_meta('_um_cool_but_hard_to_guess_plain_pw');

    	do_action('um_after_user_is_approved', um_user('ID') );

    }

    function custom_send( $email, $template=null, $args = array() ) {
      global $ultimatemember;
    	if ( !$template ) return;
    	if ( um_get_option( $template . '_on' ) != 1 ) return;
    	if ( !is_email( $email ) ) return;

    	if($template == 'welcome_email'){
		
    		$ultimatemember->mail->attachments = array(WP_CONTENT_DIR . '/uploads/Administering_the_ELEVATE_Program.pdf');
    	}else{
	
    	$ultimatemember->mail->attachments = null;
    }
    	$ultimatemember->mail->headers = 'From: '. um_get_option('mail_from') .' <'. um_get_option('mail_from_addr') .'>' . "\r\n";

    	$ultimatemember->mail->subject = um_get_option( $template . '_sub' );
    	$ultimatemember->mail->subject = um_convert_tags( $ultimatemember->mail->subject, $args );

    	if ( isset( $args['admin'] ) || isset( $args['plain_text'] ) ) {
    		$ultimatemember->mail->force_plain_text = 'forced';
    	}


    	// HTML e-mail or text
    	if ( um_get_option('email_html') && $ultimatemember->mail->email_template( $template, $args ) ) {
    		add_filter( 'wp_mail_content_type', array(&$ultimatemember->mail, 'set_content_type') );
    		$ultimatemember->mail->message = file_get_contents( $ultimatemember->mail->email_template( $template, $args ) );
    	} else {
    		$ultimatemember->mail->message = um_get_option( $template );
    	}

    	// Convert tags in body
    	$ultimatemember->mail->message = um_convert_tags( $ultimatemember->mail->message, $args );
	
    	// Send mail
    	wp_mail( $email, $ultimatemember->mail->subject, $ultimatemember->mail->message, $ultimatemember->mail->headers, $ultimatemember->mail->attachments );
    	remove_filter( 'wp_mail_content_type', array(&$ultimatemember->mail, 'set_content_type')  );

    	// reset globals
    	$ultimatemember->mail->force_plain_text = '';

    }
    
    
    /**** Ultimate member mail end ****/
    
    
    /**** Question Messages start ****/
    
    if ( class_exists( 'WooThemes_Sensei_Question' ) ) {
    	global  $woothemes_sensei;
      
      remove_action( 'sensei_quiz_question_inside_before', array( 'Sensei_Question','the_question_title' ), 10 );
      add_action( 'sensei_quiz_question_inside_before', 'custom_the_question_title',10 );
      
      remove_action( 'sensei_quiz_question_inside_before', array( 'Sensei_Question', 'the_answer_result_indication' ), 50 );
      add_action( 'sensei_quiz_question_inside_before', 'custom_the_answer_result_indication' , 50 );   
      
      
      remove_action( 'sensei_quiz_question_inside_after', array( 'Sensei_Question', 'answer_feedback_notes' ) );
      add_action( 'sensei_quiz_question_inside_after', 'custom_answer_feedback_notes'  );   
    }
    
    /**
     * Echo the sensei question title.
     *
     * @uses WooThemes_Sensei_Question::get_the_question_title
     *
     * @since 1.9.0
     * @param $question_id
     */
    function custom_the_question_title( $question_id ){

        echo custom_get_the_question_title( $question_id );

    }// end the_question_title
    
    /**
     * Generate the question title with it's grade.
     *
     * @since 1.9.0
     *
     * @param $question_id
     * @return string
     */
    function custom_get_the_question_title( $question_id ){

        /**
         * Filter the sensei question title
         *
         * @since 1.3.0
         * @param $question_title
         */
        $title = apply_filters( 'sensei_question_title', get_the_title( $question_id ) );

        /**
         * hook document in class-woothemes-sensei-message.php the_title()
         */
        $title = apply_filters( 'sensei_single_title', $title, 'question');

        $title_html  = '<span class="question question-title">';
        $title_html .= $title;
       // $title_html .= '<span class="grade">' . Sensei()->question->get_question_grade( $question_id ) . '</span>';
        $title_html .='</span>';

        return $title_html;
    }
    
    /**
     * This function can only be run withing the single quiz question loop
     *
     * @since 1.9.0
     * @param $question_id
     */
     function custom_answer_feedback_notes( $question_id ){

        //IDS
        $quiz_id = get_the_ID();
        $lesson_id = Sensei()->quiz->get_lesson_id( $quiz_id );

	    // Make sure this user has submitted answers before we show anything
	    $user_answers = Sensei()->quiz->get_user_answers( $lesson_id, get_current_user_id() );
	    if ( empty( $user_answers ) ) {
		    return;
	    }


	    // Data to check before showing feedback
        $user_lesson_status = Sensei_Utils::user_lesson_status( $lesson_id, get_current_user_id() );
        $user_quiz_grade    = Sensei_Quiz::get_user_quiz_grade( $lesson_id, get_current_user_id() );
        $reset_quiz_allowed = Sensei_Quiz::is_reset_allowed( $lesson_id );
        $quiz_grade_type    = get_post_meta( $quiz_id , '_quiz_grade_type', true );
		$quiz_graded        = isset( $user_lesson_status->comment_approved ) && ! in_array( $user_lesson_status->comment_approved, array( 'ungraded', 'in-progress' ) );

	    $quiz_required_pass_grade = intval( get_post_meta($quiz_id, '_quiz_passmark', true) );
	    $failed_and_reset_not_allowed =  $user_quiz_grade < $quiz_required_pass_grade && ! $reset_quiz_allowed && $quiz_graded;

		// Check if answers must be shown
		$show_answers = false;
	    if ( $quiz_graded || $failed_and_reset_not_allowed ) {
	    	$show_answers = true;
	    }

	    /**
         * Allow dynamic overriding of whether to show question answers or not
         *
         * @since 1.9.7
         * 
         * @param boolean $show_answers
         * @param integer $question_id
         * @param integer $quiz_id
         * @param integer $lesson_id
         * @param integer $user_id
         */
	    $show_answers = apply_filters( 'sensei_question_show_answers', $show_answers, $question_id, $quiz_id, $lesson_id, get_current_user_id() );

		// Show answers if allowed
		if( $show_answers ) {
            $answer_notes = Sensei()->quiz->get_user_question_feedback( $lesson_id, $question_id, get_current_user_id() );

            if( $answer_notes ) { ?>

                <div class="grey-block">
                    <p>
                    <?php

                        /**
                         * Filter the answer feedback
                         * Since 1.9.0
                         *
                         * @param string $answer_notes
                         * @param string $question_id
                         * @param string $lesson_id
                         */
                        echo apply_filters( 'sensei_question_answer_notes', $answer_notes, $question_id, $lesson_id );

                    ?>
                  </p>
                </div>

            <?php }

        }// end if we can show answer feedback

    }// end answer_feedback_notes
    
  	/**
  	 * This function has to be run inside the quiz question loop on the single quiz page.
  	 *
  	 * It show the correct/incorrect answer per question depending on the quiz logic explained here:
  	 * https://docs.woothemes.com/document/sensei-quiz-settings-flowchart/
  	 *
  	 * Pseudo code for logic:  https://github.com/Automattic/sensei/issues/1422#issuecomment-214494263
  	 *
  	 * @since 1.9.0
  	 */
  	function custom_the_answer_result_indication(){

  		global $post,  $current_user, $sensei_question_loop;

  		$answer_message       = '';
  		$answer_message_class = '';
  		$quiz_id              = $sensei_question_loop['quiz_id'];
  		$question_item        = $sensei_question_loop['current_question'];
  		$lesson_id            = Sensei()->quiz->get_lesson_id( $quiz_id );
  		$user_lesson_status   = Sensei_Utils::user_lesson_status( $lesson_id, get_current_user_id() );
  		$quiz_graded          = isset( $user_lesson_status->comment_approved ) && ! in_array( $user_lesson_status->comment_approved, array( 'in-progress', 'ungraded' ) );

  		if ( ! Sensei_Utils::user_started_course( Sensei()->lesson->get_course_id( $lesson_id ), get_current_user_id() ) ) {
  			return;
  		}

  		if ( ! $quiz_graded ) {
  			return;
  		}

  		$user_quiz_grade          = Sensei_Quiz::get_user_quiz_grade( $lesson_id, get_current_user_id() );
  		$quiz_required_pass_grade = intval( get_post_meta($quiz_id, '_quiz_passmark', true) );
  		$user_passed              = $user_quiz_grade >= $quiz_required_pass_grade;

  		$show_answers = false;
  		if( ! Sensei_Quiz::is_pass_required( $lesson_id ) || $user_passed || ! Sensei_Quiz::is_reset_allowed( $lesson_id ) ) {
  			$show_answers = true;
  		}

  		// This filter is documented in self::answer_feedback_notes()
  		$show_answers = apply_filters( 'sensei_question_show_answers', $show_answers, $question_item->ID, $quiz_id, $lesson_id, get_current_user_id() );

  		if( $show_answers ) {
  			custom_output_result_indication( $lesson_id, $question_item->ID);
  			return;
  		}
  	}
    
  	/**
  	 * @since 1.9.5
  	 *
  	 * @param integer $lesson_id
  	 * @param integer $question_id
  	 */
  	function custom_output_result_indication( $lesson_id, $question_id ) {
  		$question_grade       = Sensei()->question->get_question_grade( $question_id );
  		$user_question_grade  = Sensei()->quiz->get_user_question_grade( $lesson_id, $question_id, get_current_user_id() );

  		// Defaults
  		$user_correct         = false;
  		$answer_message_class = 'incorrect';
  		$answer_message       = __( 'Incorrect - Right Answer:','woothemes-sensei') . ' ' . custom_get_correct_answer( $question_id );

  		// For zero grade mark as 'correct' but add no classes
  		if ( 0 == $question_grade   ) {
  			$user_correct         = true;
  			$answer_message_class = '';
  			$answer_message       = '';
  		} elseif( $user_question_grade > 0 ) {
  			$user_correct         = true;
  			$answer_message_class = 'correct';
  			//$answer_message       = sprintf( __( 'Grade: %d', 'woothemes-sensei' ), $user_question_grade );
        $answer_message       = 'Correct';
  		}

  		// setup answer feedback class
  		$answer_notes = Sensei()->quiz->get_user_question_feedback( $lesson_id, $question_id, get_current_user_id() );
  		if( $answer_notes ) {
  			$answer_message_class .= ' has_notes';
  		}

  		?>
  			<span class="<?php echo esc_attr( $answer_message_class ); ?>"><?php echo $answer_message; ?></span>
  		<?php
  	}
    
    
    
    /**
     * Get the correct answer for a question
     *
     * @param $question_id
     * @return string $correct_answer or empty
     */
    function custom_get_correct_answer( $question_id ){

        $right_answer = get_post_meta( $question_id, '_question_right_answer', true );
        $type = Sensei()->question->get_question_type( $question_id );
        $type_name = __( 'Multiple Choice', 'woothemes-sensei' );
        $grade_type = 'manual-grade';

        if ('boolean'== $type ) {

            $right_answer = ucfirst($right_answer);

        }elseif( 'multiple-choice' == $type ) {

            $right_answer = (array) $right_answer;
            $right_answer = implode( ', ', $right_answer );

        }elseif( 'gap-fill' == $type ) {

            $right_answer_array = explode( '||', $right_answer );
            if ( isset( $right_answer_array[0] ) ) { $gapfill_pre = $right_answer_array[0]; } else { $gapfill_pre = ''; }
            if ( isset( $right_answer_array[1] ) ) { $gapfill_gap = $right_answer_array[1]; } else { $gapfill_gap = ''; }
            if ( isset( $right_answer_array[2] ) ) { $gapfill_post = $right_answer_array[2]; } else { $gapfill_post = ''; }

            $right_answer = $gapfill_pre . ' <span class="highlight">' . $gapfill_gap . '</span> ' . $gapfill_post;

        }else{

            // for non auto gradable question types no answer should be returned.
            $right_answer = '';

        } /**
         * Filters the correct answer response.
         *
         * Can be used for text filters.
         *
         * @since 1.9.7
         *
         * @param string $right_answer Correct answer.
         * @param int    $question_id  Question ID
         */
        return apply_filters( 'sensei_questions_get_correct_answer', $right_answer, $question_id );

    } // get_correct_answer
    
    
    /**** Question Messages Ends ****/
    
    
    /**** Quiz Messages start ****/
    
    if ( class_exists( 'WooThemes_Sensei_Quiz' ) ) {
    	global  $woothemes_sensei;
      //add_action( 'sensei_single_quiz_content_inside_before', array( 'Sensei_Quiz', 'the_user_status_message' ), 40 );
      remove_action( 'sensei_single_quiz_content_inside_before', array( 'Sensei_Quiz', 'the_user_status_message' ), 40 );
      add_action( 'sensei_single_quiz_content_inside_before', 'custom_the_user_status_message' , 40 );
      
      remove_action( 'sensei_single_quiz_content_inside_before', array( 'Sensei_Quiz', 'the_title' ), 20 );
      add_action( 'sensei_single_quiz_content_inside_before', 'custom_lesson_the_title' , 20 ); 
    }
    
    /**
     * Output the sensei quiz status message.
     *
     * @param $quiz_id
     */
   function  custom_the_user_status_message( $quiz_id ){

       $lesson_id =  Sensei()->quiz->get_lesson_id( $quiz_id );
       $status = Sensei_Utils::sensei_user_quiz_status_message( $lesson_id , get_current_user_id() );
       
        $message = '<div class="congrats-text ' . $status['box_class'] . '"><p>' .  $status['message'] . '</p></div>';
       //$message = '<div class="sensei-message ' . $status['box_class'] . '">' . $status['message'] . '</div>';

       if ( !empty( Sensei()->frontend->messages ) ) {
         $message .= Sensei()->frontend->messages;
       }

       echo $message;
   }
    /**** Quiz Messages Ends ****/
    /**** Lesson Messages start ****/
    
    if ( class_exists( 'WooThemes_Sensei_Lesson' ) ) {
    	global  $woothemes_sensei;
      remove_action( 'sensei_single_lesson_content_inside_before', array( 'Sensei_Lesson', 'user_lesson_quiz_status_message' ), 20 );
      add_action( 'sensei_single_lesson_content_inside_before', 'custom_user_lesson_quiz_status_message' , 20 );
      
      remove_action( 'sensei_single_lesson_content_inside_before', array( 'Sensei_Lesson', 'the_title' ), 15 );
      add_action( 'sensei_single_lesson_content_inside_before', 'custom_lesson_the_title' , 15 ); 
    }
    /**
     * Output the title for the single lesson page
     *
     * @global $post
     * @since 1.9.0
     */
    function custom_lesson_the_title(){

        global $post;

        ?><div class="lession-detail-top">
            <h2 class="red">

                <?php
                /**
                 * Filter documented in class-sensei-messages.php the_title
                 */
                echo apply_filters( 'sensei_single_title', get_the_title( $post ), $post->post_type );
                ?>

            </h2>
          </div>
        <?php

    }//the_title
    
    
    /**
     * Display the leeson quiz status if it should be shown
     *
     * @param int $lesson_id defaults to the global lesson id
     * @param int $user_id defaults to the current user id
     *
     * @since 1.9.0
     */
    function custom_user_lesson_quiz_status_message( $lesson_id = 0, $user_id = 0){

        $lesson_id                 =  empty( $lesson_id ) ?  get_the_ID() : $lesson_id;
        $user_id                   = empty( $lesson_id ) ?  get_current_user_id() : $user_id;
        $lesson_course_id          = (int) get_post_meta( $lesson_id, '_lesson_course', true );
        $quiz_id                   = Sensei()->lesson->lesson_quizzes( $lesson_id );
        $has_user_completed_lesson = Sensei_Utils::user_completed_lesson( intval( $lesson_id ), $user_id );


        if ( $quiz_id && is_user_logged_in()
            && Sensei_Utils::user_started_course( $lesson_course_id, $user_id ) ) {

            $no_quiz_count = 0;
            $has_quiz_questions = get_post_meta( $lesson_id, '_quiz_has_questions', true );

            // Display lesson quiz status message
            if ( $has_user_completed_lesson || $has_quiz_questions ) {
                $status = Sensei_Utils::sensei_user_quiz_status_message( $lesson_id, $user_id, true );

	            if( ! empty( $status['message']  ) ){
	                echo '<div class="congrats-text ' . esc_attr( $status['box_class'] ) . '"><p>' . Sensei_Wp_Kses::wp_kses( $status['message'] ) . '</p></div>';
                }

                if( $has_quiz_questions ) {
                   // echo $status['extra'];
                } // End If Statement
            } // End If Statement

        }

    }

   /**** Lesson Messages start ****/
    /***** Progress Meter Start *********/  
  
    if ( class_exists( 'WooThemes_Sensei_Course' ) ) {
    	global  $woothemes_sensei;
      remove_action('sensei_single_course_content_inside_before', array( $woothemes_sensei->course,'the_progress_meter' ), 16);
      add_action( 'sensei_single_course_content_inside_before' , 'custom_attach_course_progress', 16 );
      
    	remove_action('sensei_course_content_inside_before', array( $woothemes_sensei->course, 'the_course_meta' ) );
    	add_action('sensei_course_content_inside_before', 'custom_the_course_meta'  );
      
      remove_action('sensei_single_course_content_inside_before', array( 'Sensei_Course', 'the_title' ) );
    	add_action('sensei_single_course_content_inside_before', 'custom_the_title2' );
      
    }
    
   
      function custom_the_title2(){
  	    if( ! is_singular( 'course' ) ){
  			return;
  	    }
          global $post;

          ?>
          <div class="course-detail-top">
                          	<h2 class="red"> <?php
                  /**
                   * Filter documented in class-sensei-messages.php the_title
                   */
                  echo apply_filters( 'sensei_single_title', get_the_title( $post ), $post->post_type );
                  ?>
                  </h2>
                              <a href="course-listing.html" class="back-btn"><span></span> Back</a>
                              <div class="clear"></div>
                              
                  <?
                    
                  $course = get_post( $course_id );
                  $category_output = get_the_term_list( $course->ID, 'course-category', '', ', ', '' );
                  $author_display_name = get_the_author_meta( 'display_name', $course->post_author  );
      
                  echo '<ul>
                    <li><span>'.Sensei()->course->course_lesson_count( $course->ID ) . '&nbsp;' .  __( 'Lessons', 'woothemes-sensei' ).'</span></li><li>/</li>';
      
                  if( Sensei_Utils::user_started_course( $course->ID,  get_current_user_id() )
                      || Sensei_Utils::user_completed_course( $course->ID,  get_current_user_id() )  ){

                      $completed = count( Sensei()->course->get_completed_lesson_ids( $course->ID, get_current_user_id() ) );
                      $lesson_count = count( Sensei()->course->course_lessons( $course->ID ) );
                      echo '<li>' . sprintf( __( '%1$d of %2$d lessons completed', 'woothemes-sensei' ) , $completed, $lesson_count  ) . '</li>';

                  }                    
                    echo  '</ul>';                    
                  ?>            
                          </div>

          <?php

      }// end the title


    function custom_attach_course_progress( $course_id ){
      global  $woothemes_sensei;
     /*  $percentage = Sensei()->course->get_completion_percentage( $course_id, get_current_user_id() );
       custom_get_progress_meter( $percentage );*/
     
       if( empty( $course_id ) ){
           global $post;
           $course_id = $post->ID;
       }

       if( empty( $user_id ) ){
           $user_id = get_current_user_id();
       }

       if( 'course' != get_post_type( $course_id ) || ! get_userdata( $user_id )
           || ! Sensei_Utils::user_started_course( $course_id ,$user_id ) ){
           return;
       }
       $percentage_completed = Sensei()->course->get_completion_percentage( $course_id, $user_id );

       echo custom_get_progress_meter( $percentage_completed );
  
   }
 
  	  /**
       * Generate the course meter component
       *
       * @since 1.8.0
       * @param int $progress_percentage 0 - 100
       * @return string $progress_bar_html
       */
      function custom_get_progress_meter( $progress_percentage ){

          if ( 50 < $progress_percentage ) {
              $class = ' green';
          } elseif ( 25 <= $progress_percentage && 50 >= $progress_percentage ) {
              $class = ' orange';
          } else {
              $class = ' red';
          }
       $progress_bar_html = '<div class="progress-bar"><div class="progress-barin"><div class="progress-status' . esc_attr( $class ) . '"><span style="width: ' . $progress_percentage . '%"></span></div><p>' . round( $progress_percentage ) . '%</p></div></div>';
  		

          return $progress_bar_html;

      }// end get_progress_meter
  
  
     if ( class_exists( 'Sensei_Shortcode_User_Courses' ) ) {
      	global  $woothemes_sensei;
        remove_action( 'sensei_course_content_inside_after', array( $woothemes_sensei->course, 'attach_course_progress' ) );
        add_action( 'sensei_course_content_inside_after','custom_attach_course_progress1' );
        

      }
    
      function custom_attach_course_progress1( $course_id ){
          $percentage = Sensei()->course->get_completion_percentage( $course_id, get_current_user_id() );
          echo custom_get_progress_meter( $percentage );

      }// attach_course_progress
    
    /***** Progress Meter End *********/ 
    
  	
    /**
     * Add course mata to the course meta hook
     *
     * @since 1.9.0
     * @param integer $course_id
     */
    function custom_the_course_meta( $course_id ){
      
      $course = get_post( $course_id );
      $category_output = get_the_term_list( $course->ID, 'course-category', '', ', ', '' );
      $author_display_name = get_the_author_meta( 'display_name', $course->post_author  );
      
      echo '<div class="clear"></div>';
      echo '<ul class="length">
        <li><span>'.Sensei()->course->course_lesson_count( $course->ID ) . '&nbsp;' .  __( 'Lessons', 'woothemes-sensei' ).'</span></li><li>/</li>';
      
      if( Sensei_Utils::user_started_course( $course->ID,  get_current_user_id() )
          || Sensei_Utils::user_completed_course( $course->ID,  get_current_user_id() )  ){

          $completed = count( Sensei()->course->get_completed_lesson_ids( $course->ID, get_current_user_id() ) );
          $lesson_count = count( Sensei()->course->course_lessons( $course->ID ) );
          echo '<li>' . sprintf( __( '%1$d of %2$d lessons completed', 'woothemes-sensei' ) , $completed, $lesson_count  ) . '</li>';

      }                    
        echo  '</ul>';
        sensei_simple_course_price( $course->ID );
        echo '<div class="clear"></div>';

/*        echo '<p class="sensei-course-meta test">';

       

        if ( isset( Sensei()->settings->settings[ 'course_author' ] ) && ( Sensei()->settings->settings[ 'course_author' ] ) ) {?>

            <span class="course-author"><?php _e( 'by ', 'woothemes-sensei' ); ?>

                <a href="<?php echo esc_attr( get_author_posts_url( $course->post_author ) ); ?>" title="<?php echo esc_attr( $author_display_name ); ?>"><?php echo esc_attr( $author_display_name ); ?></a>

            </span>

        <?php } // End If Statement ?>

        <span class="course-lesson-count"><?php echo Sensei()->course->course_lesson_count( $course->ID ) . '&nbsp;' .  __( 'Lessons', 'woothemes-sensei' ); ?></span>

       <?php if ( '' != $category_output ) { ?>

            <span class="course-category"><?php echo sprintf( __( 'in %s', 'woothemes-sensei' ), $category_output ); ?></span>

        <?php } // End If Statement

        // number of completed lessons
        if( Sensei_Utils::user_started_course( $course->ID,  get_current_user_id() )
            || Sensei_Utils::user_completed_course( $course->ID,  get_current_user_id() )  ){

            $completed = count( Sensei()->course->get_completed_lesson_ids( $course->ID, get_current_user_id() ) );
            $lesson_count = count( Sensei()->course->course_lessons( $course->ID ) );
            echo '<span class="course-lesson-progress">' . sprintf( __( '%1$d of %2$d lessons completed', 'woothemes-sensei' ) , $completed, $lesson_count  ) . '</span>';

        }

        sensei_simple_course_price( $course->ID );

        echo '</p>';*/
    } // end the course meta
  
  
  remove_action('sensei_course_content_inside_before', array( 'Sensei_Templates', 'the_title' ) ,5, 1 );
	add_action('sensei_course_content_inside_before', 'custom_the_title',5, 1 );
    function custom_the_title( $post ){
        // ID passed in
        if( is_numeric( $post ) ){
            $post = get_post( $post );
        }

        /**
         * Filter the template html tag for the title
         *
         * @since 1.9.0
         *
         * @param $title_html_tag default is 'h3'
         */
        $title_html_tag = apply_filters('sensei_the_title_html_tag','h4');
	
		    $user_course_status = Sensei_Utils::user_course_status( intval($post->ID), get_current_user_id() );
		
		
        /**
         * Filter the title classes
         *
         * @since 1.9.0
         * @param string $title_classes defaults to $post_type-title
         */
        //$title_classes = apply_filters('sensei_the_title_classes', $post->post_type . '-title' );
        $title_classes = 'blue';
        $html= '';
        $html .= '<'. $title_html_tag .' class="'. $title_classes .'" >';
		if(!Sensei_Utils::user_completed_course( $user_course_status ) ) {
        $html .= '<a href="' . get_permalink( $post->ID ) . '" >';
		}
        $html .= $post->post_title ;
       if(!Sensei_Utils::user_completed_course( $user_course_status ) ) {
		    $html .= '</a>';
		}
        $html .= '</'. $title_html_tag. '>';
        echo $html;

    }// end the title
    
    
    
    
    
  	
   
   
	global  $woothemes_sensei;
	//define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
	//include( MY_PLUGIN_PATH . 'sensei-course-progress/includes/class-sensei-course-progress-widget.php');

	include_once( ABSPATH.'/wp-content/plugins/sensei-course-progress/includes/class-sensei-course-progress-widget.php' );

	class My_Widget extends Sensei_Course_Progress_Widget {
		protected $woo_widget_cssclass;
		protected $woo_widget_description;
		protected $woo_widget_idbase;
		protected $woo_widget_title;

		/**
		 * Constructor function.
		 * @since  1.1.0
		 * @return  void
		 */
		public function __construct() {
			/* Widget variable settings. */
			$this->woo_widget_cssclass = 'widget_sensei_course_progress111';
			$this->woo_widget_description = __( 'Displays the current learners progress within the current course/module (only displays on single lesson page).', 'sensei-course-progress' );
			$this->woo_widget_idbase = 'sensei_course_progress';
			$this->woo_widget_title = __( 'Sensei - Course Progress', 'sensei-course-progress' );
			/* Widget settings. */
			$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

			/* Widget control settings. */
			$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => $this->woo_widget_idbase );

			/* Create the widget. */
			parent::__construct( $this->woo_widget_idbase, $this->woo_widget_title, $widget_ops, $control_ops );
		}
		function widget( $args, $instance ) {

			global $woothemes_sensei, $post, $current_user, $view_lesson, $user_taking_course;

	        $allmodules = 'off';
			if ( isset( $instance['allmodules'] ) ) {
				$allmodules = $instance['allmodules'];
			}
		
			// If not viewing a lesson/quiz, don't display the widget
			if( !( ( is_singular('lesson') || is_singular('quiz') ) ) ) return;

			extract( $args );
			if ( is_singular('quiz') ) {
				$current_lesson_id = absint( get_post_meta( $post->ID, '_quiz_lesson', true ) );
			} else $current_lesson_id = $post->ID;

			// get the course for the current lesson/quiz
			$lesson_course_id = get_post_meta( $current_lesson_id, '_lesson_course', true );

			// Check if the user is taking the course
			$is_user_taking_course = WooThemes_Sensei_Utils::user_started_course( $lesson_course_id, $current_user->ID );

			//Check for preview lesson
			$is_preview = false;
			if ( method_exists( 'WooThemes_Sensei_Utils', 'is_preview_lesson' ) ) {
				$is_preview = WooThemes_Sensei_Utils::is_preview_lesson( $post->ID );
			}

			$course_title = get_the_title( $lesson_course_id );
			$course_url = get_the_permalink( $lesson_course_id );

			$in_module = false;
			$lesson_module = '';
			$lesson_array = array();

			if ( 0 < $current_lesson_id ) {
				// get an array of lessons in the module if there is one
				if( isset( Sensei()->modules ) && has_term( '', Sensei()->modules->taxonomy, $current_lesson_id ) ) {
					// Get all modules
	    			$course_modules = Sensei()->modules->get_course_modules( $lesson_course_id );
					$lesson_module = Sensei()->modules->get_lesson_module( $current_lesson_id );
					$in_module = true;
					$current_module_title = htmlspecialchars( $lesson_module->name );

					// Display all modules
					if ( 'on' == $allmodules ) {
						foreach ($course_modules as $module) {
							// get all lessons in the module
							$args = array(
								'post_type' => 'lesson',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'meta_query' => array(
									array(
										'key' => '_lesson_course',
										'value' => intval( $lesson_course_id ),
										'compare' => '='
									)
								),
								'tax_query' => array(
									array(
										'taxonomy' => Sensei()->modules->taxonomy,
										'field' => 'id',
										'terms' => intval( $module->term_id )
									)
								),
								'meta_key' => '_order_module_' . intval( $module->term_id ),
								'orderby' => 'meta_value_num date',
								'order' => 'ASC'
							);
							$lesson_array = array_merge( $lesson_array, get_posts( $args) );
						}
					} else {
						// Only display current module
				    	// get all lessons in the current module
						$args = array(
							'post_type' => 'lesson',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'meta_query' => array(
								array(
									'key' => '_lesson_course',
									'value' => intval( $lesson_course_id ),
									'compare' => '='
								)
							),
							'tax_query' => array(
								array(
									'taxonomy' => Sensei()->modules->taxonomy,
									'field' => 'id',
									'terms' => $lesson_module
								)
							),
							'meta_key' => '_order_module_' . intval( $lesson_module->term_id ),
							'orderby' => 'meta_value_num date',
							'order' => 'ASC'
						);

						$lesson_array = get_posts( $args );
					}
				} else {
					// if there's no module, get all lessons in the course
					$lesson_array = Sensei()->course->course_lessons( $lesson_course_id );
				}
			}

			echo $before_widget; ?>
<div class="inner-right">
      <h3>Modules</h3>

<!--			<header>
        
				<?php /*?><h2 class="course-title"><a><?php echo $course_title; ?></a></h2><?php */?>

				<?php if ( $in_module && 'on' != $allmodules ) { ?>
					<h3 class="module-title"><?php echo $current_module_title ; ?></h3>
				<?php } ?>

			</header> -->

			<?php
			$nav_id_array = sensei_get_prev_next_lessons( $current_lesson_id );
			$previous_lesson_id = absint( $nav_id_array['prev_lesson'] );
			$next_lesson_id = absint( $nav_id_array['next_lesson'] );

			/*if ( ( 0 < $previous_lesson_id ) || ( 0 < $next_lesson_id ) ) { ?>

				<ul class="right-module-listing">
					<?php if ( 0 < $previous_lesson_id ) { ?><li class="prev"><a href="<?php echo esc_url( get_permalink( $previous_lesson_id ) ); ?>" title="<?php echo get_the_title( $previous_lesson_id ); ?>"><span><?php _e( 'Previous', 'sensei-course-progress' ); ?></span></a></li><?php } ?>
					<?php if ( 0 < $next_lesson_id ) { ?><li class="next"><a href="<?php echo esc_url( get_permalink( $next_lesson_id ) ); ?>" title="<?php echo get_the_title( $next_lesson_id ); ?>"><span><?php _e( 'Next', 'sensei-course-progress' ); ?></span></a></li><?php } ?>
				</ul>

			<?php } */?>

			<ul class="right-module-listing">

				<?php global $wpdb,$woothemes_sensei, $post, $wp_query, $course, $my_courses_page, $my_courses_section;	
				 $per_page = 20;
		 $course_statuses = WooThemes_Sensei_Utils::sensei_check_for_activity( array( 'user_id' => get_current_user_id(), 'type' => 'sensei_course_status' ), true );
				// User may only be on 1 Course
				if ( !is_array($course_statuses) ) {
					$course_statuses = array( $course_statuses );
				}
		 $completed_ids = $active_ids = array();
				foreach( $course_statuses as $course_status ) {
					if ( WooThemes_Sensei_Utils::user_completed_course( $course_status, get_current_user_id() ) ) {
						$completed_ids[] = $course_status->comment_post_ID;
					} else {
						$active_ids[] = $course_status->comment_post_ID;
					}
				}
		 $active_count = $completed_count = 0;

				$active_courses = array();
				if ( 0 < intval( count( $active_ids ) ) ) {
					$my_courses_section = 'active';
					$active_courses = $woothemes_sensei->post_types->course->course_query( $per_page, 'usercourses', $active_ids );
					$active_count = count( $active_ids );
				} // End If Statement

	
							//echo $lessonlink;
			foreach ( $active_courses as $course_item ) {
				 $lesson_course_id = $course_item->ID;
							//$lesson_course_id = 7748;
							$lesson_array = array();
							$course_modules = Sensei()->modules->get_course_modules( $lesson_course_id );
							foreach ($course_modules as $module) {
							// get all lessons in the module
							$args = array(
								'post_type' => 'lesson',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'meta_query' => array(
									array(
										'key' => '_lesson_course',
										'value' => intval( $lesson_course_id ),
										'compare' => '='
									)
								),
								'tax_query' => array(
									array(
										'taxonomy' => Sensei()->modules->taxonomy,
										'field' => 'id',
										'terms' => intval( $module->term_id )
									)
								),
								'meta_key' => '_order_module_' . intval( $module->term_id ),
								'orderby' => 'meta_value_num date',
								'order' => 'ASC'
							);
							$lesson_array = array_merge( $lesson_array, get_posts( $args) );
						}
						//print_r($lesson_array);
						$getcountlesson = 0;
						$lastclick = 0;
						$total_lengthoflesson = 0;
						foreach($lesson_array as $row_getlessons)
						{
						$lessonid = $row_getlessons->ID;
					
						
							$getcountlesson = $wpdb->get_var(
							$wpdb->prepare(
							'SELECT COUNT(*) FROM `wp_comments` WHERE `user_id` = "'.get_current_user_id().'" and `comment_post_ID` = "'.$lessonid.'" and `comment_approved` IN("complete", "graded","passed")'
							)
							);
						
							//echo "<br>getcountlesson:".$getcountlesson;
						
							if($getcountlesson == 0 && $lastclick != 1){
								$lastclick = 1;
								$post_7 = get_post( $lessonid ); 
								//print_r($post_7);
								$lessontitle = $post_7->post_title;
								$lessonname = $post_7->post_name;							
							
								 $lessonlink1 = get_site_url().'/lesson/'.$lessonname;
								$lid =  $post_7->ID;
							
								}
							
								$getlessonlength = $wpdb->get_var($wpdb->prepare('SELECT meta_value FROM wp_postmeta where meta_key = "_lesson_length" and post_id="'.$lessonid.'"',ARRAY_A));
							
								$total_lengthoflesson += $getlessonlength;
							
						
						
							}
						
					 }	
				 
				 

				$old_module = '';

				foreach( $lesson_array as $lesson ) {
					$lesson_id = $lesson->ID;
					$lesson_title = htmlspecialchars( $lesson->post_title );
					$lesson_url = get_the_permalink( $lesson_id );

					// add 'completed' class to completed lessons
					$classes = "not-completed";
					if( WooThemes_Sensei_Utils::user_completed_lesson( $lesson->ID, $current_user->ID ) ) {
						$classes = "completed";
					}

					// Lesson Quiz Meta
	                $lesson_quiz_id = Sensei()->lesson->lesson_quizzes( $lesson_id );
          $classes_cur ='';        
					// add 'current' class on the current lesson/quiz
					if( $lesson_id == $post->ID || $lesson_quiz_id == $post->ID ) {
						$classes_cur = "current";
					}

					/*if ( isset( Sensei()->modules ) && 'on' == $allmodules ) {
						$new_module = Sensei()->modules->get_lesson_module( $lesson_id );
						if ( $old_module != $new_module ) {
							?>
							<li class="course-progress-module"><h3><?php echo $new_module->name; ?></h3></li>
							<?php
							$old_module = $new_module;
						}
					}*/
				
			$nav_id_array1 = sensei_get_prev_next_lessons( $lesson->ID );
			$previous_lesson_id1 = absint( $nav_id_array1['prev_lesson'] );
			$next_lesson_id1 = absint( $nav_id_array1['next_lesson'] );
      
      
      $nextclasses = "not-completed";
			if( WooThemes_Sensei_Utils::user_completed_lesson( $next_lesson_id1, $current_user->ID ) ) {
				$nextclasses = "completed";
			}
      
      $prevclasses = "not-completed";
			if( WooThemes_Sensei_Utils::user_completed_lesson( $previous_lesson_id1, $current_user->ID ) ) {
				$prevclasses = "completed";
			}
      
      
       ?>

					<!--<li class="course-progress-lesson <?php echo end($lesson_array)->ID; ?> <?php echo $classes; ?>">-->
            <li>
            <?
            if($classes=='completed'){
              echo '<a class="active" href="' . $lesson_url . '">' . $lesson_title . '</a>';
            }
            else if($classes_cur=='current'){
              echo '<a class="current" href="' . $lesson_url . '">' . $lesson_title . '</a>';
            }
            else if($classes == 'not-completed' && $nextclasses == 'not-completed' && $prevclasses == 'completed'){
              echo '<a  href="' . $lesson_url . '">' . $lesson_title . '</a>';
            }
            else if($classes == 'not-completed' && $nextclasses == 'not-completed' && $prevclasses == 'not-completed' && $count==1){
              echo '<a  href="' . $lesson_url . '">' . $lesson_title . '</a>';
            }
            else if($nextclasses == 'completed' && $prevclasses == 'completed'){
              echo '<a  href="' . $lesson_url . '">' . $lesson_title . '</a>';
            }
            else{
              echo '<a  href="#">' . $lesson_title . '</a>';
            }
            ?>   
						<?php /*if($classes == 'completed' || $lesson->ID == $next_lesson_id1 ){
							echo '<a class="active" href="' . $lesson_url . '">' . $lesson_title . '</a>';
						} else if($classes == 'not-completed' && $lesson->ID == $lid ){
							echo '<a href="' . $lesson_url . '">' . $lesson_title . '</a>';
						} else if( $lesson->ID == $post->ID || $lesson_quiz_id == $post->ID || $classes != 'completed')  {
              echo '<a class="active" href="' . $lesson_url . '">' . $lesson_title . '</a>';
						}else{
              echo '<span>' . $lesson_title . '</span>';
            } */?>
                    
					</li>

				<?php } ?>

			</ul>
    </div>

			<?php echo $after_widget;
		}

		}
		add_action( 'widgets_init', function(){
		register_widget( 'My_Widget' );
	}); 
	function enqueue_files() {
		?>
  	  <script type='text/javascript'>
	 
  		   jQuery(document).ready(function() {
			  
  			  jQuery("input[name='quiz_complete']").val('Done');
       });

   </script>  
		<?php
	  if ( is_page( 'iump-register' ) ) {
	 ?> 

	  <script type='text/javascript'>
	 
		   jQuery(document).ready(function() {
			 
			
		   		jQuery("input[name='same_billing[]']:checkbox").click(function(){
				
		   			var chkds = jQuery("input[name='same_billing[]']:checkbox");
		   			if (chkds.is(":checked"))  {
						
		   			jQuery("input[name='billing_address1']").val(jQuery("input[name='user_address1']").val());
		   			jQuery("input[name='billing_address2']").val(jQuery("input[name='user_address2']").val());
		   			jQuery("input[name='billing_city']").val(jQuery("input[name='user_city']").val());
		   			jQuery("input[name='billing_province']").val(jQuery("input[name='user_province']").val());	
		   			jQuery("input[name='billing_postalcode']").val(jQuery("input[name='user_postal_code']").val());	
			
			
		   			} else {
		   				jQuery("input[name='billing_address1']").val("");
		   				jQuery("input[name='billing_address2']").val("");
		   				jQuery("input[name='billing_city']").val("");
		   				jQuery("input[name='billing_province']").val("");	
		   				jQuery("input[name='billing_postalcode']").val("");	
				
		   			}
			
		   		 });
	   
		       });
		
	  
  
		   </script>
	<?php  } else {
	    // enqueue common scripts here
	  }
	}
	add_action( 'wp_enqueue_scripts', 'enqueue_files' );
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
	add_action('wp_footer', 'wp_enqueue_scripts', 5);
	
	add_filter( 'register_url', 'custom_register_url' );
	function custom_register_url( $register_url )
	{
	    $register_url = get_permalink( $register_page_id = '171' ).'?lid=2';
	    return $register_url;
	}

	////// - Register save customization start  -  //////
/*global $wpdb;
		
		include_once( ABSPATH.'/wp-content/plugins/indeed-membership-pro/classes/UserAddEdit.class.php' );
		//include_once( ABSPATH.'/wp-content/plugins/indeed-membership-pro/classes/LiteRegister.class.php' );

if (class_exists('UserAddEdit')){
  
	Class My_LiteRegister extends UserAddEdit
	{
		protected $is_public = TRUE;
		protected $user_id = '';
		protected $type = 'create';//create or edit
		protected $action = '';// form action (url) 		
		protected $user_data = array();
		private $tos = false;
		private $captcha = false;
		protected $register_metas = array();
		protected $errors = false;
		protected $register_fields = '';
		private $disabled_submit_form = '';
		protected $register_template = 'ihc-register-1';
		private $bank_transfer_message = FALSE;
		private $display_type = 'display_admin';
		private $coupon = '';
		private $show_sm = FALSE;
		protected $print_errors = array();
		protected $required_fields = array();
		private $payment_gateway = '';
		private $current_level = -1;
		protected $global_css = '';
		protected $global_js = '';
		private $exception_fields = array();
		//private $donation_field = FALSE;
		private $taxes_enabled = FALSE;
		private $show_taxes = FALSE;
		private $payment_available_after_excluded_by_lid = array();
		private $rewrite_payment_gateway = TRUE;
		private $preview = FALSE;
		protected $order_id = 0;
		protected $shortcodes_attr = array();
		protected $set_password_auto = FALSE;
		protected $send_password_via_mail = FALSE;
		private $authorize_txn_id = FALSE;
		
		/////////
	/*	public function __construct(){
			/*
			 * @param none
			 * @return none
			 */
			///////////////set payment gateway
/*	if (!empty($_REQUEST['ihc_payment_gateway'])){
				$this->payment_gateway = $_REQUEST['ihc_payment_gateway'];
				$this->rewrite_payment_gateway = FALSE;
				if (isset($_REQUEST['ihc_payment_gateway_radio'])){
					unset($_REQUEST['ihc_payment_gateway_radio']);
				}
			} else {
				//DEFAULT
				$this->payment_gateway = get_option('ihc_payment_selected');
			}
		}*/
			
	/*	public function __construct() {
		     //   parent::setTest('hello!');  // Or, $this->setTest('hello!');
		        parent::__construct();
		    }
			
	}
	
	////// - Register save customization end  -  //////
  
}
else{
  echo "class does not exists"; die();
}
*/
		
add_action( 'ump_on_register_action', 'func_ump_on_register_action', 10, 1 );
function func_ump_on_register_action($user_id){
	//echo $user."inside functions";
	global $woothemes_sensei;			
	global $wpdb;
	$course_id = 11;
	$result = WooThemes_Sensei_Utils::user_start_course( $user_id, $course_id );
	
	
}

remove_action('init', 'ihc_init', 50, 0);
add_action('init', 'custom_ihc_init', 50, 0);

include_once( ABSPATH.'/wp-content/plugins/indeed-membership-pro/public/functions.php' );
function custom_ihc_init(){
	/*
	 * RUN EVERYTIME ON PUBLIC
	 * @param none
	 * @return none
	 */
	//========== REGISTER SOCIAL MEDIA COOKIE 
	if (isset($_COOKIE['ihc_register'])){
		global $ihc_stored_form_values;
		$data = unserialize(stripslashes($_COOKIE['ihc_register']));
		if (is_array($data) && count($data)){
			foreach ($data as $k=>$v){
				$ihc_stored_form_values[$k] = $v;
			}
		}
		setcookie("ihc_register", "", time()-3600, COOKIEPATH, COOKIE_DOMAIN, false);//delete the cookie
	}
	
	$postid = -1;	
	$url = IHC_PROTOCOL . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; /// $_SERVER['SERVER_NAME'] 
	$current_user = false;  
	if (!empty($_POST['ihcaction'])){    
		/// FORM ACTIONS : REGISTER/LOGIN/UPDATE/ RESET PASS/ DELETE LEVEL FROM ACCOUNT PAGE/CANCEL LEVEL FROM ACCOUNT PAGE/ RENEW LEVEL 
		custom_ihc_init_form_action($url); 
	} else {
		/// LOGOUT / PAY NEW LEVEL
		if (!empty($_GET['ihcdologout'])){
			include_once IHC_PATH . 'public/functions/logout.php';
			ihc_do_logout($url);
		} else if (!empty($_GET['ihcnewlevel'])){
			ihc_do_pay_new_level();
		}
		
		
		//// UX BUILDER
		if (isset($_GET['uxb_iframe']) && !empty($_GET['post_id'])){
			return;
		}		
		//// UX BUILDER
		
		
		/// REDIRECT / REPLACE CONTENT
		$postid = url_to_postid( $url );//getting post id
		
		if ($postid==0){
			$cpt_arr = ihc_get_all_post_types();
			$the_cpt = FALSE;
			$post_name = FALSE;
			if (count($cpt_arr)){
				foreach ($cpt_arr as $cpt){
					if (!empty($_GET[$cpt])){
						$the_cpt = $cpt;
						$post_name = $_GET[$cpt];
						break;
					}
				}				
			}
			if ($the_cpt && $post_name){
				$cpt_id = ihc_get_post_id_by_cpt_name($the_cpt, $post_name);
				if ($cpt_id){
					$postid = $cpt_id;			
				}
			} else {
				//test if its homepage
				$homepage = get_option('page_on_front');
				if($url==get_permalink($homepage)) $postid = $homepage;				
			}
		}
    
		ihc_if_register_url($url);//test if is register page		 
		ihc_block_page_content($postid, $url);//block page
	}

	//// BLOCK INDIVIDUAL PAGE
	ihc_do_block_if_individual_page($postid);
	/////////////BLOCK BY URL
	ihc_block_url($url, $current_user, $postid);//function available in public/functions.php
	/// Block Rules
	ihc_check_block_rules($url, $current_user, $postid);
	/// Hide ADMIN BAR
	ihc_do_show_hide_admin_bar_on_public();
}

function custom_ihc_init_form_action($url){
	/*
	 * form actions : 
	 * REGISTER
	 * LOGIN 
	 * UPDATE
	 * RESET PASS
	 * DELETE LEVEL FROM ACCOUNT PAGE
	 * CANCEL LEVEL FROM ACCOUNT PAGE  
	 * RENEW LEVEL 
	 */
  
	switch ($_POST['ihcaction']){
		case 'suspend':
			global $current_user;
			if (!empty($current_user->ID)){
				if (ihc_suspend_account($current_user->ID)){
					////// do logout
					///write log
					Ihc_User_Logs::set_user_id($current_user->ID);
					$username = Ihc_Db::get_username_by_wpuid($current_user->ID);
					Ihc_User_Logs::write_log(__('User ', 'ihc') . $username . __(' suspend his profile.', 'ihc'), 'user_logs');						
					require_once IHC_PATH . 'public/functions/logout.php';
					ihc_do_logout($url);					
				}
			}
			break;		
		case 'login':
			//login
			include_once IHC_PATH . 'public/functions/login.php';
			ihc_login($url);
		break;		
		case 'register':
   
			///////////////////////////////register
			
			
			 
			if (!class_exists('UserAddEdit')){
				include_once IHC_PATH . 'classes/UserAddEdit.class.php';				
			}
			
			$args = array(
					'user_id' => false,
					'type' => 'create',
					'tos' => true,
					'captcha' => true,
					'action' => '',
					'is_public' => true,
					'url' => $url,
			);
			$obj = new UserAddEdit();
			
			$obj->setVariable($args);//setting the object variables
			$abc = $obj->save_update_user();
			
  			// global $woothemes_sensei;			
  			// global $wpdb;
  			//  $course_id = 11;
  			//$user_id = $wpdb->insert_id();
  			//$result = WooThemes_Sensei_Utils::user_start_course( $user_id, $course_id );
		//	print_r($abc);	
			//	echo "ddddd111";die();	
	
			
		break;	
		case 'register_lite':
		 	if (!class_exists('LiteRegister')){
		 		include_once IHC_PATH . 'classes/LiteRegister.class.php';
		 	}
			$data['metas'] = ihc_return_meta_arr('register_lite');
			$args = array(
					'user_id' => false,
					'type' => 'create',
					'is_public' => true,
					'url' => $url,
					'lite_register_metas' => $data['metas'],
			);
			$object = new LiteRegister();	
			$object->setVariable($args);//setting the object variables
			$object->save_update_user();		
			break;	
		case 'update':
			/////////////////////// UPDATE
			
			if (is_user_logged_in()){
				$current_user = wp_get_current_user();
				$user_id = $current_user->ID;
				if ($user_id){
					 					
					Ihc_User_Logs::set_user_id($current_user->ID);
					$username = Ihc_Db::get_username_by_wpuid($current_user->ID);
					Ihc_User_Logs::write_log(__('User ', 'ihc') . $username . __(' update his profile.', 'ihc'), 'user_logs');					
					if (!class_exists('UserAddEdit')){
						include_once IHC_PATH . 'classes/UserAddEdit.class.php';						
					}
					$args = array(
							'user_id' => $user_id,
							'type' => 'edit',
							'tos' => false,
							'captcha' => false,
							'action' => '',
							'is_public' => true,
					);
					$obj = new UserAddEdit();
					$obj->setVariable($args);
					$obj->save_update_user();	
	     			// global $woothemes_sensei;	
	     			//  $course_id = 11;	     		
	     			//$result = WooThemes_Sensei_Utils::user_start_course( $user_id, $course_id );	
				}
			}
		break;				
		case 'reset_pass':
			require_once IHC_PATH . 'classes/ResetPassword.class.php';
			$reset_password = new IHC\ResetPassword();
			$reset_password->send_mail_with_link($_REQUEST['email_or_userlogin']);
		break;		
		case 'renew_cancel_delete_level_ap':
			global $current_user;

			if (isset($_POST['ihc_delete_level']) && $_POST['ihc_delete_level']!=''){
				//delete level				
				if (isset($current_user->ID)){
					/// user logs
					Ihc_User_Logs::set_user_id($current_user->ID);
					Ihc_User_Logs::set_level_id($_POST['ihc_delete_level']);
					$username = Ihc_Db::get_username_by_wpuid($current_user->ID);
					$level_name = Ihc_Db::get_level_name_by_lid($_POST['ihc_delete_level']);
					Ihc_User_Logs::write_log(__('User ', 'ihc') . $username . __(' delete Level ', 'ihc') . $level_name, 'user_logs', $_POST['ihc_delete_level']);						
					ihc_delete_user_level_relation($_POST['ihc_delete_level'], $current_user->ID);
				}
				$level_data = ihc_get_level_by_id($_POST['ihc_delete_level']);
				if (isset($level_data['access_type']) && $level_data['access_type']=='regular_period'){
					//RECURRENCE, must do cancel
					$_POST['ihc_cancel_level'] = $_POST['ihc_delete_level'];		
				}
			} 
			
			if (isset($_POST['ihc_cancel_level']) && $_POST['ihc_cancel_level']!=''){
				//////////////cancel level
				/// user logs
				Ihc_User_Logs::set_user_id($current_user->ID);
				Ihc_User_Logs::set_level_id($_POST['ihc_cancel_level']);
				$username = Ihc_Db::get_username_by_wpuid($current_user->ID);
				$level_name = Ihc_Db::get_level_name_by_lid($_POST['ihc_cancel_level']);
				Ihc_User_Logs::write_log(__('User ', 'ihc') . $username . __(' cancel Level ', 'ihc') . $level_name, 'user_logs', $_POST['ihc_cancel_level']);					
				ihc_cancel_level($current_user->ID, $_POST['ihc_cancel_level']);
			}
			
			if (isset($_POST['ihc_renew_level']) && $_POST['ihc_renew_level']){
				$payment_type = (!empty($_POST['ihc_payment_gateway'])) ? $_POST['ihc_payment_gateway'] : '';
				if (ihc_check_payment_available($payment_type)){
					ihc_renew_level($current_user->ID, $_POST['ihc_renew_level'], $payment_type);					
				}
			}			
		break;
	}
}//end of ihc_init_form_action()

/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/




?>

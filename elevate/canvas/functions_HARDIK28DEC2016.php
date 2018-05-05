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
	
		//echo $status = um_user('status'); 
	
			
		$corporate_or_individual_usr = get_the_author_meta( 'group_individual_account', $user_id );
		
		if($corporate_or_individual_usr != ''){
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
	if ( class_exists( 'Sensei_Shortcode_User_Courses' ) ) {
	remove_action( 'sensei_course_content_inside_after', array( 'Sensei_Shortcode_User_Courses', 'attach_course_progress' ) );
	add_action( 'sensei_course_content_inside_after', array( 'Sensei_Shortcode_User_Courses', 'custom_attach_course_progress' ) );
	}
	
     function custom_attach_course_progress( $course_id ){

        $percentage = Sensei()->course->get_completion_percentage( $course_id, get_current_user_id() );
        echo "TESRTTTTTT:". $this->custom_get_progress_meter( $percentage );

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
		 //$progress_bar_html = '<div style="float:right;clear:none;" class="c100 p' . $progress_percentage . ' big">
//                            <span>' . round( $progress_percentage ) . '%<span>Complete</span></span>
//                            <div class="slice">
//                            <div class="bar"></div>
//                            </div>
//							</div>';

        return $progress_bar_html;

    }// end get_progress_meter
	
	
	
	if ( class_exists( 'WooThemes_Sensei_Course' ) ) {
		global  $woothemes_sensei;
	  remove_action('sensei_course_single_meta', array( $woothemes_sensei->course,'the_progress_meter' ), 16);
	  add_action( 'sensei_course_single_meta' , 'custom_the_progress_meter', 16 );
	}

	function custom_the_progress_meter( $course_id = 0, $user_id = 0 ){
	global  $woothemes_sensei;
	        if( empty( $course_id ) ){
	            global $post;
	            $course_id = $post->ID;
	        }

	        if( empty( $user_id ) ){
	            $user_id = get_current_user_id();
	        }

	        if( 'course' != get_post_type( $course_id ) || ! get_userdata( $user_id )
	            || ! WooThemes_Sensei_Utils::user_started_course( $course_id ,$user_id ) ){
	            return;
	        }
		
	     $percentage_completed = $woothemes_sensei->course->get_completion_percentage( $course_id, $user_id );

	        echo custom_get_progress_meter( $percentage_completed );

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
/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>
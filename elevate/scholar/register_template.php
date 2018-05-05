<?php
/**
 Template Name: Register
 */
 
get_header(); ?>
<div class="outer-wrapper">
        	<div class="wrapper">
            <div>
            <?php if(defined('REGISTRATION_ERROR')){
            foreach(unserialize(REGISTRATION_ERROR) as $error){
              echo '<p class="order_error">'.$error.'</p><br>';
            }
          }?>
          </div>
            <form id="register" method="post" action="<?php echo add_query_arg('do', 'register', get_permalink( $post->ID )); ?>" class="form_comment">
            <?php //if ( !is_user_logged_in() ) { ?>
            	<h1 class="main-title">Course Registration</h1>
                
                <h2 class="sub-title">Select Subscription Type:</h2>
               
                <?php
$type = 'subscription';
$args=array(
  'post_type' => $type,
  'post_status' => 'publish',
  'posts_per_page' => -1);

$my_query = null;
$my_query = new WP_Query($args);

?>
<?php if( $my_query->have_posts() ) { ?>
 <ul class="subscription-type">
 <?php while ($my_query->have_posts()) : $my_query->the_post();
 
 $postid = get_the_id();
 
 $subscription_price = get_post_meta($postid,'_subscription_price');
  $subscription_currency = get_post_meta($postid,'_currency');

  ?>
                	<li>
                    	<div class="left-cont">
                        	<div class="checkBox">
                            	<label class="label_radio">
                                    <input type="radio" name="user_subscription_type" value="<?php echo $postid; ?>" />
                                    <span></span>
                                </label>
                            </div>
                            <div class="cont-section">
                            	<h3><?php the_title(); ?></h3>
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>
                        <div class="price-sec">
                        	<p><?php echo $subscription_price[0]; ?></p>
                        </div>
                    </li>
                	
                	<?php  endwhile; ?>
                </ul>
             <?php }
wp_reset_query();  // Restore global post data stomped by the_post().
?>   
                <div class="clear"></div>
            	
           <?php //} ?>   
             
                    <div class="com">
                    	<input type="text" placeholder="First Name *" id="first-name" name="user_fname"><input type="text" placeholder="Last Name*" id="last-ame" name="user_lname">
                    </div>
                    <div class="com">
                    	<input type="text" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" placeholder = "Email ID *" id="email-id" name="email">
                        <div class="email-txt">Email address will be used as your username. Confirmation email will be sent upon account activations</div>
                    </div>
                    <div class="com">
                    	<input type="text" placeholder="Password *" id="password" name="pass"><input type="text" placeholder="Confirm Password*" id="confirm-password" name="cpass">
                    </div>
                    <div class="com">
                    	<input type="text" placeholder="Company Name" id="company-name" name="user_company_name"><input type="text" placeholder="Phone Number" id="phone-number" name="user_phone">
                    </div>
                    <div class="com">
                    	<input type="text" placeholder="Address1*" id="address1" name="user_address1"><input type="text" placeholder="Address2" id="address2" name="user_address2">
                    </div>
                    <div class="com">
                    	<input type="text" placeholder="City*" id="city" name="user_city"><input type="text" placeholder="Province*" id="province" name="user_province">
                    </div>
                    <div class="com no-com-pad">
                    	<input type="text" placeholder="Postal Code" id="postal-code" name="user_postal" class="postal">
                    </div>
                    <?php if ( !is_user_logged_in() ) { ?> 
                    <h2 class="sub-title">Payment Details:</h2>                    
                    <p class="order">Fill out the fields below to complete your order.</p>                   
                   
                    	<p class="same-address"><label class="myCheckbox">
                                    <input type="checkbox" name="test"/>
                                    <span></span>
                                    
                                </label>
                               Same address for billing
                               </p>
                   

                     <div class="com">
                    	<input type="text" value="Address1*" id="address1" name="Address1"><input type="text" value="Address2" id="address2" name="Address2">
                    </div>
                    <div class="com">
                    	<input type="text" value="City*" id="city" name="City"><input type="text" value="Province*" id="province" name="Province">
                    </div>
                    <div class="com">
                    	<input type="text" value="Postal Code*" id="postal-code" name="Postal Code" class="postal">
                    </div>
                    
                    <div class="payment">
                    <p>Payment Method:</p> <div class="area-radio">
                    <label class="label_radio" for="sample-radio"><input name="sample-radio1" id="sample-radio1" value="1" type="radio" />Invoice Me
									</label>
                                	<label class="label_radio" for="sample-radio">
                                    	<input name="sample-radio2" id="sample-radio2" value="1" type="radio" />Credit Card
									</label>
                    
                    
                   </div>
                    </div>
                    <div class="">
                    <div class="com">
                    	<input type="text" value="Card Number" id="Card number" name="Card Number"><input type="text" value="CVV" id="cw" name="CVV" class="cvv">
                    </div>
                    
                    <div class="month-year">
                    	<input type="text" value="Month" id="month" name="Month" class="month"><input type="text" value="Year" id="Year" name="Year" class="month">
                        
                    <img src="images/payment-images.jpg" class="payment-imgs">
                    
                    </div>
                    </div>
                    <div class="clear"></div>
                    <?php } ?>
                    
                    <p class="same-address terms-conditions"><label class="myCheckbox">
                                    <input type="checkbox" name="terms_condition"/>
                                    <span></span>
                                    
                                </label>
                               I Agree to the <a href="#">Terms & Conditions</a>
                               </p>
                    
                    <div class="com no-com-pad1"><input type="submit" value="Submit" class=""></div>
                    <div class="clear"></div>
                    
                </form>
                
          </div>
          <div class="clear"></div>
        </div>
        
 
<?php
get_sidebar();
get_footer(); ?>
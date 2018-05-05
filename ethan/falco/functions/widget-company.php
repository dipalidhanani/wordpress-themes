<?php
/**
 * Widget Muffin Company Box
 *
 * @package Falco
 * @author Muffin group
 * @link http://muffingroup.com
 */

class Mfn_Company_Widget extends WP_Widget {

	
	/* ---------------------------------------------------------------------------
	 * Constructor
	 * --------------------------------------------------------------------------- */
	function Mfn_Company_Widget() {
		$widget_ops = array( 'classname' => 'widget_mfn_company', 'description' => __( 'Use this widget on pages to display Company Box.', 'mfn-opts' ) );
		$this->WP_Widget( 'widget_mfn_company', __( 'Muffin Company Box', 'mfn-opts' ), $widget_ops );
		$this->alt_option_name = 'widget_mfn_company';
	}
	
	
	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = null;
		extract( $args, EXTR_SKIP );

		echo $before_widget;
		
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base);
		if( $title ) echo $before_title . $title . $after_title;
		
		echo '<div class="company_box">';
			if( $instance['image'] ){
				echo '<div class="logo">';
					echo '<img class="scale-with-grid" src="'. $instance['image'] .'" alt="" />';
				echo '</div>';
			}
			echo '<div class="contact_details">';
				echo '<ul>';
					if( $instance['tel'] ) echo '<li class="phone"><i class="icon-phone"></i><p><a href="tel:'. $instance['tel'] .'">'. $instance['tel'] .'</a></p></li>';
					if( $instance['email'] ) echo '<li class="mail"><i class="icon-envelope"></i><p><a href="mailto:'. $instance['email'] .'">'. $instance['email'] .'</a></p></li>';
				echo '</ul>';
			echo '</div>';
		echo '</div>';

		echo $after_widget;
	}


	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] 	= strip_tags( $new_instance['title'] );
		$instance['image'] 	= strip_tags( $new_instance['image'] );
		$instance['tel'] 	= strip_tags( $new_instance['tel'] );
		$instance['email'] 	= strip_tags( $new_instance['email'] );
		
		return $instance;
	}

	
	/* ---------------------------------------------------------------------------
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 * --------------------------------------------------------------------------- */
	function form( $instance ) {
		
		$title 	= isset( $instance['title']) 	? esc_attr( $instance['title'] ) 	: '';
		$image 	= isset( $instance['image']) 	? esc_attr( $instance['image'] ) 	: '';
		$tel 	= isset( $instance['tel']) 		? esc_attr( $instance['tel'] ) 		: '';
		$email 	= isset( $instance['email']) 	? esc_attr( $instance['email'] ) 	: '';

		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'mfn-opts' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php _e( 'Image URL:', 'mfn-opts' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>" />
				<small>Please upload image using WP Media Library and paste an uploaded image URL.</small>
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'tel' ) ); ?>"><?php _e( 'Telephone number:', 'mfn-opts' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tel' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tel' ) ); ?>" type="text" value="<?php echo esc_attr( $tel ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php _e( 'Email:', 'mfn-opts' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
			</p>

		<?php
	}
}
?>
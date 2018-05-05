<?php
/**
* Creates widget with albums
*/
class Person_Widget extends WP_Widget {
    /**
    * Widget constructor
    *
    * @desc sets default options and controls for widget
    */
    protected $language;

    function Person_Widget() {
        if(!defined('ICL_LANGUAGE_CODE')){
            $this->language = "en";
        } else {
            $this->language = ICL_LANGUAGE_CODE;
        }

        /* Widget settings */
        $widget_ops = array (
            'classname' => 'widget_person',
            'description' => __('Display person', 'ait')
        );

        /* Create the widget */
        $this->WP_Widget('person-widget', __('Theme &rarr; Person', 'ait'), $widget_ops);
    }

    /**
    * Displaying the widget
    *
    * Handle the display of the widget
    * @param array
    * @param array
    */
    function widget($args, $instance) {
        extract ($args);
        global $wpdb;

        /* Before widget(defined by theme)*/
        echo $before_widget;

        $person = get_post($instance['person_person_'.$this->language]);
        $thumbnail = wp_get_attachment_url(get_post_thumbnail_id($person->ID));
        $options = get_post_meta($person->ID, '_ait-team');

        if($instance['person_display_title']){
            echo($before_title.$person->post_title.$after_title);
        }
        if($instance['person_display_image']){
            echo('<a href="#"><img style="border:3px solid #ffffff;" class="alignleft" src="'.$thumbnail.'" alt="person" /></a>');
        }
        if($instance['person_display_description']){
            echo('<p><small>'.$options[0]['description'].'</small></p>');
        }
        if($instance['person_display_phone']){
            echo('<ul class="phone"><li><small><strong>'.$options[0]['phone'].'</strong></small></li></ul>');
        }

        /* After widget(defined by theme)*/
        echo $after_widget;
    }

    /**
    * Update and save widget
    *
    * @param array $new_instance
    * @param array $old_instance
    * @return array New widget values
    */
    function update ( $new_instance, $old_instance ) {
        $old_instance['person_person_'.$this->language] = strip_tags( $new_instance['person_person_'.$this->language] );
        $old_instance['person_display_title'] = strip_tags( $new_instance['person_display_title'] );
        $old_instance['person_display_image'] = strip_tags( $new_instance['person_display_image'] );
        $old_instance['person_display_description'] = strip_tags( $new_instance['person_display_description'] );
        $old_instance['person_display_phone'] = strip_tags( $new_instance['person_display_phone'] );

        return $old_instance;
    }

    /**
    * Creates widget controls or settings
    *
    * @param array Return widget options form
    */
    function form ( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'person_person_'.$this->language => '',
            'person_display_title' => '',
            'person_display_image' => '',
            'person_display_description' => '',
            'person_display_phone' => '',
        ) );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'person_person_'.$this->language ); ?>"><?php echo __( 'Person', 'ait' ); ?>:</label>
        <select id="<?php echo $this->get_field_id( 'person_person_'.$this->language ); ?>" name="<?php echo $this->get_field_name( 'person_person_'.$this->language ); ?>">
            <?php
            $team = query_posts(array('post_type' => 'ait-team', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => -1));
            foreach($team as $person){
                if($instance['person_person_'.$this->language] == $person->ID){
                    echo('<option selected="selected" value="'.$person->ID.'">'.$person->post_title.'</option>');
                } else {
                    echo('<option value="'.$person->ID.'">'.$person->post_title.'</option>');
                }
            }
            wp_reset_query();
            ?>
        </select>
    </p>

    <p>
        <?php $checked = ''; if ( $instance['person_display_title'] ) $checked = 'checked="checked"'; ?>
        <input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'person_display_title' ); ?>" name="<?php echo $this->get_field_name( 'person_display_title' ); ?>" class="checkbox" />
        <label for="<?php echo $this->get_field_id( 'person_display_title' ); ?>"><?php echo __( 'Display Title', 'ait' ); ?></label>
    </p>

    <p>
        <?php $checked = ''; if ( $instance['person_display_image'] ) $checked = 'checked="checked"'; ?>
        <input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'person_display_image' ); ?>" name="<?php echo $this->get_field_name( 'person_display_image' ); ?>" class="checkbox" />
        <label for="<?php echo $this->get_field_id( 'person_display_image' ); ?>"><?php echo __( 'Display Image', 'ait' ); ?></label>
    </p>

    <p>
        <?php $checked = ''; if ( $instance['person_display_description'] ) $checked = 'checked="checked"'; ?>
        <input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'person_display_description' ); ?>" name="<?php echo $this->get_field_name( 'person_display_description' ); ?>" class="checkbox" />
        <label for="<?php echo $this->get_field_id( 'person_display_description' ); ?>"><?php echo __( 'Display Description', 'ait' ); ?></label>
    </p>

    <p>
        <?php $checked = ''; if ( $instance['person_display_phone'] ) $checked = 'checked="checked"'; ?>
        <input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'person_display_phone' ); ?>" name="<?php echo $this->get_field_name( 'person_display_phone' ); ?>" class="checkbox" />
        <label for="<?php echo $this->get_field_id( 'person_display_phone' ); ?>"><?php echo __( 'Display Phone', 'ait' ); ?></label>
    </p>
    <?php
    }
}

register_widget( 'Person_Widget' );
<?php
/**
 * Creates widget with albums
 */
class FAQ_Widget extends WP_Widget {
    /**
    * Widget constructor
    *
    * @desc sets default options and controls for widget
    */
    protected $language;

    function FAQ_Widget(){
        if(!defined('ICL_LANGUAGE_CODE')){
            $this->language = "en";
        } else {
            $this->language = ICL_LANGUAGE_CODE;
        }

        /* Widget settings */
        $widget_ops = array (
            'classname' => 'widget_faq',
            'description' => __('Display faq', 'ait')
        );

        /* Create the widget */
        $this->WP_Widget('faq-widget', __('Theme &rarr; FAQ', 'ait'), $widget_ops);
    }

    /**
    * Displaying the widget
    *
    * Handle the display of the widget
    * @param array
    * @param array
    */
    function widget ($args, $instance) {
        extract ($args);
        global $wpdb;

        /* Before widget(defined by theme)*/
        echo $before_widget;
        echo($before_title.do_shortcode($instance['widget_title']).$after_title);
        echo('<ul class="qmark">');
        $faqs = get_posts( array( 'post_type' => 'ait-faq', 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array( array( 'taxonomy' => 'ait-faq-category', 'field' => 'id', 'terms' => $instance['faq_category_'.$this->language]) ) )  );
        foreach($faqs as $faq){
            echo('<li>');
            echo('<span class="italic"><strong>'.$faq->post_title.'</strong></span>');
            echo('<br>');
            echo('<p style="margin-top:10px;">'.$faq->post_content.'</p>');
            echo('</li>');
        }
        echo('</ul>');

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
        $old_instance['widget_title'] = strip_tags( $new_instance['widget_title'] );
        $old_instance['faq_category_'.$this->language] = strip_tags( $new_instance['faq_category_'.$this->language] );

        return $old_instance;
    }

    /**
    * Creates widget controls or settings
    *
    * @param array Return widget options form
    */
    function form ( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'widget_title' => '',
            'faq_category_'.$this->language => '',
        ) );
    ?>

    <p>
        <label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php echo __( 'Widget Title', 'ait' ); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" value="<?php echo $instance['widget_title']; ?>"class="widefat" style="width:100%;" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'faq_category' ); ?>"><?php echo __( 'Faq category', 'ait' ); ?>:</label>
        <?php
            wp_dropdown_categories( array( 'name' => $this->get_field_name('faq_category_'.$this->language), 'show_option_all' => 'All', 'show_count' => 1 , 'selected' => $instance['faq_category_'.$this->language], 'taxonomy' => 'ait-faq-category' ) );
        ?>
    </p>

    <?php
    }
}

register_widget( 'FAQ_Widget' );
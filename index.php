<?php

/**
 * @package Social Space
 */
/*
Plugin Name: Social Space
Plugin URI: http://wordpress.org/plugins/social-space/
Description: A simple Plugin for showing your social links using a simple widget so that people can connect with you more easily.
Version: 1.0
Author: Rishabh Shah
Author URI: http://profiles.wordpress.org/rishabh_19/
License: GPLv2 or later
*/

class social_space extends WP_Widget {

    function social_space() {
        parent::WP_Widget(false, $name = __('Social Space', 'wp_widget_plugin') );
    }

    function form($instance) {
        $social = array('Facebook','Twitter','LinkedIn','GooglePlus','Pintrest','Flickr','RSS','Skype','YouTube','Vimeo','Dribble');
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo ( $instance ) ? esc_attr($instance['title']) : '' ?>" placeholder="This TITLE will be shown to users"/>
            </p>
            <p>Note: Please enter every URL by starting with 'http://' to make the social icon link properly to your profile.</p>
        <?php
        foreach ($social as $social_item) {
            ?>
                <p>
                    <label for="<?php echo $this->get_field_id($social_item); ?>"><?php _e($social_item, 'wp_widget_plugin'); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id($social_item); ?>" name="<?php echo $this->get_field_name($social_item); ?>" type="text" value="<?php echo ( $instance ) ? esc_attr($instance[$social_item]) : '' ?>" placeholder="Example: http://www.xyz.com" />
                </p>
            <?php
        }
    }

    function update($new_instance, $old_instance) {
        $social = array('Facebook','Twitter','LinkedIn','GooglePlus','Pintrest','Flickr','RSS','Skype','YouTube','Vimeo','Dribble');
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        foreach ($social as $social_item) {
            $instance[$social_item] = strip_tags($new_instance[$social_item]);
        }
        return $instance;
    }

    function widget($args, $instance) {
        $img_path = plugins_url( 'social-space/social.png');
        ?>
            <style type="text/css">
                .social div{
                    display: inline-block;
                    cursor: pointer;
                    margin-right: 5px;
                }
                .social #Facebook,
                .social #Twitter,
                .social #RSS,
                .social #YouTube,
                .social #Vimeo,
                .social #LinkedIn,
                .social #GooglePlus,
                .social #Pintrest,
                .social #Flickr,
                .social #Skype,
                .social #Dribble{
                    height: 30px;
                    width: 30px;
                    background: url(<?php echo $img_path; ?>) no-repeat;
                    background-size: 330px 90px;
                }
                .social #Facebook{
                    background-position: 0 -60px;
                }
                .social #Facebook:hover{
                    background-position: 0 -30px;
                }
                .social #Twitter{
                    background-position: -240px -60px;
                }
                .social #Twitter:hover{
                    background-position: -240px -30px;
                }
                .social #GooglePlus{
                    background-position: -90px -60px;
                }
                .social #GooglePlus:hover{
                    background-position: -90px -30px;
                }
                .social #RSS{
                    background-position: -180px -60px;
                }
                .social #RSS:hover{
                    background-position: -180px -30px;
                }
                .social #LinkedIn{
                    background-position: -120px -60px;
                }
                .social #LinkedIn:hover{
                    background-position: -120px -30px;
                }
                .social #YouTube{
                    background-position: -300px -60px;
                }
                .social #YouTube:hover{
                    background-position: -300px -30px;
                }
                .social #Vimeo{
                    background-position: -270px -60px;
                }
                .social #Vimeo:hover{
                    background-position: -270px -30px;
                }
                .social #Pintrest{
                    background-position: -150px -60px;
                }
                .social #Pintrest:hover{
                    background-position: -150px -30px;
                }
                .social #Flickr{
                    background-position: -30px -60px;
                }
                .social #Flickr:hover{
                    background-position: -30px -30px;
                }
                .social #Skype{
                    background-position: -210px -60px;
                }
                .social #Skype:hover{
                    background-position: -210px -30px;
                }
                .social #Dribble{
                    background-position: -60px -60px;
                }
                .social #Dribble:hover{
                    background-position: -60px -30px;
                }
            </style>
        <?php
            extract( $args );
            $social = array('Facebook','Twitter','LinkedIn','GooglePlus','Pintrest','Flickr','RSS','Skype','YouTube','Vimeo','Dribble');

            // these are the widget options
            $title = apply_filters('widget_title', $instance['title']);
            echo $before_widget;

            // Display the widget
            echo '<div class="widget-text wp_widget_plugin_box social">';

            // Check if title is set
            if ( $title ) {
              echo $before_title . $title . $after_title;
            }
            foreach ($social as $social_item) {
                // Check if $instance is set for each social item and
                // if it is set then only show on front-end
                if( $instance[$social_item]){
                    echo '<a href="'.$instance[$social_item].'" target="_blank"><div id="'.$social_item.'"></div></a>';
                }
            }
            echo '</div>';
            echo $after_widget;
        }
    }

    // register the widget
    add_action('widgets_init', create_function('', 'return register_widget("social_space");'));
?>
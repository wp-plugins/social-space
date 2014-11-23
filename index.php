<?php

/**
 * @package Social Space
 */
/*
Plugin Name: Social Space
Plugin URI: http://wordpress.org/plugins/social-space/
Description: A simple Plugin for showing your social links using a simple widget so that people can connect with you more easily.
Version: 2.0
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
            <style type="text/css">
                .default-icon input[type=radio],
                .rollover-icon input[type=radio]{
                    margin-top: -10px !important;
                }
            </style>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo ( $instance ) ? esc_attr($instance['title']) : '' ?>" placeholder="This TITLE will be shown to users"/>
            </p>
            
            <p class="default-icon">
                <legend>Default Icon:</legend>
                <?php
                    // 3 being the default value or "no rating set (yet)"
                    $defaultIcon = ( isset( $instance['defaultIcon'] ) && is_numeric( $instance['defaultIcon'] ) ) ? (int) $instance['defaultIcon'] : 3;
                    for( $n = 1; $n <= 3; $n++ ) {
                        echo '<input type="radio" id="'.$this->get_field_id( 'defaultIcon' ) . '-' . $n . '" name="' . $this->get_field_name( 'defaultIcon' ) . '" value="' . $n . '" ' . checked( $defaultIcon == $n, true, false ) . '><label for="' . $this->get_field_id( 'defaultIcon' ) . '-' . $n . '">  <img src="'.plugins_url( 'social-space/type'.$n.'.png' ).'"> </label>';
                    }
                ?>
            </p>
            <p class="rollover-icon">
                <legend>Rollover Icon: &nbsp;&nbsp;( Icon on mouse hover )</legend>
                <?php
                    // 2 being the default value or "no rating set (yet)"
                    $rolloverIcon = ( isset( $instance['rolloverIcon'] ) && is_numeric( $instance['rolloverIcon'] ) ) ? (int) $instance['rolloverIcon'] : 2;
                    for( $m = 1; $m <= 3; $m++ ) {
                        echo '<input type="radio" id="'.$this->get_field_id( 'rolloverIcon' ) . '-' . $m . '" name="' . $this->get_field_name( 'rolloverIcon' ) . '" value="' . $m . '" ' . checked( $rolloverIcon == $m, true, false ) . '><label for="' . $this->get_field_id( 'rolloverIcon' ) . '-' . $m . '">  <img src="'.plugins_url( 'social-space/type'.$m.'.png' ).'"> </label>';
                    }
                ?>
            </p>

            <p>Note: Please enter every URL by starting with 'http://' to make the social icon link properly to your profile.</p>
        <?php
        foreach ($social as $social_item) {
            ?>
                <p>
                    <label for="<?php echo $this->get_field_id($social_item); ?>"><?php _e($social_item, 'wp_widget_plugin'); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id($social_item); ?>" name="<?php echo $this->get_field_name($social_item); ?>" type="text" value="<?php echo ( $instance ) ? esc_attr($instance[$social_item]) : '' ?>" placeholder=" http://www.example.com" />
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
        $instance['defaultIcon'] = strip_tags( $new_instance['defaultIcon'] );
        $instance['rolloverIcon'] = strip_tags( $new_instance['rolloverIcon'] );
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

                /* Icon Type 1 */
                .social .t11 #Facebook, .social .t12 #Facebook, .social .t13 #Facebook,
                .social .t11 #Facebook:hover, .social .t21 #Facebook:hover, .social .t31 #Facebook:hover{
                    background-position: 0 0;
                }
                .social .t11 #Flickr, .social .t12 #Flickr, .social .t13 #Flickr,
                .social .t11 #Flickr:hover, .social .t21 #Flickr:hover, .social .t31 #Flickr:hover{
                    background-position: -30px 0;
                }
                .social .t11 #Dribble, .social .t12 #Dribble, .social .t13 #Dribble,
                .social .t11 #Dribble:hover, .social .t21 #Dribble:hover, .social .t31 #Dribble:hover{
                    background-position: -60px 0;
                }
                .social .t11 #GooglePlus, .social .t12 #GooglePlus, .social .t13 #GooglePlus,
                .social .t11 #GooglePlus:hover, .social .t21 #GooglePlus:hover, .social .t31 #GooglePlus:hover{
                    background-position: -90px 0;
                }
                .social .t11 #LinkedIn, .social .t12 #LinkedIn, .social .t13 #LinkedIn,
                .social .t11 #LinkedIn:hover, .social .t21 #LinkedIn:hover, .social .t31 #LinkedIn:hover{
                    background-position: -120px 0;
                }
                .social .t11 #Pintrest, .social .t12 #Pintrest, .social .t13 #Pintrest,
                .social .t11 #Pintrest:hover, .social .t21 #Pintrest:hover, .social .t31 #Pintrest:hover{
                    background-position: -150px 0;
                }
                .social .t11 #RSS, .social .t12 #RSS, .social .t13 #RSS,
                .social .t11 #RSS:hover, .social .t21 #RSS:hover, .social .t31 #RSS:hover{
                    background-position: -180px 0;
                }
                .social .t11 #Skype, .social .t12 #Skype, .social .t13 #Skype,
                .social .t11 #Skype:hover, .social .t21 #Skype:hover, .social .t31 #Skype:hover{
                    background-position: -210px 0;
                }
                .social .t11 #Twitter, .social .t12 #Twitter, .social .t13 #Twitter,
                .social .t11 #Twitter:hover, .social .t21 #Twitter:hover, .social .t31 #Twitter:hover{
                    background-position: -240px 0;
                }
                .social .t11 #Vimeo, .social .t12 #Vimeo, .social .t13 #Vimeo,
                .social .t11 #Vimeo:hover, .social .t21 #Vimeo:hover, .social .t31 #Vimeo:hover{
                    background-position: -270px 0;
                }
                .social .t11 #YouTube, .social .t12 #YouTube, .social .t13 #YouTube,
                .social .t11 #YouTube:hover, .social .t21 #YouTube:hover, .social .t31 #YouTube:hover{
                    background-position: -300px 0;
                }

                /* Icon Type 2 */
                .social .t21 #Facebook, .social .t22 #Facebook, .social .t23 #Facebook,
                .social .t12 #Facebook:hover, .social .t22 #Facebook:hover, .social .t32 #Facebook:hover{
                    background-position: 0 -30px;
                }
                .social .t21 #Flickr, .social .t22 #Flickr, .social .t23 #Flickr,
                .social .t12 #Flickr:hover, .social .t22 #Flickr:hover, .social .t32 #Flickr:hover{
                    background-position: -30px -30px;
                }
                .social .t21 #Dribble, .social .t22 #Dribble, .social .t23 #Dribble,
                .social .t12 #Dribble:hover, .social .t22 #Dribble:hover, .social .t32 #Dribble:hover{
                    background-position: -60px -30px;
                }
                .social .t21 #GooglePlus, .social .t22 #GooglePlus, .social .t23 #GooglePlus,
                .social .t12 #GooglePlus:hover, .social .t22 #GooglePlus:hover, .social .t32 #GooglePlus:hover{
                    background-position: -90px -30px;
                }
                .social .t21 #LinkedIn, .social .t22 #LinkedIn, .social .t23 #LinkedIn,
                .social .t12 #LinkedIn:hover, .social .t22 #LinkedIn:hover, .social .t32 #LinkedIn:hover{
                    background-position: -120px -30px;
                }
                .social .t21 #Pintrest, .social .t22 #Pintrest, .social .t23 #Pintrest,
                .social .t12 #Pintrest:hover, .social .t22 #Pintrest:hover, .social .t32 #Pintrest:hover{
                    background-position: -150px -30px;
                }
                .social .t21 #RSS, .social .t22 #RSS, .social .t23 #RSS,
                .social .t12 #RSS:hover, .social .t22 #RSS:hover, .social .t32 #RSS:hover{
                    background-position: -180px -30px;
                }
                .social .t21 #Skype, .social .t22 #Skype, .social .t23 #Skype,
                .social .t12 #Skype:hover, .social .t22 #Skype:hover, .social .t32 #Skype:hover{
                    background-position: -210px -30px;
                }
                .social .t21 #Twitter, .social .t22 #Twitter, .social .t23 #Twitter,
                .social .t12 #Twitter:hover, .social .t22 #Twitter:hover, .social .t32 #Twitter:hover{
                    background-position: -240px -30px;
                }
                .social .t21 #Vimeo, .social .t22 #Vimeo, .social .t23 #Vimeo,
                .social .t12 #Vimeo:hover, .social .t22 #Vimeo:hover, .social .t32 #Vimeo:hover{
                    background-position: -270px -30px;
                }
                .social .t21 #YouTube, .social .t22 #YouTube, .social .t23 #YouTube,
                .social .t12 #YouTube:hover, .social .t22 #YouTube:hover, .social .t32 #YouTube:hover{
                    background-position: -300px -30px;
                }

                /* Icon Type 3 */
                .social .t31 #Facebook, .social .t32 #Facebook, .social .t33 #Facebook,
                .social .t13 #Facebook:hover, .social .t23 #Facebook:hover, .social .t33 #Facebook:hover{
                    background-position: 0 -60px;
                }
                .social .t31 #Flickr, .social .t32 #Flickr, .social .t33 #Flickr,
                .social .t13 #Flickr:hover, .social .t23 #Flickr:hover, .social .t33 #Flickr:hover{
                    background-position: -30px -60px;
                }
                .social .t31 #Dribble, .social .t32 #Dribble, .social .t33 #Dribble,
                .social .t13 #Dribble:hover, .social .t23 #Dribble:hover, .social .t33 #Dribble:hover{
                    background-position: -60px -60px;
                }
                .social .t31 #GooglePlus, .social .t32 #GooglePlus, .social .t33 #GooglePlus,
                .social .t13 #GooglePlus:hover, .social .t23 #GooglePlus:hover, .social .t33 #GooglePlus:hover{
                    background-position: -90px -60px;
                }
                .social .t31 #LinkedIn, .social .t32 #LinkedIn, .social .t33 #LinkedIn,
                .social .t13 #LinkedIn:hover, .social .t23 #LinkedIn:hover, .social .t33 #LinkedIn:hover{
                    background-position: -120px -60px;
                }
                .social .t31 #Pintrest, .social .t32 #Pintrest, .social .t33 #Pintrest,
                .social .t13 #Pintrest:hover, .social .t23 #Pintrest:hover, .social .t33 #Pintrest:hover{
                    background-position: -150px -60px;
                }
                .social .t31 #RSS, .social .t32 #RSS, .social .t33 #RSS,
                .social .t13 #RSS:hover, .social .t23 #RSS:hover, .social .t33 #RSS:hover{
                    background-position: -180px -60px;
                }
                .social .t31 #Skype, .social .t32 #Skype, .social .t33 #Skype,
                .social .t13 #Skype:hover, .social .t23 #Skype:hover, .social .t33 #Skype:hover{
                    background-position: -210px -60px;
                }
                .social .t31 #Twitter, .social .t32 #Twitter, .social .t33 #Twitter,
                .social .t13 #Twitter:hover, .social .t23 #Twitter:hover, .social .t33 #Twitter:hover{
                    background-position: -240px -60px;
                }
                .social .t31 #Vimeo, .social .t32 #Vimeo, .social .t33 #Vimeo,
                .social .t13 #Vimeo:hover, .social .t23 #Vimeo:hover, .social .t33 #Vimeo:hover{
                    background-position: -270px -60px;
                }
                .social .t31 #YouTube, .social .t32 #YouTube, .social .t33 #YouTube,
                .social .t13 #YouTube:hover, .social .t23 #YouTube:hover, .social .t33 #YouTube:hover{
                    background-position: -300px -60px;
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

            $defaultIcon = $instance['defaultIcon'];
            $rolloverIcon = $instance['rolloverIcon'];
            $icons = 't'.$defaultIcon.''.$rolloverIcon;

            // Check if title is set
            if ( $title ) {
              echo $before_title . $title . $after_title;
            }
            foreach ($social as $social_item) {
                // Check if $instance is set for each social item and
                // if it is set then only show on front-end
                if( $instance[$social_item]){
                    echo '<a href="'.$instance[$social_item].'" target="_blank" class="'.$icons.'"><div id="'.$social_item.'"></div></a>';
                }
            }
            echo '</div>';
            echo $after_widget;
        }
    }

    // register the widget
    add_action('widgets_init', create_function('', 'return register_widget("social_space");'));
?>
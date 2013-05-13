<?php
    
    /* Logo Component Shortcode 
     * @url         : The logo url extracted from attributes. Default is logo.png
     * @position    : The logo position, default is Left
     */
    function theme_logo_shortcode($atts){
        extract(shortcode_atts(array(
	      'url' => '',
	      'position' => 'left'
        ), $atts));
        return "logo here and position is {$position}";
    }


add_shortcode('atk_logo_shortcode', 'theme_logo_shortcode');

?>

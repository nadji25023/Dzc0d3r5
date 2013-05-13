<?php
/*
 +-----------------------------------------------------------------------------+
 | File Path = "header.php"                                                    |
 |                                                                             |
 | This file is part of Inpress Wordpress Theme                                |
 | Copyright (C) 2013, Atakor Web Studio                                       |
 |                                                                             |
 | CONTENTS:                                                                   |
 |   The header of the wordpress website                                       |
 |                                                                             |
 |   THIS FILE IS REQUIRED FOR THEME RUNNING                                   |
 +-----------------------------------------------------------------------------+
 | Author: Atakor Web Studio - Zakaria Sahnoune <jokface@hotmail.com>          |
 | Author URL: http://themeforest.net/user/Atakor                              |
 +-----------------------------------------------------------------------------+
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

    <head profile="http://gmpg.org/xfn/11">
        
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        
        <title>
            <?php
            
            wp_title("|", true, "right");
            
            // Add the blog name.
            bloginfo("name");

            // Add the blog description for the home/front page.
            $site_description = get_bloginfo("description", THEME_SLUG);
            if ( $site_description && ( is_home() || is_front_page() ) )
                    echo " | $site_description";
            
            ?>
        </title>

        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
          
        
        
        
        <?php 
           /* global $theme_init;
            
            $theme_init->styles($post->ID);
            $theme_init->scripts($post->ID);*/
            
            wp_head(); 
            $layout_class = get_theme_option('general',THEME_SLUG."-site-layout")? get_theme_option('general',THEME_SLUG."-site-layout") : 'wide';
        ?>
    </head>

    <body>
        <!--  body_wrap -->  
        <div class="body_wrap <?php echo  $layout_class; ?>">
            
            <!--  Header Area -->  
            <div class="header_wrap">
                
                <?php   
                    echo '<input type="hidden" value="'.home_url().'" id="base-url"/>';
                ?>
                <!-- Top Header Area -->
                <div class="top_header_wrap <?php // if fixed echo 'navbar-fixed-top' ?>">
                    <div class="top_header container-fluid">
                        <?php 
                            dynamic_sidebar(__('Header Top Area','inpress_admin'));
                        ?>  
                    </div>
                </div>
                <!-- End Top Header Area -->
                
                <!-- Middle Header Area -->
                <div class="middle_header_wrap">
                    <div class="middle_header container-fluid">
                        <?php 
                            dynamic_sidebar(__('Header Middle Area','inpress_admin'));
                        ?>
                    </div>
                </div>
                <!-- End Middle Header Area -->
                
                <!-- Bottom Header Area -->
                <div class="bottom_header_wrap">
                   <div class="bottom_header container-fluid <?php // if fixed echo 'navbar-fixed-top' ?>">
                       <?php 
                           dynamic_sidebar(__('Header Bottom Area','inpress_admin'));
                        ?>
                   </div> 
                </div>
                <!-- End Main Navigation Bar -->
            </div> 
            <!-- End Header Area --> 
            
            <!-- Title & Featured Area -->
            <div style="background:#ccc; height: 420px;">
                
            </div>
            <!-- End Title & Featured Area -->
            
            <div style="height: 800px; background: white;-webkit-box-shadow: 0px -2px 2px 0px rgba(0, 0, 0, 0.3);
box-shadow: 0px -2px 2px 0px rgba(0, 0, 0, 0.3);"></div>
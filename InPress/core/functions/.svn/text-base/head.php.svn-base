<?php 
/*
 +-----------------------------------------------------------------------------+
 | File Path = "core/functions/head.php"                                       |
 |                                                                             |
 | This file is part of Inpress Wordpress Theme                                |
 | Copyright (C) 2013, YouCode Web Studio                                      |
 |                                                                             |
 | CONTENTS:                                                                   |
 |   Header Main Functions                                                     |
 |                                                                             |
 |   THIS FILE IS REQUIRED FOR THEME RUNNING                                   |
 +-----------------------------------------------------------------------------+
 | Author: YouCode Web Studio - Zakaria Sahnoune <zakaria.sahnoune@gmail.com>  |
 | Author URL: http://themeforest.net/user/youcode                             |
 +-----------------------------------------------------------------------------+
*/

function enqueue_theme_scripts() {
    if(is_admin()){
        return;
    } 
    /* Enqueue Bootstarp libraries */
    wp_enqueue_script('bootstrap-js', THEME_JS_LIBRARIES."/bootstrap.min.js", array('jquery'), '2.3.1', false);
    wp_enqueue_script('jquery-easing', THEME_JS_LIBRARIES."/jquery.easing.1.3.min.js", array('jquery'), '1.3', false);
    
    wp_enqueue_script('hoverIntent', THEME_JS_LIBRARIES."/hoverIntent.js", array('jquery'), 'r7', false);
    wp_enqueue_script('supersubs', THEME_JS_LIBRARIES."/supersubs.js", array('jquery'), '0.2b', false);
    wp_enqueue_script('superfish', THEME_JS_LIBRARIES."/superfish.js", array('jquery'), '1.5.12', false);
    wp_enqueue_script('bootstrap-toggle', THEME_JS_LIBRARIES."/jquery.toggle.buttons.js", array('jquery'), '2.8.2', false);
    wp_enqueue_script('bootstrap-colorpicker', THEME_JS_LIBRARIES."/bootstrap-colorpicker.js", array('jquery'), '2012', false);
    
    wp_enqueue_script('jqueryui-custom', THEME_JS_LIBRARIES."/jquery-ui-1.10.2.custom.min.js", array('jquery'), '1.10.2', false);
    
    wp_enqueue_script('custom-navmenu', THEME_CUSTOM_JS."/navmenu.custom.js", array('jquery', 'easing'), '1.0', false);
    
    /* fixes */
    wp_enqueue_style('ios-orientationchange', THEME_FIXES_JS . '/ios-orientationchange-fix.js', array(), '2.8.2', 'screen');
    wp_enqueue_style('touch-punch', THEME_FIXES_JS . '/jquery.ui.touch-punch.js', array('jquery.ui.widget','jquery.ui.mouse'), '2.8.2', 'screen');
    
    /* main js */
    wp_register_script('custom-gmap', THEME_CUSTOM_JS."/gmap.custom.js", array('jquery'), '1.0');
    
    wp_enqueue_script('common-js', THEME_COMMON_JS."/common.js", array('jquery'), '1.0', false);
    wp_enqueue_script('custom-js', THEME_CUSTOM_JS."/custom.php", array('jquery'), '1.0', false);
}
add_action('wp_print_scripts', 'enqueue_theme_scripts');

function enqueue_theme_styles(){
    if(is_admin()){
        return;
    }
    wp_enqueue_style('reset-css', THEME_CSS_LIBRARIES . '/reset.css', array(), '2.0', 'screen');
    wp_enqueue_style('bootstrap-css', THEME_CSS_LIBRARIES . '/bootstrap.min.css', array(), '2.3.1', 'screen');
    wp_enqueue_style('bootstrap-css-responsive', THEME_CSS_LIBRARIES . '/bootstrap-responsive.min.css', array(), '2.3.1', 'screen');
    wp_enqueue_style('icons', THEME_CSS_LIBRARIES . '/icons.css', array(), '1.0', 'screen');
    wp_enqueue_style('bootstrap-toggle', THEME_CSS_LIBRARIES . '/bootstrap-toggle-buttons.css', array(), '2.8.2', 'screen');
    wp_enqueue_style('colorpicker', THEME_CSS_LIBRARIES . '/colorpicker.css', array(), '2', 'screen');
    
    wp_enqueue_style('common-style', THEME_COMMON_CSS . '/common.css', array(), '1.0', 'screen');
    wp_enqueue_style('custom-style', THEME_CUSTOM_CSS . '/custom.php', array(), '1.0', 'screen');
}
add_action('wp_print_styles', 'enqueue_theme_styles');

if(get_theme_option('pages',THEME_SHORTNAME."-google-map")){
    function add_gmap_script(){
        echo "\n<script type='text/javascript' src='http://maps.google.com/maps/api/js?v=3.1&sensor=true'></script>\n";
        wp_print_scripts('custom-gmap');
    }
    add_filter('wp_head','add_gmap_script');
}

/*if(theme_get_option('advance','combine_js')){
	global $theme_combine_js_enqueued; 
	$theme_combine_js_enqueued = false;
	function theme_combine_js($handles){
		if(is_admin()){
			return;
		}
		global $wp_scripts, $theme_combine_js_enqueued;
		if($theme_combine_js_enqueued) return;
		if (! is_a($wp_scripts, 'WP_Scripts')) return;
		
		$move_bottom = theme_get_option('advance','move_bottom');
		$combine_scripts = array();
		$queue_unset = array();
		$wp_scripts->all_deps($wp_scripts->queue); 
		foreach ($wp_scripts->to_do As $key => $handle) {
			$src = $wp_scripts->registered[$handle]->src;
			if (substr($src, 0, 4) != 'http') {
				$src = site_url($src);
				$external = false;
			} else {
				$home = get_option('home');
				if (substr($src, 0, strlen($home)) == $home) {
					$external = false;
				} else	{
					$external = true;
				}
			}
			if(!$external && $handle!='jquery'){
				$combine_scripts[$handle] = $src;
				unset($wp_scripts->to_do[$key]);
				$queue_unset[$handle] = true;
			}
		}
		foreach ($wp_scripts->queue as $key => $handle) {
			if (isset($queue_unset[$handle])){
				unset($wp_scripts->queue[$key]);
			}
		}
		
		$fileId = 0;
		foreach($combine_scripts as $handle => $src){
			$path = ABSPATH . str_replace(get_option('siteurl').'/', '', $src);
			$fileId += @filemtime($path);
		}
			
		$cache_name = md5(serialize($combine_scripts).$fileId);
		$cache_file_path = THEME_CACHE_DIR . '/' .$cache_name .'.js';
		$cache_file_url = THEME_CACHE_URI . '/' .$cache_name .'.js';
		
		if(!is_readable($cache_file_path)){
			$content = '';
			foreach($combine_scripts as $handle => $src){
				$content .= "/* $handle: ($src) *//*\n";
				$content .= @file_get_contents($src). "\n\n\n\n";;
			}
			if (is_writable(THEME_CACHE_DIR)) {
				$fhandle = @fopen($cache_file_path, 'w+');
				if ($fhandle) fwrite($fhandle, $content, strlen($content));
			}
		}
		wp_enqueue_script($cache_name, $cache_file_url,array(),false,$move_bottom);
		$theme_combine_js_enqueued = true;
	}
	add_action('wp_print_scripts', 'theme_combine_js',100);
}*/
	
/*if(theme_get_option('advance','combine_css')){
	function theme_combine_css($handles){
		if(is_admin()){
			return;
		}
		global $wp_styles;
		if (! is_object($wp_styles)) return;
		$combine_styles = array();
		$queue_unset = array();
		$wp_styles->all_deps($wp_styles->queue); 
		foreach ($wp_styles->to_do As $key => $handle) {
			$media = ($wp_styles->registered[$handle]->args ? $wp_styles->registered[$handle]->args : 'screen');
			$src = $wp_styles->registered[$handle]->src;
			if (substr($src, 0, 4) != 'http') {
				$src = site_url($src);
				$external = false;
			} else {
				$home = get_option('home');
				if (substr($src, 0, strlen($home)) == $home) {
					$external = false;
				} else	{
					$external = true;
				}
			}
			if(!$external){
				$combine_styles[$media][$handle] = $src;
				unset($wp_styles->to_do[$key]);
				$queue_unset[$handle] = true;
			}
		}
		foreach ($wp_styles->queue as $key => $handle) {
			if (isset($queue_unset[$handle])){
				unset($wp_styles->queue[$key]);
			}
		}
		foreach ($combine_styles as $media => $styles) {
			$fileId = 0;
			foreach($styles as $handle => $src){
				$path = ABSPATH . str_replace(get_option('siteurl').'/', '', $src);
				$fileId += @filemtime($path);
			}
				
			$cache_name = md5(serialize($combine_styles).$fileId);
			$cache_file_path = THEME_CACHE_DIR . '/' .$cache_name .'.css';
			$cache_file_url = THEME_CACHE_URI . '/' .$cache_name .'.css';
			
			if(!is_readable($cache_file_path)){
				$content = '';
				foreach($styles as $handle => $src){
					$content .= "/* $handle: ($src) *//*\n";
					$content .= @file_get_contents($src). "\n\n";;
				}
				if (is_writable(THEME_CACHE_DIR)) {
					$fhandle = @fopen($cache_file_path, 'w+');
					if ($fhandle) fwrite($fhandle, $content, strlen($content));
				}
			}
			wp_enqueue_style(THEME_SHORTNAME.'-styles-'.$media, $cache_file_url, false, false, $media);
		}
	}
	add_action('wp_print_styles', 'theme_combine_css',100);
}*/
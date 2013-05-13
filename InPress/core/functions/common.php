<?php
global $theme_options;

function get_theme_option($page, $name = NULL){
    global $theme_options;
    if ($name == NULL) {
        if (isset($theme_options[$page])) {
            return $theme_options[$page];
        } else {
            return false;
        }
    } else {
        if (isset($theme_options[$page][$name])) {
            return $theme_options[$page][$name];
        } else {
            return false;
        }
    }
}

function set_theme_option($page, $name, $value) {
	global $theme_options;
	$theme_options[$page][$name] = $value;
	
	update_option(THEME_SHORTNAME. '_' . $page, $theme_options[$page]);
}

function ie_fix_filter($tag, $handle){
    if ($handle === 'ie-fix'){
        $tag = '<!--[if IE]>' . "\n" . $tag . '<![endif]-->' . "\n";
    }
    else if ($handle === 'ie7-fix'){
        $tag = '<!--[if IE7]>' . "\n" . $tag . '<![endif]-->' . "\n";
    }
    return $tag;
}
?>

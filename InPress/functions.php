<?php
/*
 +-----------------------------------------------------------------------------+
 | File Path = "functions.php"                                                 |
 |                                                                             |
 | This file is part of Inpress Wordpress Theme                                |
 | Copyright (C) 2013, YouCode Web Studio                                      |
 |                                                                             |
 | CONTENTS:                                                                   |
 |   the functions file of the theme                                           |
 |                                                                             |
 |   THIS FILE IS REQUIRED FOR THEME RUNNING                                   |
 +-----------------------------------------------------------------------------+
 | Author: YouCode Web Studio - Zakaria Sahnoune <zakaria.sahnoune@gmail.com>  |
 | Author URL: http://themeforest.net/user/youcode                             |
 +-----------------------------------------------------------------------------+
*/

global $theme_init;

$themename = "InPress";
$themslug = "inpress";
$shortname = "ips";
$themever = "1.0";
$themeurl = "http://www.themeforest.com/";

require_once (TEMPLATEPATH . '/core/ThemeInit.php');

$theme_init = new ThemeInit();
$theme_init -> init(array(
    'theme_name' => $themename, 
    'theme_slug' => $themslug,
    'short_name' => $shortname,
    'theme_version' => $themever,
    'theme_url' => $themeurl
));

?>
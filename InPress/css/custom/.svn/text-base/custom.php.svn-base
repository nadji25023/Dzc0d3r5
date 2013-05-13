<?php
/*
 +-----------------------------------------------------------------------------+
 | File Path = "css/custom/custom.php"                                         |
 |                                                                             |
 | This file is part of Inpress Wordpress Theme                                |
 | Copyright (C) 2013, YouCode Web Studio                                      |
 |                                                                             |
 | CONTENTS:                                                                   |
 |   PHP file to generate custom css style                                     |
 |                                                                             |
 |   THIS FILE IS REQUIRED FOR THEME RUNNING                                   |
 +-----------------------------------------------------------------------------+
 | Author: YouCode Web Studio - Zakaria Sahnoune <zakaria.sahnoune@gmail.com>  |
 | Author URL: http://themeforest.net/user/youcode                             |
 +-----------------------------------------------------------------------------+
*/

$root = dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}

header("Content-type: text/css; charset=utf-8");

/* This file section prevent each time reloading */

//Get the last-modified-date of the file
$lastModified = filemtime(__FILE__);
//Get a unique hash of this file
$etagFile = md5_file(__FILE__);

//Get the HTTP_IF_MODIFIED_SINCE header is set
$ifModifiedSince = (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);

//Get the HTTP_IF_NONE_MATCH header is set (etag: unique file hash)
$etagHeader = (isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);

//Set last-modified header
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
//Set etag-header
header("Etag: $etagFile");
//Make sure caching is turned on
header('Cache-Control: public');
foreach($_SERVER as $key => $value){
    echo $key .' => ' . $value. "\n";
}
//Check if file has changed. If not, send 304 and exit
if (@strtotime($ifModifiedSince) == $lastModified || $etagHeader == $etagFile)
{
    header("HTTP/1.1 304 Not Modified");
    exit;
}
?>
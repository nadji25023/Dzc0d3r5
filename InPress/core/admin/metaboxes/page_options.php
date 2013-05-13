<?php
$config = array(
	'title' => __('Page Options','inpress_admin'),
	'id' => 'page-options-metabox',
	'pages' => array('page'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
            "name" => __('Show Page Title','inpress_admin'),
            "label" => __('Show Page Title','inpress_admin'),
            "desc" => __('Disable if you prefer to hide page title','inpress_admin'),
            "id" => THEME_SLUG.'-show-page-title',
            "default" => 'true',
            "type" => "toggle",
	),
        array(
            "name" => __('Show Breadcrumbs','inpress_admin'),
            "label" => __('Show Breadcrumbs','inpress_admin'),
            "desc" => __('If Breadcrumbs are disabled from the <b>General Options Menu</b>, this value will be ignored.','inpress_admin'),
            "id" => THEME_SLUG.'-show-breadrumbs',
            "default" => 'true',
            "type" => "toggle",
	),
);
new MetaboxGenerator($config,$options);

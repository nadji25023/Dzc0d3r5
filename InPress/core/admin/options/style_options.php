<?php

$options = array(
    array(
        "name" => __("Style Settings","incount_admin"),
        "type" => "title",
        "sub-menu" => "Skins, Colors, Fonts"
    ),
    
    array(
        "name" => __("Skins","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Colors","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Fonts","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
);

return array(
    'name' => 'style',
    'options' => $options
);
?>

<?php

$options = array(
    array(
        "name" => __("SEO Settings","incount_admin"),
        "type" => "title",
        "sub-menu" => ""
    ),
    
    
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
);

return array(
    'name' => 'seo',
    'options' => $options
);
?>

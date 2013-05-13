<?php
$config = array(
	'title' => __('Slideshow Type','inpress_admin'),
	'id' => 'slider_metabox',
	'pages' => array('page'),
	'callback' => '',
	'context' => 'side',
	'priority' => 'default',
);
$options = array(
	array(
            "name" => __('Slideshow Type','inpress_admin'),
            "label" => __('Select a slideshow for this page','inpress_admin'),
            "desc" => __('After selecting a type the options will be available','inpress_admin'),
            "id" => THEME_SLUG.'_slider_type',
            "default" => 'none',
            "options" => array(
                    'none' => 'None',
                    'simple_slider' => 'Simple Slider',
                    'iview_slider' => 'iView Slider',
                    'flex_slider' => 'Flex Slider',
                    'anything_slider' => 'Anything Slider',
                    'accordion_slider' => 'Accordion Slider',
                    'carousel_slider' => 'Carousel Slider',
                    'piecemaker_slider' => 'Piecemaker Slider',
                ),
            "type" => "select",
	),
);
new MetaboxGenerator($config,$options);

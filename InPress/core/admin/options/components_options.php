<?php

$options = array(
    array(
        "name" => __("Components Settings","incount_admin"),
        "type" => "title",
        "sub-menu" => "Header, Navigation, Banners, Social Links, Footer, Shortcodes, Widgets"
    ),
    
    array(
        "name" => __("Header","inpress_admin"),
        "type" => "start"
    ),
        array(
            "name" => __("Use Logo Image","inpress_admin"),
            "id" => THEME_SHORTNAME."-show-logoimg",
            "type" => "toggle",
            "default" => "off",
            "alternate" => 'alternate',
            "desc" => "Enable to use a logo image instead of website title",
        ),
        array(
            "name" => __("Custom Logo Image","inpress_admin"),
            "id" => THEME_SHORTNAME."-logoimg",
            "type" => "upload",
            "extra" => "preview",
            "size" => "50",
            "alternate" => 'alternate',
            "desc" => "You should enable Use Logo Image to make this operational",
        ),
        array(
            "name" => __("Logo Image Resizing","inpress_admin"),
            "id" => THEME_SHORTNAME."-logoresize",
            "type" => "toggle",
            "default" => "off",
            "alternate" => 'alternate',
            "desc" => "Enable to resize logo according to a specific height",
        ),
        array(
            "name" => __("Logo Image Height","inpress_admin"),
            "id" => THEME_SHORTNAME."-logoheight",
            "type" => "numeric",
            "unit" => "px",
            "toscroll" => false,
            "alternate" => 'alternate',
            "desc" => "",
        ),
        array(
            "name" => __("Logo Text Size","inpress_admin"),
            "id" => THEME_SHORTNAME."-logotsize",
            "type" => "numeric",
            "unit" => "px",
            "toscroll" => false,
            "alternate" => 'alternate',
            "desc" => "In case of not using a Logo Image, the website title will be shown, so here you can specify the title text size.use size in px.",
        ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Navigation","inpress_admin"),
        "type" => "start"
    ),
        array(
            "name" => __("Javascript Effect To Main Menu","inpress_admin"),
            "id" => THEME_SHORTNAME."-js-mainnav",
            "type" => "toggle",
            "alternate" => 'alternate',
            "default" => "false",
            "desc" => "Add Javascript effects to Main Navigation Menu.",
        ),
        array(

            "name" => __("Show Breacrumbs","inpress_admin"),
            "id" => THEME_SHORTNAME."-show-breadcrumbs",
            "type" => "toggle",
            "default" => "true",
            "desc" => "Showing current page ancestors.",
        ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Sliders","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Banners","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Social Links","inpress_admin"),
        "type" => "start"
    ),
        array(
            "name" => __("AIM URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-aim",
            "type" => "text",
            "text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Behance URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-behance",
            "type" => "text",
            "text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Digg URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-digg",
            "type" => "text",
            "text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Dribbble URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-dribbble",
            "type" => "text",
            "text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Ember URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-ember",
            "type" => "text",
            "text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Evernote URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-evernote",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Facebook URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-facebook",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Flickr URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-flickr",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Forrst URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-forrst",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Github URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-github",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Google Plus URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-googleplus",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Last FM URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-lastfm",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("LinkedIn URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-linkedin",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Paypal URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-paypal",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("StumbleUpon URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-stumbleupon",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Tumblr URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-tumblr",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Twitter URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-twitter",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Vimeo URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-vimeo",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Yahoo URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-yahoo",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Youtube URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-youtube",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
        array(
            "name" => __("Zerply URL","incount_admin"),
            "id" => THEME_SHORTNAME."-sociallinks-zerply",
            "type" => "text",
"text_addon" => "append",
            "addon" => '<span class="icon16 icons-link"></span>',
            "alternate" => 'alternate',
            "size" => "40",
        ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Footer","inpress_admin"),
        "type" => "start"
    ),
        
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Shortcodes","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Widgets","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
);

return array(
    "name" => 'components',
    'options' => $options
);
?>

<?php

if (! function_exists("theme_blog_page_process")) {
	function theme_blog_page_process($option,$value) {
		if(!empty($value)){
			update_option( 'page_for_posts', $value );
		}
		return $value;
	}
}

$options = array(
    array(
        "name" => __("Pages Options","incount_admin"),
        "type" => "title",
        "sub-menu" => "Homepage, Blog, Archives, Posts, Single Post, Portfolio, Maintain Mode, Contacts, Sitemap"
    ),
    
    array(
        "name" => __("Homepage","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Blog","inpress_admin"),
        "type" => "start"
    ),   
    array(
        "name" => __("Blog Page","inpress_admin"),
        "id" => THEME_SHORTNAME."-blog-page",
        "type" => "select",
        "page" => 0,
        "default" => 0,
        "prompt" => __("None",'inpress_admin'),
        "process" => "theme_blog_page_process",
        "desc" => "The page you choose here will display the blog"
   ),array(
        "name" => __("Sidebar Position",'inpress_admin'),
        "desc" => "Select the position of the sidebar on blog pages.",
        "id" => THEME_SHORTNAME."-sidebar-position",
        "default" => 'right',
        "options" => array(
                "full" => __('Full Width','inpress_admin'),
                "right" => __('Right Sidebar','inpress_admin'),
                "left" => __('Left Sidebar','inpress_admin'),
        ),
        "type" => "select",
   ),array(
        "name" => __("Layout blog",'inpress_admin'),
        "desc" => "Select your layout blog between Full Width view or Left Float view",
        "id" => THEME_SHORTNAME."-layout-blog",
        "default" => 'wide',
        "options" => array(
                "wide" => __('Full Width','inpress_admin'),
                "left" => __('Left Float','inpress_admin'),
        ),
        "type" => "select"
    ),array(
        "name" => __("Display Full Blog Posts",'inpress_admin'),
        "desc" => __("This option determinate whether to display full blog posts in index page.",'inpress_admin'),
        "id" => THEME_SHORTNAME."-display-full",
        "default" => false,
        "type" => "toggle"
    ),array(
        "name" => __("Gap Between Posts",'inpress_admin'),
        "desc" => "",
        "id" => THEME_SHORTNAME."-posts-gap",
        "type" => "numeric",
        "unit" => "px",
        "toscroll" => false,
        "alternate" => 'alternate'
    ),/*array(
        "name" => __("Exclude Categories",'inpress_admin'),
        "desc" => __("The blog Page usually displays all Categorys, since sometimes you want to exclude some of these categories you can exclude multiple categories here:",'striking_admin'),
        "id" => THEME_SHORTNAME."-exclude-categorys",
        "default" => array(),
        "target" => "cat",
        "prompt" => __("Choose category..",'inpress_admin'),
        "type" => "multidropdown"
    ),array(
        "name" => __("Exclude Categories",'inpress_admin'),
        "desc" => __("The blog Page usually displays all Categorys, since sometimes you want to exclude some of these categories you can exclude multiple categories here:",'inpress_admin'),
        "id" => THEME_SHORTNAME."-exclude-categorys",
        "prompt" => __("Choose category..",'inpress_admin'),
        "type" => "select"
    ),array(
        "name" => __("Gap Between Posts",'inpress_admin'),
        "desc" => "",
        "id" => "posts_gap",
        "min" => "0",
        "max" => "200",
        "step" => "1",
        "unit" => 'px',
        "default" => "80",
        "type" => "range"
    ),*/
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Archives","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Posts","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Single Post","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Portfolio","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
        
    array(
        "name" => __("Maintain Mode","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Contacts","inpress_admin"),
        "type" => "start"
    ), 
        array(
            "name" => __("Contact Title","inpress_admin"),
            "id" => THEME_SHORTNAME."-contact-title",
            "type" => "text",
            "size" => "40",
            "default" => get_bloginfo('name'),
            "desc" => "The title used on the map marker. By default is the website title.",
        ),
        array(
            "name" => __("Contact Adress","inpress_admin"),
            "id" => THEME_SHORTNAME."-contact-adress",
            "type" => "text",
            "size" => "40",
            "default" => "",
            "desc" => "The adress to find you (Required for Google Map).",
        ),
        array(
            "name" => __("Display Fullwidth Map","inpress_admin"),
            "id" => THEME_SHORTNAME."-fullwidth-map",
            "type" => "toggle",
            "default" => "true",
            "desc" => "Display a fullwidth map on the top of the page.",
        ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
    
    array(
        "name" => __("Sitemap","inpress_admin"),
        "type" => "start"
    ),
    array(
        "type" => "end",
        "id" => "save_plugin_options"
    ),
);

return array(
    'name' => 'pages',
    'options' => $options
);
?>

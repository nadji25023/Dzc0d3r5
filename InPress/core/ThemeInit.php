<?php
/*
 +-----------------------------------------------------------------------------+
 | File Path = "core/InpressInit.php"                                          |
 |                                                                             |
 | This file is part of Inpress Wordpress Theme                                |
 | Copyright (C) 2013, YouCode Web Studio                                      |
 |                                                                             |
 | CONTENTS:                                                                   |
 |   Class used for the theme initialization                                   |
 |                                                                             |
 |   THIS FILE IS REQUIRED FOR THEME RUNNING                                   |
 +-----------------------------------------------------------------------------+
 | Author: YouCode Web Studio - Zakaria Sahnoune <zakaria.sahnoune@gmail.com>  |
 | Author URL: http://themeforest.net/user/youcode                             |
 +-----------------------------------------------------------------------------+
*/

// deny access to this file where wordpress core files are not present
if (!function_exists ('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

$js_array = array();
    
class ThemeInit {
    

    function init($propreties){
        /* Define theme's constants */
        $this->constants($propreties);
        
        $this->PluginsActivator();
    
        /* Add language support */
        //add_action('init',array(&$this, 'language'));
        
        /* Add theme supports */
        add_action('after_setup_theme', array(&$this, 'supports'));

        /* Load theme's functions */
        $this->functions();

        /* Register theme's custom post types */
        $this->types();

        /* Register theme's custom post types */
        $this->filters();
        
        /* Load theme's plugins */
        $this->PluginsActivator();

        /* Load theme's shortcodes */
        //$this->shortcodes();

        /* Initialize the theme's widgets */
        add_action('widgets_init',array(&$this, 'widgets')); 
        
        /* Load admin files */
        $this->admin();
               
        //Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
        //@ini_set('pcre.backtrack_limit', 1000000);
    }
      
    function constants($propreties){
        define('THEME_NAME', $propreties['theme_name']);
        define('THEME_SLUG', $propreties['theme_slug']);
        define('THEME_SHORTNAME', $propreties['short_name']);
        define('THEME_VERSION', $propreties['theme_version']);
        define('THEME_URL', $propreties['theme_url']);

        define('THEME_DIR', get_template_directory());
        define('THEME_URI', get_template_directory_uri());

        define('THEME_CORE', THEME_DIR . '/core');

        define('THEME_ADMIN', THEME_CORE . '/admin');
        define('THEME_PLUGINS', THEME_CORE . '/plugins');
        define('THEME_SLIDERS', THEME_PLUGINS . '/sliders');
        define('THEME_HELPERS', THEME_CORE . '/helpers');
        define('THEME_FUNCTIONS', THEME_CORE . '/functions');
        define('THEME_TYPES', THEME_CORE . '/types');
        define('THEME_WIDGETS', THEME_CORE . '/widgets');
        define('THEME_SHORTCODES', THEME_CORE . '/shortcodes');

        define('THEME_COMMON_JS', THEME_URI . '/js/common');
        define('THEME_CUSTOM_JS', THEME_URI . '/js/custom');
        define('THEME_JS_LIBRARIES', THEME_URI . '/js/libraries');
        define('THEME_ADMIN_JS', THEME_URI . '/js/admin');
        define('THEME_SLIDERS_JS', THEME_URI . '/js/sliders');  
        define('THEME_FIXES_JS', THEME_URI . '/js/fixes');
        
        define('THEME_COMMON_CSS', THEME_URI . '/css/common');
        define('THEME_CUSTOM_CSS', THEME_URI . '/css/custom');
        define('THEME_CSS_LIBRARIES', THEME_URI . '/css/libraries');
        define('THEME_FIXES_CSS', THEME_URI . '/css/fixes');
        define('THEME_ADMIN_CSS', THEME_URI . '/css/admin');
        define('THEME_SLIDERS_CSS', THEME_URI . '/css/sliders');
        
        define('THEME_IMAGES', THEME_DIR . '/images');
        define('THEME_IMAGES_URI', THEME_URI . '/images');

        define('THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions');
        define('THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options');
        define('THEME_ADMIN_DOCS', THEME_ADMIN . '/docs');
        define('THEME_ADMIN_METABOXES', THEME_ADMIN . '/metaboxes');
    }
    
    function language(){
        
    }
    
    function supports(){
        if (function_exists('add_theme_support')) {
            
            //This enables post-thumbnail support for a theme.
            add_theme_support('post-thumbnails', array('post', 'page', 'portfolio', 'slide'));

            //This enables the naviagation menu ability. 
            add_theme_support('menus');

            register_nav_menus(array(
                'quicknav-menu' => __(THEME_NAME . ' Quick Menu', 'inpress_admin'),
                'mainnav-menu' => __(THEME_NAME . ' Main Menu', 'inpress_admin'),
                'footernav-menu' => __(THEME_NAME . ' Footer Menu', 'inpress_admin')
            ));

            //This enables post and comment RSS feed links to head. This should be used in place of the deprecated automatic_feed_links.
            add_theme_support('automatic-feed-links');

            // reference to: http://codex.wordpress.org/Function_Reference/add_editor_style
            add_theme_support('editor-style');
        }
    }
    
    function functions(){
        
        require_once (THEME_CORE.'/builder/PageBuilder.php');
        require_once (THEME_FUNCTIONS . '/walkers.php');
        require_once (THEME_FUNCTIONS . '/common.php'); 
        require_once (THEME_FUNCTIONS . '/head.php');
        require_once (THEME_HELPERS . '/CssGenerator.php');
        require_once (THEME_HELPERS . '/ThemeGenerator.php'); 
        require_once (THEME_HELPERS . '/SidebarGenerator.php');
             
        $this->options();
    }
    
    function options() {
        global $theme_options;
        
        $theme_options = array();
        $option_files = array(
            'general_options',
            'pages_options',
            'components_options',
            'style_options',
            'advanced_options',
        );
        
        foreach($option_files as $file){
            $page = include (THEME_ADMIN_OPTIONS . "/" . $file.'.php');
            $theme_options[$page['name']] = array();
            foreach($page['options'] as $option) {
                if (isset($option['default'])) {
                        $theme_options[$page['name']][$option['id']] = $option['default'];
                }
            }
            $theme_options[$page['name']] = array_merge((array) $theme_options[$page['name']], (array) get_option(THEME_SHORTNAME. '_' . $page['name']));
            }
            
    } 
    
    function types(){
        require_once (THEME_TYPES . '/portfolio.php');
        require_once (THEME_TYPES . '/slides.php');
    }
    
    
    function filters(){
        if (function_exists('add_filter')) {
            add_filter( 'style_loader_tag', 'ie_fix_filter', 10, 2 );
        }
    }
    
    function shortcodes(){
        require_once (THEME_SHORTCODES . '/test.php');
    }
    
    function widgets(){
        require_once (THEME_WIDGETS . '/headerWidgets.php');
        register_widget('Theme_Header_Widgets');
                
    }
    
    function admin(){
        if (is_admin()) {
            require_once (THEME_ADMIN . '/AdminInit.php');
            $admin = new AdminInit();
            $admin->init();
        }
    }
   
    // plugin activation
    function PluginsActivator(){      
        require_once(THEME_PLUGINS.'/class-tgm-plugin-activation.php');
        add_action('tgmpa_register',  array(&$this, 'inpress_register_required_plugins'));
    }
    
    function inpress_register_required_plugins(){      
        
        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins =
                array(
                    array(
                        'name'     		=> 'Revolution Slide', // The plugin name
                        'slug'     		=> 'revolutionslide', // The plugin slug (typically the folder name)
                        'source'   		=> get_stylesheet_directory(). '/core/plugins/sliders/revslider.zip', // The plugin source
                        'required' 		=> false, // If false, the plugin is only 'recommended' instead of required
                        'version' 		=> '2.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                        'force_activation' 	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                        'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                        'external_url' 		=> '', // If set, overrides default API URL and points to an external URL
                         ),
                    array(
                        'name'     		=> 'Layer Slider', // The plugin name
                        'slug'     		=> 'layerslider', // The plugin slug (typically the folder name)
                        'source'   		=> get_stylesheet_directory(). '/core/plugins/sliders/layerslider.zip', // The plugin source
                        'required' 		=> false, // If false, the plugin is only 'recommended' instead of required
                        'version' 		=> '4.0.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                        'force_activation' 	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                        'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                        'external_url' 		=> '', // If set, overrides default API URL and points to an external URL
                        ),
                     array(
                        'name'     		=> 'Cute Slider', // The plugin name
                        'slug'     		=> 'cuteslider', // The plugin slug (typically the folder name)
                        'source'   		=> get_stylesheet_directory() . '/core/plugins/sliders/cuteslider.zip', // The plugin source
                        'required' 		=> false, // If false, the plugin is only 'recommended' instead of required
                        'version' 		=> '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                        'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                        'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                        'external_url' 		=> '', // If set, overrides default API URL and points to an external URL
                        ),
                    );

                // Change this to your theme text domain, used for internationalising strings
                $theme_text_domain = THEME_NAME;

                /**
                 * Array of configuration settings. Amend each line as needed.
                 * If you want the default strings to be available under your own theme domain,
                 * leave the strings uncommented.
                 * Some of the strings are added into a sprintf, so see the comments at the
                 * end of each line for what each argument will be.
                 */

                $config = array(
                        'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
                        'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
                        'parent_menu_slug' 	=> 'themes.php', 		// Default parent menu slug
                        'parent_url_slug' 	=> 'themes.php', 		// Default parent URL slug
                        'menu'         		=> 'install-required-plugins', 	// Menu slug
                        'has_notices'      	=> true,                       	// Show admin notices or not
                        'is_automatic'    	=> false,			// Automatically activate plugins after installation or not
                        'message' 	        => '',				// Message to output right before the plugins table
                        'strings'      		=> array(
                            'page_title'                        => __( 'Install Required Plugins', $theme_text_domain ),
                            'menu_title'                        => __( 'Install Plugins', $theme_text_domain ),
                            'installing'                        => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
                            'oops'                              => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
                            'notice_can_install_required'       => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
                            'notice_can_install_recommended'    => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
                            'notice_cannot_install'             => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
                            'notice_can_activate_required'      => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                            'notice_can_activate_recommended'   => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                            'notice_cannot_activate'            => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
                            'notice_ask_to_update'              => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
                            'notice_cannot_update' 		=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
                            'install_link' 			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                            'activate_link'                     => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                            'return'                            => __( 'Return to Required Plugins Installer', $theme_text_domain ),
                            'plugin_activated'                  => __( 'Plugin activated successfully.', $theme_text_domain ),
                            'complete'                          => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
                            'nag_type'                          => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
                        )
                );
                tgmpa($plugins, $config);
    }
    
    // Load css_pannel
    function activate_css_pannel(){
        wp_enqueue_style( 'css3_panels', THEME_SLIDERS . '/css3panels/css3panels.css', 'style' ); 
        wp_enqueue_script('css3_panels', THEME_SLIDERS. '/css3panels/css3panels.js',array('jquery'),'1.3',true);
    }
    
    // Load iosSlider
    function activate_iosSlider(){
        wp_enqueue_style('ios_slider', THEME_SLIDERS . '/iosslider/style.css', 'style'); 
        wp_enqueue_script('ios_slider_min', get_template_directory_uri() . '/iosslider/jquery.iosslider.min.js',array('jquery'),'1.3',true);
        wp_enqueue_script('ios_slider_kalypso', get_template_directory_uri() . '/iosslider/jquery.iosslider.kalypso.js',array('jquery'),'1.3',true);

        $ios_slider = array( 
                        'ios_slider' =>
                                        "jQuery('.iosSlider').iosSlider({
                                        snapToChildren: true,
                                        desktopClickDrag: true,
                                        keyboardControls: true,
                                        navNextSelector: jQuery('.next'),
                                        navPrevSelector: jQuery('.prev'),
                                        navSlideSelector: jQuery('.selectors .item'),
                                        scrollbar: true,
                                        scrollbarContainer: '#slideshow .scrollbarContainer',
                                        scrollbarMargin: '0',
                                        scrollbarBorderRadius: '4px',
                                        onSlideComplete: slideComplete,
                                        onSliderLoaded: function(args){
                                                var otherSettings = {
                                                        hideControls : true, // Bool, if true, the NAVIGATION ARROWS will be hidden and shown only on mouseover the slider
                                                        hideCaptions : false  // Bool, if true, the CAPTIONS will be hidden and shown only on mouseover the slider
                                                }
                                                sliderLoaded(args, otherSettings);
                                        },
                                        onSlideChange: slideChange,
                                        keyboardControls: true,
                                        infiniteSlider: true,
                                        autoSlide: true
                                     });
                        ;");

        $this->js_updater( $ios_slider );
    }     
    
    // Load iCarousel
    function activate_icarousel() {
        wp_enqueue_style( 'icarousel_demo', THEME_SLIDERS . '/icarousel/css/demo3.css', 'style' ); 
        wp_enqueue_style( 'icarousel', THEME_SLIDERS . '/icarousel/css/icarousel.css', 'style' ); 
        wp_enqueue_script('icarousel', THEME_SLIDERS . '/icarousel/js/icarousel.packed.js',array('jquery'),'1.3',true);
        wp_enqueue_script('mousewheel', THEME_SLIDERS. '/icarousel/js/jquery.mousewheel.js',array('jquery'),'1.3',true);
        wp_enqueue_script('raphael_min', THEME_SLIDERS . '/icarousel/js/raphael-min.js',array('jquery'),'1.3',true);

        $icarousel = array ( 'icarousel_slider' =>
                        "	
                                jQuery('#icarousel').iCarousel({
                                        easing: 'easeInOutQuint',
                                        slides: 7,
                                        animationSpeed: 700,
                                        pauseTime: 5000,
                                        perspective: 75,
                                        slidesSpace: 300,
                                        pauseOnHover: true,
                                        direction: \"ltr\",
                                        timer: \"Bar\",
                                        timerOpacity: 0.4,
                                        timerDiameter: 220,
                                        keyboardNav: true,
                                        mouseWheel: true,
                                        timerPadding: 3,
                                        timerStroke: 4,
                                        timerBarStroke: 0,
                                        timerColor: \"#FFF\",
                                        timerPosition: \"bottom-center\",
                                        timerX: 15,
                                        timerY: 30
                                });
                        ;");

        $this->js_updater( $icarousel );

    }

    // Load Paralax effect
    function activate_rev_slider() {
        wp_enqueue_script('flex_slider', THEME_SLIDERS . '/paralax/parallax.js',array('jquery'),'1.3',true);
        $paralax = array ( 'paralax' =>
                        "	
                                var parallax = new Parallax({
                                        container: '#slideshow',
                                        layers: [
                                                { selector: '.para1', ratio: .020 },
                                                { selector: '.para2', ratio: .010 },
                                                { selector: '.para3', ratio: .008 },
                                                { selector: '.para4', ratio: .005 },
                                                { selector: '.para5', ratio: .005 }
                                        ]
                                });
                        ");
        $this->js_updater( $paralax );
    }

    // Load Laptop Slider
    function activate_lslider() {
        wp_enqueue_style('lslider', THEME_SLIDERS . '/flex_slider/css/flexslider-laptop.css', 'style'); 

        wp_enqueue_script('flex_slider', THEME_SLIDERS . '/flex_slider/js/jquery.flexslider-min.js',array('jquery'),'1.3',true);

        $laptop_slider = array ( 'laptop_slider' =>
                "
                (function($){ 
                        $(window).load(function(){

                                function slideCompletezn_laptop_slider(args) {
                                        var caption = $(args.container).find('.flex-caption').attr('style', ''),
                                                thisCaption = $('.flexslider.zn_laptop_slider .slides > li.flex-active-slide').find('.flex-caption');
                                        thisCaption.animate({left:20, opacity:1}, 500, 'easeOutQuint');
                                }

                                $(\".flexslider.zn_laptop_slider\").flexslider({
                                        animation: \"fade\",				//String: Select your animation type, \"fade\" or \"slide\"
                                        slideDirection: \"horizontal\",	//String: Select the sliding direction, \"horizontal\" or \"vertical\"
                                        slideshow: true,				//Boolean: Animate slider automatically
                                        slideshowSpeed: 997000,			//Integer: Set the speed of the slideshow cycling, in milliseconds
                                        animationDuration: 9600,			//Integer: Set the speed of animations, in milliseconds
                                        directionNav: true,				//Boolean: Create navigation for previous/next navigation? (true/false)
                                        controlNav: false,				//Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                                        keyboardNav: true,				//Boolean: Allow slider navigating via keyboard left/right keys
                                        mousewheel: false,				//{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
                                        smoothHeight: false,
                                        randomize: false,				//Boolean: Randomize slide order
                                        slideToStart: 0,				//Integer: The slide that the slider should start on. Array notation (0 = first slide)
                                        animationLoop: true,			//Boolean: Should the animation loop? If false, directionNav will received \"disable\" classes at either end
                                        pauseOnAction: true,			//Boolean: Pause the slideshow when interacting with control elements, highly recommended.
                                        pauseOnHover: false,			//Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
                                        start: slideCompletezn_laptop_slider,
                                        after: slideCompletezn_laptop_slider
                                });
                        });
                })(jQuery);
                ");

        $this->js_updater( $laptop_slider );
    }
    
    /*--------------------------------------------------------------------------------------------------
            Update_JS
    --------------------------------------------------------------------------------------------------*/
    function js_updater($script) {

            global $js_array;
            $js_array[key ($script)] = $script[key ($script)];

    }    
    
    /*--------------------------------------------------------------------------------------------------
            JS loader
    --------------------------------------------------------------------------------------------------*/
    function js_loader($script) {
        global $js_array;
        $script = '<script type="text/javascript">';
                foreach ( $js_array as $tt ){
                        $script .= $tt;
                }
        $script .= '</script>';
        echo $script;
     }
}

<?php
// Avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

class ThemeGenerator {
    function header_widgets_helper($component, $hposition, $hlposition, $hrposition, $vposition){
        $output = '';
        $function = $component.'_hwidget_generator';
        if(method_exists(&$this, $function)){
            switch($component){
                case 'social':
                    $social_links = array();
                    $options = get_theme_option('components');
                    foreach($options as $option => $value){
                        $pattern = '/^'.THEME_SHORTNAME.'-sociallinks-/';
                        if(preg_match($pattern, $option)){
                            array_push($social_links, $option);
                        }
                    }
                    $output = $this->social_hwidget_generator($hposition, $vposition, $hlposition, $hrposition, $social_links);
                    break;
                case 'search':
                    $output = $this->search_hwidget_generator($hposition, $vposition, $hlposition, $hrposition);
                    break;
                case 'logo' : 
                    $use_img    = get_theme_option('components', THEME_SHORTNAME."-show-logoimg");            
                    $img_url    = get_theme_option('components', THEME_SHORTNAME."-logoimg");
                    $img_resize = get_theme_option('components', THEME_SHORTNAME."-logoresize");  
                    $img_height = get_theme_option('components', THEME_SHORTNAME."-logoheight");
                    
                    $output = $this->logo_hwidget_generator($hposition, $vposition, $hlposition, $hrposition, $use_img, $img_url, $img_resize, $img_height);
                    break;
                case 'quicknav':
                    $output = $this->quicknav_hwidget_generator($hposition, $vposition, $hlposition, $hrposition);
                    break;
                case 'mainnav':
                    $output = $this->mainnav_hwidget_generator($hposition, $vposition, $hlposition, $hrposition, true, '');
                    break;
                case 'contactinfo':
                    $output = $this->contactinfo_hwidget_generator($hposition, $vposition, $hlposition, $hrposition);
                    break;
                default :
                    break;
            }
        }
        print_r($output);
    }
    function slider_generator($post_id, $slider){
        $output = '<div id="content_slider">';
        
        switch($slider['type']){
            case 'simple_slider':
                $output .= $this->simple_slider($post_id, $slider['category'], $slider['layout']);
                break;
            case 'iview_slider':
                $output .= $this->iview_slider($post_id, $slider['category'], $slider['layout']);
                break;
            case 'flex_slider':
                $output .= $this->flex_slider($post_id, $slider['category'], $slider['layout']);
                break;
            case 'anything_slider':
                $output .= $this->anything_slider($post_id, $slider['category'], $slider['layout']);
                break;
            case 'accordion_slider':
                $output .= $this->accordion_slider($post_id, $slider['category'], $slider['layout']);
                break;
            case 'carousel_slider':
                $output .= $this->carousel_slider($post_id, $slider['category'], $slider['layout']);
                break;
            case 'piecemaker_slider':
                $output .= $this->piecemaker_slider($post_id, $slider['category'], $slider['layout']);
                break;
        }
        $output .= '</div>' . "\n";
       // global $slider_type_default;
        //$slider_type = get_post_meta($post_id, THEME_SHORTNAME.'_slider_type', true);

       // if($slider_type !== 'none' && array_key_exists($slider_type, $slider_type_default)){
            
        //}
        print_r($output);
    }
    
    /* Header Widgets Functions */
    
    function quicknav_hwidget_generator($hposition, $hlposition, $hrposition, $vposition){
        $output = '<div class="navbar quicknav hwidget '.$hposition.' " style="margin:'.$vposition.'px '.$hrposition.'px 0 '.$hlposition.'px;">';
        $output .= '<div class="navbar-inner ">';
        $output .= wp_nav_menu(array(
                    'theme_location'    => 'quicknav-menu',
                    'container'         => FALSE,
                    'menu_id'           => 'quicknav_menu',
                    'menu_class'        => 'menu nav quicknav',
                    'fallback_cb'       => FALSE,
                    'echo'              => FALSE,
                    'walker'            => new QuickNavWalker()
                    )
                );
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
    
    function logo_hwidget_generator($hposition, $vposition, $hlposition, $hrposition, $use_img, $img_url, $img_resize, $img_height){
        $output = '<div class="hwidget '.$hposition.'" style="margin:'.$vposition.'px '.$hrposition.'px 0 '.$hlposition.'px;">'; 
            $output .= '<div class="logo">'."\n";
                $output .= '<a href="'.home_url().'">' . "\n";
                    if($use_img == true){
                        $logo_height = '';
                        if($img_resize == true && $img_height > 0){
                            $logo_height = 'height="'.$img_height.'"';
                        }

                        $output .= '<img src="'.$img_url.'" '.$logo_height.'/>' . "\n";   
                    }
                    else{
                        $output .= '<span class="toCufon">' . get_bloginfo("name") . '</span>' . "\n";
                    }
                $output .= '</a>' . "\n";
            $output .= '</div>' . "\n";
        $output .= '</div>';
        return $output;
    }
    
    function social_hwidget_generator($hposition, $vposition, $hlposition, $hrposition, $social_links){
        $output = '<div class="hwidget '.$hposition.'" style="margin:'.$vposition.'px '.$hrposition.'px 0 '.$hlposition.'px;">';    
            $output .= '<div class="social_links">' . "\n";
                $output .= '<ul>' . "\n";
                foreach ($social_links as $social){
                    $social_name = substr($social, 16);
                    $social_link = get_theme_option('components', $social);
                    if(strlen($social_link) > 0){
                        $output .= '<li><a href="'.$social_link.'" rel="tooltip" class="icon24 rounded icons-'.$social_name.'" title="'.$social_name.'" target="_blank"></a></li>' . "\n";
                    }
                }
                $output .= '<li><a href="'.get_bloginfo('rss2_url').'" rel="tooltip" class="icon24 rounded icons-feed-2" title="RSS Feed" ></a></li>' . "\n";
                $output .= '<li><a href="mailto:'.get_bloginfo('admin_email').'" rel="tooltip" class="icon24 rounded icons-envelope" title="Email us" ></a></li>' . "\n";

                $output .= '</ul>' . "\n";
            $output .= '</div>' . "\n";
        $output .= '</div>' . "\n";
            
        return $output;        
    }
    
    function mainnav_hwidget_generator($hposition, $vposition, $hlposition, $hrposition, $show_description, $excluded_pages){
        $output = '<div class="hwidget '.$hposition.'" style="margin:'.$vposition.'px '.$hrposition.'px 0 '.$hlposition.'px;">'; 
        if (has_nav_menu('mainnav-menu') ) {
            $output .= wp_nav_menu(array(
                        'theme_location' => 'mainnav-menu',
                        'container' => FALSE,
                        'menu_id' => 'mainnav_menu',
                        'fallback_cb' => FALSE,
                        'echo' => FALSE,
                        'walker' => new NavMenuWalker($show_description)
                        )
                    );
        }else{
            $output .= '<ul id="mainnav_menu" class="menu">';
            $output .= wp_list_pages(array(
                            'depth' => 2,
                            'exclude' => $excluded_pages,
                            'title_li' => '',
                            'sort_column' => 'post_title',
                            'sort_order' => 'ASC',
                            'echo' => FALSE,
                            'walker' => new NavPageWalker()
                        ));
            $output .= "</ul>";
        } 
        $output .= '</div>';
        return $output;
    }
    
    function search_hwidget_generator($hposition, $vposition, $hlposition, $hrposition){
        $output = '<div class="hwidget '.$hposition.'" style="margin:'.$vposition.'px '.$hrposition.'px 0 '.$hlposition.'px;">'; 
            $output .= '<form method="get" id="searchform" action="'.esc_url(home_url( '/' )).'">';
            $output .= '
                                    <input type="text" class="field" name="s" id="s" placeholder="'.__( 'SEARCH...', 'inpress' ).'" />
                                
                                    <input type="submit" class="submit" name="submit" id="searchsubmit" value="&#xe014;" />
                               ';
                
            $output .= '</form>';
        $output .= '</div>';
        return $output;
    }

    function contactinfo_hwidget_generator($hposition, $vposition, $hlposition, $hrposition){
        $output = '<div class="hwidget '.$hposition.'" style="margin:'.$vposition.'px '.$hrposition.'px 0 '.$hlposition.'px;">'; 
            $output .= '<div class="contacts-info">';
                $output .= 'Call us 12-5265-487';
                $output .= ' | ';
                $output .= 'admin@mail.com';
                $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
    
    /* End Header Widgets Functions */
    
    function after_header_generator($template, $layout, $title, $fullmap, $have_slider, $slider_options, $c_title, $c_adress){
        require_once THEME_PLUGINS.'/breadcrumbs-plus/breadcrumbs-plus.php';

        if($template == 'page-contacts' && $fullmap){
            $output = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.1&sensor=true"></script>'; 
            $output .= '
                <script type="text/javascript">
                    var map;
                    var geocoder;
                    initializeMap();
            
                    function initializeMap() {
                        geocoder = new google.maps.Geocoder();
                        geocoder.geocode({
                            "address": "'.$c_adress.'",
                            "partialmatch": true}, geocodeResult);   
                    }
                    function geocodeResult(results, status) {
                        if (status == "OK" && results.length > 0) {         
                            var latlng = new google.maps.LatLng(results[0].geometry.location.b,results[0].geometry.location.c);
                            var myOptions = {
                                zoom: 15,
                                center: results[0].geometry.location,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            }; 
                            map = new google.maps.Map(document.getElementById("contact_fgmap"), myOptions);

                            var marker = new google.maps.Marker({
                                position: results[0].geometry.location,
                                map: map,
                                title: "'.$c_title.'"
                            });
                        } 
                    }
                </script>';
            $output .= '<div class="after_header_div">' . "\n";
                $output .= '<div id="contact_fgmap"></div>' . "\n";
            $output .= '</div>' . "\n";
            //$output .= '<div class="header_shadow_bottom '.$layout.'"></div>' . "\n";
        }
        else if($have_slider){
            $output = '';
        }
        else{  
            $output = '<div class="after_header_div">' . "\n";
                $output .= '<div class="after_header_wrap">' . "\n";
                    $output .= '<h1 class="page_title">'.$title.'</h1>';
                    $output .= $this->breadcrumbs(get_the_ID()); 
                $output .= '</div>' . "\n"; 
            $output .= '</div>' . "\n";
            //$output .= '<div class="header_shadow_bottom '.$layout.'"></div>' . "\n";
        }
        return $output;
    }
    
    function breadcrumbs($post_id = NULL) {
         $output = breadcrumbs_plus(array(
                        'prefix' => '<div id="breadcrumbs">',
                        'suffix' => '</div>',
                        'title' => false,
                        'home' => __( 'Home', 'inpress_front' ),
                        'sep' => '&raquo;',
                        'front_page' => false,
                        'bold' => true,
                        'blog' => __( 'Blog', 'inpress_front' ),
                        'echo' => false
                    ));
        return $output;
    }
    /* Sliders Rendering Internal Functions */
    
    function simple_slider($post_id, $category, $layout){
        
    }
    
    function iview_slider($post_id, $category, $layout){
        
    }

    function piecemaker_slider($post_id, $category, $layout){
        wp_enqueue_style('piecemaker-css', THEME_SLIDERS_CSS . '/piecemaker/piecemaker.css', array(), '', 'screen');
        
        wp_enqueue_script('jquery-flash', THEME_SLIDERS_JS."/piecemaker/jquery.flash.min.js", array('jquery'), '2.1', false);
        wp_enqueue_script('piecemaker-script', THEME_SLIDERS_JS."/piecemaker/piecemaker.js", array('jquery'), '2.0', false);
        
        return '<div id="piecemaker"></div>';
    }
}

function theme_generator($function){
    global $theme_generator;
    $theme_generator = new ThemeGenerator();
    $args = array_slice(func_get_args(), 1);
    return call_user_func_array(array( &$theme_generator, $function ), $args);
}
?>

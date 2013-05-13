<?php
class SidebarGenerator {
        var $header_sidebar_names = array();
	var $sidebar_names = array();
	var $footer_sidebar_count = 0;
	var $footer_sidebar_names = array();
	
	function SidebarGenerator(){
                $this->header_sidebar_names = array(
                    __('Header Top Area','inpress_admin'),
                    __('Header Middle Area','inpress_admin'),
                    __('Header Bottom Area','inpress_admin'),
                );
		$this->sidebar_names = array(
                    'home'=>__('Homepage Sidebar','inpress_admin'),
                    'page'=>__('Page Sidebar','inpress_admin'),
                    'blog'=>__('Blog Sidebar','inpress_admin'),
                    'portfolio' =>__('Portfolio Sidebar','inpress_admin'),
		);
		$this->footer_sidebar_names = array(
                    __('Footer First Area','inpress_admin'),
                    __('Footer Second Area','inpress_admin'),
                    __('Footer Third Area','inpress_admin'),
                    __('Footer Fourth Area','inpress_admin'),
		);

	}
        
        
	function register_sidebar(){
            
            foreach ($this->sidebar_names as $name){
                register_sidebar(array(
                    'name' => $name,
                    'description' => $name,
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="widgettitle">',
                    'after_title' => '</h3>',
                ));
            }
            //register header sidebars
            foreach ($this->header_sidebar_names as $name){
                register_sidebar(array(
                    'name' => $name,
                    'description' => $name,
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="widgettitle">',
                    'after_title' => '</h3>',
                ));
            }
            //register footer sidebars
            foreach ($this->footer_sidebar_names as $name){
                register_sidebar(array(
                    'name' =>  $name,
                    'description' => $name,
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<h3 class="widgettitle">',
                    'after_title' => '</h3>',
                ));
            }
            //register custom sidebars
            $custom_sidebars = get_theme_option('sidebars',THEME_SHORTNAME."-sidebars");
            if(!empty($custom_sidebars)){
                $custom_sidebar_names = explode(',',$custom_sidebars);
                foreach ($custom_sidebar_names as $name){
                    register_sidebar(array(
                        'name' =>  $name,
                        'description' => $name,
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget' => '</section>',
                        'before_title' => '<h3 class="widgettitle">',
                        'after_title' => '</h3>',
                    ));
                }
            }
	}
	
	function get_sidebar($post_id){
		if(is_page()){
			$sidebar = $this->sidebar_names['page'];
		}
		if(is_front_page() || $post_id == theme_get_option('homepage','home_page') ){
			$home_page_id = theme_get_option('homepage','home_page');
			$post_id = wpml_get_object_id($home_page_id,'page');
			$sidebar = $this->sidebar_names['home'];
		}
		if(is_blog()){
			$sidebar = $this->sidebar_names['blog'];
		}
		if(is_singular('post')){
			$sidebar = $this->sidebar_names['blog'];
		}elseif(is_singular('portfolio')){
			$sidebar = $this->sidebar_names['portfolio'];
		}
		if(is_search() || is_archive()){
			$sidebar = $this->sidebar_names['blog'];
		}
		
		if(!empty($post_id)){
			$custom = get_post_meta($post_id, '_sidebar', true);
			if(!empty($custom)){
				$sidebar = $custom;
			}
		}
		if(isset($sidebar)){
			dynamic_sidebar($sidebar);
		}
	}
	
	function get_footer_sidebar(){
            dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
            $this->footer_sidebar_count++;
	}
}

global $_sidebarGenerator;
$_sidebarGenerator = new SidebarGenerator;

add_action('widgets_init', array($_sidebarGenerator, 'register_sidebar'));

function sidebar_generator($function){
    global $_sidebarGenerator;
    $args = array_slice( func_get_args(), 1 );
    return call_user_func_array(array( &$_sidebarGenerator, $function ), $args );
}
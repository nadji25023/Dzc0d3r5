<?php
// Avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

class QuickNavWalker extends Walker_Nav_Menu{
    function QuickNavWalker(){}
    
    function start_el( &$output, $item, $depth, $args) {
        $li = '';
        $output .= apply_filters( 'walker_nav_menu_start_el', $li, $item, $depth, $args );
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        $value = '';
        $class_names = 'menu-item menu-item-type-custom';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a '. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class NavMenuWalker extends Walker_Nav_Menu {
 
    var $descriptionView;
    
    function NavMenuWalker($descriptionView) {

        $this->descriptionView = $descriptionView;
    }
    
    // add classes to ul sub-menus
    function start_lvl( &$output, $depth ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
            );
        $class_names = implode( ' ', $classes );
        $holder_class = 'other_level';
        if($depth == 0){
            $holder_class = 'first_level';
        }
        // build html
        
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
        $output .= '<div class="menu_drop_wrap '.$holder_class.'">' . "\n";
    }
    
    function end_lvl(&$output, $depth) {
        $output .= '</div>' . "\n";
        $output .= '</ul>' . "\n";
    }
    // add main/sub classes to li's and links
     function start_el( &$output, $item, $depth, $args ) {
        
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // depth dependent classes
        $li_depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $li_depth_class_names = esc_attr( implode( ' ', $li_depth_classes ) );
        
        // passed classes
        $li_classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $li_classes_array = apply_filters( 'nav_menu_css_class', array_filter( $li_classes ), $item );
        $li_class_names = esc_attr( implode( ' ',  $li_classes_array) );
       
        // link classes
        $link_classes = array('');
        if(in_array('current-menu-item', $li_classes_array) && in_array('current-menu-ancestor', $li_classes)) {
            $link_classes = array('current-menu-link', 'current-menu-ancestor');
        }
        elseif(in_array('current-menu-item', $li_classes_array)) {
            $link_classes = array('current-menu-link');
        }
        elseif(in_array('current-menu-ancestor', $li_classes_array)) {
            $link_classes = array('current-link-ancestor');
        }
        $link_class_names = implode(' ', $link_classes);
        
        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $li_depth_class_names . ' ' . $li_class_names . '">';
 
        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url) .'"' : '';
        $attributes .= ' class="'.$link_class_names.' menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link') . '"';
        
        $icon = '<span style="font-size:16px; padding-right:0.5em;" aria-hidden="true" class="icons-home icon24"></span>';
        
        
        //Print or not description under links
            $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                $args->before,
                $attributes,
                $args->link_before,
                $icon.apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
            );

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        $id_field = $this->db_fields['id'];

       //If the current element has children, add class 'sub-menu'
       if( isset($children_elements[$element->$id_field]) ) { 
            $classes = empty( $element->classes ) ? array() : (array) $element->classes;
            $classes[] = 'has-sub-menu';
            $element->classes =$classes;
       }
        // We don't want to do anything at the 'top level'.
        if( 0 == $depth )
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

        //Get the siblings of the current element
        $parent_id_field = $this->db_fields['parent'];      
        $parent_id = $element->$parent_id_field;
        $siblings = $children_elements[ $parent_id ] ;

        //No Siblings?? 
        if( ! is_array($siblings) )
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

        //Get the 'last' of the siblings.
        $last_child = array_shift($siblings);
        $id_field = $this->db_fields['id'];

            //If current element is the last of the siblings, add class 'last'
        if( $element->$id_field != $last_child->$id_field ){
            $classes = empty( $element->classes ) ? array() : (array) $element->classes;
            $classes[] = 'not-first';
            $element->classes =$classes;
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

class NavPageWalker extends Walker_Page{
    // add classes to ul sub-menus
    function start_lvl( &$output, $depth ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
            );
        $class_names = implode( ' ', $classes );
        $holder_class = 'other_level';
        if($depth == 0){
            $holder_class = 'first_level';
        }
        // build html
        
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
        $output .= '<div class="menu_drop_wrap '.$holder_class.'">' . "\n";
        $output .= '<div class="menu_drop_container '.$holder_class.'">' . "\n";
    }
    
    function end_lvl(&$output, $depth) {
        $output .= '</div></div>' . "\n";
        $output .= '</ul>' . "\n";
    }
    
    function start_el(&$output, $page, $depth, $args, $current_page) {
        
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        $css_class = '';
        // cuurent page class
        if ( !empty($current_page) && $page->ID == $current_page) {
            $css_class = 'current-menu-item';
        }

        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // build html
        $output .= $indent . '<li id="page-item-'. $page->ID . '" class="' . $depth_class_names . ' '. $css_class .'">';
 
        // link attributes
        $attributes = ! empty($page->ID) ? ' href="'. get_permalink($page->ID) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
        
        $prepend = $depth == 0  ? '<p class="link-title-first-level"><strong>': '<p class="link-title">';
        $append = $depth == 0  ? '</strong></p>': '</p>';
        
        //Print or not description under links
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            $prepend.apply_filters('the_title', $page->post_name, $page->ID).$append,
            $args->link_after,
            $args->after
        );

        // build html
        $output .= apply_filters( 'walker_page_start_el', $item_output, $item, $depth, $args );
    }
    
    
}

class QuickMenuWalker extends Walker_Nav_Menu{
    
}
?>

<?php

require_once (THEME_HELPERS . '/HtmlGenerator.php'); 

class AdminGenerator extends HtmlGenerator{
    var $name, $options, $saved_options, $alert = '';

    function AdminGenerator($name, $options) {
        $this->name = $name;
        $this->options = $options;
        if ($name === 'help') {
            echo $options;
        } else {
            $this->save_options();
            $this->render();
        }
    }

    function save_options() {
        $options = get_option(THEME_SHORTNAME . '_' . $this->name);

        if (isset($_POST['save_plugin_options'])) {
            foreach ($this->options as $value) {
                if (isset($value['id']) && !empty($value['id'])) {
                    if (isset($_POST[$value['id']])) {
                        if ($value['type'] == 'toggle') {
                            if ($_POST[$value['id']]) {
                                $options[$value['id']] = 'true';
                            } else {
                                $options[$value['id']] = 'false';
                            }
                        } else {
                            $options[$value['id']] = $_POST[$value['id']];
                        }
                    } else {
                        $options[$value['id']] = false;
                    }
                }
            }
            
            if (isset($value['process']) && function_exists($value['process'])) {
					$options[$value['id']] = $value['process']($value,$options[$value['id']]);
				}          
                                
            if ($options != $this->options) {
                if (update_option(THEME_SHORTNAME . '_' . $this->name, $options)) {
                    $this->alert = '<strong>' . __('Settings Updated Successfully', 'inpress_admin') . '</strong>';
                }
            }
        }
        $this->saved_options = $options;
    }

    function render() {
        
        echo '<div  class="container-fluid theme-options-page">';
        echo '<form class="form-horizontal" method="post" action="' . $_SERVER['REQUEST_URI'] . '">';
        echo '<div class="row-fluid">';

        foreach ($this->options as $option) {
            if ($option['type'] === 'title') {
                echo $this->title($option);
            }
        }

        echo '<div  class="options_wrap span9">';
        echo '<ul class="options_inner" data-spy="scroll" data-target=".bs-docs-sidenav" >';
        foreach ($this->options as $option) {
            if (method_exists($this, $option['type']) && $option['type'] !== 'title') {
                echo $this->$option['type']($option);
            }
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    }

    function title($value) {
        $alert_class = '';

        if ($this->alert != '') {
            $alert_class = "updated";
        }
        $rendering = '<div class="span3 bs-docs-sidebar">';
        $rendering .= '<ul class="nav nav-list bs-docs-sidenav affix">';
        $rendering .= '<div class="title">';
        $rendering .= '<a target="_blank" href="' . THEME_URL . '">
            <h1 title="' . THEME_NAME . '"  class="mylogo">
            <img alt="' . THEME_NAME . ' logo " src="' . THEME_IMAGES_URI . '/logo_admin.png" />
            </h1>
            </a>
            ';
        $rendering .= '<h4><span class="icon18  icons-settings"></span>' . $value['name'] . '</h4>';
        $rendering .= '</div>';
        $rendering .= '<div class="opt_alert ' . $alert_class . '">' . $this->alert . '</div>';
        if (isset($value['sub-menu'])) {
            $sub_menu = explode(',', $value['sub-menu']);
            foreach ($sub_menu as $sub_menu_link) {
                $rendering .= '<li class="sidenav-item"><a href="#' . sanitize_title($sub_menu_link) . '"><span class="icon1 icons-checkmark"></span>' . $sub_menu_link . '</a></li>';
            }
        }

        $rendering .='
         <li class="submit_btns">
            <ul>
            <li>
            <input id="submit" type="submit" name="save_plugin_options" value="&#xe00f; ' . __('Save All Changes', 'inpress_admin') . '" class="btn btn-primary"/>
            </li>
            <li>
            <input type="button" id="reset" name="reset" class="btn btn-danger" value="&#xe04c; ' . __('Reset To Default', 'inpress_admin') . '" />
            </li>
            </ul>

        </li>
            ';

        $rendering .= '</ul>';
        $rendering .= '</div>';

        return $rendering;
    }

    // bootstraped version

    function start($value) {
        $rendering = '<li  id="' . sanitize_title($value['name']) . '">';

        $rendering .= '<div class="op_heading"><h3>' . $value['name'] . '</h3></div>';
        if (isset($value['desc'])) {
            $rendering .= '<div class="description">' . $value['desc'] . '</div>';
        }
        $rendering .= '<div class="op_body">';


        return $rendering;
    }

    function end() {
        $rendering = '
            </div>';
        $rendering .='</li>';
        return $rendering;
    }    
}
?>

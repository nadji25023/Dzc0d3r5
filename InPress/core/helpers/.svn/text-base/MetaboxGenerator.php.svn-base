<?php
/**
 * The `metaboxesGenerator` class help generate the html code for meta boxes.
 */

require_once (THEME_HELPERS . '/HtmlGenerator.php'); 

class MetaboxGenerator extends HtmlGenerator{

    var $config;
    var $options;
    var $saved_options;

    /**
     * Constructor
     * 
     * @param string $name
     * @param array $options
     */
    function MetaboxGenerator($config, $options) {
        $this->config = $config;
        $this->options = $options;

        add_action('admin_menu', array(&$this, 'create'));
        add_action('save_post', array(&$this, 'save'));
    }
	
    function create() {
        if (function_exists('add_meta_box')) {
            if (! empty($this->config['callback']) && function_exists($this->config['callback'])) {
                $callback = $this->config['callback'];
            } else {
                $callback = array(&$this, 'render');
            }
            foreach($this->config['pages'] as $page) {
                add_meta_box($this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority']);
            }
        }
    }
	
    function save($post_id) {
        if (! isset($_POST[$this->config['id'] . '_noncename'])) {
            return $post_id;
        }

        if (! wp_verify_nonce($_POST[$this->config['id'] . '_noncename'], plugin_basename(__FILE__))) {
            return $post_id;
        }

        if ('page' == $_POST['post_type']) {
            if (! current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (! current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        foreach($this->options as $option) {
            if (isset($option['id']) && !empty($option['id'])) {

                if (isset($_POST[$option['id']])) {
                        switch ($option['type']) {
                            case 'multidropdown':
                                $value = array_unique(explode(',', $_POST[$option['id']]));
                                break;
                            case 'tritoggle':
                                switch($_POST[$option['id']]){
                                    case 'true':
                                        $value = 'true';
                                        break;
                                    case 'false':
                                        $value = 'false';
                                        break;
                                    case 'default':
                                        $value = '';
                                }
                                break;
                            case 'toggle':
                                $value = 'true';
                                break;
                            default:
                                $value = $_POST[$option['id']];
                        }

                } else if ($option['type'] == 'toggle') {
                    $value = 'false';
                } else {
                    $value = false;
                }

                if (get_post_meta($post_id, $option['id']) == "") {
                    add_post_meta($post_id, $option['id'], $value, true);
                } elseif ($value != get_post_meta($post_id, $option['id'], true)) {
                    update_post_meta($post_id, $option['id'], $value);
                } elseif ($value == "") {
                    delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
                }
            }
        }
    }
	
    function render() {
        global $post;
        if($this->config['context'] == 'side'){
            foreach($this->options as $option) {
                if (method_exists($this, $option['type'])) {
                    if (isset($option['id'])) {
                        $default = get_post_meta($post->ID, $option['id'], true);
                        if ($default != "") {
                            $option['default'] = $default;
                        }
                    }
                    echo $this->$option['type']($option);
                }
            }
            echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
        }
        else{
            echo '<div class="container-fluid">';
            echo '<div class="op_body">';
            foreach($this->options as $option) {
                if (method_exists($this, $option['type'])) {
                    if (isset($option['id'])) {
                        $default = get_post_meta($post->ID, $option['id'], true);
                        if ($default != "") {
                            $option['default'] = $default;
                        }
                    }
                    echo $this->$option['type']($option);
                }
            }
           echo '</div>';
           echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
           echo '</div>';
        }
    } 
}

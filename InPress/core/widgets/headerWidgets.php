<?php
/**
 * Header Widgets Class
 */
class Theme_Header_Widgets extends WP_Widget {

    function Theme_Header_Widgets() {
            $widget_ops = array('classname' => 'widgets_header', 'description' => __( 'Add a header widget (Works Only in Header Areas)', 'inpress_admin') );
            $this->WP_Widget('widheader', '[ '.THEME_NAME.' ] '.__('Header Widget', 'inpress_admin'), $widget_ops);
    }

    function widget( $args, $instance ) {
        $hposition = isset($instance['hposition']) ? $instance['hposition'] : 'pull-left';
        $hlposition = isset($instance['hlposition']) ? $instance['hlposition'] : 0;
        $hrposition = isset($instance['hrposition']) ? $instance['hrposition'] : 0;
        $vposition = isset($instance['vposition']) ? $instance['vposition'] : 0;
        
        if(isset($instance['component']) && isset($instance['vposition'])){
            echo theme_generator('header_widgets_helper',
                    $instance['component'], 
                    $hposition,
                    $hlposition,
                    $hrposition,
                    $vposition
                    );
        }
    }

    function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            if (isset( $new_instance['component']) ) {
                    $instance['component'] = $new_instance['component'];
            } else {
                    $instance['component'] = 'logo';
            }
            if (isset( $new_instance['hposition']) ) {
                    $instance['hposition'] = $new_instance['hposition'];
            } else {
                    $instance['hposition'] = 'pull-left';
            }
            if (isset( $new_instance['hlposition']) ) {
                    $instance['hlposition'] = $new_instance['hlposition'];
            } else {
                    $instance['hlposition'] = 0;
            }
            if (isset( $new_instance['hrposition']) ) {
                    $instance['hrposition'] = $new_instance['hrposition'];
            } else {
                    $instance['hrposition'] = 0;
            }
            if (isset( $new_instance['vposition']) ) {
                    $instance['vposition'] = $new_instance['vposition'];
            } else {
                    $instance['vposition'] = 0;
            }
            return $instance;
    }

    function form( $instance ) {
            //Defaults
            $instance = wp_parse_args( (array) $instance, array( 'component' => 'logo', 'hposition' => 'left', 'vposition' => 0, 'hlposition' => 0, 'hrposition' => 0) );
    ?>
            <p>
                <label for="<?php echo $this->get_field_id('component'); ?>"><?php _e( 'Select Component', 'inpress_admin'); ?></label>
                <select name="<?php echo $this->get_field_name('component'); ?>" id="<?php echo $this->get_field_id('component'); ?>" class="widefat">
                    <option value="logo"<?php selected( $instance['component'], 'logo' ); ?>><?php _e( 'Logo', 'inpress_admin' ); ?></option>
                    <option value="contactinfo"<?php selected( $instance['component'], 'contactinfo' ); ?>><?php _e('Contacts Informations', 'inpress_admin'); ?></option>
                    <option value="mainnav"<?php selected( $instance['component'], 'mainnav' ); ?>><?php _e('Main Navigation', 'inpress_admin'); ?></option>
                    <option value="quicknav"<?php selected( $instance['component'], 'quicknav' ); ?>><?php _e( 'Quick Navigation', 'inpress_admin' ); ?></option>
                    <option value="search"<?php selected( $instance['component'], 'search' ); ?>><?php _e('Search Form', 'inpress_admin'); ?></option>
                    <option value="social"<?php selected( $instance['component'], 'social' ); ?>><?php _e('Social Icons', 'inpress_admin'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('hposition'); ?>"><?php _e( 'Horizontal Alignement', 'inpress_admin'); ?></label>
                <select name="<?php echo $this->get_field_name('hposition'); ?>" id="<?php echo $this->get_field_id('hposition'); ?>" class="widefat">
                    <option value="pull-left"<?php selected( $instance['hposition'], 'pull-left' ); ?>><?php _e('Left', 'inpress_admin'); ?></option>
                    <option value="center"<?php selected( $instance['hposition'], 'center' ); ?>><?php _e('Center', 'inpress_admin'); ?></option>
                    <option value="pull-right"<?php selected( $instance['hposition'], 'pull-right' ); ?>><?php _e( 'Right', 'inpress_admin' ); ?></option>

                </select>
            </p>  
            <p>
                <label><?php _e( 'Set Distances In Pixels <br><i>(0 means defaults)</i>', 'inpress_admin'); ?></label>
                
                <table cellspacing="0" cellpadding="0" valign="middle" align="center">
                    <tr valign="middle">
                        <td colspan="2"></td>
                        <td>
                            <div class="hw-preview hw-top-component">
                                
                            </div>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    <tr valign="middle">
                        <td colspan="2"></td>
                        <td align="center">
                            <div class="hw-preview hw-input-holder" style="height:36px;">
                                <table align="center">
                                    <tr>
                                        <td>
                                            <input id="<?php echo $this->get_field_id('vposition'); ?>" name="<?php echo $this->get_field_name('vposition'); ?>" type="text" class="numeric_input" value="<?php echo $instance['vposition'] ?>" size="3" maxlenght="3">
                                        </td>
                                        <td>
                                            <div class="margin-arrows-v"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="hw-preview hw-left-component">

                            </div>
                        </td>
                        <td>
                            <div class="hw-preview hw-input-holder">
                                <input id="<?php echo $this->get_field_id('hlposition'); ?>" name="<?php echo $this->get_field_name('hlposition'); ?>" type="text" class="numeric_input" value="<?php echo $instance['hlposition'] ?>" size="3" maxlenght="3">
                                <div class="margin-arrows"></div>
                            </div>
                        </td>
                        <td>
                            <div class="hw-preview hw-component-holder">

                            </div>
                        </td>
                        <td>
                            <div class="hw-preview hw-input-holder">
                                <input id="<?php echo $this->get_field_id('hrposition'); ?>" name="<?php echo $this->get_field_name('hrposition'); ?>" type="text" class="numeric_input" value="<?php echo $instance['hrposition'] ?>" size="3" maxlenght="3">
                                <div class="margin-arrows"></div>
                            </div>
                        </td>
                        <td>
                            <div class="hw-preview hw-right-component">

                            </div>
                        </td>
                    </tr>
                </table>
            </p>
            <?php /*
                          
            
            <p class="input-append">
                <label for="<?php echo $this->get_field_id('hlposition'); ?>"><?php _e( 'Margin Left', 'inpress_admin'); ?>&nbsp;</label>
                <input id="<?php echo $this->get_field_id('hlposition'); ?>" name="<?php echo $this->get_field_name('hlposition'); ?>" type="text" class="numeric_input" value="<?php echo $instance['hlposition'] ?>" size="3" maxlenght="3">
                <span class="add-on">px</span>
            </p>
            
            <p class="input-append">
                <label for="<?php echo $this->get_field_id('hrposition'); ?>"><?php _e( 'Margin Right', 'inpress_admin'); ?>&nbsp;</label>
                <input id="<?php echo $this->get_field_id('hrposition'); ?>" name="<?php echo $this->get_field_name('hrposition'); ?>" type="text" class="numeric_input" value="<?php echo $instance['hrposition'] ?>" size="3" maxlenght="3">
                <span class="add-on">px</span>
            </p>
            
            <p class="input-append">
                <label for="<?php echo $this->get_field_id('vposition'); ?>"><?php _e( 'Margin top', 'inpress_admin'); ?>&nbsp;</label>
                <input id="<?php echo $this->get_field_id('vposition'); ?>" name="<?php echo $this->get_field_name('vposition'); ?>" type="text" class="numeric_input" value="<?php echo $instance['vposition'] ?>" size="3" maxlenght="3">
                <span class="add-on">px</span>
            </p>
        <?php
             */
             
    }
}
<?php

namespace ZPdevWPCG;

use Sabberworm\CSS\Settings;

if ( ! class_exists('Options')) {
    class Options
    {

        // private $options;

        use Instance;

        public function __construct()
        {
            add_action('admin_menu', array($this, 'add_plugin_admin_panel_pages'));
            add_action('admin_init', array($this, 'page_init'));

            add_action('admin_enqueue_scripts', array($this, 'load_scripts_admin'));
        }

        public function add_plugin_admin_panel_pages()
        {
            $this->add_plugin_admin_panel_page();
            $this->add_plugin_admin_panel_subpage_students();
            $this->add_plugin_admin_panel_subpage_settings();
        }

        public function add_plugin_admin_panel_page()
        {
            $page_title = 'zapaDEV WP Certificate Generator';
            $menu_title = 'ZPdev WPCG';
            $capability = 'manage_options';
            $slug       = 'zpdevwpcg';
            $callback   = array($this, 'create_plugin_admin_panel_page');
            $icon       = 'dashicons-admin-plugins';
            $position   = 100;

            add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
        }

        public function create_plugin_admin_panel_page()
        {
            $this->options = get_option(PREFIX . 'option');
            include_once(DIR_PATH . 'templates/template-admin-options.php');
        }

        public function add_plugin_admin_panel_subpage_students()
        {
            $parent_page = 'zpdevwpcg';
            $page_title  = 'Students';
            $menu_title  = 'Students';
            $capability  = 'manage_options';
            $slug        = PREFIX . 'students';
            $callback    = array($this, 'create_plugin_admin_panel_students_subpage');

            add_submenu_page($parent_page, $page_title, $menu_title, $capability, $slug, $callback);
        }

        public function create_plugin_admin_panel_students_subpage()
        {
            $this->options = get_option(PREFIX . 'option');
            include_once(DIR_PATH . 'templates/template-admin-options-students.php');
        }

        public function add_plugin_admin_panel_subpage_settings()
        {
            $parent_page = 'zpdevwpcg';
            $page_title  = 'Settings';
            $menu_title  = 'Settings';
            $capability  = 'manage_options';
            $slug        = PREFIX . 'settings';
            $callback    = array($this, 'create_plugin_admin_panel_settings_subpage');

            add_submenu_page($parent_page, $page_title, $menu_title, $capability, $slug, $callback);
        }

        public function create_plugin_admin_panel_settings_subpage()
        {
            $this->options = get_option(PREFIX . 'option');
            include_once(DIR_PATH . 'templates/template-admin-options-settings.php');
        }

        public function load_scripts_admin()
        {
            if ( ! did_action('wp_enqueue_media')) {
                wp_enqueue_media();
            }
            wp_enqueue_script('zpdev-wpcg-admin', ZPdevWPCG()->plugin_url() . '/assets/js/zpdev-wpcg-admin.js', ['jquery'], '1.0', true);
            wp_localize_script('zpdev-wpcg-admin', 'flow', [
                'url'     => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce(PREFIX . '_nonce'),
                'options' => json_encode(get_option(PREFIX.'option')),
            ]);

            wp_enqueue_style('zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/css/zpdev-wpcg-admin.css', false, null, 'all');
        }

        public function page_init()
        {
            register_setting(PREFIX . 'settings_option_group', PREFIX . 'option',
            // TODO Fix sanitize method

            //  array( $this, 'sanitize' )
            );
        }

        // TODO Fix sanitize method
        //            public function sanitize( $input ) {
        //                $new_input = array();
        //                if ( isset( $input['name'] ) ) {
        //                    $new_input['name'] = $input['name'];
        //                }
        ////                if ( isset( $input['text_after'] ) ) {
        ////                    $new_input['text_after'] = $input['text_after'];
        ////                }
        ////                if ( isset( $input['text_before'] ) ) {
        ////                    $new_input['text_before'] = $input['text_before'];
        ////                }
        ////                if ( isset( $input['period'] ) ) {
        ////                    $new_input['period'] = $input['period'];
        ////                }
        ////                if ( isset( $input['levels'] ) ) {
        ////                    $new_input['levels'] = $input['levels'];
        ////                }
        ////                if ( isset( $input['hours'] ) ) {
        ////                    $new_input['hours'] = $input['hours'];
        ////                }
        ////                if ( isset( $input['place'] ) ) {
        ////                    $new_input['place'] = $input['place'];
        ////                }
        ////                if ( isset( $input['date'] ) ) {
        ////                    $new_input['date'] = $input['date'];
        ////                }
        ////                if ( isset( $input['img'] ) ) {
        ////                    $new_input['img'] = sanitize_text_field( $input['img'] );
        ////                }
        ////
        ////                if ( isset( $input['logo'] ) ) {
        ////                    $new_input['logo'] = sanitize_text_field( $input['logo'] );
        ////                }
        ////                if ( isset( $input['signature'] ) ) {
        ////                    $new_input['signature'] = sanitize_text_field( $input['signature'] );
        ////                }
        ////                if ( isset( $input['address'] ) ) {
        ////                    $new_input['address'] = sanitize_text_field( $input['address'] );
        ////                }
        ////                if ( isset( $input['director'] ) ) {
        ////                    $new_input['director'] = $input['director'];
        ////                }
        ////
        //                return $new_input;
        //            }

        public function render_img($id, $demo_link)
        {
            // TODO Check img_callback method

            $img_demo_url = ZPdevWPCG()->plugin_url() . $demo_link;
            $img_url      = $this->options[$id]; ?>

            <div class="zpwpcg-adm-picture__preview-wrapper">
                <img
                    src="<?php echo $img_url['src'] ? $img_url['src'] : $img_demo_url; ?>"
                    class="zpwpcg-adm-picture__preview--<?php echo $id; ?>"
                    width="300"
                    alt=""
                >
            </div>
            <input
                type="button"
                class="zpwpcg-adm-picture__upload-btn zpwpcg-btn"
                data-item="<?php echo $id; ?>"
                value="<?php echo __('Upload image', TR); ?>"
            >
            <input
                type="hidden"
                id="zpwpcg-adm-picture-<?php echo $id; ?>"
                name="zpdevwpcg_option[<?php echo $id; ?>][src]"
                value="<?php echo isset($img_url['src']) ? esc_attr($img_url['src']) : $img_demo_url; ?>"
            >
            <?php
        }

        public function render_textarea($option, $label, $group = false)
        {

            echo '<p>';
            printf('<label for="zpdevwpcg_option%s">%s</label>',
                $group ? '[' . $group . '][' . $option . ']' : '[' . $option . ']',
                $label);
            printf('<textarea cols="40" rows="3" id="zpdevwpcg_%s" name="zpdevwpcg_option%s">%s</textarea>',
                $group,
                $group ? '[' . $group . '][' . $option . ']' : '[' . $option . ']',
                $group ? (isset($this->options[$group][$option]) ? esc_attr($this->options[$group][$option]) : '') :
                    (isset($this->options[$option]) ? esc_attr($this->options[$option]) : '')
            );
            echo '</p>';
        }

        public function render_input(string $option, string $label, $group = false)
        {
            echo '<div class="zpwpcg-adm__field">';
            printf('<label for="zpdevwpcg_option%s">%s</label>',
                $group ? '[' . $group . '][' . $option . ']' : '[' . $option . ']',
                $label);
            printf('<input type="text" id="zpdevwpcg_%s" name="zpdevwpcg_option%s" value="%s"">',
                $group ? $group .'_'. $option : $option,
                $group ? '[' . $group . '][' . $option . ']' : '[' . $option . ']',
                $group ? (isset($this->options[$group][$option]) ? esc_attr($this->options[$group][$option]) : '') :
                    (isset($this->options[$option]) ? esc_attr($this->options[$option]) : '')
            );
            echo '</div>';
        }

        public function render_level()
        {
            printf(
                '<p><label for="zpdevwpcg_level_label">%s</label>',
                __('Form and Certificate label', TR),
            );
            printf(
                '<input type="text" id="zpdevwpcg_level_label" name="zpdevwpcg_option[levels][label]" value="%s" ></p>',
                isset($this->options['levels']['label']) ? esc_attr($this->options['levels']['label']) : __('Level', TR)
            );

            $all_options = get_option('zpdevwpcg_option');
            $options     = $all_options['levels']['list'];
            echo __('List', TR);
            echo '<div class="zpwpcg-adm-repeater__wrap"><ul id="tracks-repeatable" class="zpwpcg-adm-repeater">';
            if ( ! empty($options)):
                $i = 1;
                foreach ($options as $option):
                    //                    if ($this->options['levels']['list']['level-' . $i]['value'] !== null):
                    ?>
                    <li>
                            <span>
                                <input type="text"
                                       name="zpdevwpcg_option[levels][list][level-<?php echo $i; ?>][value]"
                                       placeholder="<?php echo __('Value', TR); ?>"
                                       value="<?php echo isset($this->options['levels']['list']['level-' . $i]['value']) ?
                                           esc_attr($this->options['levels']['list']['level-' . $i]['value']) : ''; ?>">
                                <input type="text"
                                       width="500"
                                       placeholder="<?php echo __('Description', TR); ?>"
                                       name="zpdevwpcg_option[levels][list][level-<?php echo $i; ?>][desc]"
                                       value="<?php echo isset($this->options['levels']['list']['level-' . $i]['desc']) ? esc_attr($this->options['levels']['list']['level-' . $i]['desc']) : ''; ?>">
                            </span>
                        <a class="repeatable-field-remove button" href="#">X</a>
                    </li>
                    <?php
                    $i++;
                    //                    endif;
                endforeach;
            else: ?>
                <li>
                        <span>
                            <input type="text"
                                   name="zpdevwpcg_option[levels][list][level-1][value]"
                                   placeholder="<?php echo __('Value', TR); ?>"
                                   value="<?php echo isset($this->options['levels']['list']['level-1']['value']) ? esc_attr($this->options['levels']['list']['level-1']['value']) : ''; ?>">
                            <input type="text"
                                   name="zpdevwpcg_option[levels][list][level-1][desc]"
                                   placeholder="<?php echo __('Description', TR); ?>"
                                   value="<?php echo isset($this->options['levels']['list']['level-1']['desc']) ? esc_attr($this->options['levels']['list']['level-1']['desc']) : ''; ?>">
                        </span>
                    <a class="repeatable-field-remove button" href="#">X</a>
                </li>
            <?php
            endif; ?>
            </ul>
            <a class="repeatable-field-add button" href="#">+</a></div>
            <?php
        }

        public function field_tuning (
            $field,
            $y_position = 0,
            $x_position = 0,
            $align = '',
            $fontsize = 0,
            $fontweight = ''
        ) {
            echo '<div class="zpwpcg-adm-field__tuning zpwpcg-tuning">';
            echo '<button type="button" class="zpwpcg-tuning__btn--settings">' . __('Settings', TR) . '</button>';
            echo '<div class="zpwpcg-tuning__body">';
            echo '<div class="zpwpcg-control__list">';
            
            
                if ($y_position): ?>
                    <div class="zpwpcg-control__item">
                        <label for="zpdevwpcg_option<?php echo '['.$field.'][y_position]'; ?>">
                            <?php echo __('Y position', TR); ?>
                        </label>

                        <input class="zpwpcg-tuning__field zpwpcg-tuning__field--y"
                               type="range"
                               step="0.1"
                               data-field ="<?php echo $field; ?>"
                               name="zpdevwpcg_option<?php echo '['.$field.'][y_position]'; ?>"
                               value="<?php echo isset($this->options[$field]['y_position']) ? esc_attr($this->options[$field]['y_position']) : 55; ?>">
                        <input
                            type="number"
                        >
                    </div>
                <?php endif;
                
                if ($x_position): ?>
                    <div class="zpwpcg-control__item">
                        <label for="zpdevwpcg_option<?php echo '['.$field.'][x_position]'; ?>">
                            <?php echo __('X position', TR); ?>
                        </label>

                            <input class="zpwpcg-tuning__field zpwpcg-tuning__field--x"
                                   type="range"
                                   step="0.1"
                                   data-field ="<?php echo $field; ?>"
                                   name="zpdevwpcg_option<?php echo '['.$field.'][x_position]'; ?>"
                                   value="<?php echo isset($this->options[$field]['x_position']) ? esc_attr($this->options[$field]['x_position']) : 32; ?>">
                        <input type="number">
                    </div>
                <?php endif;
                
                if ($align): ?>
                    <fieldset class="zpwpcg-control__item" id="group1">
                        <div>
                            <legend><?php echo __('Alignment', TR); ?></legend>
                        </div>
    
                        <div>
                            <input
                                class="zpwpcg-tuning__field--align"
                                data-field="<?php echo $field; ?>"
                                type="radio"
                                id="contactChoice1"
                                name="zpdevwpcg_option<?php echo '['.$field.'][align]'; ?>"
                                <?php echo checked( 'left', $this->options[$field]['align'] ? $this->options[$field]['align'] : $align, true ); ?>
                                value="left">
                            <label for="contactChoice1"><?php echo __('Left', TR) ?></label>

                            <input
                                class="zpwpcg-tuning__field--align"
                                data-field="<?php echo $field; ?>"
                                type="radio"
                                id="contactChoice2"
                                name="zpdevwpcg_option<?php echo '['.$field.'][align]'; ?>"
                                <?php echo checked( 'center', $this->options[$field]['align'] ? $this->options[$field]['align']  : $align, true ); ?>
                                value="center">
                            <label for="contactChoice2"><?php echo __('Center', TR); ?></label>

                            <input
                                class="zpwpcg-tuning__field--align"
                                data-field="<?php echo $field; ?>"
                                type="radio"
                                id="contactChoice3"
                                name="zpdevwpcg_option<?php echo '['.$field.'][align]'; ?>"
                                <?php echo checked( 'right', $this->options[$field]['align'] ? $this->options[$field]['align'] : $align, true ); ?>
                                value="right">
                            <label for="contactChoice3"><?php echo __('Right', TR); ?></label>
                        </div>
                        
                    </fieldset>
                <?php endif;
                
                if ($fontsize):?>
                    <div class="zpwpcg-control__item">
                        <label for="fsize">
                            <?php echo __('Font size', TR); ?>
                        </label>

                        <input class="zpwpcg-tuning__field zpwpcg-tuning__field--y"
                               type="range"
                               step="0.1"
                               data-field ="<?php echo $field; ?>"
                               name="zpdevwpcg_option<?php echo '['.$field.'][font_size]'; ?>"
                               value="<?php echo isset($this->options[$field]['font_size']) ? esc_attr($this->options[$field]['font_size']) : 55; ?>">
                        <input class="zpwpcg-tuning__field zpwpcg-tuning__field--font-size"
                               type="number"
                               name="zpdevwpcg_option<?php echo '['.$field.'][font_size]'; ?>"
                               data-field ="<?php echo $field; ?>"
                               value="<?php echo isset($this->options[$field]['font_size']) ? esc_attr($this->options[$field]['font_size']) : 200; ?>"
                        >

                     </div>
                <?php endif;
                
                if ($fontweight):?>
                    <div class="zpwpcg-control__item">
                        <label for="font_weight">
                            <?php echo __('Font weight', TR); ?>
                        </label>

                            <input class="zpwpcg-tuning__field zpwpcg-tuning__field--font-weight"
                                   data-field ="<?php echo $field; ?>"
                                   type="text"
                                   step="100"
                                   max="900"
                                   name="zpdevwpcg_option<?php echo '['.$field.'][font_weight]'; ?>"
                                   value="<?php echo isset($this->options[$field]['font_weight']) ? esc_attr($this->options[$field]['font_weight']) : 'normal'; ?>"
                            >

                    </div>
                <?php endif;
                
                
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
}

function Options()
{
    return Options::instance();
}

$GLOBALS['ZPdevWPCG_Options'] = Options();
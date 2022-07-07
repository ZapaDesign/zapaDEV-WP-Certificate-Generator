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

            echo '<div>';
            printf('<label for="zpdevwpcg_option%s">%s</label>',
                $group ? '[' . $group . '][' . $option . ']' : '[' . $option . ']',
                $label);
            printf('<textarea cols="40" rows="2" id="zpdevwpcg_%s" name="zpdevwpcg_option%s">%s</textarea>',
                $group,
                $group ? '[' . $group . '][' . $option . ']' : '[' . $option . ']',
                $group ? (isset($this->options[$group][$option]) ? esc_attr($this->options[$group][$option]) : '') :
                    (isset($this->options[$option]) ? esc_attr($this->options[$option]) : '')
            );
            echo '</div>';
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
            echo '<div class="zpwpcg-control">';
            echo '<button type="button" class="zpwpcg-control__toggle"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M495.9 166.6c3.3 8.6.5 18.3-6.3 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4c0 8.6-.6 17.1-1.7 25.4l43.3 39.4c6.8 6.3 9.6 16 6.3 24.6c-4.4 11.9-9.7 23.4-15.7 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.3c-6 7.1-15.7 9.6-24.5 6.8l-55.7-17.8c-13.4 10.3-29.1 18.9-44 25.5l-12.5 57.1c-2 9-9 15.4-18.2 17.8c-13.8 2.3-28 3.5-43.4 3.5c-13.6 0-27.8-1.2-41.6-3.5c-9.2-2.4-16.2-8.8-18.2-17.8l-12.5-57.1c-15.8-6.6-30.6-15.2-44-25.5l-55.66 17.8c-8.84 2.8-18.59.3-24.51-6.8c-8.11-9.9-15.51-20.3-22.11-31.3l-4.68-8.1c-6.07-10.9-11.35-22.4-15.78-34.3c-3.24-8.6-.51-18.3 6.35-24.6l43.26-39.4C64.57 273.1 64 264.6 64 256c0-8.6.57-17.1 1.67-25.4l-43.26-39.4c-6.86-6.3-9.59-15.9-6.35-24.6c4.43-11.9 9.72-23.4 15.78-34.3l4.67-8.1c6.61-11 14.01-21.4 22.12-31.25c5.92-7.15 15.67-9.63 24.51-6.81l55.66 17.76c13.4-10.34 28.2-18.94 44-25.47l12.5-57.1c2-9.08 9-16.29 18.2-17.82C227.3 1.201 241.5 0 256 0s28.7 1.201 42.5 3.51c9.2 1.53 16.2 8.74 18.2 17.82l12.5 57.1c14.9 6.53 30.6 15.13 44 25.47l55.7-17.76c8.8-2.82 18.5-.34 24.5 6.81c8.1 9.85 15.5 20.25 22.1 31.25l4.7 8.1c6 10.9 11.3 22.4 15.7 34.3zM256 336c44.2 0 80-35.8 80-80.9c0-43.3-35.8-80-80-80s-80 36.7-80 80c0 45.1 35.8 80.9 80 80.9z"/></svg>' . __('Settings', TR) . '</button>';
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
                        <label for="zpdevwpcg_option<?php echo '['.$field.'][font_size]'; ?>">
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
                        <label for="zpdevwpcg_option<?php echo '['.$field.'][font_weight]'; ?>">
                            <?php echo __('Font weight', TR); ?>
                        </label>
                        <div>
                            <select
                                class="zpwpcg-tuning__field--font-weight"
                                data-field="<?php echo $field; ?>"
                                name="zpdevwpcg_option<?php echo '['.$field.'][font_weight]'; ?>" id="">
                                <option
                                    value="400"
                                    <?php echo selected( $this->options['font_weight'], '400', false); ?>>
                                    normal
                                </option>
                                <option
                                    value="700"
                                    <?php echo selected( $this->options['font_weight'], '700', false); ?>>
                                    bold
                                </option>
                            </select>
                        </div>


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
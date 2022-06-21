<?php
    
    namespace ZPdevWPCG;
    
    if ( ! class_exists( 'ZPdevWPCG_Options' ) ) {
        class ZPdevWPCG_Options {

            private $options;
            
            use Instance;
            
            public function __construct() {
                add_action( 'admin_menu', array( $this, 'add_plugin_admin_panel_page' ) );
                add_action( 'admin_menu', array( $this, 'add_plugin_admin_panel_settings_subpage' ) );
                add_action( 'admin_init', array( $this, 'page_init' ) );
                //            add_action('admin_enqueue_scripts', array($this, 'load_scripts_admin'));
                
                add_action( 'admin_footer', array( $this, 'load_scripts_admin' ) );
            }
            
            public function add_plugin_admin_panel_page() {
                // Add the menu item and page
                $page_title = 'zapaDEV WP Certificate Generator';
                $menu_title = 'ZPdev WPCG';
                $capability = 'manage_options';
                $slug       = 'zpdevwpcg';
                $callback   = array( $this, 'create_plugin_admin_panel_page' );
                $icon       = 'dashicons-admin-plugins';
                $position   = 100;
                
                add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
            }
            
            public function add_plugin_admin_panel_settings_subpage() {
                // Add the menu item and page
                $parent_page = 'zpdevwpcg';
                $page_title  = 'Settings';
                $menu_title  = 'Settings';
                $capability  = 'manage_options';
                $slug        = 'zpdevwpcg_settings';
                $callback    = array( $this, 'create_plugin_admin_panel_settings_subpage' );
                
                add_submenu_page( $parent_page, $page_title, $menu_title, $capability, $slug, $callback );
            }
            
            public function create_plugin_admin_panel_page() {
                // Set class property
                $this->options = get_option( 'zpdevwpcg_option' );
                ?>
                <div class="wrap">
                    <h1><?php
                            echo __( 'zapaDEV WP Certificate Generator', 'zapadev-wp-certificate-generator' ) ?></h1>
                    <form method="post" action="options.php">
                        <?php
                            // This prints out all hidden setting fields
                            settings_fields( 'zpdevwpcg_option_group' );
                            do_settings_sections( 'zpdevwpcg' );
                            submit_button();
                        ?>
                    </form>
                </div>
                <?php
            }
            
            public function create_plugin_admin_panel_settings_subpage() {
                // Set class property
                $this->options = get_option( 'zpdevwpcg_option' );
                ?>
                <div class="wrap">
                    <h1><?php
                            echo __( 'Settings', 'zapadev-wp-certificate-generator' ) ?></h1>
                    <form method="post" action="options.php">
                        <?php
                            // This prints out all hidden setting fields
                            settings_fields( 'zpdevwpcg_settings_option_group' );
                            do_settings_sections( 'zpdevwpcg_settings' );
                            submit_button();
                        ?>
                    </form>
                    
                    <?php
                        echo '<pre>';
                        var_dump( get_option( 'zpdevwpcg_option' ) );
                        echo '</pre>';
                    ?>


                </div>
                <?php
            }
            
            public function load_scripts_admin() {
                wp_enqueue_script( 'zpdev-wpcg-admin', ZPdevWPCG()->plugin_url() . '/assets/js/zpdev-wpcg-admin.js',
                    [ 'jquery' ], '1.0', true );
            }
            
            public function page_init() {
                $option_group = 'zpdevwpcg_settings_option_group';
                $option_name  = 'zpdevwpcg_option';
                $args         = array( $this, 'sanitize' );
                
                register_setting( $option_group, $option_name, $args );
                
                
                $id       = 'setting_section_body_main';
                $title    = __( 'Certificate Body Main', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'print_section_body_main_info' );
                $page     = 'zpdevwpcg_settings';
                
                add_settings_section( $id, $title, $callback, $page );
                
                
                $id       = 'img';
                $title    = __( 'Image', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'img_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_main';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                
                $id       = 'name_label';
                $title    = __( 'Field (Name label)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'name_label_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_main';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                $id       = 'top_text';
                $title    = __( 'Field (Top text)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'top_text_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_main';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                $id       = 'bottom_text';
                $title    = __( 'Field (Bottom text)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'bottom_text_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_main';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                $id       = 'bottom_strong_text';
                $title    = __( 'Field (Bottom strong text)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'bottom_strong_text_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_main';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                
                $id       = 'setting_section_body_grid';
                $title    = __( 'Certificate Body Grid', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'print_section_body_grid_info' );
                $page     = 'zpdevwpcg_settings';
                
                add_settings_section( $id, $title, $callback, $page );
                
                $id       = 'period';
                $title    = __( 'Field (Course dates)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'period_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                $id       = 'level_label';
                $title    = __( 'Field (Level label)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'level_label_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                
                $id       = 'level_value_arr';
                $title    = __( 'Field (Level value)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'level_value_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';
                $arr      = array(
                    'label' => 'level_label',
                    'value' => [],
                    'desc'  => 'level_desc'
                );
                
                add_settings_field( $id, $title, $callback, $page, $section, $arr );
                
                
                $id       = 'level_desc';
                $title    = __( 'Field (Level description)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'level_desc_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';
                
                add_settings_field( $id, $title, $callback, $page, $section, $arr );
                
                
                $id       = 'hours';
                $title    = __( 'Field (Number of hours)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'hours_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                $id       = 'place';
                $title    = __( 'Field (Place of Study)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'place_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                $id       = 'date';
                $title    = __( 'Field (Date of issue)', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'date_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                
                /*
                 * Certificate footer section
                 *
                 * */
                
                $id       = 'setting_section_footer';
                $title    = __( 'Certificate Footer', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'print_section_footer' );
                $page     = 'zpdevwpcg_settings';
                
                add_settings_section( $id, $title, $callback, $page );
                
                
                $id       = 'logo';
                $title    = __( 'Logo', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'logo_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_footer';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                
                $id       = 'address';
                $title    = __( 'Address', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'address_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_footer';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                
                $id       = 'signature';
                $title    = __( 'Signature', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'signature_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_footer';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                
                $id       = 'director_label';
                $title    = __( 'Director Label', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'director_label_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_footer';
                
                add_settings_field( $id, $title, $callback, $page, $section );
                
                $id       = 'director';
                $title    = __( 'Director', 'zapadev-wp-certificate-generator' );
                $callback = array( $this, 'director_callback' );
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_footer';
                
                add_settings_field( $id, $title, $callback, $page, $section );
            }
            
            public function sanitize( $input ) {
                $new_input = array();
                if ( isset( $input['name_label'] ) ) {
                    $new_input['name_label'] = sanitize_text_field( $input['name_label'] );
                }
                if ( isset( $input['top_text'] ) ) {
                    $new_input['top_text'] = sanitize_text_field( $input['top_text'] );
                }
                if ( isset( $input['bottom_text'] ) ) {
                    $new_input['bottom_text'] = sanitize_text_field( $input['bottom_text'] );
                }
                if ( isset( $input['bottom_strong_text'] ) ) {
                    $new_input['bottom_strong_text'] = sanitize_text_field( $input['bottom_strong_text'] );
                }
                if ( isset( $input['period'] ) ) {
                    $new_input['period'] = sanitize_text_field( $input['period'] );
                }
                if ( isset( $input['level_label'] ) ) {
                    $new_input['level_label'] = sanitize_text_field( $input['level_label'] );
                }
                if ( isset( $input['level_desc'] ) ) {
                    $new_input['level_desc'] = sanitize_text_field( $input['level_desc'] );
                }
                if ( isset( $input['level_value'] ) ) {
                    $new_input['level_value'] = sanitize_text_field( $input['level_value'] );
                }
                if ( isset( $input['hours'] ) ) {
                    $new_input['hours'] = sanitize_text_field( $input['hours'] );
                }
                if ( isset( $input['place'] ) ) {
                    $new_input['place'] = sanitize_text_field( $input['place'] );
                }
                if ( isset( $input['date'] ) ) {
                    $new_input['date'] = sanitize_text_field( $input['date'] );
                }
                if ( isset( $input['img'] ) ) {
                    $new_input['img'] = sanitize_text_field( $input['img'] );
                }
                if ( isset( $input['logo'] ) ) {
                    $new_input['logo'] = sanitize_text_field( $input['logo'] );
                }
                if ( isset( $input['signature'] ) ) {
                    $new_input['signature'] = sanitize_text_field( $input['signature'] );
                }
                if ( isset( $input['address'] ) ) {
                    $new_input['address'] = sanitize_text_field( $input['address'] );
                }
                if ( isset( $input['director'] ) ) {
                    $new_input['director'] = sanitize_text_field( $input['director'] );
                }
                if ( isset( $input['director_label'] ) ) {
                    $new_input['director_label'] = sanitize_text_field( $input['director_label'] );
                }
                
                return $new_input;
            }
            
            public function print_section_footer() {
                print __( 'Add Certificate Footer Data', 'zapadev-wp-certificate-generator' );
            }
            
            public function print_section_body_main_info() {
                print __( 'Add Certificate body data', 'zapadev-wp-certificate-generator' );
            }
            
            public function print_section_body_grid_info() {
                print __( 'Add Certificate body grid data', 'zapadev-wp-certificate-generator' );
            }
            
            public function img_callback() {
                printf( '<div class="zpwpcg-adm__picture-preview-wrapper"><img id="zpwpcg-adm__picture-preview--img" src="%s" height="300" alt=""></div>',
                    $this->options['img'] );
                printf( '<input class="zpwpcg-adm__upload-button" data-item="img" type="button"  value="%s">',
                    __( 'Upload image', 'zapadev-wp-certificate-generator' ) );
                printf( '<input type="hidden" id="img" name="zpdevwpcg_option[img]" value="%s" />',
                    isset( $this->options['img'] ) ? esc_attr( $this->options['img'] ) : '' );
            }
            
            public function period_callback() {
                printf(
                    '<input type="text" id="period" name="zpdevwpcg_option[period]" value="%s" />',
                    isset( $this->options['period'] ) ? esc_attr( $this->options['period'] ) : ''
                );
            }
            
            public function name_label_callback() {
                printf(
                    '<input type="text" id="name_label" name="zpdevwpcg_option[name_label]" value="%s" />',
                    isset( $this->options['name_label'] ) ? esc_attr( $this->options['name_label'] ) : ''
                );
            }
            
            public function top_text_callback() {
                printf(
                    '<textarea cols="40" rows="3" id="top_text" name="zpdevwpcg_option[top_text]">%s</textarea>',
                    isset( $this->options['top_text'] ) ? esc_attr( $this->options['top_text'] ) : ''
                );
            }
            
            public function bottom_text_callback() {
                printf(
                    '<textarea cols="40" rows="3" id="bottom_text" name="zpdevwpcg_option[bottom_text]">%s</textarea>',
                    isset( $this->options['bottom_text'] ) ? esc_attr( $this->options['bottom_text'] ) : ''
                );
            }
            
            public function bottom_strong_text_callback() {
                printf(
                    '<textarea cols="40" rows="3" id="bottom_strong_text" name="zpdevwpcg_option[bottom_strong_text]">%s</textarea>',
                    isset( $this->options['bottom_strong_text'] ) ? esc_attr( $this->options['bottom_strong_text'] ) : ''
                );
            }
            
            public function level_label_callback() {
                printf(
                    '<input type="text" id="level_label" name="zpdevwpcg_option[level_label]" value="%s" />',
                    isset( $this->options['level_label'] ) ? esc_attr( $this->options['level_label'] ) : ''
                );
            }
            
            public function level_value_callback() {
                printf(
                    '<input type="text" id="level_value" name="zpdevwpcg_option[level_value]" value="%s" />',
                    isset( $this->options['level_value'] ) ? esc_attr( $this->options['level_value'] ) : ''
                );
                echo '<button type="button">Add Level</button>';
                echo '<p>List</p>';
                echo '<ul>';
                echo '<li>';
                $options = get_option( 'zpdevwpcg_option' );
                echo $options['level_value'];
                echo '</li>';
                echo '</ul>';
            }
            
            public function level_desc_callback() {
                printf(
                    '<textarea cols="40" rows="3" id="level_desc" name="zpdevwpcg_option[level_desc]">%s</textarea>',
                    isset( $this->options['level_desc'] ) ? esc_attr( $this->options['level_desc'] ) : ''
                );
            }
            
            public function hours_callback() {
                printf(
                    '<input type="text" id="hours" name="zpdevwpcg_option[hours]" value="%s" />',
                    isset( $this->options['hours'] ) ? esc_attr( $this->options['hours'] ) : ''
                );
            }
            
            public function place_callback() {
                printf(
                    '<input type="text" id="place" name="zpdevwpcg_option[place]" value="%s" />',
                    isset( $this->options['place'] ) ? esc_attr( $this->options['place'] ) : ''
                );
            }
            
            public function date_callback() {
                printf(
                    '<input type="text" id="date" name="zpdevwpcg_option[date]" value="%s" />',
                    isset( $this->options['date'] ) ? esc_attr( $this->options['date'] ) : ''
                );
            }
            
            public function logo_callback() {
                printf( '<div class="zpwpcg-adm__picture-preview-wrapper"><img id="zpwpcg-adm__picture-preview--logo" src="%s" width="300" alt=""></div>',
                    $this->options['logo'] );
                printf( '<input class="zpwpcg-adm__upload-button" data-item="logo" type="button"  value="%s">',
                    __( 'Upload image', 'zapadev-wp-certificate-generator' ) );
                printf( '<input type="hidden" id="logo" name="zpdevwpcg_option[logo]" value="%s" />',
                    isset( $this->options['logo'] ) ? esc_attr( $this->options['logo'] ) : '' );
            }
            
            public function address_callback() {
                printf(
                    '<textarea cols="40" rows="4" id="address" name="zpdevwpcg_option[address]">%s</textarea>',
                    isset( $this->options['address'] ) ? esc_attr( $this->options['address'] ) : ''
                );
            }
            
            public function director_callback() {
                printf(
                    '<input type="text" id="director" name="zpdevwpcg_option[director]" value="%s" />',
                    isset( $this->options['director'] ) ? esc_attr( $this->options['director'] ) : ''
                );
            }
            
            public function signature_callback() {
                printf( '<div class="zpwpcg-adm__picture-preview-wrapper"><img id="zpwpcg-adm__picture-preview--signature" src="%s" width="300" alt=""></div>',
                    $this->options['signature'] );
                printf( '<input class="zpwpcg-adm__upload-button" data-item="signature" type="button"  value="%s">',
                    __( 'Upload image', 'zapadev-wp-certificate-generator' ) );
                printf( '<input type="hidden" id="signature" name="zpdevwpcg_option[signature]" value="%s" />',
                    isset( $this->options['signature'] ) ? esc_attr( $this->options['signature'] ) : '' );
            }
            
            public function director_label_callback() {
                printf(
                    '<input type="text" id="director_label" name="zpdevwpcg_option[director_label]" value="%s" />',
                    isset( $this->options['director_label'] ) ? esc_attr( $this->options['director_label'] ) : ''
                );
            }
        }
    }
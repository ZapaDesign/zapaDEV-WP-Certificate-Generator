<?php
    
    namespace ZPdevWPCG;
    
    if ( ! class_exists( 'ZPdevWPCG_Options' ) ) {
        class ZPdevWPCG_Options {
            
//            private $options;
            
            use Instance;
            
            public function __construct() {
                add_action( 'admin_menu', array( $this, 'add_plugin_admin_panel_page' ) );
                add_action( 'admin_menu', array( $this, 'add_plugin_admin_panel_settings_subpage' ) );
                add_action( 'admin_init', array( $this, 'page_init' ) );
                
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
                $slug        = PREFIX . 'settings';
                $callback    = array( $this, 'create_plugin_admin_panel_settings_subpage' );
                
                add_submenu_page( $parent_page, $page_title, $menu_title, $capability, $slug, $callback );
            }
            
            public function create_plugin_admin_panel_page() {
                // Set class property
                $this->options = get_option( PREFIX . 'option' );
                ?>
                <div class="wrap">
                    <h1><?php
                            echo __( 'zapaDEV WP Certificate Generator', TR_ID ) ?></h1>
                    <form method="post" action="options.php">
                        <?php
                            // This prints out all hidden setting fields
                            settings_fields( PREFIX . 'option_group' );
                            do_settings_sections( 'zpdevwpcg' );
                            submit_button();
                        ?>
                    </form>
                </div>
                <?php
            }
            
            public function create_plugin_admin_panel_settings_subpage() {
                $this->options = get_option( PREFIX . 'option' );
                ?>
                <div class="wrap">
                    <h1><?php
                            echo __( 'Settings', TR_ID ) ?></h1>
                    <form method="post" action="options.php">
                        <?php
                            // This prints out all hidden setting fields
                            settings_fields( PREFIX . 'settings_option_group' );
                            do_settings_sections( PREFIX . 'settings' );
                            submit_button();
                        ?>
                    </form>
                </div>
                <?php
            }
            
            public function load_scripts_admin() {
                wp_enqueue_script( 'zpdev-wpcg-admin', ZPdevWPCG()->plugin_url() . '/assets/js/zpdev-wpcg-admin.js',
                    [ 'jquery' ], '1.0', true );
            }
            
            public function page_init() {
                register_setting( PREFIX . 'settings_option_group', PREFIX . 'option', array( $this, 'sanitize' ) );
    
                /*
                 * Certificate body main section
                 * */
                
                $ss_body_main = 'setting_section_body_main';
                add_settings_section( $ss_body_main, __( 'Certificate Body Main', TR_ID ), array( $this, 'print_section_body_main_info' ), PREFIX . 'settings' );
                
                add_settings_field( 'img', __( 'Image', TR_ID ), array( $this, 'img_callback' ), PREFIX . 'settings', $ss_body_main );
                add_settings_field( 'name', __( 'Field (Name label)', TR_ID ), array( $this, 'name_callback' ), PREFIX . 'settings', $ss_body_main );
                add_settings_field( 'text', __( 'Field (Text)', TR_ID ), array( $this, 'text_callback' ), PREFIX . 'settings', $ss_body_main );
    
                
                /*
                 * Certificate body grid section
                 * */

                $ss_body_grid = 'setting_section_body_grid';
                add_settings_section( $ss_body_grid, __( 'Certificate Body Grid', TR_ID ), array( $this, 'print_section_body_grid_info' ), PREFIX . 'settings' );
                
                add_settings_field( 'period', __( 'Field (Course dates)', TR_ID ), array( $this, 'period_callback' ), PREFIX . 'settings', $ss_body_grid );
                add_settings_field( 'levels', __( 'Field (Levels)', TR_ID ), array( $this, 'levels_callback' ), PREFIX . 'settings', $ss_body_grid );
                add_settings_field( 'hours', __( 'Field (Number of hours)', TR_ID ), array( $this, 'hours_callback' ), PREFIX . 'settings', $ss_body_grid );
                add_settings_field( 'place', __( 'Field (Place of Study)', TR_ID ), array( $this, 'place_callback' ), PREFIX . 'settings', $ss_body_grid );
                add_settings_field( 'date', __( 'Field (Date of issue)', TR_ID ), array( $this, 'date_callback' ), PREFIX . 'settings', $ss_body_grid );
                
                
                /*
                 * Certificate footer section
                 * */
                
                add_settings_section( 'setting_section_footer', __( 'Certificate Footer', TR_ID ), array( $this, 'print_section_footer' ), PREFIX . 'settings' );
                
                add_settings_field( 'logo', __( 'Logo', TR_ID ), array( $this, 'logo_callback' ), PREFIX . 'settings', 'setting_section_footer' );
                add_settings_field( 'address', __( 'Address', TR_ID ), array( $this, 'address_callback' ), PREFIX . 'settings', 'setting_section_footer' );
                add_settings_field( 'signature', __( 'Signature', TR_ID ), array( $this, 'signature_callback' ), PREFIX . 'settings', 'setting_section_footer' );
                add_settings_field( 'director', __( 'Director', TR_ID ), array( $this, 'director_callback' ), PREFIX . 'settings', 'setting_section_footer' );
            }
            
            public function sanitize( $input ) {
                $new_input = array();
                if ( isset( $input['name'] ) ) {
                    $new_input['name'] = $input['name'];
                }
                if ( isset( $input['text'] ) ) {
                    $new_input['text'] =  $input['text'];
                }
                if ( isset( $input['period'] ) ) {
                    $new_input['period'] = $input['period'];
                }
                if ( isset( $input['levels'] ) ) {
                    $new_input['levels'] = $input['levels'];
                }
                if ( isset( $input['hours'] ) ) {
                    $new_input['hours'] = $input['hours'];
                }
                if ( isset( $input['place'] ) ) {
                    $new_input['place'] = $input['place'];
                }
                if ( isset( $input['date'] ) ) {
                    $new_input['date'] = $input['date'];
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
                    $new_input['director'] = $input['director'];
                }
                
                return $new_input;
            }
            
            public function print_section_footer() {
                print __( 'Add Certificate Footer Data', TR_ID );
            }
            
            public function print_section_body_main_info() {
                print __( 'Add Certificate body data', TR_ID );
            }
            
            public function print_section_body_grid_info() {
                print __( 'Add Certificate body grid data', TR_ID );
            }
            
            public function img_callback() {
                printf( '<div class="zpwpcg-adm-picture__preview-wrapper"><img class="zpwpcg-adm-picture__preview--img" src="%s" height="300" alt=""></div>',
                    $this->options['img'] );
                printf( '<input class="zpwpcg-adm-picture__upload-button" data-item="img" type="button"  value="%s">',
                    __( 'Upload image', TR_ID ) );
                printf( '<input type="hidden" id="img" name="zpdevwpcg_option[img]" value="%s" />',
                    isset( $this->options['img'] ) ? esc_attr( $this->options['img'] ) : '' );
            }
            
            public function period_callback() {
                printf(
                    '<input type="text" name="zpdevwpcg_option[period][label]" value="%s" placeholder="%s"/>',
                    isset( $this->options['period']['label'] ) ? esc_attr( $this->options['period']['label'] ) : '',
                    __( 'Label', TR_ID )
                );
                printf(
                    '<input type="text" name="zpdevwpcg_option[period][start]" value="%s" placeholder="%s"/>',
                    isset( $this->options['period']['start'] ) ? esc_attr( $this->options['period']['start'] ) : '',
                    __( 'Start', TR_ID )
                );
                printf(
                    '<input type="text" name="zpdevwpcg_option[period][finish]" value="%s" placeholder="%s"/>',
                    isset( $this->options['period']['finish'] ) ? esc_attr( $this->options['period']['finish'] ) : '',
                    __( 'Finish', TR_ID )
                );
            }
            
            public function name_callback() {
                printf(
                    '<input type="text" name="zpdevwpcg_option[name][label]" value="%s" placeholder="%s">',
                    isset( $this->options['name']['label'] ) ? esc_attr( $this->options['name']['label'] ) : '',
                    __( 'Label' )
                );
            }
            
            public function text_callback() {
                printf(
                    '<textarea cols="40" rows="3" name="zpdevwpcg_option[text][after]" placeholder="%s">%s</textarea>',
                    __('After name text', TR_ID),
                    isset( $this->options['text']['after'] ) ? esc_attr( $this->options['text']['after'] ) : ''
                );
                printf(
                    '<textarea cols="40" rows="3" name="zpdevwpcg_option[text][before]" placeholder="%s">%s</textarea>',
                    __('Before name text', TR_ID),
                    isset( $this->options['text']['before'] ) ? esc_attr( $this->options['text']['before'] ) : ''
                );
                printf(
                    '<textarea cols="40" rows="3" name="zpdevwpcg_option[text][before_strong]" placeholder="%s">%s</textarea>',
                    __('Before name strong text', TR_ID),
                    isset( $this->options['text']['before_strong'] ) ? esc_attr( $this->options['text']['before_strong'] ) : ''
                );
            }
            
            public function levels_callback() {
                printf(
                    '<input type="text" name="zpdevwpcg_option[levels][label]" value="%s" placeholder="%s"/>',
                    isset( $this->options['levels']['label'] ) ? esc_attr( $this->options['levels']['label'] ) : '',
                    __( 'Label' )
                );
                
                $all_options = get_option( 'zpdevwpcg_option' );
                $options     = $all_options['levels']['list'];
                echo '<div class="repeatable-wrap"><ul id="tracks-repeatable" class="repeatable-fields-list">';
                if ( ! empty( $options ) ):
                    
                    $i = 1;
                    foreach ( $options as $option ):
                        //                    if ($this->options['levels']['list']['level-' . $i]['value'] !== null):
                        ?>
                        <li>
                            <input type="text"
                                   name="zpdevwpcg_option[levels][list][level-<?php
                                       echo $i; ?>][value]"
                                   placeholder="<?php echo __('Value', TR_ID); ?>"
                                   value="<?php
                                       echo isset( $this->options['levels']['list'][ 'level-' . $i ]['value'] ) ?
                                           esc_attr( $this->options['levels']['list'][ 'level-' . $i ]['value'] ) : ''; ?>">
                            <input type="text"
                                   width="500"
                                   placeholder="<?php echo __('Description', TR_ID); ?>"
                                   name="zpdevwpcg_option[levels][list][level-<?php
                                       echo $i; ?>][desc]"
                                   value="<?php
                                       echo isset( $this->options['levels']['list'][ 'level-' . $i ]['desc'] ) ? esc_attr( $this->options['levels']['list'][ 'level-' . $i ]['desc'] ) : ''; ?>">
                            <a class="repeatable-field-remove button" href="#">X</a>
                        </li>
                        <?php
                        $i ++;
                        //                    endif;
                    endforeach;
                else: ?>
                    <li>
                        <input type="text"
                               name="zpdevwpcg_option[levels][list][level-1][value]"
                               placeholder="<?php echo __('Value', TR_ID); ?>"
                               value="<?php
                                   echo isset( $this->options['levels']['list']['level-1']['value'] ) ? esc_attr( $this->options['levels']['list']['level-1']['value'] ) : ''; ?>">
                        <input type="text"
                               name="zpdevwpcg_option[levels][list][level-1][desc]"
                               placeholder="<?php echo __('Description', TR_ID); ?>"
                               value="<?php
                                   echo isset( $this->options['levels']['list']['level-1']['desc'] ) ? esc_attr( $this->options['levels']['list']['level-1']['desc'] ) : ''; ?>">
                        <a class="repeatable-field-remove button" href="#">X</a>
                    </li>
                <?php
                endif; ?>
                </ul><a class="repeatable-field-add button" href="#">+</a></div>
                <?php
            }
            
            public function hours_callback() {
                printf(
                    '<input type="text" name="zpdevwpcg_option[hours][label]" value="%s" placeholder="%s"/>',
                    isset( $this->options['hours']['label'] ) ? esc_attr( $this->options['hours']['label'] ) : '',
                    __( 'Label' )
                );
                
                printf(
                    '<input type="text" name="zpdevwpcg_option[hours][value]" value="%s" placeholder="%s"/>',
                    isset( $this->options['hours']['value'] ) ? esc_attr( $this->options['hours']['value'] ) : '',
                    __( 'Default value' )
                );
            }
            
            public function place_callback() {
                printf(
                    '<input type="text" name="zpdevwpcg_option[place][label]" value="%s" placeholder="%s"/>',
                    isset( $this->options['place']['label'] ) ? esc_attr( $this->options['place']['label'] ) : '',
                    __( 'Label' )
                );
                
                printf(
                    '<input type="text" name="zpdevwpcg_option[place][value]" value="%s" placeholder="%s"/>',
                    isset( $this->options['place']['value'] ) ? esc_attr( $this->options['place']['value'] ) : '',
                    __( 'Default value' )
                );
            }
            
            public function date_callback() {
                printf(
                    '<input type="text" name="zpdevwpcg_option[date][label]" value="%s" placeholder="%s">',
                    isset( $this->options['date']['label'] ) ? esc_attr( $this->options['date']['label'] ) : '',
                    __( 'Label' )
                );
            }
            
            public function logo_callback() {
                printf( '<div class="zpwpcg-adm-picture__preview-wrapper"><img class="zpwpcg-adm-picture__preview--logo" src="%s" width="300" alt=""></div>',
                    $this->options['logo'] );
                printf( '<input class="zpwpcg-adm-picture__upload-button" data-item="logo" type="button"  value="%s">',
                    __( 'Upload image', TR_ID ) );
                printf( '<input type="hidden" id="logo" name="zpdevwpcg_option[logo]" value="%s" />',
                    isset( $this->options['logo'] ) ? esc_attr( $this->options['logo'] ) : '' );
            }
            
            public function address_callback() {
                printf(
                    '<textarea cols="40" rows="4" id="address" name="zpdevwpcg_option[address]" placeholder="%s">%s</textarea>',
                    __('Address', TR_ID),
                    isset( $this->options['address'] ) ? esc_attr( $this->options['address'] ) : ''
                );
            }
            
            public function director_callback() {
                printf(
                    '<input type="text" id="director_label" name="zpdevwpcg_option[director][label]" value="%s" placeholder="%s">',
                    isset( $this->options['director']['label'] ) ? esc_attr( $this->options['director']['label'] ) : '',
                    __('Label', TR_ID)
                );
                
                printf(
                    '<input type="text" id="director_value" name="zpdevwpcg_option[director][value]" value="%s" placeholder="%s">',
                    isset( $this->options['director']['value'] ) ? esc_attr( $this->options['director']['value'] ) : '',
                    __('Value', TR_ID)
                );
            }
            
            public function signature_callback() {
                printf( '<div class="zpwpcg-adm-picture__preview-wrapper"><img class="zpwpcg-adm-picture__preview--signature" src="%s" width="300" alt=""></div>',
                    $this->options['signature'] );
                printf( '<input class="zpwpcg-adm-picture__upload-button" data-item="signature" type="button"  value="%s">',
                    __( 'Upload image', TR_ID ) );
                printf( '<input type="hidden" id="signature" name="zpdevwpcg_option[signature]" value="%s" />',
                    isset( $this->options['signature'] ) ? esc_attr( $this->options['signature'] ) : '' );
            }
        }
    }
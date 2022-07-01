<?php
    
    namespace ZPdevWPCG;
    
    if ( ! class_exists( 'ZPdevWPCG_Options' ) ) {
        class ZPdevWPCG_Options {
            
            // private $options;
            
            use Instance;
            
            public function __construct() {
                add_action( 'admin_menu', array( $this, 'add_plugin_admin_panel_pages' ) );
                add_action( 'admin_init', array( $this, 'page_init' ) );
                
                add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts_admin' ) );
            }
            
            public function add_plugin_admin_panel_pages() {
                $this->add_plugin_admin_panel_page();
                $this->add_plugin_admin_panel_subpage_students();
                $this->add_plugin_admin_panel_subpage_settings();
            }
            
            public function add_plugin_admin_panel_page() {
                $page_title = 'zapaDEV WP Certificate Generator';
                $menu_title = 'ZPdev WPCG';
                $capability = 'manage_options';
                $slug       = 'zpdevwpcg';
                $callback   = array( $this, 'create_plugin_admin_panel_page' );
                $icon       = 'dashicons-admin-plugins';
                $position   = 100;
                
                add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
            }
            public function create_plugin_admin_panel_page() {
                $this->options = get_option( PREFIX . 'option' );
                include_once( DIR_PATH . 'templates/template-admin-options.php' );
            }
    
            public function add_plugin_admin_panel_subpage_students() {
                $parent_page = 'zpdevwpcg';
                $page_title  = 'Students';
                $menu_title  = 'Students';
                $capability  = 'manage_options';
                $slug        = PREFIX . 'students';
                $callback    = array( $this, 'create_plugin_admin_panel_students_subpage' );
        
                add_submenu_page( $parent_page, $page_title, $menu_title, $capability, $slug, $callback );
            }
            public function create_plugin_admin_panel_students_subpage() {
                $this->options = get_option( PREFIX . 'option' );
                include_once( DIR_PATH . 'templates/template-admin-options-students.php' );
            }
            
            public function add_plugin_admin_panel_subpage_settings() {
                $parent_page = 'zpdevwpcg';
                $page_title  = 'Settings';
                $menu_title  = 'Settings';
                $capability  = 'manage_options';
                $slug        = PREFIX . 'settings';
                $callback    = array( $this, 'create_plugin_admin_panel_settings_subpage' );
                
                add_submenu_page( $parent_page, $page_title, $menu_title, $capability, $slug, $callback );
            }
            public function create_plugin_admin_panel_settings_subpage() {
                $this->options = get_option( PREFIX . 'option' );
                include_once( DIR_PATH . 'templates/template-admin-options-settings.php' );
            }
            
            public function load_scripts_admin() {
                if ( ! did_action( 'wp_enqueue_media' ) ) {
                    wp_enqueue_media();
                }
                wp_enqueue_script( 'zpdev-wpcg-admin', ZPdevWPCG()->plugin_url() . '/assets/js/zpdev-wpcg-admin.js', [ 'jquery' ], '1.0', true );
    
                wp_enqueue_style( 'zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/css/zpdev-wpcg-admin.css', false, null, 'all' );
            }
            
            public function page_init() {
                register_setting( PREFIX . 'settings_option_group', PREFIX . 'option', array( $this, 'sanitize' ) );
                
                /*
                 * Certificate body main section
                 * */
                
                $ss_body_main = 'setting_section_body_main';
                add_settings_section( $ss_body_main, __( 'Certificate Body Main', TR_ID ), array( $this, 'print_section_body_main_info' ), PREFIX . 'settings' );
                
                add_settings_field( 'img', __( 'Image', TR_ID ), array( $this, 'render_img' ), PREFIX . 'settings', $ss_body_main, array(
                    'label_for' =>'img',
                    'demo_link' => '/assets/img/certificate-template-demo.svg') );
                add_settings_field( 'name', __( 'Field (Name label)', TR_ID ), array( $this, 'render_name' ), PREFIX . 'settings', $ss_body_main );
                add_settings_field( 'text', __( 'Field (Text)', TR_ID ), array( $this, 'render_text' ), PREFIX . 'settings', $ss_body_main );
                
                
                /*
                 * Certificate body grid section
                 * */
                
                $ss_body_grid = 'setting_section_body_grid';
                add_settings_section( $ss_body_grid, __( 'Certificate Body Grid', TR_ID ), array( $this, 'print_section_body_grid_info' ), PREFIX . 'settings' );
                
                add_settings_field( 'period', __( 'Field (Course dates)', TR_ID ), array( $this, 'render_period' ), PREFIX . 'settings', $ss_body_grid, array(
                    'label',
                    'start',
                    'finish'
                ) );
                add_settings_field( 'levels', __( 'Field (Levels)', TR_ID ), array( $this, 'render_level' ), PREFIX . 'settings', $ss_body_grid );
                add_settings_field( 'hours', __( 'Field (Number of hours)', TR_ID ), array( $this, 'hours_callback' ), PREFIX . 'settings', $ss_body_grid );
                add_settings_field( 'place', __( 'Field (Place of Study)', TR_ID ), array( $this, 'place_callback' ), PREFIX . 'settings', $ss_body_grid );
                add_settings_field( 'date', __( 'Field (Date of issue)', TR_ID ), array( $this, 'date_callback' ), PREFIX . 'settings', $ss_body_grid );
                
                
                /*
                 * Certificate footer section
                 * */
                $ss_footer = 'setting_section_footer';
                add_settings_section( 'setting_section_footer', __( 'Certificate Footer', TR_ID ), array( $this, 'print_section_footer' ), PREFIX . 'settings' );
                
                add_settings_field( 'logo', __( 'Logo', TR_ID ), array( $this, 'img_callback' ), PREFIX . 'settings',$ss_footer, array(
                        'label_for' =>'logo',
                        'demo_link' => '/assets/img/certificate-logo-demo.svg') );
                add_settings_field( 'address', __( 'Address', TR_ID ), array( $this, 'address_callback' ), PREFIX . 'settings', $ss_footer );
                add_settings_field( 'signature', __( 'Signature', TR_ID ), array( $this, 'img_callback' ), PREFIX . 'settings', $ss_footer, array(
                    'label_for' =>'signature',
                    'demo_link' => '/assets/img/certificate-signature-demo.svg') );
                add_settings_field( 'director', __( 'Director', TR_ID ), array( $this, 'director_callback' ), PREFIX . 'settings', $ss_footer );
            }
            
            // TODO Fix sanitize method
            public function sanitize( $input ) {
                $new_input = array();
                if ( isset( $input['name'] ) ) {
                    $new_input['name'] = $input['name'];
                }
                if ( isset( $input['text'] ) ) {
                    $new_input['text'] = $input['text'];
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
            
            public function render_img( $args ) {
                // TODO Check img_callback method

                $img_demo_url  = ZPdevWPCG()->plugin_url() . $args['demo_link'];
                $img_url = $this->options[$args['label_for']]; ?>

                <div class="zpwpcg-adm-picture__preview-wrapper">
                    <img
                        src="<?php echo $img_url ? $img_url : $img_demo_url; ?>"
                        class="zpwpcg-adm-picture__preview--<?php echo $args['label_for']; ?>"
                        width="200"
                        alt=""
                    >
                </div>
                <input
                    type="button"
                    class="zpwpcg-adm-picture__upload-button"
                    data-item="<?php echo $args['label_for']; ?>"
                    value="<?php echo __( 'Upload image', TR_ID ); ?>"
                >
                <input
                    type="hidden"
                    id="zpwpcg-adm-picture-<?php echo $args['label_for']; ?>"
                    name="zpdevwpcg_option[<?php echo $args['label_for']; ?>]"
                    value="<?php echo isset( $img_url ) ? esc_attr( $img_url ) : $img_demo_url; ?>"
                >
                <?php
            }
           
            public function render_period() {
                printf(
                    '<p><label for="zpdevwpcg_option[period][label]">%s</label><input type="text" name="zpdevwpcg_option[period][label]" value="%s"></p>',
                    __( 'Label', TR_ID ),
                    isset( $this->options['period']['label'] ) ? esc_attr( $this->options['period']['label'] ) : __('Course period', TR_ID)
                );
                printf(
                    '<p><label for="zpdevwpcg_option[period][start]">%s</label><input type="text" name="zpdevwpcg_option[period][start]" value="%s"></p>',
                    __( 'Start', TR_ID ),
                    isset( $this->options['period']['start'] ) ? esc_attr( $this->options['period']['start'] ) : __('Course start', TR_ID)
                );
                printf(
                    '<p><label for="zpdevwpcg_option[period][finish]">%s</label><input type="text" name="zpdevwpcg_option[period][finish]" value="%s"/>',
                    __( 'Finish', TR_ID ),
                    isset( $this->options['period']['finish'] ) ? esc_attr( $this->options['period']['finish'] ) : __('Course finish', TR_ID)
                );
            }
            
            public function render_name() {
                printf(
                    '<label for="zpdevwpcg_option[name][label]">%s</label><input type="text" name="zpdevwpcg_option[name][label]" value="%s"">',
                    __( 'Label', TR_ID ),
                    isset( $this->options['name']['label'] ) ? esc_attr( $this->options['name']['label'] ) : __('Name', TR_ID),
                    __( 'Label', TR_ID )
                );
            }
            
            public function render_text() {
                printf(
                    '<p><label for="zpdevwpcg_option[text][after]">%s</label><textarea cols="40" rows="3" name="zpdevwpcg_option[text][after]">%s</textarea></p>',
                    __( 'After name text', TR_ID ),
                    isset( $this->options['text']['after'] ) ? esc_attr( $this->options['text']['after'] ) : ''
                );
                printf(
                    '<p><label for="zpdevwpcg_option[text][before]">%s</label><textarea cols="40" rows="3" name="zpdevwpcg_option[text][before]">%s</textarea></p>',
                    __( 'Before name text', TR_ID ),
                    isset( $this->options['text']['before'] ) ? esc_attr( $this->options['text']['before'] ) : ''
                );
                printf(
                    '<p><label for="zpdevwpcg_option[text][before_strong]">%s</label><textarea cols="40" rows="3" name="zpdevwpcg_option[text][before_strong]">%s</textarea></p>',
                    __( 'Before name strong text', TR_ID ),
                    isset( $this->options['text']['before_strong'] ) ? esc_attr( $this->options['text']['before_strong'] ) : ''
                );
            }
            
            public function render_level() {
                printf(
                    '<p><label for="zpdevwpcg_option[levels][label]">%s</label><input type="text" name="" value="%s" ></p>',
                    __( 'Label', TR_ID ),
                    isset( $this->options['levels']['label'] ) ? esc_attr( $this->options['levels']['label'] ) : __('Level', TR_ID)
                );
                
                $all_options = get_option( 'zpdevwpcg_option' );
                $options     = $all_options['levels']['list'];
                echo '<div class="zpwpcg-repeater__wrap"><ul id="tracks-repeatable" class="zpwpcg-adm-repeater">';
                if ( ! empty( $options ) ):
                    
                    $i = 1;
                    foreach ( $options as $option ):
                        //                    if ($this->options['levels']['list']['level-' . $i]['value'] !== null):
                        ?>
                        <li>
                            <input type="text"
                                   name="zpdevwpcg_option[levels][list][level-<?php echo $i; ?>][value]"
                                   placeholder="<?php echo __( 'Value', TR_ID ); ?>"
                                   value="<?php echo isset( $this->options['levels']['list'][ 'level-'.$i ]['value'] ) ?
                                           esc_attr( $this->options['levels']['list'][ 'level-'.$i ]['value'] ) : ''; ?>">
                            <input type="text"
                                   width="500"
                                   placeholder="<?php echo __( 'Description', TR_ID ); ?>"
                                   name="zpdevwpcg_option[levels][list][level-<?php echo $i; ?>][desc]"
                                   value="<?php echo isset( $this->options['levels']['list'][ 'level-'.$i ]['desc'] ) ? esc_attr( $this->options['levels']['list'][ 'level-'.$i ]['desc'] ) : ''; ?>">
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
                               placeholder="<?php echo __( 'Value', TR_ID ); ?>"
                               value="<?php echo isset( $this->options['levels']['list']['level-1']['value'] ) ? esc_attr( $this->options['levels']['list']['level-1']['value'] ) : ''; ?>">
                        <input type="text"
                               name="zpdevwpcg_option[levels][list][level-1][desc]"
                               placeholder="<?php echo __( 'Description', TR_ID ); ?>"
                               value="<?php echo isset( $this->options['levels']['list']['level-1']['desc'] ) ? esc_attr( $this->options['levels']['list']['level-1']['desc'] ) : ''; ?>">
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
                    isset( $this->options['hours']['label'] ) ? esc_attr( $this->options['hours']['label'] ) : __('Number of hours', TR_ID),
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
                    isset( $this->options['place']['label'] ) ? esc_attr( $this->options['place']['label'] ) : __('Place of Study', TR_ID),
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
                    isset( $this->options['date']['label'] ) ? esc_attr( $this->options['date']['label'] ) : __('Date of issue', TR_ID),
                    __( 'Label' )
                );
            }
            
            public function address_callback() {
                printf(
                    '<textarea cols="40" rows="4" id="address" name="zpdevwpcg_option[address]" placeholder="%s">%s</textarea>',
                    __( 'Address', TR_ID ),
                    isset( $this->options['address'] ) ? esc_attr( $this->options['address'] ) : ''
                );
            }
            
            public function director_callback() {
                printf(
                    '<input type="text" id="director_label" name="zpdevwpcg_option[director][label]" value="%s" placeholder="%s">',
                    isset( $this->options['director']['label'] ) ? esc_attr( $this->options['director']['label'] ) : '',
                    __( 'Label', TR_ID )
                );
                
                printf(
                    '<input type="text" id="director_value" name="zpdevwpcg_option[director][value]" value="%s" placeholder="%s">',
                    isset( $this->options['director']['value'] ) ? esc_attr( $this->options['director']['value'] ) : '',
                    __( 'Value', TR_ID )
                );
            }
            
        }
    }

    function ZPdevWPCG_Options() {
        return ZPdevWPCG_Options::instance();
    }

    $GLOBALS['ZPdevWPCG_Options'] = ZPdevWPCG_Options();
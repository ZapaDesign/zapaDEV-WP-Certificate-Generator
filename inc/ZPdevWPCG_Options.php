<?php

namespace ZPdevWPCG\Options;

class ZPdevWPCG_Options
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_panel_page' ) );
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_panel_settings_subpage' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_admin_panel_page() {
		// Add the menu item and page
		$page_title = 'zapaDEV WP Certificate Generator';
		$menu_title = 'ZPdev WPCG';
		$capability = 'manage_options';
		$slug = 'zpdevwpcg';
		$callback = array( $this, 'create_plugin_admin_panel_page' );
		$icon = 'dashicons-admin-plugins';
		$position = 100;

		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
	}

	/**
	 * Add options sub-page
	 */
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

	/**
	 * Options page callback
	 */
	public function create_plugin_admin_panel_page()
	{
		// Set class property
		$this->options = get_option( 'zpdevwpcg_option' );
		?>
        <div class="wrap">
            <h1><?php echo __('zapaDEV WP Certificate Generator', 'zapadev-wp-certificate-generator') ?></h1>
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

	public function create_plugin_admin_panel_settings_subpage()
	{
		// Set class property
		$this->options = get_option( 'zpdevwpcg_option' );
		?>
        <div class="wrap">
            <h1><?php echo __('Settings', 'zapadev-wp-certificate-generator') ?></h1>
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
                var_dump( get_option('zpdevwpcg_option') );
                echo '</pre>';
            ?>


        </div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init()
	{
		$option_group = 'zpdevwpcg_settings_option_group';
		$option_name  = 'zpdevwpcg_option';
		$args         = array( $this, 'sanitize' );

        register_setting( $option_group, $option_name,  $args );



		$id       = 'setting_section_body_main';
		$title    = __('Certificate Body Main', 'zapadev-wp-certificate-generator' );
		$callback = array( $this, 'print_section_info' );
		$page     = 'zpdevwpcg_settings';

		add_settings_section( $id, $title, $callback, $page );


		$id       = 'setting_section_body_grid';
		$title    = __('Certificate Body Grid', 'zapadev-wp-certificate-generator' );
		$callback = array( $this, 'print_section_info' );
		$page     = 'zpdevwpcg_settings';

		add_settings_section( $id, $title, $callback, $page );


		$id       = 'setting_section_footer';
        $title    = __('Certificate Footer', 'zapadev-wp-certificate-generator' );
        $callback = array( $this, 'print_section_footer' );
        $page     = 'zpdevwpcg_settings';

        add_settings_section( $id, $title, $callback, $page );



        $id       = 'hours';
        $title    = __( 'Number of hours','zapadev-wp-certificate-generator' );
        $callback = array( $this, 'hours_callback' );
        $page     = 'zpdevwpcg_settings';
        $section  = 'setting_section_body_grid';

		add_settings_field( $id, $title, $callback, $page, $section );



        $id       = 'director';
        $title    = __( 'Director','zapadev-wp-certificate-generator' );
        $callback = array( $this, 'director_callback' );
        $page     = 'zpdevwpcg_settings';
        $section  = 'setting_section_footer';

		add_settings_field( $id, $title, $callback, $page, $section );



		$id       = 'address';
		$title    = __( 'Address', 'zapadev-wp-certificate-generator' );
		$callback = array( $this, 'address_callback' );
		$page     = 'zpdevwpcg_settings';
		$section  = 'setting_section_footer';

		add_settings_field( $id, $title, $callback, $page, $section );
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input )
	{
		$new_input = array();
		if( isset( $input['hours'] ) )
			$new_input['hours'] = sanitize_text_field( $input['hours'] );

		if( isset( $input['director'] ) )
			$new_input['director'] = sanitize_text_field( $input['director'] );

		if( isset( $input['address'] ) )
			$new_input['address'] = sanitize_text_field( $input['address'] );

		return $new_input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_footer()
	{
		print __('Add Certificate Footer Data', 'zapadev-wp-certificate-generator');
	}

    /**
     * Get the settings option array and print one of its values
     */
    public function hours_callback()
    {
        printf(
            '<input type="text" id="hours" name="zpdevwpcg_option[hours]" value="%s" />',
            isset( $this->options['hours'] ) ? esc_attr( $this->options['hours']) : ''
        );
    }


	/**
	 * Get the settings option array and print one of its values
	 */
	public function director_callback()
	{
		printf(
			'<input type="text" id="director" name="zpdevwpcg_option[director]" value="%s" />',
			isset( $this->options['director'] ) ? esc_attr( $this->options['director']) : ''
		);
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function address_callback()
	{
		printf(
			'<textarea cols="40" rows="5" id="address" name="zpdevwpcg_option[address]">%s</textarea>',
			isset( $this->options['address'] ) ? esc_attr( $this->options['address']) : ''
		);
	}
}
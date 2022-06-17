<?php
    /**
     * @internal never define functions inside callbacks.
     * these functions could be run multiple times; this would result in a fatal error.
     */
    
    /**
     * custom option and settings
     */
    function zpdevwpcg_settings_init()
    {
        // Register a new setting for "zpdevwpcg" page.
        register_setting('zpdevwpcg', 'zpdevwpcg_options');
        
        // Register a new section in the "zpdevwpcg" page.
        add_settings_section(
            'zpdevwpcg_section_developers',
            __('The Matrix has you.', 'zpdevwpcg'), 'zpdevwpcg_section_developers_callback',
            'zpdevwpcg'
        );
        
        // Register a new field in the "zpdevwpcg_section_developers" section, inside the "zpdevwpcg" page.
        add_settings_field(
            'zpdevwpcg_field_director', // As of WP 4.6 this value is used only internally.
            // Use $args' label_for to populate the id inside the callback.
            __('Director', 'zpdevwpcg'),
            'zpdevwpcg_field_director_cb',
            'zpdevwpcg',
            'zpdevwpcg_section_developers',
            array(
                'label_for'             => 'zpdevwpcg_field_director',
                'class'                 => 'zpdevwpcg_row',
                'zpdevwpcg_custom_data' => 'custom',
            )
        );
    }
    
    /**
     * Register our zpdevwpcg_settings_init to the admin_init action hook.
     */
    add_action('admin_init', 'zpdevwpcg_settings_init');
    
    
    /**
     * Custom option and settings:
     *  - callback functions
     */
    
    
    /**
     * Developers section callback function.
     *
     * @param array $args The settings array, defining title, id, callback.
     */
    function zpdevwpcg_section_developers_callback($args)
    {
        ?>
        <p id="<?php
            echo esc_attr($args['id']); ?>"><?php
                esc_html_e('Follow the white rabbit.', 'zpdevwpcg'); ?></p>
        <?php
    }
    
    /**
     * Pill field callbakc function.
     *
     * WordPress has magic interaction with the following keys: label_for, class.
     * - the "label_for" key value is used for the "for" attribute of the <label>.
     * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
     * Note: you can add custom key value pairs to be used inside your callbacks.
     *
     * @param array $args
     */
    function zpdevwpcg_field_director_cb($args)
    {
        // Get the value of the setting we've registered with register_setting()
        $options = get_option('zpdevwpcg_options');
        ?>

        <input

            type="text">

        <select
            id="<?php
                echo esc_attr($args['label_for']); ?>"
            data-custom="<?php
                echo esc_attr($args['zpdevwpcg_custom_data']); ?>"
            name="zpdevwpcg_options[<?php
                echo esc_attr($args['label_for']); ?>]">
            <option value="red" <?php
                echo isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'red',
                    false)) : (''); ?>>
                <?php
                    esc_html_e('red pill', 'zpdevwpcg'); ?>
            </option>
            <option value="blue" <?php
                echo isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'blue',
                    false)) : (''); ?>>
                <?php
                    esc_html_e('blue pill', 'zpdevwpcg'); ?>
            </option>
        </select>
        <?php
    }
    
    /**
     * Add the top level menu page.
     */
    function zpdevwpcg_options_page()
    {
        add_menu_page(
            'zapaDEV WP Certificate Generator',
            'ZPdev WPCG',
            'manage_options',
            'zpdevwpcg',
            'zpdevwpcg_options_page_html'
        );
    }
    
    
    /**
     * Register our zpdevwpcg_options_page to the admin_menu action hook.
     */
    add_action('admin_menu', 'zpdevwpcg_options_page');
    
    
    /**
     * Top level menu callback function
     */
    function zpdevwpcg_options_page_html()
    {
        // check user capabilities
        if ( ! current_user_can('manage_options')) {
            return;
        }
        
        // add error/update messages
        
        // check if the user have submitted the settings
        // WordPress will add the "settings-updated" $_GET parameter to the url
        if (isset($_GET['settings-updated'])) {
            // add settings saved message with the class of "updated"
            add_settings_error('zpdevwpcg_messages', 'zpdevwpcg_message', __('Settings Saved', 'zpdevwpcg'), 'updated');
        }
        
        // show error/update messages
        settings_errors('zpdevwpcg_messages');
        ?>
        <div class="wrap">
            <h1><?php
                    echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                    // output security fields for the registered setting "zpdevwpcg"
                    settings_fields('zpdevwpcg');
                    // output setting sections and their fields
                    // (sections are registered for "zpdevwpcg", each field is registered to a specific section)
                    do_settings_sections('zpdevwpcg');
                    // output save settings button
                    submit_button('Save Settings');
                ?>
            </form>
            
            <?php
                echo '<pre>';
                var_dump(get_option('zpdevwpcg_options'));
                echo '</pre>';
            ?>
        </div>
        <?php
    }
    
    
    function zpdevwpcgs_options_page_html()
    {
        // check user capabilities
        if ( ! current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?php
                    echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                    // output security fields for the registered setting "zpdevwpcgs_options"
                    settings_fields('zpdevwpcgs_options');
                    // output setting sections and their fields
                    // (sections are registered for "zpdevwpcgs", each field is registered to a specific section)
                    do_settings_sections('zpdevwpcgs');
                    // output save settings button
                    submit_button(__('Save Settings', 'textdomain'));
                ?>
            </form>
        </div>
        <?php
    }
    
    function zpdevwpcgs_options_page()
    {
        add_submenu_page(
            'zpdevwpcg',
            'Settings',
            'Settings',
            'manage_options',
            'zpdevwpcg-settings',
            'zpdevwpcgs_options_page_html'
        );
    }
    
    add_action('admin_menu', 'zpdevwpcgs_options_page');
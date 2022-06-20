<?php

namespace ZPdevWPCG;

if ( ! class_exists('ZPdevWPCG_Options')) {

    class ZPdevWPCG_Options
    {
        /**
         * Holds the values to be used in the fields callbacks
         */
        private $options;

        use Instance;

        /**
         * Start up
         */
        public function __construct()
        {
            add_action('admin_menu', array($this, 'add_plugin_admin_panel_page'));
            add_action('admin_menu', array($this, 'add_plugin_admin_panel_settings_subpage'));
            add_action('admin_init', array($this, 'page_init'));
            //            add_action('admin_enqueue_scripts', array($this, 'load_scripts_admin'));

            add_action('admin_footer', array($this, 'load_scripts_admin'));
        }

        /**
         * Add options page
         */
        public function add_plugin_admin_panel_page()
        {
            // Add the menu item and page
            $page_title = 'zapaDEV WP Certificate Generator';
            $menu_title = 'ZPdev WPCG';
            $capability = 'manage_options';
            $slug       = 'zpdevwpcg';
            $callback   = array($this, 'create_plugin_admin_panel_page');
            $icon       = 'dashicons-admin-plugins';
            $position   = 100;

            add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
        }

        /**
         * Add options sub-page
         */
        public function add_plugin_admin_panel_settings_subpage()
        {
            // Add the menu item and page
            $parent_page = 'zpdevwpcg';
            $page_title  = 'Settings';
            $menu_title  = 'Settings';
            $capability  = 'manage_options';
            $slug        = 'zpdevwpcg_settings';
            $callback    = array($this, 'create_plugin_admin_panel_settings_subpage');

            add_submenu_page($parent_page, $page_title, $menu_title, $capability, $slug, $callback);
        }

        /**
         * Options page callback
         */
        public function create_plugin_admin_panel_page()
        {
            // Set class property
            $this->options = get_option('zpdevwpcg_option');
            ?>
            <div class="wrap">
                <h1><?php echo __('zapaDEV WP Certificate Generator', 'zapadev-wp-certificate-generator') ?></h1>
                <form method="post" action="options.php">
                    <?php
                    // This prints out all hidden setting fields
                    settings_fields('zpdevwpcg_option_group');
                    do_settings_sections('zpdevwpcg');
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
        }

        public function create_plugin_admin_panel_settings_subpage()
        {
            // Set class property
            $this->options = get_option('zpdevwpcg_option');
            ?>
            <div class="wrap">
                <h1><?php echo __('Settings', 'zapadev-wp-certificate-generator') ?></h1>
                <form method="post" action="options.php">
                    <?php
                    // This prints out all hidden setting fields
                    settings_fields('zpdevwpcg_settings_option_group');
                    do_settings_sections('zpdevwpcg_settings');
                    submit_button();
                    ?>
                </form>

                <?php
                echo '<pre>';
                var_dump(get_option('zpdevwpcg_option'));
                echo '</pre>';
                ?>


            </div>
            <?php
        }

        /**
         * Load scripts and style sheet for settings page
         */
        public function load_scripts_admin()
        {
            $options = get_option('zpdevwpcg_option');


            $my_saved_attachment_post_id = $options['img'] ? $options['img'] : 0;

            ?>
            <script type='text/javascript'>

                jQuery(document).ready(function ($) {

                    // Uploading files
                    var file_frame;
                    var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                    var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

                    jQuery('#upload_image_button').on('click', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame) {
                            // Set the post ID to what we want
                            file_frame.uploader.uploader.param('post_id', set_to_post_id);
                            // Open frame
                            file_frame.open();
                            return;
                        } else {
                            // Set the wp.media post id so the uploader grabs the ID we want when initialised
                            wp.media.model.settings.post.id = set_to_post_id;
                        }

                        // Create the media frame.
                        file_frame = wp.media.frames.file_frame = wp.media({
                            title: 'Select a image to upload',
                            button: {
                                text: 'Use this image',
                            },
                            multiple: false	// Set to true to allow multiple files to be selected
                        });

                        // When an image is selected, run a callback.
                        file_frame.on('select', function () {
                            // We set multiple to false so only get one image from the uploader
                            attachment = file_frame.state().get('selection').first().toJSON();

                            // Do something with attachment.id and/or attachment.url here
                            $('#image-preview').attr('src', attachment.url).css('width', 'auto');
                            $('#img').val(attachment.id);

                            // Restore the main post ID
                            wp.media.model.settings.post.id = wp_media_post_id;
                        });

                        // Finally, open the modal
                        file_frame.open();
                    });

                    // Restore the main ID when the add media button is pressed
                    jQuery('a.add_media').on('click', function () {
                        wp.media.model.settings.post.id = wp_media_post_id;
                    });
                });

            </script><?php
        }

        /**
         * Register and add settings
         */
        public function page_init()
        {
            $option_group = 'zpdevwpcg_settings_option_group';
            $option_name  = 'zpdevwpcg_option';
            $args         = array($this, 'sanitize');

            register_setting($option_group, $option_name, $args);


            $id       = 'setting_section_body_main';
            $title    = __('Certificate Body Main', 'zapadev-wp-certificate-generator');
            $callback = array($this, 'print_section_body_main_info');
            $page     = 'zpdevwpcg_settings';

            add_settings_section($id, $title, $callback, $page);


            $id       = 'img';
            $title    = __('Image', 'zapadev-wp-certificate-generator');
            $callback = array($this, 'img_callback');
            $page     = 'zpdevwpcg_settings';
            $section  = 'setting_section_body_main';

            add_settings_field($id, $title, $callback, $page, $section);


            $id       = 'setting_section_body_grid';
            $title    = __('Certificate Body Grid', 'zapadev-wp-certificate-generator');
            $callback = array($this, 'print_section_body_grid_info');
            $page     = 'zpdevwpcg_settings';

            add_settings_section($id, $title, $callback, $page);

                $id       = 'period';
                $title    = __('Field (Course dates)', 'zapadev-wp-certificate-generator');
                $callback = array($this, 'period_callback');
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';

                add_settings_field($id, $title, $callback, $page, $section);

                $id       = 'level';
                $title    = __('Field (Level)', 'zapadev-wp-certificate-generator');
                $callback = array($this, 'level_callback');
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';

                add_settings_field($id, $title, $callback, $page, $section);

                $id       = 'hours';
                $title    = __('Field (Number of hours)', 'zapadev-wp-certificate-generator');
                $callback = array($this, 'hours_callback');
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';

                add_settings_field($id, $title, $callback, $page, $section);

                $id       = 'place';
                $title    = __('Field (Place of Study)', 'zapadev-wp-certificate-generator');
                $callback = array($this, 'place_callback');
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';

                add_settings_field($id, $title, $callback, $page, $section);

                $id       = 'date';
                $title    = __('Field (Date of issue)', 'zapadev-wp-certificate-generator');
                $callback = array($this, 'date_callback');
                $page     = 'zpdevwpcg_settings';
                $section  = 'setting_section_body_grid';

                add_settings_field($id, $title, $callback, $page, $section);


            $id       = 'setting_section_footer';
            $title    = __('Certificate Footer', 'zapadev-wp-certificate-generator');
            $callback = array($this, 'print_section_footer');
            $page     = 'zpdevwpcg_settings';

            add_settings_section($id, $title, $callback, $page);

            $id       = 'director';
            $title    = __('Director', 'zapadev-wp-certificate-generator');
            $callback = array($this, 'director_callback');
            $page     = 'zpdevwpcg_settings';
            $section  = 'setting_section_footer';

            add_settings_field($id, $title, $callback, $page, $section);


            $id       = 'address';
            $title    = __('Address', 'zapadev-wp-certificate-generator');
            $callback = array($this, 'address_callback');
            $page     = 'zpdevwpcg_settings';
            $section  = 'setting_section_footer';

            add_settings_field($id, $title, $callback, $page, $section);
        }

        /**
         * Sanitize each setting field as needed
         *
         * @param array $input Contains all settings fields as array keys
         */
        public function sanitize($input)
        {
            $new_input = array();
            if (isset($input['period'])) {
                $new_input['period'] = sanitize_text_field($input['period']);
            }

            if (isset($input['level'])) {
                $new_input['level'] = sanitize_text_field($input['level']);
            }

            if (isset($input['hours'])) {
                $new_input['hours'] = sanitize_text_field($input['hours']);
            }

            if (isset($input['place'])) {
                $new_input['place'] = sanitize_text_field($input['place']);
            }
            if (isset($input['date'])) {
                $new_input['date'] = sanitize_text_field($input['date']);
            }

            if (isset($input['img'])) {
                $new_input['img'] = sanitize_text_field($input['img']);
            }

            if (isset($input['director'])) {
                $new_input['director'] = sanitize_text_field($input['director']);
            }

            if (isset($input['address'])) {
                $new_input['address'] = sanitize_text_field($input['address']);
            }

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
         * Print the Section text
         */
        public function print_section_body_main_info()
        {
            print __('Add Certificate body data', 'zapadev-wp-certificate-generator');
        }

        /**
         * Print the Section text
         */
        public function print_section_body_grid_info()
        {
            print __('Add Certificate body grid data', 'zapadev-wp-certificate-generator');
        }


        /**
         * Get the settings option array and print one of its values
         */
        public function img_callback()
        {

            echo '<div class="image-preview-wrapper"><img id="image-preview" src="' . wp_get_attachment_url($this->options['img']) . '" height="300"></div>';
            echo '<input id="upload_image_button" type="button" class="button" value="' . __('Upload image',
                    'zapadev-wp-certificate-generator') . '"/>';

            printf(
                '<input type="hidden" id="img" name="zpdevwpcg_option[img]" value="%s" />',
                isset($this->options['img']) ? esc_attr($this->options['img']) : ''
            );
        }

        public function period_callback()
        {
            printf(
                '<input type="text" id="period" name="zpdevwpcg_option[period]" value="%s" />',
                isset($this->options['period']) ? esc_attr($this->options['period']) : ''
            );
        }


        public function level_callback()
        {
            printf(
                '<input type="text" id="level" name="zpdevwpcg_option[level]" value="%s" />',
                isset($this->options['level']) ? esc_attr($this->options['level']) : ''
            );
        }

        public function hours_callback()
        {
            printf(
                '<input type="text" id="hours" name="zpdevwpcg_option[hours]" value="%s" />',
                isset($this->options['hours']) ? esc_attr($this->options['hours']) : ''
            );
        }

        public function place_callback()
        {
            printf(
                '<input type="text" id="place" name="zpdevwpcg_option[place]" value="%s" />',
                isset($this->options['place']) ? esc_attr($this->options['place']) : ''
            );
        }
        public function date_callback()
        {
            printf(
                '<input type="text" id="date" name="zpdevwpcg_option[date]" value="%s" />',
                isset($this->options['date']) ? esc_attr($this->options['date']) : ''
            );
        }

        public function director_callback()
        {
            printf(
                '<input type="text" id="director" name="zpdevwpcg_option[director]" value="%s" />',
                isset($this->options['director']) ? esc_attr($this->options['director']) : ''
            );
        }

        /**
         * Get the settings option array and print one of its values
         */
        public function address_callback()
        {
            printf(
                '<textarea cols="40" rows="5" id="address" name="zpdevwpcg_option[address]">%s</textarea>',
                isset($this->options['address']) ? esc_attr($this->options['address']) : ''
            );
        }
    }
}
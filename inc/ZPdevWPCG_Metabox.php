<?php

namespace ZPdevWPCG;

if ( ! class_exists('ZPdevWPCG_Metabox')) {

    final class my_metaboxes_init {
        static function get_instance() {
            static $instance = null;
            if ( is_null( $instance ) ) {
                $instance = new self();
                $instance->init();
            }
            return $instance;
        }

        private function __construct() {
        }

        function init() {
            add_action( 'admin_menu', array( $this, 'settings_menu' ) );
            add_action( 'load-toplevel_page_malcure', array( $this, 'load_meta_boxes' ) );
            add_action( 'load-toplevel_page_malcure', array( $this, 'add_meta_boxes' ) );
            add_action( 'load-toplevel_page_malcure', array( $this, 'add_admin_scripts' ) );
        }

        function settings_menu() {
            add_menu_page( 'My Plugin Settings', 'My Plugin Settings', 'manage_options', 'malcure', array( $this, 'settings_page' ), 'dashicons-chart-pie', 79 );
        }

        function load_meta_boxes() {
            add_action( 'add_meta_boxes', array( $this, 'my_plugin_metaboxes' ) );
        }

        function add_meta_boxes() {
            do_action( 'add_meta_boxes', 'toplevel_page_malcure', '' );
        }

        function add_admin_scripts() {
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'common' );
            wp_enqueue_script( 'wp-lists' );
            wp_enqueue_script( 'postbox' );
        }

        function settings_page() {
            ?>
            <div class="wrap">
                <h1 id="page_title">My Settings Page Heading</h1>
                <div id="poststuff">
                    <div class="metabox-holder columns-2" id="post-body">
                        <div class="postbox-container" id="post-body-content">
                            <?php do_meta_boxes( 'toplevel_page_malcure', 'main', null ); ?>
                        </div>
                        <!-- #postbox-container -->
                        <div id="postbox-container-1" class="postbox-container">
                            <?php
                            do_meta_boxes( 'toplevel_page_malcure', 'side', null );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                //<![CDATA[
                jQuery(document).ready(function($) {
                    // close postboxes that should be closed
                    $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                    // postboxes setup
                    postboxes.add_postbox_toggles('toplevel_page_malcure');
                });
                //]]>
            </script>
            <?php
        }

        function my_plugin_metaboxes() {
            add_meta_box( 'my_first_metabox', 'My First Metabox', array( $this, 'my_first_metabox_html' ), 'toplevel_page_malcure', 'main', 'high' );
            add_meta_box( 'my_second_metabox', 'My Second Metabox', array( $this, 'my_second_metabox_html' ), 'toplevel_page_malcure', 'side', 'high' );
        }

        function my_first_metabox_html() {
            ?>
            Howdy! I'm your first custom metabox. Now with some WordPress and PHP magic you can customize me as you like.
            <?php
        }

        function my_second_metabox_html() {
            ?>
            Meanwhile, I'll sit in the side. I'm your second custom metabox.
            <?php
        }

    }


    function my_metaboxes_init() {
        return my_metaboxes_init::get_instance();
    }
}

my_metaboxes_init();
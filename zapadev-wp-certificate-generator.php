<?php

/**
 * Plugin Name: zapaDEV Certificate Generator
 * Description:
 * Plugin URI:  https://dev-zapadesign.netlify.app/ru/aboutme
 * Version:     1.0.0
 * Author:      zapaDEV
 * Author URI:  https://dev-zapadesign.netlify.app/ru/aboutme
 * Text Domain: zapadev-certificate-generator.php
 */

namespace ZPdevWPCG;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'DIR_PATH', plugin_dir_path( __FILE__ ) );


/**
 * Main plugin class.
 *
 * @class    ZPdevWPCG
 * @version  1.0.0
 */

if ( ! class_exists( 'ZPdevWPCG' ) ) {
	class ZPdevWPCG
	{
		protected static $instance = null;

        /**
         * Main ZPdevWPCG instance.
         *
         * Ensures only one instance of ZPdevWPCG is loaded or can be loaded - @see 'ZPdevWPCG()'.
         *
         * @since  1.0.0
         *
         * @static
         * @return ZPdevWPCG - Main instance
         */
        public static function instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Contructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            // Entry point.
            add_action( 'plugins_loaded', array( $this, 'initialize_plugin' ), 9 );
        }


        /**
         * Plugin Initialization
         */
        public function initialize_plugin() {

            $this->includes();

            ZPdevWPCG_Options::instance();
            ZPdevWPCG_Shortcode::instance();
        }

        /**
         * Includes.
         */
        public function includes() {

            // Class containing WP Options page.
            require_once( 'inc/ZPdevWPCG_Options.php' );

            // Class Shortcode
            require_once( 'inc/ZPdevWPCG_Shortcode.php' );

        }
	}
}

/**
 * Returns the main instance of ZPdevWPCG to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return ZPdevWPCG
 */
function ZPdevWPCG() {
    return ZPdevWPCG::instance();
  }
  
  $GLOBALS[ 'ZPdevWPCG' ] = ZPdevWPCG();


/**
 * Plugin Scripts and Style
 */
//add_action('wp_enqueue_scripts', function () {
//	wp_enqueue_script( 'zapadev-wp-certificate-generator-js', plugins_url( '/assets/js/zpdev-wpcg.js', __FILE__ ), array('jquery'), false, true);
//	wp_enqueue_style( 'zapadev-wp-certificate-generator-style', plugins_url( '/assets/css/zapadev-wp-certificate-generator.css', __FILE__ ), null, null );
//});



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
        exit;
    }
    
    define( 'DIR_PATH', plugin_dir_path( __FILE__ ) );
    define( 'TR_ID', 'zapadev-wp-certificate-generator' );
    define( 'PREFIX', 'zpdevwpcg_' );
    
    trait Instance {
        protected static $instance = null;
        
        public static function instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            
            return self::$instance;
        }
    }
    
    if ( ! class_exists( 'ZPdevWPCG' ) ) {
        class ZPdevWPCG {
            use Instance;
            
            public function __construct() {
                add_action( 'plugins_loaded', array( $this, 'initialize_plugin' ), 9 );
            }
            
            public function plugin_url() {
                return plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) );
            }
            
            
            public function initialize_plugin() {
                $this->includes();
                
                ZPdevWPCG_Options::instance();
                ZPdevWPCG_Shortcode::instance();
                ZPdevWPCG_Certificate::instance();
            }
            
            public function includes() {
                require_once( 'inc/ZPdevWPCG_Options.php' );
                require_once( 'inc/ZPdevWPCG_Shortcode.php' );
                require_once( 'inc/ZPdevWPCG_Certificate.php' );
            }
        }
    }
    
    function ZPdevWPCG() {
        return ZPdevWPCG::instance();
    }
    
    $GLOBALS['ZPdevWPCG'] = ZPdevWPCG();
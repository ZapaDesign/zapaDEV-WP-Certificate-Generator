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
    
    define( 'PL_NAME', 'zapaDEV WP Cerificate Generator' );
    define( 'SHORT_PL_NAME', 'ZPdevWPCG' );
    define( 'DIR_PATH', plugin_dir_path( __FILE__ ) );
    define( 'TR_ID', 'zapadev-wp-certificate-generator' );
    define( 'PREFIX', 'zpdevwpcg_' );
    define( 'SHORTCODE', 'ZPdevWPCG' );
    
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
                ZPdevWPCG_AJAX::instance();
                ZPdevWPCG_Metabox::instance();
                
                add_action( 'init', array( $this, 'register_zpdevwpcg_certificat_post_type' ) );
                add_action( 'init', array( $this, 'register_zpdevwpcg_student_post_type' ) );
            }
            
            public function includes() {
               require_once( 'functions.php' );
                
                require_once( 'inc/class-ZPdevWPCG_Options.php' );
                require_once( 'inc/class-ZPdevWPCG_Shortcode.php' );
                require_once( 'inc/class-ZPdevWPCG_AJAX.php' );
                require_once( 'inc/class-ZPdevWPCG_Certificate.php' );
                require_once( 'inc/class-ZPdevWPCG_Student.php' );
                require_once( 'inc/class-ZPdevWPCG_Metabox.php' );
            }
            
            public function register_zpdevwpcg_certificat_post_type() {
                /**
                 * Post Type: ZPdevWPCG Certificates.
                 */
                
                $labels = [
                    "name"          => __( "ZPdevWPCG Certificates", TR_ID ),
                    "singular_name" => __( "ZPdevWPCG Certificate", TR_ID ),
                ];
                
                $args = [
                    "label"                 => __( "ZPdevWPCG Certificates", TR_ID ),
                    "labels"                => $labels,
                    "description"           => "",
                    "public"                => true,
                    "publicly_queryable"    => true,
                    "show_ui"               => true,
                    "show_in_rest"          => true,
                    "rest_base"             => "",
                    "rest_controller_class" => "WP_REST_Posts_Controller",
                    "rest_namespace"        => "wp/v2",
                    "has_archive"           => false,
                    "show_in_menu"          => true,
                    "show_in_nav_menus"     => true,
                    "delete_with_user"      => false,
                    "exclude_from_search"   => false,
                    "capability_type"       => "post",
                    "map_meta_cap"          => true,
                    "hierarchical"          => false,
                    "can_export"            => false,
                    "rewrite"               => [ "slug" => "zpdevwpcg_certificat", "with_front" => true ],
                    "query_var"             => true,
                    "menu_icon"             => "dashicons-text-page",
                    "show_in_graphql"       => false,
                ];
                
                register_post_type( "zpdevwpcg_certificat", $args );
            }
            
            public function register_zpdevwpcg_student_post_type() {
                /**
                 * Post Type: ZPdevWPCG Students.
                 */
                
                $labels = [
                    "name"          => __( SHORT_PL_NAME . " Students", TR_ID ),
                    "singular_name" => __( SHORT_PL_NAME . " Student", TR_ID ),
                ];
                
                $args = [
                    "label"                 => __( SHORT_PL_NAME . " Students", TR_ID ),
                    "labels"                => $labels,
                    "description"           => "",
                    "public"                => true,
                    "publicly_queryable"    => true,
                    "show_ui"               => true,
                    "show_in_rest"          => true,
                    "rest_base"             => "",
                    "rest_controller_class" => "WP_REST_Posts_Controller",
                    "rest_namespace"        => "wp/v2",
                    "has_archive"           => false,
                    "show_in_menu"          => true,
                    "show_in_nav_menus"     => true,
                    "delete_with_user"      => false,
                    "exclude_from_search"   => false,
                    "capability_type"       => "post",
                    "map_meta_cap"          => true,
                    "hierarchical"          => false,
                    "can_export"            => false,
                    "rewrite"               => [ "slug" => "zpdevwpcg_student", "with_front" => true ],
                    "query_var"             => true,
                    "menu_icon"             => "dashicons-admin-users",
                    "show_in_graphql"       => false,
                ];
                
                register_post_type( "zpdevwpcg_student", $args );
            }
            
        }
    }
    
    function ZPdevWPCG() {
        return ZPdevWPCG::instance();
    }
    
    $GLOBALS['ZPdevWPCG'] = ZPdevWPCG();
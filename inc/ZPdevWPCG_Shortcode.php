<?php
	
	namespace ZPdevWPCG;
	
	if ( ! class_exists( 'ZPdevWPCG_Shortcode' ) ) {
		class ZPdevWPCG_Shortcode {
			private $title;
			
			use Instance;
			
			public function __construct() {
			    
                // Front end scripts.
                add_action( 'wp_enqueue_scripts', array( $this, 'load_front_scripts' ) );
                
				add_shortcode( 'ZPdevWPCG', array( $this, 'render' ) );
			}
			
			public function render() {
				
				$content = '';
				ob_start();
				include_once( DIR_PATH . '/templates/template-front.php' );
				$content .= ob_get_clean();
				
				return $content;
			}
			
			public function load_front_scripts() {
			    
                $dependencies = array( 'jquery' );
                
                wp_register_script( 'zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/js/zpdev-wpcg-front.js', $dependencies, '1.0', true );
                wp_enqueue_script( 'zpdev-wpcg-front' );
                
                wp_register_style( 'zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/css/zpdev-wpcg-front.css', false, null, 'all' );
                wp_enqueue_style( 'zpdev-wpcg-front' );
				
			}
		}
	}
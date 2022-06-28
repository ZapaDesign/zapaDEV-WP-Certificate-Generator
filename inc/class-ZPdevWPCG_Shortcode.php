<?php
    
    namespace ZPdevWPCG;
    
    if ( ! class_exists( 'ZPdevWPCG_Shortcode' ) ) {
        class ZPdevWPCG_Shortcode {
            private $title;
            
            use Instance;
            
            public function __construct() {
                add_shortcode( SHORTCODE, array( $this, 'render' ) );
            }
            
            public function render() {
                // TODO Добавить продакшин скрипты и стили
                /*            if( WP_DEBUG ) {
                            
                            } else {
                
                            }*/
                
                wp_enqueue_script( 'zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/js/zpdev-wpcg-front.js', [ 'jquery' ], '1.0', true );
                wp_localize_script( 'zpdev-wpcg-front', 'flow', [
                    'url'   => admin_url( 'admin-ajax.php' ),
                    'nonce' => wp_create_nonce( PREFIX . '_nonce' )
                ] );
                wp_enqueue_style( 'zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/css/zpdev-wpcg-front.css', false, null, 'all' );
                
                $content = '';
                ob_start();
                include_once( DIR_PATH . '/templates/template-front.php' );
                $content .= ob_get_clean();
                
                return $content;
            }
        }
    }
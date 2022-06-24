<?php

namespace ZPdevWPCG;

if ( ! class_exists('ZPdevWPCG_Shortcode')) {
    class ZPdevWPCG_Shortcode
    {
        private $title;

        use Instance;

        public function __construct()
        {
            add_shortcode( SHORTCODE, array($this, 'render') );
        }

        public function render()
        {

/*            if( WP_DEBUG ) {
                wp_enqueue_script('select2', ZPdevWPCG()->plugin_url() . '/assets/js/libs/select2.js', ['jquery'], '4.0.13', true);
                wp_enqueue_style('select2', ZPdevWPCG()->plugin_url() . '/assets/css/libs/select2.css', false, '4.0.13', 'all');
            } else {
                wp_enqueue_script('select2', ZPdevWPCG()->plugin_url() . '/assets/js/libs/select2.min.js', ['jquery'], '4.0.13', true);
                wp_enqueue_style('select2', ZPdevWPCG()->plugin_url() . '/assets/css/libs/select2.css', false, '4.0.13', 'all');
            }*/
            wp_enqueue_script('zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/js/zpdev-wpcg-front.js', ['jquery'], '1.0', true);
            wp_enqueue_style('zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/css/zpdev-wpcg-front.css', false, null, 'all');

            $content = '';
            ob_start();
            include_once(DIR_PATH . '/templates/template-front.php');
            $content .= ob_get_clean();

            return $content;
        }
    }
}
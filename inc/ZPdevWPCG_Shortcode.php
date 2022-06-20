<?php

namespace ZPdevWPCG;

if ( ! class_exists('ZPdevWPCG_Shortcode')) {
    class ZPdevWPCG_Shortcode
    {
        private $title;

        use Instance;

        public function __construct()
        {
            add_shortcode('ZPdevWPCG', array($this, 'render'));
        }

        public function render()
        {

            if( WP_DEBUG ) {
                wp_enqueue_script( 'vue', 'https://cdn.jsdelivr.net/npm/vue@3.2.37/dist/vue.global.js', [], '3.2.37', true );
            } else {
                wp_enqueue_script( 'vue', 'https://cdn.jsdelivr.net/npm/vue@3.2.37/dist/vue.global.prod.js', [], '3.2.37', true );
            }
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
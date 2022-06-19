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
            $content = '';
            ob_start();
            include_once(DIR_PATH . '/templates/template-front.php');
            $content .= ob_get_clean();

            return $content;
        }
    }
}
<?php

namespace ZPdevWPCG;

if ( ! class_exists('Shortcode')) {
    class Shortcode
    {
        private $title;

        use Instance;

        public function __construct()
        {
            add_shortcode(SHORTCODE, array($this, 'render'));
        }

        public function render()
        {
            $last_certificate = wp_get_recent_posts( array( 'post_type' =>'zpdevwpcg_certificat', 'posts_per_page' => 1 ) );
            $last_certificate_id = $last_certificate ? get_cert_id_number($last_certificate[0]['post_title']) + 1 : '1';

            wp_enqueue_script('zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/js/zpdev-wpcg-front.js', ['jquery'], '1.0', true);
            wp_localize_script('zpdev-wpcg-front', 'flow', [
                'url'     => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce(PREFIX . '_nonce'),
                'options' => json_encode(get_option(PREFIX.'option')),
                'lastCertID' => $last_certificate_id
                ]);
            wp_enqueue_style('zpdev-wpcg-front', ZPdevWPCG()->plugin_url() . '/assets/css/zpdev-wpcg-front.css', false, null, 'all');

            $content = '';
            ob_start();
            include_once(DIR_PATH . '/templates/template-front.php');
            $content .= ob_get_clean();

            return $content;
        }
    }
}

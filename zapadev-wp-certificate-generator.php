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

if ( ! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('DIR_PATH', plugin_dir_path(__FILE__));

trait Instance
{
    protected static $instance = null;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

if ( ! class_exists('ZPdevWPCG')) {
    class ZPdevWPCG
    {
        use Instance;

        public function __construct()
        {
            add_action('plugins_loaded', array($this, 'initialize_plugin'), 9);
        }

        public function initialize_plugin()
        {
            $this->includes();

            ZPdevWPCG_Options::instance();
            ZPdevWPCG_Shortcode::instance();
        }

        public function includes()
        {
            require_once('inc/ZPdevWPCG_Options.php');
            require_once('inc/ZPdevWPCG_Shortcode.php');
        }
    }
}

function ZPdevWPCG()
{
    return ZPdevWPCG::instance();
}

$GLOBALS['ZPdevWPCG'] = ZPdevWPCG();


/**
 * Plugin Scripts and Style
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('zapadev-wp-certificate-generator-js', plugins_url('/assets/js/zpdev-wpcg.js', __FILE__),
        array('jquery'), false, true);
    wp_enqueue_style('zapadev-wp-certificate-generator-style', plugins_url('/assets/css/zpdev-wpcg.css', __FILE__),
        null, null);
});

<?php

/**
 * Plugin Name: zapaDEV Certificate Generator
 * Description:
 * Plugin URI:  https://dev-zapadesign.netlify.app/ru/aboutme
 * Version:     1.0.0
 * Author:      zapaDEV
 * Author URI:  https://dev-zapadesign.netlify.app/ru/aboutme
 * Text Domain: zapadev-certificate-generator.php
 *
 */
namespace ZPdevWPCG;
use ZPdevWPCG\Options\ZPdevWPCG_Options;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Scripts and Style
 */
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script( 'zapadev-wp-certificate-generator-js', plugins_url( '/assets/js/zpdev-wpcg.js', __FILE__ ), array('jquery'), false, true);
	wp_enqueue_style( 'zapadev-wp-certificate-generator-style', plugins_url( '/assets/css/zapadev-wp-certificate-generator.css', __FILE__ ), null, null );
});


/**
 * Plugin AdminPanel Options Page
 */

include( plugin_dir_path( __FILE__ ) . '/inc/ZPdevWPCG.php');
include( plugin_dir_path( __FILE__ ) . '/inc/ZPdevWPCG_Options.php');

new ZPdevWPCG_Options();
new ZPdevWPCG();

//add_shortcode( 'ZPdevWPCG', 'add_plugin_shortcode' );
//
//function add_plugin_shortcode() {
//    $content = 'zapaDEV WP Certificate Generator Shortcode';
//    return $content;
//}




/**
 * Plugin AdminPanel Options Page
 */
//include( plugin_dir_path( __FILE__ ) . 'inc/options-page.php');



<?php

namespace ZPdevWPCG;

class ZPdevWPCG
{
    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_admin_panel_page' ) );
        add_shortcode( 'ZPdevWPCG', array( $this, 'add_shortcode' ) );
    }


    public function add_shortcode() {
        return 'zapaDEV WP Certificate Generator Shortcode';
    }
}
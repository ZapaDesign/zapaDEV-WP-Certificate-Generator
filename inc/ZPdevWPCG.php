<?php

namespace ZPdevWPCG;

class ZPdevWPCG
{
    /**
     * Start up
     */
    public function __construct()
    {
        add_shortcode( 'ZPdevWPCG', array( $this, 'add_plugin_shortcode' ) );
    }


    public function add_plugin_shortcode() {

        $content = 'zapaDEV WP Certificate Generator Shortcode';

        return $content;
    }
}
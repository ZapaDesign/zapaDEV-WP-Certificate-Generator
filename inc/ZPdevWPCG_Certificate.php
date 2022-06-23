<?php
    
namespace ZPdevWPCG;

if ( ! class_exists( 'ZPdevWPCG_Certificate' ) ) {
    class ZPdevWPCG_Certificate {
        
        use Instance;
        
        private $id = 0;
        
        private $student = '';
        
        private $period = [];
        private $level = [];
        private $hours = 0;
        private $place = '0';
        private $date = '';
        
        public function __construct($id, $student, $period, $level, $hours, $place, $date) {
            $this->id = $id;
            $this->student = $student;
            $this->period = $period;
            $this->level = $level;
            $this->hours = $hours;
            $this->place = $place;
            $this->date = $date;
            
            add_action( 'init', array($this, 'register_certificate_post_type' ));
        }
        
        public function register_certificate_post_type() {
    
            $labels = [
                "name" => __( "Certificates", "storefront" ),
                "singular_name" => __( "Certificate", "storefront" ),
            ];

            $args = [
                "label" => __( "Certificates", "storefront" ),
                "labels" => $labels,
                "description" => "Certificate post type",
                "public" => false,
                "publicly_queryable" => false,
                "show_ui" => true,
                "show_in_rest" => true,
                "rest_base" => "",
                "rest_controller_class" => "WP_REST_Posts_Controller",
                "rest_namespace" => "wp/v2",
                "has_archive" => false,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "delete_with_user" => false,
                "exclude_from_search" => false,
                "capability_type" => "post",
                "map_meta_cap" => true,
                "hierarchical" => false,
                "can_export" => false,
                "rewrite" => [ "slug" => "certificate", "with_front" => false ],
                "query_var" => true,
                "show_in_graphql" => false,
            ];

            register_post_type( "certificate", $args );
        }
        
        public function __get( $name ) {
            // TODO: Implement __get() method.
        }
    
        public function __set( $name, $value ) {
            // TODO: Implement __set() method.
        }
    }
}
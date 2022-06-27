<?php
    
    namespace ZPdevWPCG;
    
    class ZPdevWPCG_AJAX {
    
        use Instance;
        
        public function __construct() {
            add_action( 'wp_ajax_add_certificate', array( $this, 'add_certificate' ) );
            add_action( 'wp_ajax_nopriv_add_certificate', array( $this, 'add_certificate') );
        }
        
        public function add_certificate() {
    
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';
            
            
            $certificate_data = array(
                'post_title'    => $_POST['id'],
                'post_status'   => 'publish',
                'post_type'     => 'zpdevwpcg_certificat'
            );
    
            $post_id = wp_insert_post( wp_slash($certificate_data) );

            wp_die();
        }
    }
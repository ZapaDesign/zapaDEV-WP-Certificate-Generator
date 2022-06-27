<?php
    
    namespace ZPdevWPCG;
    
    class ZPdevWPCG_AJAX {
        
        use Instance;
        
        public function __construct() {
            add_action( 'wp_ajax_add_certificate', array( $this, 'add_certificate' ) );
            add_action( 'wp_ajax_nopriv_add_certificate', array( $this, 'add_certificate' ) );
        }
        
        public function add_certificate() {
            $id      = $_POST['id'];
            $st_name = $_POST['name'];
            $period  = array($_POST['start'], $_POST['finish']);
            $level   = $_POST['level'];
            $hours   = $_POST['hours'];
            $place   = $_POST['place'];
            $date    = $_POST['date'];
            
            $certificate = new ZPdevWPCG_Certificate($id, $st_name, $period, $level, $hours, $place, $date );
            $certificate->set();
            
            wp_die();
        }
    }
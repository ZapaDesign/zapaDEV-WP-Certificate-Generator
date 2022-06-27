<?php
    
    namespace ZPdevWPCG;
    
    if ( ! class_exists( 'ZPdevWPCG_Certificate' ) ) {
        class ZPdevWPCG_Certificate {
            
            private $id;
            
            private $student;
            
            private $st_name;
            private $period;
            private $level;
            private $hours;
            private $place;
            private $date;
            
            public function __construct( $id, $st_name, $period, $level, $hours, $place, $date ) {
                $this->id      = $id;
                $this->st_name = $st_name;
                $this->period  = $period;
                $this->level   = $level;
                $this->hours   = $hours;
                $this->place   = $place;
                $this->date    = $date;
            }
            
            public function get( $id ) {
                // TODO: Implement get() method.
            }
            

            public function set() {
    
                $data_st = array(
                    'post_title'  => $this->st_name,
                    'post_status' => 'publish',
                    'post_type'   => 'zpdevwpcg_student'
                );
    
                $st_post_id = wp_insert_post( wp_slash( $data_st ) );
                
                
                
                $data = array(
                    'post_title'  => $this->id,
                    'post_status' => 'publish',
                    'post_type'   => 'zpdevwpcg_certificat'
                );
                
                $cert_post_id = wp_insert_post( wp_slash( $data ) );
                
                
            }
        }
    }
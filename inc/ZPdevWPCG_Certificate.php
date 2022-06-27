<?php
    
namespace ZPdevWPCG;

if ( ! class_exists( 'ZPdevWPCG_Certificate' ) ) {
    class ZPdevWPCG_Certificate {
        
        private $id;
        
        private $student;
        
        private $period;
        private $level;
        private $hours;
        private $place;
        private $date;
        
        public function __construct( $id,  $student,  $period,  $level,  $hours,  $place,  $date) {
            $this->id = $id;
            $this->student = $student;
            $this->period = $period;
            $this->level = $level;
            $this->hours = $hours;
            $this->place = $place;
            $this->date = $date;
        }
        
        public function get( $id ) {
            // TODO: Implement get() method.
        }
    
        public function set() {
    
            $certificate_data = array(
                'post_title'  => $this->id,
                'post_status' => 'publish',
                'post_type'   => 'zpdevwpcg_certificat'
            );

            wp_insert_post( wp_slash( $certificate_data ) );
        }
    
        public function set_student() {
        
            $certificate_data = array(
                'post_title'  => $this->student,
                'post_status' => 'publish',
                'post_type'   => 'zpdevwpcg_student'
            );
        
            wp_insert_post( wp_slash( $certificate_data ) );
        }
    }
}
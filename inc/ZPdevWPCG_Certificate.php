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
        
        public function get( $name ) {
            // TODO: Implement get() method.
        }
    
        public function set( $name, $value ) {
            // TODO: Implement set() method.
        }
    }
}
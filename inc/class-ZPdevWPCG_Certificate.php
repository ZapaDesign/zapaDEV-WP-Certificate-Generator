<?php
    
    namespace ZPdevWPCG;
    
    if ( ! class_exists( 'ZPdevWPCG_Certificate' ) ) {
        class ZPdevWPCG_Certificate {
            
            private $id;

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
            
            public function set() {

                $student = new ZPdevWPCG_Student($this->st_name);
                
                $data = array(
                    'post_title'  => $this->id,
                    'post_status' => 'publish',
                    'post_type'   => 'zpdevwpcg_certificat'
                );
                
                $cert_post_id = wp_insert_post( wp_slash( $data ) );
                
                add_post_meta( $cert_post_id, 'certificate_data', array(
                    'student' => $student->get_student_post_id(),
                    'start'   => $this->period['start'],
                    'finish'  => $this->period['finish'],
                    'level'   => $this->level,
                    'hours'   => $this->hours,
                    'place'   => $this->place,
                    'date'    => $this->date,
                ), true );
            }
        }
    }
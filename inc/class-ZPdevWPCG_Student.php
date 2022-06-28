<?php
    
    namespace ZPdevWPCG;
    
    class ZPdevWPCG_Student {
        
        private $name;
        private $st_post_id;
        
        public function __construct($name, $st_post_id = '') {
            
            $this->name = $name;
            
            // TODO Добавить проверку на существование юзера
            $data_st = array(
                'post_title'  => $this->name,
                'post_status' => 'publish',
                'post_type'   => 'zpdevwpcg_student'
            );
    
            // TODO Добавить: если студент уже есть
            if(get_page_by_title($this->name, 'OBJECT ','zpdevwpcg_student') == null) {
                $st_post_id = wp_insert_post( wp_slash( $data_st ) );
                $this->st_post_id = $st_post_id;
            }
        }
        
        public function get_student_post_id() {
            return $this->st_post_id;
        }
    }
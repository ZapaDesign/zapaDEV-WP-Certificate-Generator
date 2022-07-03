<?php

namespace ZPdevWPCG;

class Student
{

    private $name;
    private $id;

    public function __construct($name, $id = '')
    {

        $this->name = $name;

        $data_st = array(
            'post_title'  => $this->name,
            'post_status' => 'publish',
            'post_type'   => 'zpdevwpcg_student'
        );

        if (get_page_by_title($this->name, 'OBJECT ', 'zpdevwpcg_student') == null) {
            $id       = wp_insert_post(wp_slash($data_st));
            $this->id = $id;
        } else {
            $st_obj = get_page_by_title($this->name, 'OBJECT ', 'zpdevwpcg_student');
            $this->id = $st_obj->ID;
        }
    }

    public function get_id()
    {
        return $this->id;
    }
}
<?php
    
    namespace ZPdevWPCG;
    
    class ZPdevWPCG_Control {
        
        public $field;
        public $args;
        
        public $x_position = 0;
        public $y_position = 0;
        public $align = 'center';
        public $font_size = 32;
        public $font_weight = 400;
        
        public function __construct( $field, $x_position, $y_position, $align, $font_size, $font_weight ) {
            $this->field       = $field;
            $this->x_position  = $x_position;
            $this->y_position  = $y_position;
            $this->align       = $align;
            $this->font_size   = $font_size;
            $this->font_weight = $font_weight;
        }
        
        public function render( ...$params ) {
        }
    }
<?php
    
    namespace ZPdevWPCG;
    
    class ZPdevWPCG_Metabox {
        
        use Instance;
        
        public function __construct() {
            add_action('add_meta_boxes', array( $this, 'add_meta_box' ) );
        }
        
        public function add_meta_box() {
            add_meta_box(
                PREFIX.'meta_box',
                'Certificate data',
                array( $this, 'meta_box_callback' ),
                'zpdevwpcg_certificat',
            );
        }
        
        public function meta_box_callback( $post, $meta ) {
            
            $post_meta = get_post_meta( $post->ID, 'certificate_data');
            echo '<ul>';
            echo '<li><span>Student: </span><b>' . get_the_title($post_meta[0]['student']) . '</b></li>';
            echo '<li><span>Course period: </span><sapn><b>' . $post_meta[0]['start'] . '</b></sapn> - <span><b>' . $post_meta[0]['start'] . '</b></span></li>';
            echo '<li><span>Level: </span><b>' . $post_meta[0]['level'] . '</b></li>';
            echo '<li><span>Number of hours: </span><b>' . $post_meta[0]['hours'] . '</b></li>';
            echo '<li><span>Place of Study: </span><b>' . $post_meta[0]['place'] . '</b></li>';
            echo '<li><span>Date of issue: </span><b>' . $post_meta[0]['date'] . '</b></li>';
            echo '</ul>';
        }
    }